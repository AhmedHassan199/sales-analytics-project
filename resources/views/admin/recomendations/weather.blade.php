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
                @endif

                {{-- Search Form --}}
               <form method="GET" action="{{ route('weather') }}">
                <div class="input-group">
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

            </div>
        </div>
    </div>
</div>
@endsection
