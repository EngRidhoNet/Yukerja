<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Layanan Tambal Ban Terdekat</h4>
        <button class="filters-btn">
            <i class="fas fa-sliders-h me-2"></i> Filters
        </button>
    </div>

    <div class="row">
        @foreach($serviceProviders as $provider)
            <div class="col-md-3 col-sm-6 col-12">
                <div class="service-card">
                    <div class="d-flex align-items-start mb-2">
                        <div class="service-img me-3"></div>
                        <div>
                            <div class="service-title">Tambal Ban</div>
                            <div class="service-title">Setia Sukses</div>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-star service-rating"></i>
                                <span class="me-2">{{ $provider['rating'] }}</span>
                                <span class="service-distance">{{ $provider['distance'] }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="service-price">Mulai dari {{ $provider['price'] }}</div>
                    <div class="d-flex">
                        <button class="btn btn-chat me-2">Chat</button>
                        <button class="btn btn-order">Pesan Sekarang</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection