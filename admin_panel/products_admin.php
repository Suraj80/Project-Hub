<?php
  include 'config.php';
  include 'includes/db.php';
  include 'components/header.php';     // <head> with Bootstrap CSS
    include 'components/sidebar.php';
  include 'components/navbar.php';     // Top navbar
    // Side menu
?>
<head>
 

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    
    <!-- Products specific styles -->
    <link href="assets/css/product.css" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Products Management</h1>
            <div>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm mr-2" onclick="showAddProductModal()">
                    <i class="fas fa-plus fa-sm text-white-50"></i> Add Product
                </a>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-download fa-sm text-white-50"></i> Export Products
                </a>
            </div>
        </div>

        <!-- Filters Section -->
        <div class="filter-section">
            <div class="row">
                <div class="col-md-3">
                    <label for="searchInput" class="form-label">Search Products</label>
                    <input type="text" class="form-control" id="searchInput" placeholder="Name, Category, Technology...">
                </div>
                <div class="col-md-2">
                    <label for="categoryFilter" class="form-label">Category</label>
                    <select class="form-control" id="categoryFilter">
                        <option value="">All Categories</option>
                        <option value="Web Development">Web Development</option>
                        <option value="Mobile Development">Mobile Development</option>
                        <option value="Desktop Application">Desktop Application</option>
                        <option value="Machine Learning">Machine Learning</option>
                        <option value="Game Development">Game Development</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="difficultyFilter" class="form-label">Difficulty</label>
                    <select class="form-control" id="difficultyFilter">
                        <option value="">All Levels</option>
                        <option value="Beginner">Beginner</option>
                        <option value="Intermediate">Intermediate</option>
                        <option value="Advanced">Advanced</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="featuredFilter" class="form-label">Featured</label>
                    <select class="form-control" id="featuredFilter">
                        <option value="">All Products</option>
                        <option value="1">Featured Only</option>
                        <option value="0">Non-Featured</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="priceFilter" class="form-label">Price Range</label>
                    <select class="form-control" id="priceFilter">
                        <option value="">All Prices</option>
                        <option value="0-50">$0 - $50</option>
                        <option value="51-100">$51 - $100</option>
                        <option value="101-200">$101 - $200</option>
                        <option value="201-500">$201 - $500</option>
                        <option value="500+">$500+</option>
                    </select>
                </div>
                <div class="col-md-1 d-flex align-items-end">
                    <button class="btn btn-outline-secondary btn-block" onclick="clearFilters()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Products Table -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Products List</h6>
            </div>
            <div class="card-body">
                <!-- Loading spinner -->
                <div id="loadingSpinner" class="text-center py-4" style="display: none;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered" id="productsTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Difficulty</th>
                                <th>Rating</th>
                                <th>Technologies</th>
                                <th>Featured</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="productsTableBody">
                            <!-- Products will be populated here by JavaScript -->
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="row">
                    <div class="col-sm-12 col-md-5">
                        <div class="pagination-info" id="paginationInfo">
                            Showing 0 to 0 of 0 entries
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="pagination-wrapper float-right">
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm" id="pagination">
                                    <!-- Pagination will be populated by JavaScript -->
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    <!-- Add/Edit Product Modal -->
    <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Add New Product</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="productForm" enctype="multipart/form-data">
                        <input type="hidden" id="productId" name="productId">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="productName">Product Name *</label>
                                    <input type="text" class="form-control" id="productName" name="productName" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="productCategory">Category *</label>
                                    <select class="form-control" id="productCategory" name="productCategory" required>
                                        <option value="">Select Category</option>
                                        <option value="Web Development">Web Development</option>
                                        <option value="Mobile Development">Mobile Development</option>
                                        <option value="Desktop Application">Desktop Application</option>
                                        <option value="Machine Learning">Machine Learning</option>
                                        <option value="Game Development">Game Development</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="productPrice">Price *</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="number" class="form-control" id="productPrice" name="productPrice" step="0.01" min="0" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="productDifficulty">Difficulty *</label>
                                    <select class="form-control" id="productDifficulty" name="productDifficulty" required>
                                        <option value="">Select Difficulty</option>
                                        <option value="Beginner">Beginner</option>
                                        <option value="Intermediate">Intermediate</option>
                                        <option value="Advanced">Advanced</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="productRating">Rating</label>
                                    <input type="number" class="form-control" id="productRating" name="productRating" step="0.1" min="0" max="5">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="productDuration">Duration</label>
                                    <input type="text" class="form-control" id="productDuration" name="productDuration" placeholder="e.g., 2-3 weeks">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="productImage">Product Image</label>
                                    <input type="file" class="form-control-file" id="productImage" name="productImage" accept="image/*">
                                    <small class="form-text text-muted">Upload a product image (JPG, PNG, GIF)</small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="productDescription">Description</label>
                            <textarea class="form-control" id="productDescription" name="productDescription" rows="4" placeholder="Enter product description..."></textarea>
                        </div>

                        <div class="form-group">
                            <label>Technologies Used</label>
                            <div id="technologiesContainer">
                                <div class="technology-input-group">
                                    <input type="text" class="form-control" name="technologies[]" placeholder="Enter technology">
                                    <button type="button" class="btn btn-success btn-sm" onclick="addTechnologyInput()">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="productFeatured" name="productFeatured" value="1">
                                <label class="form-check-label" for="productFeatured">
                                    Featured Product
                                </label>
                            </div>
                        </div>

                        <div id="imagePreviewContainer" style="display: none;">
                            <label>Current Image</label>
                            <div>
                                <img id="currentImagePreview" class="image-preview" src="" alt="Current Image">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="button" onclick="saveProduct()">Save Product</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Details Modal -->
    <div class="modal fade" id="productDetailsModal" tabindex="-1" role="dialog" aria-labelledby="productDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productDetailsModalLabel">Product Details</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="productDetailsBody">
                    <!-- Product details will be populated here -->
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this product? This action cannot be undone and will also remove all associated technology entries.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-danger" type="button" onclick="confirmDelete()">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

    <!-- Products JavaScript -->
    <script src="assets/js/products.js"></script>

    <!-- Custom template js-->
    <script src="js/sb-admin-2.min.js"></script>

</body>
</html>

<?php include 'components/footer.php'; // Footer with scripts and closing tags ?>