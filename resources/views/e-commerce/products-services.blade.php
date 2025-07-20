@extends('layouts.master')
@section('menuEcommerce', 'active')
@section('masterEcommerce', 'menu-is-opening menu-open')
@section('menuLayananproduk', 'active')
@section('style')
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4895ef;
            --dark-color: #2b2d42;
            --light-color: #f8f9fa;
            --success-color: #4cc9f0;
            --danger-color: #f72585;
            --warning-color: #f8961e;
            --info-color: #4895ef;
            --border-radius: 12px;
            --box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fb;
        }

        /* Card Styles */
        .modern-product-card {
            border: none;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
            transition: var(--transition);
            background: white;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .modern-product-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--box-shadow);
        }

        /* Image Container */
        .product-image-container {
            height: 200px;
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .no-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #d1d5db;
            font-size: 3rem;
        }

        /* Quick Actions */
        .quick-actions {
            position: absolute;
            top: 15px;
            right: -50px;
            transition: var(--transition);
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .show-actions {
            right: 15px;
        }

        .btn-action {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            color: var(--dark-color);
            border: none;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: var(--transition);
        }

        .btn-action:hover {
            background: var(--primary-color);
            color: white;
            transform: scale(1.1);
        }

        /* Badges */
        .status-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-badge.active {
            background: var(--success-color);
            color: white;
        }

        .status-badge.inactive {
            background: #6c757d;
            color: white;
        }

        .discount-badge {
            position: absolute;
            bottom: 15px;
            left: 15px;
            background: var(--danger-color);
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        /* Product Info */
        .product-info {
            padding: 20px;
            flex-grow: 1;
        }

        .product-title {
            font-size: 1rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 5px;
            line-height: 1.3;
        }

        .product-category {
            font-size: 0.75rem;
            color: #6c757d;
            display: block;
            margin-bottom: 10px;
        }

        .product-views {
            font-size: 0.75rem;
            color: #6c757d;
            background: #f1f3f8;
            padding: 3px 8px;
            border-radius: 10px;
        }

        /* Price Section */
        .price-section {
            margin-top: 10px;
        }

        .current-price {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .original-price {
            font-size: 0.85rem;
            text-decoration: line-through;
            color: #adb5bd;
            margin-left: 5px;
        }

        /* Footer Actions */
        .product-footer {
            padding: 0 20px 20px;
            display: flex;
            gap: 10px;
        }

        .btn-edit-full,
        .btn-delete {
            flex: 1;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 500;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-edit-full {
            background: var(--primary-color);
            color: white;
            border: none;
        }

        .btn-edit-full:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
        }

        .btn-delete {
            background: white;
            color: var(--danger-color);
            border: 1px solid #f1f1f1;
        }

        .btn-delete:hover {
            background: #fff5f7;
            transform: translateY(-2px);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
        }

        .empty-image {
            max-width: 200px;
            margin-bottom: 20px;
            opacity: 0.7;
        }

        .empty-state h3 {
            color: var(--dark-color);
            margin-bottom: 10px;
        }

        .empty-state p {
            color: #6c757d;
            margin-bottom: 20px;
        }

        .btn-create {
            padding: 8px 20px;
            border-radius: 6px;
            font-weight: 500;
        }

        /* Filter Card */
        /* Filter Card - Mobile First Approach */
        .filter-card {
            border: none;
            border-radius: var(--border-radius);
            background: white;
            margin-bottom: 1rem;
        }

        .search-box {
            position: relative;
            width: 100%;
        }

        .search-box i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #adb5bd;
            z-index: 2;
        }

        .search-box input {
            width: 100%;
            padding: 8px 15px 8px 35px;
            border-radius: 20px;
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            transition: var(--transition);
            font-size: 0.9rem;
        }

        .search-box input:focus {
            background: white;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(67, 97, 238, 0.25);
        }

        .select-category,
        .select-status {
            width: 100%;
            padding: 8px 15px;
            border-radius: 20px;
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            font-size: 0.9rem;
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 16px;
            transition: var(--transition);
        }

        .select-category:focus,
        .select-status:focus {
            background-color: white;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(67, 97, 238, 0.25);
        }

        .btn-reset {
            padding: 8px 12px;
            border-radius: 20px;
            font-size: 0.9rem;
            white-space: nowrap;
            transition: var(--transition);
        }

        .btn-reset:hover {
            background-color: #f8f9fa;
        }

        /* Responsive Adjustments */
        @media (max-width: 767.98px) {
            .filter-card .card-body {
                padding: 15px;
            }

            .search-box,
            .select-category,
            .select-status {
                margin-bottom: 10px;
            }

            .btn-reset {
                width: 100%;
                margin-top: 5px;
            }
        }

        @media (max-width: 575.98px) {

            .search-box input,
            .select-category,
            .select-status {
                font-size: 0.85rem;
                padding: 6px 12px 6px 30px;
            }

            .search-box i {
                left: 10px;
                font-size: 0.9rem;
            }
        }

        /* Summary Card */
        .summary-card {
            border: none;
            border-radius: var(--border-radius);
            background: white;
        }

        .summary-card h6 {
            font-size: 0.9rem;
            color: var(--dark-color);
            font-weight: 600;
        }

        .summary-card .rounded-circle {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Pagination */
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        .pagination .page-item.active .page-link {
            background: var(--primary-color);
            border-color: var(--primary-color);
        }

        .pagination .page-link {
            color: var(--dark-color);
            border-radius: 6px !important;
            margin: 0 3px;
            border: none;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }


        /* Responsive */
        @media (max-width: 1199.98px) {
            .product-image-container {
                height: 180px;
            }
        }

        @media (max-width: 991.98px) {
            .product-image-container {
                height: 160px;
            }

            .product-footer {
                flex-direction: column;
            }
        }

        @media (max-width: 767.98px) {
            .product-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .product-image-container {
                height: 140px;
            }

            .search-box {
                min-width: 100%;
                margin-bottom: 10px;
            }

            .select-category,
            .select-status {
                min-width: calc(50% - 8px);
            }
        }

        @media (max-width: 575.98px) {
            .product-image-container {
                height: 120px;
            }

            .product-title {
                font-size: 0.9rem;
            }

            .product-footer .btn {
                font-size: 0.75rem;
            }
        }
    </style>
@endsection

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Product Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                            <li class="breadcrumb-item active">Products</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Filters -->
                <div class="row mb-4">
                    <div class="col-md-8">
                        <div class="card filter-card shadow-sm">
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <div class="d-flex flex-wrap align-items-center">
                                            <button class="btn btn-outline-primary btn-reset">
                                                Tambah Data
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="d-flex flex-wrap align-items-center">
                                            <div class="search-box mr-3 mb-2 mb-md-0">
                                                <i class="fas fa-search"></i>
                                                <input type="text" class="form-control border-0"
                                                    placeholder="Search products..." id="productSearch">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex flex-wrap align-items-center">
                                            <button class="btn btn-outline-primary btn-reset">
                                                <i class="fas fa-sync-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card summary-card shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <h6 class="mb-0">Total Products</h6>
                                        <span class="text-muted">3 items</span>
                                    </div>
                                    <div class="bg-primary rounded-circle p-3">
                                        <i class="fas fa-box-open text-white"></i>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <select class="form-control select-category mr-3 mb-2 mb-md-0">
                                        <option value="">All Categories</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

                <!-- Product Grid -->
                <div class="row product-grid">
                    @forelse($products as $product)
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-4">
                            <div class="card modern-product-card">
                                <!-- Product Image -->
                                <div class="product-image-container">
                                    @if ($product->primaryImage)
                                        <img src="{{ $product->primaryImage->image_url }}" alt="{{ $product->name }}"
                                            class="product-image">
                                    @else
                                        <div class="no-image">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @endif

                                    <!-- Quick Actions -->
                                    <div class="quick-actions">
                                        <button class="btn btn-action btn-edit" data-id="{{ $product->id }}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                        <button class="btn btn-action btn-view" data-id="{{ $product->id }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>

                                    <!-- Status Badge -->
                                    <div class="status-badge {{ $product->is_active ? 'active' : 'inactive' }}">
                                        {{ $product->is_active ? 'Active' : 'Inactive' }}
                                    </div>

                                    <!-- Discount Badge -->
                                    @if ($product->discounted_price)
                                        <div class="discount-badge">
                                            -{{ number_format((($product->price - $product->discounted_price) / $product->price) * 100, 0) }}%
                                        </div>
                                    @endif
                                </div>

                                <!-- Product Info -->
                                <div class="product-info">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h5 class="product-title">{{ Str::limit($product->name, 40) }}</h5>
                                            <span
                                                class="product-category">{{ $product->category->name ?? 'Uncategorized' }}</span>
                                        </div>
                                        <div class="product-views">
                                            <i class="fas fa-eye"></i> {{ $product->click_count }}
                                        </div>
                                    </div>

                                    <div class="price-section mt-2">
                                        @if ($product->discounted_price)
                                            <span class="current-price">Rp
                                                {{ number_format($product->discounted_price, 0) }}</span>
                                            <span class="original-price">Rp {{ number_format($product->price, 0) }}</span>
                                        @else
                                            <span class="current-price">Rp {{ number_format($product->price, 0) }}</span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Footer Actions -->
                                <div class="product-footer">
                                    <a href="" class="btn btn-edit-full">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </a>
                                    <form action="" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete"
                                            onclick="return confirm('Delete this product?')">
                                            <i class="fas fa-trash-alt mr-1"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="empty-state">
                                <img src="" alt="No products" class="empty-image">
                                <h3>No Products Found</h3>
                                <p>You don't have any products yet. Let's create your first product!</p>
                                <a href="" class="btn btn-primary btn-create">
                                    <i class="fas fa-plus mr-1"></i> Add Product
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="row">
                    <div class="col-12">
                        <div class="pagination-wrapper">
                            {{ $products->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>

@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            // Product card hover effect
            $('.modern-product-card').hover(
                function() {
                    $(this).addClass('hover-effect');
                    $(this).find('.quick-actions').addClass('show-actions');
                },
                function() {
                    $(this).removeClass('hover-effect');
                    $(this).find('.quick-actions').removeClass('show-actions');
                }
            );

            // Quick edit action
            $('.btn-edit').click(function() {
                let productId = $(this).data('id');
                window.location.href = '/admin/products/' + productId + '/edit';
            });

            // Quick view action
            $('.btn-view').click(function() {
                let productId = $(this).data('id');
                window.location.href = '/admin/products/' + productId;
            });

            // Search functionality
            $('#productSearch').on('keyup', function() {
                let value = $(this).val().toLowerCase();
                $('.product-grid .col-xl-3').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
@endpush
