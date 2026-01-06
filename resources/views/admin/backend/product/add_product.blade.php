@extends('admin.admin_master')
@section('admin')
<div class="content d-flex flex-column flex-column-fluid">
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid my-0">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h2 class="fs-22 fw-semibold m-0">Add Product</h2>
                </div>
                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <a href="{{ route('all.product') }}" class="btn btn-dark">Back</a>
                    </ol>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('store.product') }}" method="post" enctype="multipart/form-data" id="productForm">
                        @csrf
                        <div class="row">
                            <!-- Left Section: Product Details (8 columns) -->
                            <div class="col-xl-8">
                                <div class="card mb-3">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="mb-0">Product Information</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- Section 1: Product Name, Category, Price -->
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Product Name: <span class="text-danger">*</span></label>
                                                <input type="text" name="name" placeholder="Enter Name" class="form-control" required>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Product Category: <span class="text-danger">*</span></label>
                                                <select name="category_id" id="category_id" class="form-control form-select" required>
                                                    <option value="">Select Category</option>
                                                    @foreach ($categories as $item)
                                                    <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Product Price:</label>
                                                <input type="number" name="price" class="form-control" placeholder="Enter product price" step="0.01" min="0">
                                            </div>

                                            <!-- Section 2: Code, Brand, Stock Alert -->
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Code: <span class="text-danger">*</span></label>
                                                <input type="text" name="code" class="form-control" placeholder="Enter Code" required>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Brand: <span class="text-danger">*</span></label>
                                                <select name="brand_id" id="brand_id" class="form-control form-select" required>
                                                    <option value="">Select Brand</option>
                                                    @foreach ($brands as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Stock Alert: <span class="text-danger">*</span></label>
                                                <input type="number" name="stock_alert" class="form-control" placeholder="Enter Stock Alert" min="0" required>
                                            </div>

                                            <!-- Notes - Spans full width -->
                                            <div class="col-md-12">
                                                <label class="form-label">Notes:</label>
                                                <textarea class="form-control" name="note" rows="3" placeholder="Enter Notes"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Section: Images and Stock (4 columns) -->
                            <div class="col-xl-4">
                                <!-- Section 3: Multiple Images -->
                                <div class="card mb-3">
                                    <div class="card-header bg-info text-white">
                                        <h5 class="mb-0">Product Images</h5>
                                    </div>
                                    <div class="card-body">
                                        <label class="form-label">Multiple Image: <span class="text-danger">*</span></label>
                                        <div class="mb-3">
                                            <input name="image[]" accept=".png, .jpg, .jpeg" multiple type="file" id="multiImg" class="form-control" required>
                                            <small class="text-muted">Select multiple images</small>
                                        </div>
                                        <div class="row" id="preview_img"></div>
                                    </div>
                                </div>

                                <!-- Add Stock Section (No section header as requested) -->
                                <div class="card">
                                    <div class="card-header bg-success text-white">
                                        <h5 class="mb-0">Add Stock</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label">Warehouse: <span class="text-danger">*</span></label>
                                            <select name="warehouse_id" id="warehouse_id" class="form-control form-select" required>
                                                <option value="">Select Warehouse</option>
                                                @foreach ($warehouses as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Supplier: <span class="text-danger">*</span></label>
                                            <select name="supplier_id" id="supplier_id" class="form-control form-select" required>
                                                <option value="">Select Supplier</option>
                                                @foreach ($suppliers as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Product Quantity: <span class="text-danger">*</span></label>
                                            <input type="number" name="product_qty" class="form-control" placeholder="Enter Product Quantity" min="1" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Status: <span class="text-danger">*</span></label>
                                            <select name="status" id="status" class="form-control form-select" required>
                                                <option value="">Select Status</option>
                                                <option value="Received">Received</option>
                                                <option value="Pending">Pending</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="col-xl-12">
                                <div class="d-flex mt-4 justify-content-start">
                                    <button class="btn btn-primary me-3" type="submit">
                                        <i class="mdi mdi-content-save me-1"></i>Save Product
                                    </button>
                                    <a class="btn btn-secondary" href="{{ route('all.product') }}">
                                        <i class="mdi mdi-cancel me-1"></i>Cancel
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Enhanced Image Preview with Remove Button -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const multiImgInput = document.getElementById('multiImg');
    const previewContainer = document.getElementById('preview_img');
    let filesArray = [];

    multiImgInput.addEventListener('change', function(event) {
        const newFiles = Array.from(event.target.files);

        // Add new files to the array
        filesArray = [...filesArray, ...newFiles];

        // Update preview
        updatePreview();
    });

    function updatePreview() {
        previewContainer.innerHTML = ''; // Clear previous previews

        filesArray.forEach((file, index) => {
            if (file.type.match('image.*')) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    // Create preview container
                    const col = document.createElement('div');
                    col.className = 'col-6 mb-3';
                    col.style.position = 'relative';

                    // Create image wrapper
                    const imgWrapper = document.createElement('div');
                    imgWrapper.className = 'position-relative';
                    imgWrapper.style.border = '2px solid #dee2e6';
                    imgWrapper.style.borderRadius = '8px';
                    imgWrapper.style.overflow = 'hidden';
                    imgWrapper.style.backgroundColor = '#f8f9fa';

                    // Create image
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'img-fluid';
                    img.style.width = '100%';
                    img.style.height = '120px';
                    img.style.objectFit = 'cover';
                    img.alt = 'Image Preview';

                    // Create remove button
                    const removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.className = 'btn btn-danger btn-sm position-absolute';
                    removeBtn.style.top = '5px';
                    removeBtn.style.right = '5px';
                    removeBtn.style.padding = '2px 8px';
                    removeBtn.style.zIndex = '10';
                    removeBtn.innerHTML = '<i class="mdi mdi-close"></i>';
                    removeBtn.title = 'Remove Image';

                    // Remove button functionality
                    removeBtn.addEventListener('click', function() {
                        // Remove file from array
                        filesArray.splice(index, 1);

                        // Update file input
                        updateFileInput();

                        // Update preview
                        updatePreview();
                    });

                    // Append elements
                    imgWrapper.appendChild(img);
                    imgWrapper.appendChild(removeBtn);
                    col.appendChild(imgWrapper);
                    previewContainer.appendChild(col);
                };

                reader.readAsDataURL(file);
            }
        });
    }

    function updateFileInput() {
        const dataTransfer = new DataTransfer();
        filesArray.forEach(file => dataTransfer.items.add(file));
        multiImgInput.files = dataTransfer.files;
    }

    // Form validation
    const form = document.getElementById('productForm');
    form.addEventListener('submit', function(event) {
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;

        requiredFields.forEach(field => {
            if (!field.value) {
                isValid = false;
                field.classList.add('is-invalid');
            } else {
                field.classList.remove('is-invalid');
            }
        });

        if (!isValid) {
            event.preventDefault();
            alert('Please fill in all required fields!');
        }
    });

    // Add interactive focus effects
    const formInputs = document.querySelectorAll('.form-control, .form-select');
    formInputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.style.boxShadow = '0 0 0 0.2rem rgba(0, 123, 255, 0.25)';
        });

        input.addEventListener('blur', function() {
            this.style.boxShadow = '';
        });
    });
});
</script>

<style>
    .card-header {
        padding: 12px 20px;
    }

    .form-control:focus, .form-select:focus {
        border-color: #80bdff;
        transition: all 0.2s ease-in-out;
    }

    .btn {
        transition: all 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }

    #preview_img img {
        transition: transform 0.2s ease;
    }

    #preview_img img:hover {
        transform: scale(1.05);
    }
</style>

@endsection
