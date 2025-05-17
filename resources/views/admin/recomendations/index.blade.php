

@extends('admin.layouts.app')

@section('title', 'Dashboard - Admin')

@section('content')
    <!-- Dashboard content goes here -->
    <div class="container-fluid pt-4 px-4">
        <div class="row">
            <div class="col-12">
               <!-- Content Start -->
  <div class="content">
    <!-- Blank Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row vh-100 bg-light rounded align-items-center justify-content-center mx-0">
            <div class="col-md-6 text-center">
                <div class="container">
                    <h2>AI Recommendations for Product Promotion</h2>

                    <button id="fetch-recommendations" class="btn btn-primary">Get Recommendations</button>

                    <div id="recommendations" class="mt-4">
                        <h3>Product Promotion Suggestions:</h3>
                        <ul id="recommendations-list">
                            <!-- Recommendations will be appended here -->
                        </ul>
                    </div>
                </div>
                        </div>
        </div>
    </div>
    <!-- Blank End -->


    <!-- Footer Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded-top p-4">
            <div class="row">
                <div class="col-12 col-sm-6 text-center text-sm-start">
                    &copy; <a href="#">Your Site Name</a>, All Right Reserved.
                </div>
                <div class="col-12 col-sm-6 text-center text-sm-end">
                    <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                    Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->
</div>
<!-- Content End -->>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fetchButton = document.getElementById('fetch-recommendations');
        if (fetchButton) {
            fetchButton.addEventListener('click', function () {
                fetch('/recommendations')
                    .then(response => response.json())
                    .then(data => {
                        const recommendations = data.recommendations;
                        const recommendationsList = document.getElementById('recommendations-list');
                        if (recommendationsList) {
                            recommendationsList.innerHTML = recommendations.split('\n').map(item => `<li>${item}</li>`).join('');
                        }
                    })
                    .catch(error => console.error('Error fetching recommendations:', error));
            });
        } else {
            console.error("Button with id 'fetch-recommendations' not found.");
        }
    });
</script>

