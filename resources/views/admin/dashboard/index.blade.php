@extends('admin.layouts.app')

@section('title', 'Dashboard - Admin')
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

@section('content')
    <div class="container-fluid py-5">
        <div class="row">
            <div class="col-lg-12 mb-4">
                <h2 class="text-center fw-bold">Admin Dashboard</h2>
                <p class="text-center text-muted">Real-time insights into your platform's performance</p>
            </div>
        </div>

        <div class="row g-4">
            <!-- Total Revenue Card -->
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <h4 class="card-title text-primary">Total Revenue</h4>
                        <h2 class="total-revenue display-5 text-success">${{ $data['total_revenue'] }}</h2>
                        <p class="text-muted">Revenue Change (Last 1 Minute): <span class="revenue-change text-warning">${{ $data['revenue_change'] }}</span></p>
                    </div>
                </div>
            </div>

            <!-- Order Count Card -->
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <h4 class="card-title text-primary">Order Count</h4>
                        <h2 class="order-count display-5 text-info">{{ $data['order_count'] }}</h2>
                        <p class="text-muted">New orders placed in the last minute</p>
                    </div>
                </div>
            </div>

            <!-- Top Products Card -->
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body">
                        <h4 class="card-title text-primary">Top Products</h4>
                        <ul class="list-group top-products">
                            @foreach($data['top_products'] as $product)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $product->name }}
                                    <span class="badge bg-success">${{ $product->total_sales }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Section -->
        <div class="row mt-5">
            <div class="col-lg-12 text-center">
                <p class="text-muted">&copy; 2025 Your Company. All rights reserved. Designed with <span class="text-danger">&hearts;</span> by <a href="#">Your Team</a>.</p>
            </div>
        </div>
    </div>
@endsection

<script>
    Pusher.logToConsole = true;

    var pusher = new Pusher('69d27226eac1ce65c20a', {
        cluster: 'mt1'
    });

    var channel = pusher.subscribe('dashboard');

    channel.bind('App\\Events\\DashboardUpdated', function(data) {
        console.log("Received data: ", data);

        document.querySelector('.total-revenue').textContent = `$${data.data.total_revenue}`;

        document.querySelector('.revenue-change').textContent = `$${data.data.revenue_change}`;

        document.querySelector('.order-count').textContent = data.data.order_count;

        var topProductsList = document.querySelector('.top-products');
        topProductsList.innerHTML = '';

        data.data.top_products.forEach(product => {
            let listItem = document.createElement('li');
            listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
            listItem.textContent = product.name;
            let badge = document.createElement('span');
            badge.className = 'badge bg-success';
            badge.textContent = `$${product.total_sales}`;
            listItem.appendChild(badge);
            topProductsList.appendChild(listItem);
        });
    });
</script>
