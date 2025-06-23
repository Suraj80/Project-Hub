<?php
// ajax/product_action.php
header('Content-Type: application/json');

// Database connection
$host = 'localhost';
$dbname = 'project_hub';
$username = 'suraj';
$password = 'Suraj@123';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $e->getMessage()]);
    exit;
}

// Get the action from POST data
$action = $_POST['action'] ?? '';

switch ($action) {
    case 'fetch':
        fetchProducts();
        break;
    case 'add':
        addProduct();
        break;
    case 'update':
        updateProduct();
        break;
    case 'delete':
        deleteProduct();
        break;
    case 'get':
        getProduct();
        break;
    case 'getCategories':
        getCategories();
        break;
    case 'getTechnologies':
        getTechnologies();
        break;
    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
        break;
}

function fetchProducts() {
    global $pdo;
    
    try {
        // Get filter parameters
        $search = $_POST['search'] ?? '';
        $category = $_POST['category'] ?? '';
        $difficulty = $_POST['difficulty'] ?? '';
        $featured = $_POST['featured'] ?? '';
        $priceRange = $_POST['priceRange'] ?? '';
        $page = intval($_POST['page'] ?? 1);
        $limit = intval($_POST['limit'] ?? 10);
        $offset = ($page - 1) * $limit;

        // Base query
        $whereConditions = [];
        $params = [];

        // Search condition
        if (!empty($search)) {
            $whereConditions[] = "(p.name LIKE :search OR p.category LIKE :search OR p.description LIKE :search OR pt.technology LIKE :search)";
            $params[':search'] = '%' . $search . '%';
        }

        // Category filter
        if (!empty($category)) {
            $whereConditions[] = "p.category = :category";
            $params[':category'] = $category;
        }

        // Difficulty filter
        if (!empty($difficulty)) {
            $whereConditions[] = "p.difficulty = :difficulty";
            $params[':difficulty'] = $difficulty;
        }

        // Featured filter
        if ($featured !== '') {
            $whereConditions[] = "p.featured = :featured";
            $params[':featured'] = intval($featured);
        }

        // Price range filter
        if (!empty($priceRange)) {
            switch ($priceRange) {
                case '0-50':
                    $whereConditions[] = "p.price BETWEEN 0 AND 50";
                    break;
                case '51-100':
                    $whereConditions[] = "p.price BETWEEN 51 AND 100";
                    break;
                case '101-200':
                    $whereConditions[] = "p.price BETWEEN 101 AND 200";
                    break;
                case '201-500':
                    $whereConditions[] = "p.price BETWEEN 201 AND 500";
                    break;
                case '500+':
                    $whereConditions[] = "p.price > 500";
                    break;
            }
        }

        $whereClause = !empty($whereConditions) ? 'WHERE ' . implode(' AND ', $whereConditions) : '';

        // Count total records
        $countQuery = "
            SELECT COUNT(DISTINCT p.id) as total
            FROM products p
            LEFT JOIN product_technologies pt ON p.id = pt.product_id
            $whereClause
        ";
        
        $countStmt = $pdo->prepare($countQuery);
        $countStmt->execute($params);
        $totalCount = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];

        // Fetch products with technologies
        $query = "
            SELECT DISTINCT p.*, 
                   GROUP_CONCAT(pt.technology) as technologies
            FROM products p
            LEFT JOIN product_technologies pt ON p.id = pt.product_id
            $whereClause
            GROUP BY p.id
            ORDER BY p.created_at DESC
            LIMIT :limit OFFSET :offset
        ";

        $stmt = $pdo->prepare($query);
        
        // Bind parameters
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Process products data
        foreach ($products as &$product) {
            $product['technologies'] = $product['technologies'] ? explode(',', $product['technologies']) : [];
            $product['featured'] = (bool)$product['featured'];
            $product['rating'] = $product['rating'] ? (float)$product['rating'] : null;
            $product['price'] = (float)$product['price'];
        }

        echo json_encode([
            'success' => true,
            'data' => $products,
            'total' => intval($totalCount),
            'page' => $page,
            'limit' => $limit
        ]);

    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error fetching products: ' . $e->getMessage()]);
    }
}

