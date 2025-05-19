@extends('admin.layouts.app')

@section('title', 'Weather Insights - Admin')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row vh-100 bg-light rounded align-items-center justify-content-center mx-0">
        <div class="col-md-8">
            <div class="bg-white rounded shadow p-4">
                <h2 class="text-center mb-4">🌤️ Weather-Based Recommendations</h2>

                {{-- Error --}}
                @if (isset($error))
                    <div class="alert alert-danger text-center">
                        {{ $error }}
                    </div>
                @else
                    {{-- Weather Info --}}
                    <div class="mb-4 text-center">
                        <h4>📍 Location: {{ $weather['name'] }}</h4>
                        <p><strong>Temperature:</strong> {{ $weather['main']['temp'] }}°C</p>
                        <p><strong>Condition:</strong> {{ ucfirst($weather['weather'][0]['description']) }}</p>
                    </div>

                    {{-- Drink Recommendations --}}
                    <div class="mb-4">
                        <h5 class="text-primary">🥤 Suggested Drink:</h5>
                        <p>{{ $recommendations }}</p>
                    </div>

                    {{-- Dynamic Pricing --}}
                    <div class="mb-4">
                        <h5 class="text-success">💰 Dynamic Pricing Suggestions:</h5>
                        <p>{{ $dynamicPricing }}</p>
                    </div>

                    @if (!empty($showForm) && $showForm === true)
                        <form method="POST" action="{{ route('updatePrices') }}">
                            @csrf
                            <input type="hidden" name="category" value="{{ $categoryToUpdate }}">

                            <div class="mb-3">
                                <label for="percentIncrease" class="form-label">
                                    Increase Price Percentage 
                                </label>
                                <input type="number" class="form-control" id="percentIncrease" name="percent" step="0.01" min="0" max="100" required>
                            </div>

                            <button type="submit" class="btn btn-success">Update Prices</button>
                        </form>
                    @endif
                @endif

                {{-- Search Form --}}
                <form method="GET" action="{{ route('weather') }}">
                    <div class="input-group mt-4">
                        <select name="location" class="form-select">
                            <option value="">Choose a city</option>
                            @foreach($cities as $city)
                                <option value="{{ $city }}" {{ request('location') == $city ? 'selected' : '' }}>
                                    {{ $city }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary">🔍 Search</button>
                    </div>
                </form>

                @if(session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection
