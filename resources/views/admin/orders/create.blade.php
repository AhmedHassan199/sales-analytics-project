@extends('admin.layouts.app')

@section('title', 'Create Order - Admin')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row">
            <div class="col-12">
                <!-- Content Start -->
                <div class="content">
                    <!-- Create Order Start -->
                    <div class="container-fluid pt-4 px-4">
                        <div class="row vh-100 bg-light rounded align-items-center justify-content-center mx-0">
                            <div class="col-md-6">
                                <div class="bg-light rounded h-100 p-4">
                                    <h3 class="mb-4 text-center">Create Order</h3>
                                    <form method="POST" action="/orders">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="product" class="form-label">Product</label>
                                            <select name="product_id" class="form-select" required>
                                                <option value="" disabled selected>Select a product</option>
                                                @foreach($products as $product)
                                                    <option value="{{ $product->id }}">
                                                        {{ $product->name }} (${{ $product->price }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="quantity" class="form-label">Quantity</label>
                                            <input type="number" name="quantity" class="form-control" min="1" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">Create Order</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Create Order End -->

                    <!-- Footer Start -->
                    <div class="container-fluid pt-4 px-4">
                        <div class="bg-light rounded-top p-4">
                            <div class="row">
                                <div class="col-12 col-sm-6 text-center text-sm-start">
                                    &copy; <a href="#">Your Site Name</a>, All Right Reserved.
                                </div>
                                <div class="col-12 col-sm-6 text-center text-sm-end">
                                    Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Footer End -->
                </div>
                <!-- Content End -->
            </div>
        </div>
    </div>
@endsection