function addProduct() {
    global $pdo;
    
    try {
        $pdo->beginTransaction();

        // Validate required fields
        if (empty($_POST['productName']) || empty($_POST['productCategory']) || empty($_POST['productPrice']) || empty($_POST['productDifficulty'])) {
            throw new Exception('Please fill all required fields');
        }

        // Handle image upload
        $imagePath = null;
        if (isset($_FILES['productImage']) && $_FILES['productImage']['error'] === UPLOAD_ERR_OK) {
            $imagePath = handleImageUpload($_FILES['productImage']);
            if (!$imagePath) {
                throw new Exception('Image upload failed');
            }
        }

        // Insert product
        $query = "
            INSERT INTO products (name, category, price, difficulty, rating, duration, description, image, featured)
            VALUES (:name, :category, :price, :difficulty, :rating, :duration, :description, :image, :featured)
        ";

        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ':name' => trim($_POST['productName']),
            ':category' => trim($_POST['productCategory']),
            ':price' => floatval($_POST['productPrice']),
            ':difficulty' => trim($_POST['productDifficulty']),
            ':rating' => !empty($_POST['productRating']) ? floatval($_POST['productRating']) : null,
            ':duration' => !empty($_POST['productDuration']) ? trim($_POST['productDuration']) : null,
            ':description' => !empty($_POST['productDescription']) ? trim($_POST['productDescription']) : null,
            ':image' => $imagePath,
            ':featured' => isset($_POST['productFeatured']) ? 1 : 0
        ]);

        $productId = $pdo->lastInsertId();

        // Insert technologies
        if (isset($_POST['technologies']) && is_array($_POST['technologies'])) {
            $techQuery = "INSERT INTO product_technologies (product_id, technology) VALUES (:product_id, :technology)";
            $techStmt = $pdo->prepare($techQuery);
            
            foreach ($_POST['technologies'] as $technology) {
                $technology = trim($technology);
                if (!empty($technology)) {
                    $techStmt->execute([
                        ':product_id' => $productId,
                        ':technology' => $technology
                    ]);
                }
            }
        }

        $pdo->commit();
        echo json_encode(['success' => true, 'message' => 'Product added successfully']);

    } catch (Exception $e) {
        $pdo->rollBack();
        echo json_encode(['success' => false, 'message' => 'Error adding product: ' . $e->getMessage()]);
    }
}

function updateProduct() {
    global $pdo;
    
    try {
        $pdo->beginTransaction();

        $productId = intval($_POST['productId']);
        
        if (!$productId) {
            throw new Exception('Invalid product ID');
        }

        // Validate required fields
        if (empty($_POST['productName']) || empty($_POST['productCategory']) || empty($_POST['productPrice']) || empty($_POST['productDifficulty'])) {
            throw new Exception('Please fill all required fields');
        }
        
        // Get current product data
        $currentStmt = $pdo->prepare("SELECT image FROM products WHERE id = :id");
        $currentStmt->execute([':id' => $productId]);
        $currentProduct = $currentStmt->fetch(PDO::FETCH_ASSOC);

        if (!$currentProduct) {
            throw new Exception('Product not found');
        }

        // Handle image upload
        $imagePath = $currentProduct['image']; // Keep current image by default
        if (isset($_FILES['productImage']) && $_FILES['productImage']['error'] === UPLOAD_ERR_OK) {
            $newImagePath = handleImageUpload($_FILES['productImage']);
            if ($newImagePath) {
                // Delete old image if it exists
                if ($currentProduct['image'] && file_exists($currentProduct['image'])) {
                    unlink($currentProduct['image']);
                }
                $imagePath = $newImagePath;
            }
        }

        // Update product
        $query = "
            UPDATE products 
            SET name = :name, category = :category, price = :price, difficulty = :difficulty, 
                rating = :rating, duration = :duration, description = :description, 
                image = :image, featured = :featured, updated_at = CURRENT_TIMESTAMP
            WHERE id = :id
        ";

        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ':id' => $productId,
            ':name' => trim($_POST['productName']),
            ':category' => trim($_POST['productCategory']),
            ':price' => floatval($_POST['productPrice']),
            ':difficulty' => trim($_POST['productDifficulty']),
            ':rating' => !empty($_POST['productRating']) ? floatval($_POST['productRating']) : null,
            ':duration' => !empty($_POST['productDuration']) ? trim($_POST['productDuration']) : null,
            ':description' => !empty($_POST['productDescription']) ? trim($_POST['productDescription']) : null,
            ':image' => $imagePath,
            ':featured' => isset($_POST['productFeatured']) ? 1 : 0
        ]);

       // Delete existing technologies
        $deleteStmt = $pdo->prepare("DELETE FROM product_technologies WHERE product_id = :product_id");
        $deleteStmt->execute([':product_id' => $productId]);

        // Insert updated technologies
        if (isset($_POST['technologies']) && is_array($_POST['technologies'])) {
            $techQuery = "INSERT INTO product_technologies (product_id, technology) VALUES (:product_id, :technology)";
            $techStmt = $pdo->prepare($techQuery);
            
            foreach ($_POST['technologies'] as $technology) {
                $technology = trim($technology);
                if (!empty($technology)) {
                    $techStmt->execute([
                        ':product_id' => $productId,
                        ':technology' => $technology
                    ]);
                }
            }
        }

        $pdo->commit();
        echo json_encode(['success' => true, 'message' => 'Product updated successfully']);

    } catch (Exception $e) {
        $pdo->rollBack();
        echo json_encode(['success' => false, 'message' => 'Error updating product: ' . $e->getMessage()]);
    }
}

