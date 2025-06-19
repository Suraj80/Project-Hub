<?php
// ajax/products_action.php
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
            $product['rating'] = (float)$product['rating'];
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
            ':name' => $_POST['productName'],
            ':category' => $_POST['productCategory'],
            ':price' => floatval($_POST['productPrice']),
            ':difficulty' => $_POST['productDifficulty'],
            ':rating' => !empty($_POST['productRating']) ? floatval($_POST['productRating']) : null,
            ':duration' => $_POST['productDuration'] ?? null,
            ':description' => $_POST['productDescription'] ?? null,
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
        
        // Get current product data
        $currentStmt = $pdo->prepare("SELECT image FROM products WHERE id = :id");
        $currentStmt->execute([':id' => $productId]);
        $currentProduct = $currentStmt->fetch(PDO::FETCH_ASSOC);

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
            ':name' => $_POST['productName'],
            ':category' => $_POST['productCategory'],
            ':price' => floatval($_POST['productPrice']),
            ':difficulty' => $_POST['productDifficulty'],
            ':rating' => !empty($_POST['productRating']) ? floatval($_POST['productRating']) : null,
            ':duration' => $_POST['productDuration'] ?? null,
            ':description' => $_POST['productDescription'] ?? null,
            ':image' => $imagePath,
            ':featured' => isset($_POST['productFeatured']) ? 1 : 0
        ]);

        // Delete existing technologies
        $deleteStmt = $pdo->prepare("DELETE FROM product_technologies WHERE product_id = :product_id");
        $deleteStmt->execute([':product_id' => $productId]);

        // Insert new technologies
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
        
        // Get product image path
        $stmt = $pdo->prepare("SELECT image FROM products WHERE id = :id");
        $stmt->execute([':id' => $productId]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        // Delete product (technologies will be deleted automatically due to CASCADE)
        $deleteStmt = $pdo->prepare("DELETE FROM products WHERE id = :id");
        $deleteStmt->execute([':id' => $productId]);

        // Delete image file if exists
        if ($product && $product['image'] && file_exists($product['image'])) {
            unlink($product['image']);
        }

        echo json_encode(['success' => true, 'message' => 'Product deleted successfully']);

    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error deleting product: ' . $e->getMessage()]);
    }
}

function getProduct() {
    global $pdo;
    
    try {
        $productId = intval($_POST['productId']);
        
        // Get product with technologies
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

        if ($product) {
            $product['technologies'] = $product['technologies'] ? explode(',', $product['technologies']) : [];
            $product['featured'] = (bool)$product['featured'];
            $product['rating'] = (float)$product['rating'];
            $product['price'] = (float)$product['price'];
            
            echo json_encode(['success' => true, 'data' => $product]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Product not found']);
        }

    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error fetching product: ' . $e->getMessage()]);
    }
}

function handleImageUpload($file) {
    $uploadDir = '../uploads/';
    
    // Create uploads directory if it doesn't exist
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    // Check file type
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (!in_array($file['type'], $allowedTypes)) {
        throw new Exception('Invalid file type. Only JPG, PNG, GIF, and WebP are allowed.');
    }

    // Check file size (5MB max)
    if ($file['size'] > 5 * 1024 * 1024) {
        throw new Exception('File size too large. Maximum 5MB allowed.');
    }

    // Generate unique filename
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = uniqid('product_', true) . '.' . $extension;
    $filepath = $uploadDir . $filename;

    // Move uploaded file to the uploads directory
    if (move_uploaded_file($file['tmp_name'], $filepath)) {
        return $filepath;
    } else {
        throw new Exception('Failed to move uploaded file.');
    }
}

// Function to get categories for dropdown
function getCategories() {
    global $pdo;
    
    try {
        $query = "SELECT DISTINCT category FROM products ORDER BY category";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $categories = $stmt->fetchAll(PDO::FETCH_COLUMN);
        
        echo json_encode(['success' => true, 'data' => $categories]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error fetching categories: ' . $e->getMessage()]);
    }
}

// Function to get technologies for autocomplete
function getTechnologies() {
    global $pdo;
    
    try {
        $query = "SELECT DISTINCT technology FROM product_technologies ORDER BY technology";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $technologies = $stmt->fetchAll(PDO::FETCH_COLUMN);
        
        echo json_encode(['success' => true, 'data' => $technologies]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error fetching technologies: ' . $e->getMessage()]);
    }
}
?>