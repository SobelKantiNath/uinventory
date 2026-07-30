@extends('admin.admin_master')
@section('admin')

<div class="content d-flex flex-column flex-column-fluid">
    <div class="container-fluid">

        {{-- ── Page Header ─────────────────────────────────────────────── --}}
        <div class="py-2 d-flex justify-content-between align-items-center">
            <h2 class="fs-22 fw-semibold m-0">Edit Product</h2>
            <a href="{{ route('all.product') }}" class="btn btn-dark">
                <i class="fas fa-arrow-left me-1"></i> Back
            </a>
        </div>

        {{-- ============================================================ --}}
        {{-- FORM 1: Update Product Info                                   --}}
        {{-- ============================================================ --}}
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('update.product') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $editData->id }}">

                    <div class="row">

                        {{-- ── LEFT: Product Information ───────────────────────── --}}
                        <div class="col-xl-8">
                            <div class="card mb-3">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0"><i class="fas fa-box me-1"></i> Product Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">

                                        {{-- Product Name --}}
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label fw-semibold">
                                                Product Name <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                   name="name"
                                                   class="form-control @error('name') is-invalid @enderror"
                                                   value="{{ old('name', $editData->name) }}"
                                                   required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Product Code --}}
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label fw-semibold">
                                                Product Code <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                   name="code"
                                                   class="form-control @error('code') is-invalid @enderror"
                                                   value="{{ old('code', $editData->code) }}"
                                                   required>
                                            @error('code')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Price --}}
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label fw-semibold">Price <span class="text-danger">*</span></label>
                                            <input type="number"
                                                   name="price"
                                                   class="form-control @error('price') is-invalid @enderror"
                                                   value="{{ old('price', $editData->price) }}"
                                                   step="0.01" min="0" required>
                                            @error('price')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Category --}}
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label fw-semibold">
                                                Category <span class="text-danger">*</span>
                                            </label>
                                            <select name="category_id"
                                                    class="form-select @error('category_id') is-invalid @enderror"
                                                    required>
                                                <option value="">-- Select Category --</option>
                                                @foreach ($categories as $cat)
                                                    <option value="{{ $cat->id }}"
                                                        {{ old('category_id', $editData->category_id) == $cat->id ? 'selected' : '' }}>
                                                        {{ $cat->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Brand --}}
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label fw-semibold">
                                                Brand <span class="text-danger">*</span>
                                            </label>
                                            <select name="brand_id"
                                                    class="form-select @error('brand_id') is-invalid @enderror"
                                                    required>
                                                <option value="">-- Select Brand --</option>
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}"
                                                        {{ old('brand_id', $editData->brand_id) == $brand->id ? 'selected' : '' }}>
                                                        {{ $brand->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('brand_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Stock Alert --}}
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label fw-semibold">Stock Alert</label>
                                            <input type="number"
                                                   name="stock_alert"
                                                   class="form-control @error('stock_alert') is-invalid @enderror"
                                                   value="{{ old('stock_alert', $editData->stock_alert) }}"
                                                   min="0">
                                            @error('stock_alert')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Notes --}}
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label fw-semibold">Notes</label>
                                            <textarea name="note"
                                                      class="form-control"
                                                      rows="3">{{ old('note', $editData->note) }}</textarea>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ── RIGHT: Stock Information ────────────────────────── --}}
                        <div class="col-xl-4">
                            <div class="card">
                                <div class="card-header bg-success text-white">
                                    <h5 class="mb-0"><i class="fas fa-warehouse me-1"></i> Stock Information</h5>
                                </div>
                                <div class="card-body">

                                    {{-- Warehouse --}}
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">
                                            Warehouse <span class="text-danger">*</span>
                                        </label>
                                        <select name="warehouse_id"
                                                class="form-select @error('warehouse_id') is-invalid @enderror"
                                                required>
                                            <option value="">-- Select Warehouse --</option>
                                            @foreach ($warehouses as $wh)
                                                <option value="{{ $wh->id }}"
                                                    {{ old('warehouse_id', $editData->warehouse_id) == $wh->id ? 'selected' : '' }}>
                                                    {{ $wh->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('warehouse_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Supplier --}}
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">
                                            Supplier <span class="text-danger">*</span>
                                        </label>
                                        <select name="supplier_id"
                                                class="form-select @error('supplier_id') is-invalid @enderror"
                                                required>
                                            <option value="">-- Select Supplier --</option>
                                            @foreach ($suppliers as $sup)
                                                <option value="{{ $sup->id }}"
                                                    {{ old('supplier_id', $editData->supplier_id) == $sup->id ? 'selected' : '' }}>
                                                    {{ $sup->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('supplier_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Quantity --}}
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">
                                            Quantity <span class="text-danger">*</span>
                                        </label>
                                        <input type="number"
                                               name="product_qty"
                                               class="form-control @error('product_qty') is-invalid @enderror"
                                               value="{{ old('product_qty', $editData->product_qty) }}"
                                               required min="0">
                                        @error('product_qty')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Status --}}
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">
                                            Status <span class="text-danger">*</span>
                                        </label>
                                        <select name="status"
                                                class="form-select @error('status') is-invalid @enderror"
                                                required>
                                            <option value="active"
                                                {{ old('status', $editData->status) == 'active' ? 'selected' : '' }}>
                                                Active
                                            </option>
                                            <option value="inactive"
                                                {{ old('status', $editData->status) == 'inactive' ? 'selected' : '' }}>
                                                Inactive
                                            </option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                        </div>

                        {{-- ── Submit Buttons ──────────────────────────────────── --}}
                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save me-1"></i> Update Product
                            </button>
                            <a href="{{ route('all.product') }}" class="btn btn-secondary ms-2">
                                <i class="fas fa-times me-1"></i> Cancel
                            </a>
                        </div>

                    </div>
                </form>
            </div>
        </div>

        {{-- ============================================================ --}}
        {{-- FORM 2: Upload New Product Images                             --}}
        {{-- ============================================================ --}}
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">
                    <i class="fas fa-cloud-upload-alt me-1"></i> Upload New Images
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('update.product.image') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $editData->id }}">

                    <div class="row align-items-end">
                        <div class="col-md-8 mb-3">
                            <label class="form-label fw-semibold">Choose Images</label>
                            <input type="file"
                                   name="image[]"
                                   class="form-control @error('image.*') is-invalid @enderror"
                                   multiple
                                   accept="image/*"
                                   required>
                            <small class="text-muted">
                                Accepted: jpeg, png, jpg, gif, webp &mdash; Max 2MB each
                            </small>
                            @error('image.*')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <button type="submit" class="btn btn-info text-white w-100">
                                <i class="fas fa-upload me-1"></i> Upload Images
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- ============================================================ --}}
        {{-- Existing Product Images Gallery                               --}}
        {{-- ============================================================ --}}
        <div class="card mb-4">
            <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-images me-1"></i> Current Product Images
                </h5>
                <span class="badge bg-light text-dark">{{ $multiimg->count() }} image(s)</span>
            </div>
            <div class="card-body">

                @if ($multiimg->isEmpty())
                    <div class="text-center text-muted py-4">
                        <i class="fas fa-image fa-3x mb-2 d-block opacity-50"></i>
                        No images uploaded for this product yet.
                    </div>
                @else
                    <div class="row g-3">
                        @foreach ($multiimg as $img)
                            <div class="col-6 col-sm-4 col-md-3 col-lg-2" id="img-card-{{ $img->id }}">
                                <div class="card border shadow-sm h-100">
                                    <img src="{{ asset($img->image) }}"
                                         class="card-img-top"
                                         style="height: 120px; object-fit: cover;"
                                         alt="Product Image">
                                    <div class="card-footer p-1 text-center">
                                        <a href="{{ route('delete.product.image', $img->id) }}"
                                           class="btn btn-danger btn-sm w-100"
                                           onclick="return confirm('Delete this image? This cannot be undone.')">
                                            <i class="fas fa-trash-alt me-1"></i> Delete
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>
        </div>

    </div>
</div>

@endsection
