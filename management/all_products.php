<?php
    include('../panel/header.php');
    include('../panel/sidebar.php');
    include('../panel/navbar.php');

    # DELETE BUTTON
    if ((isset($_GET['func'])) && ($_GET['func'] == 'delete')) {
        $deleteID = $_GET['id'];
        $delete = mysqli_query($database, "DELETE FROM `products` WHERE `id` = '$deleteID'");
        if ($delete) {
            $_SESSION['success'] = "You have deleted this product successfully.";
            echo "<script>window.location.href='all_products.php';</script>";
            exit();
        } else {
            $_SESSION['error'] = "Failed to delete the product. Please try again.";
            echo "<script>window.location.href='all_products.php';</script>";
            exit();
        }
    }

    # ADD BUTTON
    if (isset($_POST['submit'])) {
        $productName = $_POST['productName'];
        $sku = $_POST['sku'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $stockLevel = $_POST['stockLevel'];
        $description = $_POST['description'];

        // Handle Image Upload
        $directory = "../assets/images/products/";
        $picture = $_FILES["productImage"]["name"];
        $model = $_FILES["productImage"]["tmp_name"];
        if ($picture) {
            $extension = strtolower(pathinfo($picture, PATHINFO_EXTENSION));
            $pictureLink = 'product_' . rand(10000, 99999) . '.' . $extension;
            if (!move_uploaded_file($model, $directory . $pictureLink)) {
                $_SESSION['error'] = "Failed to upload product image.";
                echo "<script>window.location.href='all_products.php';</script>";
                exit();
            }
        } else {
            $_SESSION['error'] = "No image provided. Please upload an image.";
            echo "<script>window.location.href='all_products.php';</script>";
            exit();
        }

        $insert = mysqli_query($database, "
            INSERT INTO `products` (`image`, `name`, `sku`, `category`, `price`, `stock`, `description`)
            VALUES ('$pictureLink', '$productName', '$sku', '$category', '$price', '$stockLevel', '$description')
        ");

        if ($insert) {
            $_SESSION['success'] = "You've successfully added a new product.";
            echo "<script>window.location.href='all_products.php';</script>";
            exit();
        } else {
            $_SESSION['error'] = "Failed to add the product. Please try again.";
            echo "<script>window.location.href='all_products.php';</script>";
            exit();
        }
    }

    # UPDATE BUTTON
    if (isset($_POST['update'])) {
        $productID = $_POST['product_id'];
        $productName = $_POST['productName'];
        $sku = $_POST['sku'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $stockLevel = $_POST['stockLevel'];
        $description = $_POST['description'];

        // Handle Image Upload
        $directory = "../assets/images/products/";
        $picture = $_FILES["productImage"]["name"];
        $model = $_FILES["productImage"]["tmp_name"];
        $imageSQL = ""; // Initialize
        if ($picture) {
            $extension = strtolower(pathinfo($picture, PATHINFO_EXTENSION));
            $pictureLink = 'product_' . rand(10000, 99999) . '.' . $extension;
            if (move_uploaded_file($model, $directory . $pictureLink)) {
                $imageSQL = "`image` = '$pictureLink',"; // Update image if uploaded
            } else {
                $_SESSION['error'] = "Failed to upload product image.";
                echo "<script>window.location.href='all_products.php';</script>";
                exit();
            }
        }

        $update = mysqli_query($database, "
            UPDATE `products`
            SET
                $imageSQL
                `name` = '$productName',
                `sku` = '$sku',
                `category` = '$category',
                `price` = '$price',
                `stock` = '$stockLevel',
                `description` = '$description'
            WHERE `id` = '$productID'
        ");

        if ($update) {
            $_SESSION['success'] = "You've successfully updated the product.";
            echo "<script>window.location.href='all_products.php';</script>";
            exit();
        } else {
            $_SESSION['error'] = "Failed to update the product. Please try again.";
            echo "<script>window.location.href='all_products.php';</script>";
            exit();
        }
    }

    # READ
    $products = mysqli_query($database, "SELECT * FROM `products` ORDER BY `id` DESC");
?>


    <div class="iq-navbar-header" style="height: 215px;">
        <!-- Success Alert -->
        <?php if (isset($_SESSION['success'])) { ?>
            <div class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3" 
                role="alert" style="z-index: 1050; width: 80%; max-width: 1000px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
                <span><b>Success!</b> <?= htmlspecialchars($_SESSION['success']); ?></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <script>
                // Auto-dismiss the alert after 5 seconds
                setTimeout(() => {
                    const alert = document.querySelector('.alert');
                    if (alert) alert.classList.remove('show');
                }, 5000);
            </script>
        <?php unset($_SESSION['success']); } ?>
        <!-- Error Alert -->
        <?php if (isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3" 
                role="alert" style="z-index: 1050; width: 80%; max-width: 1000px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
                <span><b>Error:</b> <?= htmlspecialchars($_SESSION['error']); ?></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <script>
                // Auto-dismiss the alert after 3 seconds
                setTimeout(() => {
                    const alert = document.querySelector('.alert');
                    if (alert) alert.classList.remove('show');
                }, 3000);
            </script>
        <?php unset($_SESSION['error']); } ?>
        <div class="container-fluid iq-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="flex-wrap d-flex justify-content-between align-items-center">
                        <div>
                            <h1>ALL PRODUCTS</h1>
                            <p>This is a short details to illustrate all products page.</p>
                        </div>
                        <div>
                            <a href="#AddProduct" class="btn btn-link btn-soft-light">
                                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.33 2H16.66C20.06 2 22 3.92 22 7.33V16.67C22 20.06 20.07 22 16.67 22H7.33C3.92 22 2 20.06 2 16.67V7.33C2 3.92 3.92 2 7.33 2ZM12.82 12.83H15.66C16.12 12.82 16.49 12.45 16.49 11.99C16.49 11.53 16.12 11.16 15.66 11.16H12.82V8.34C12.82 7.88 12.45 7.51 11.99 7.51C11.53 7.51 11.16 7.88 11.16 8.34V11.16H8.33C8.11 11.16 7.9 11.25 7.74 11.4C7.59 11.56 7.5 11.769 7.5 11.99C7.5 12.45 7.87 12.82 8.33 12.83H11.16V15.66C11.16 16.12 11.53 16.49 11.99 16.49C12.45 16.49 12.82 16.12 12.82 15.66V12.83Z" fill="currentColor"></path>                            </svg>
                                Add Product
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="iq-header-img">
            <img src="../assets/images/dashboard/top-header.png" alt="header" class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
            <img src="../assets/images/dashboard/top-header1.png" alt="header" class="theme-color-purple-img img-fluid w-100 h-100 animated-scaleX">
            <img src="../assets/images/dashboard/top-header2.png" alt="header" class="theme-color-blue-img img-fluid w-100 h-100 animated-scaleX">
            <img src="../assets/images/dashboard/top-header3.png" alt="header" class="theme-color-green-img img-fluid w-100 h-100 animated-scaleX">
            <img src="../assets/images/dashboard/top-header4.png" alt="header" class="theme-color-yellow-img img-fluid w-100 h-100 animated-scaleX">
            <img src="../assets/images/dashboard/top-header5.png" alt="header" class="theme-color-pink-img img-fluid w-100 h-100 animated-scaleX">
        </div>
    </div>          <!-- Nav Header Component End -->
<!--Nav End-->
</div>
      

<div class="container-fluid content-inner mt-n5 py-0">
    <!-- DATATABLE -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">All Products</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="custom-datatable-entries">
                        <table id="datatable" class="table table-striped" data-toggle="data-table">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Product Name</th>
                                    <th>SKU</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Stock Level</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $id = 1; foreach ($products as $product) { ?>
                                <tr>
                                    <td><?= $id++; ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img class="rounded img-fluid avatar-40 me-3 bg-primary-subtle"
                                                src="../assets/images/products/<?= $product['image']; ?>" alt="profile">
                                            <h6><?= htmlspecialchars($product['name']); ?></h6>
                                        </div>
                                    </td>
                                    <td><?= htmlspecialchars($product['sku']); ?></td>
                                    <td><?= htmlspecialchars($product['category']); ?></td>
                                    <td>$<?= htmlspecialchars($product['price']); ?></td>
                                    <td><?= htmlspecialchars($product['stock']); ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editModal" 
                                            data-id="<?= $product['id']; ?>" 
                                            data-name="<?= htmlspecialchars($product['name']); ?>" 
                                            data-sku="<?= htmlspecialchars($product['sku']); ?>" 
                                            data-category="<?= htmlspecialchars($product['category']); ?>" 
                                            data-price="<?= htmlspecialchars($product['price']); ?>" 
                                            data-stock="<?= htmlspecialchars($product['stock']); ?>" 
                                            data-description="<?= htmlspecialchars($product['description']); ?>" 
                                            data-image="<?= htmlspecialchars($product['image']); ?>">Edit</button>
                                        <button class="btn btn-sm btn-danger" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteModal" 
                                            data-id="<?= $product['id']; ?>">Delete</button>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>S/N</th>
                                    <th>Product Name</th>
                                    <th>SKU</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Stock Level</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this product?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editProductForm" action="all_products.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" id="productId" name="product_id" value="">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="productName" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="productName" name="productName" required>
                            </div>
                            <div class="col-md-6">
                                <label for="sku" class="form-label">SKU</label>
                                <input type="text" class="form-control" id="sku" name="sku" required>
                            </div>
                            <div class="col-md-6">
                                <label for="category" class="form-label">Category</label>
                                <select class="form-select" id="category" name="category" required>
                                    <option value="Beverages">Beverages</option>
                                    <option value="Snacks">Snacks</option>
                                    <option value="Juices">Juices</option>
                                    <option value="Energy Drinks">Energy Drinks</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="price" class="form-label">Price ($)</label>
                                <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                            </div>
                            <div class="col-md-6">
                                <label for="stockLevel" class="form-label">Stock Level</label>
                                <input type="number" class="form-control" id="stockLevel" name="stockLevel" required>
                            </div>
                            <div class="col-md-6">
                                <label for="productImage" class="form-label">Product Image</label>
                                <input type="file" class="form-control" id="productImage" name="productImage" accept="image/*">
                            </div>
                            <div class="col-md-10">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Preview</label>
                                <img id="previewImage" class="img-fluid img-thumbnail">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="update" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>  

    <script>
        // Delete Modal Script
        const deleteModal = document.getElementById('deleteModal');
        const confirmDeleteButton = document.getElementById('confirmDeleteButton');
        let deleteId = null;

        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            deleteId = button.getAttribute('data-id');
        });

        confirmDeleteButton.addEventListener('click', function () {
            if (deleteId) {
                window.location.href = `all_products.php?id=${deleteId}&func=delete`;
            }
        });

        // Edit Modal Script
        const editModal = document.getElementById('editModal');
        editModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const productId = button.getAttribute('data-id');
            const productName = button.getAttribute('data-name');
            const sku = button.getAttribute('data-sku');
            const category = button.getAttribute('data-category');
            const price = button.getAttribute('data-price');
            const stockLevel = button.getAttribute('data-stock');
            const description = button.getAttribute('data-description');
            const image = button.getAttribute('data-image');

            document.getElementById('productId').value = productId;
            document.getElementById('productName').value = productName;
            document.getElementById('sku').value = sku;
            document.getElementById('price').value = price;
            document.getElementById('stockLevel').value = stockLevel;
            document.getElementById('description').value = description;

            const categoryDropdown = document.getElementById('category');
            for (const option of categoryDropdown.options) {
                option.selected = option.value === category;
            }

            const previewImage = document.getElementById('previewImage');
            previewImage.src = image ? `../assets/images/products/${image}` : '../assets/images/no-preview.png';
        });

        // Preview Image
        document.getElementById('productImage').addEventListener('change', function () {
            const [file] = this.files;
            if (file) {
                document.getElementById('previewImage').src = URL.createObjectURL(file);
            }
        });
    </script>

    <!-- FORM -->
    <div class="row" id="AddProduct">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Add a New Product</h4>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Add Product Form -->
                    <form class="row g-3" action="all_products.php" method="POST" enctype="multipart/form-data">
                        <!-- Product Name -->
                        <div class="col-md-6">
                            <label for="productName" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="productName" name="productName" placeholder="Enter product name" required>
                        </div>
                        <!-- SKU -->
                        <div class="col-md-6">
                            <label for="sku" class="form-label">SKU</label>
                            <input type="text" class="form-control" id="sku" name="sku" placeholder="Enter SKU" required>
                        </div>
                        <!-- Category -->
                        <div class="col-md-6">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select" id="category" name="category" required>
                                <option selected disabled value="">Choose a category...</option>
                                <option value="Beverages">Beverages</option>
                                <option value="Snacks">Snacks</option>
                                <option value="Juices">Juices</option>
                                <option value="Energy Drinks">Energy Drinks</option>
                            </select>
                        </div>
                        <!-- Price -->
                        <div class="col-md-6">
                            <label for="price" class="form-label">Price ($)</label>
                            <input type="number" class="form-control" id="price" name="price" placeholder="Enter price" step="0.01" required>
                        </div>
                        <!-- Stock Level -->
                        <div class="col-md-6">
                            <label for="stockLevel" class="form-label">Stock Level</label>
                            <input type="number" class="form-control" id="stockLevel" name="stockLevel" placeholder="Enter stock level" required>
                        </div>
                        <!-- Product Image -->
                        <div class="col-md-6">
                            <label for="productImage" class="form-label">Product Image</label>
                            <input type="file" class="form-control" id="productImage" name="productImage" accept="image/*" required>
                        </div>
                        <!-- Description -->
                        <div class="col-md-10">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="5" placeholder="Enter product description"></textarea>
                        </div>
                        <!-- Image Preview -->
                        <div class="col-md-2">
                            <label class="form-label">Preview</label>
                            <img id="productImagePreview" class="img-fluid img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
                        </div>
                        <script>
                            // Preview Image for Add Product Form
                            const productImageInput = document.getElementById('productImage');
                            const productImagePreview = document.getElementById('productImagePreview');

                            productImageInput.addEventListener('change', function () {
                                const file = this.files[0]; // Get the uploaded file
                                if (file) {
                                    const reader = new FileReader();
                                    reader.onload = function (e) {
                                        productImagePreview.src = e.target.result; // Set preview image
                                    };
                                    reader.readAsDataURL(file); // Read file as a data URL
                                }
                            });
                        </script>
                        <!-- Terms and Conditions -->
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms" required>
                                <label class="form-check-label" for="terms">
                                    Agree to terms and conditions
                                </label>
                            </div>
                        </div>
                        <!-- Submit and Reset Buttons -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary" name="submit">Add Product</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
</div>
   

                       
<?php
include('../panel/footer.php');
?>