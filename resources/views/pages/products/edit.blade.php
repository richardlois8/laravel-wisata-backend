@extends('layouts.app')

@section('title', 'Edit Product')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <style>
        .form-group {
            margin-bottom: 10px;
        }
        .selectgroup-button {
            padding: 0.25rem 0.5rem;
        }
        .form-control, .select2-container .select2-selection--single, .selectric .label {
            min-height: 30px;
            padding: 0.25rem 0.5rem;
        }
        .card-footer {
            padding: 0.75rem;
        }
        .btn {
            padding: 0.25rem 0.5rem;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Product</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Products</a></div>
                    <div class="breadcrumb-item">Edit Product</div>
                </div>
            </div>

            <div class="section-body">
                <div class="card">
                    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Product Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $product->name }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror">{{ $product->description }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="price">Price</label>
                                    <input type="number" id="price" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ $product->price }}">
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="stock">Stock</label>
                                    <input type="number" id="stock" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ $product->stock }}">
                                    @error('stock')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="category_id">Category</label>
                                    <select id="category_id" name="category_id" class="form-control selectric @error('category_id') is-invalid @enderror">
                                        <option value="">Choose Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="image">Product Image</label>
                                    <input type="file" id="image" name="image" class="form-control-file @error('image') is-invalid @enderror">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="status" value="published" class="selectgroup-input" {{ $product->status == 'published' ? 'checked' : '' }}>
                                        <span class="selectgroup-button">Published</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="status" value="archived" class="selectgroup-input" {{ $product->status == 'archived' ? 'checked' : '' }}>
                                        <span class="selectgroup-button">Archived</span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Criteria</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="criteria" value="perorangan" class="selectgroup-input" {{ $product->criteria == 'perorangan' ? 'checked' : '' }}>
                                        <span class="selectgroup-button">Perorangan</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="criteria" value="rombongan" class="selectgroup-input" {{ $product->criteria == 'rombongan' ? 'checked' : '' }}>
                                        <span class="selectgroup-button">Rombongan</span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Is Favorite</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="favorite" value="1" class="selectgroup-input" {{ $product->favorite == 1 ? 'checked' : '' }}>
                                        <span class="selectgroup-button">Yes</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="favorite" value="0" class="selectgroup-input" {{ $product->favorite == 0 ? 'checked' : '' }}>
                                        <span class="selectgroup-button">No</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
@endpush