function deleteProduct() {
    global $pdo;
    
    try {
        $productId = intval($_POST['productId']);
        
        if (!$productId) {
            throw new Exception('Invalid product ID');
        }

        $pdo->beginTransaction();

        // Get product image path before deletion
        $stmt = $pdo->prepare("SELECT image FROM products WHERE id = :id");
        $stmt->execute([':id' => $productId]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            throw new Exception('Product not found');
        }

        // Delete technologies first (foreign key constraint)
        $deleteTechStmt = $pdo->prepare("DELETE FROM product_technologies WHERE product_id = :product_id");
        $deleteTechStmt->execute([':product_id' => $productId]);

        // Delete product
        $deleteStmt = $pdo->prepare("DELETE FROM products WHERE id = :id");
        $deleteStmt->execute([':id' => $productId]);

        // Delete image file if it exists
        if ($product['image'] && file_exists($product['image'])) {
            unlink($product['image']);
        }

        $pdo->commit();
        echo json_encode(['success' => true, 'message' => 'Product deleted successfully']);

    } catch (Exception $e) {
        $pdo->rollBack();
        echo json_encode(['success' => false, 'message' => 'Error deleting product: ' . $e->getMessage()]);
    }
}

function getProduct() {
    global $pdo;
    
    try {
        $productId = intval($_POST['productId']);
        
        if (!$productId) {
            throw new Exception('Invalid product ID');
        }

        // Fetch product with technologies
        $query = "
            SELECT p.*, 
                   GROUP_CONCAT(pt.technology) as technologies
            FROM products p
            LEFT JOIN product_technologies pt ON p.id = pt.product_id
            WHERE p.id = :id
            GROUP BY p.id
        ";

        $stmt = $pdo->prepare($query);
        $stmt->execute([':id' => $productId]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            throw new Exception('Product not found');
        }

        // Process product data
        $product['technologies'] = $product['technologies'] ? explode(',', $product['technologies']) : [];
        $product['featured'] = (bool)$product['featured'];
        $product['rating'] = $product['rating'] ? (float)$product['rating'] : null;
        $product['price'] = (float)$product['price'];

        echo json_encode(['success' => true, 'data' => $product]);

    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error fetching product: ' . $e->getMessage()]);
    }
}

function getCategories() {
    global $pdo;
    
    try {
        $query = "SELECT DISTINCT category FROM products WHERE category IS NOT NULL AND category != '' ORDER BY category";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $categories = $stmt->fetchAll(PDO::FETCH_COLUMN);

        echo json_encode(['success' => true, 'data' => $categories]);

    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error fetching categories: ' . $e->getMessage()]);
    }
}

function getTechnologies() {
    global $pdo;
    
    try {
        $query = "SELECT DISTINCT technology FROM product_technologies WHERE technology IS NOT NULL AND technology != '' ORDER BY technology";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $technologies = $stmt->fetchAll(PDO::FETCH_COLUMN);

        echo json_encode(['success' => true, 'data' => $technologies]);

    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error fetching technologies: ' . $e->getMessage()]);
    }
}

function handleImageUpload($file) {
    // Define upload directory
    $uploadDir = 'uploads/';
    
    // Create directory if it doesn't exist
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    // Validate file type
    $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
    if (!in_array($file['type'], $allowedTypes)) {
        throw new Exception('Invalid file type. Only JPEG, PNG, GIF, and WebP images are allowed.');
    }

    // Validate file size (5MB max)
    $maxSize = 5 * 1024 * 1024; // 5MB
    if ($file['size'] > $maxSize) {
        throw new Exception('File size too large. Maximum size is 5MB.');
    }

    // Generate unique filename
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = uniqid('product_') . '.' . $extension;
    $filepath = $uploadDir . $filename;

    // Move uploaded file
    if (move_uploaded_file($file['tmp_name'], $filepath)) {
        return $filepath;
    } else {
        throw new Exception('Failed to move uploaded file.');
    }
}

// Additional utility functions
function sanitizeInput($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function generateSlug($string) {
    $slug = strtolower($string);
    $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
    $slug = preg_replace('/-+/', '-', $slug);
    $slug = trim($slug, '-');
    return $slug;
}

function logError($message) {
    $logFile = '../logs/error.log';
    $timestamp = date('Y-m-d H:i:s');
    $logMessage = "[$timestamp] $message" . PHP_EOL;
    file_put_contents($logFile, $logMessage, FILE_APPEND | LOCK_EX);
}

?>