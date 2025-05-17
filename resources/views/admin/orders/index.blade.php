@extends('admin.layouts.app')

@section('title', 'Orders - Admin')

@section('content')
    <!-- Dashboard content goes here -->
    <div class="container-fluid pt-4 px-4">
        <div class="row">
            <div class="col-12">
                <!-- Content Start -->
                <div class="content">
                    <!-- Orders List Start -->
                    <div class="container-fluid pt-4 px-4">
                        <div class="row vh-100 bg-light rounded align-items-start justify-content-center mx-0">

                            <div class="col-md-12">
                                <div class="bg-light rounded h-100 p-4">
                                    <h6 class="mb-4">Order List</h6>
                                    <div class="mb-3">
                                        <a href="{{ route('orders.create') }}" class="btn btn-primary">Create New Order</a>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Product</th>
                                                    <th>Description</th>
                                                    <th>Quantity</th>
                                                    <th>Total Price</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($orders as $order)
                                                    <tr>
                                                        <td>{{ $order->id }}</td>
                                                        <td>{{ $order->product_name }}</td>
                                                        <td>{{ $order->description }}</td>
                                                        <td>{{ $order->quantity }}</td>
                                                        <td>${{ $order->total_price }}</td>
                                                        <td>
                                                            <form method="POST" action="/orders/{{ $order->id }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger m-2" type="submit" onclick="return confirm('Are you sure you want to delete this order?')">Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Orders List End -->

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
