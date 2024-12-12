@extends('layouts.app')  {{--  Предполагается, что у вас есть layouts/app.blade.php --}}

@section('title', 'Каталог товаров')

@push('styles')
    <style>
        .page-title {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .product-catalog {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .product-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            width: calc(25% - 20px);
            box-sizing: border-box;
            background-color: #fff;
            text-decoration: none;
            color: inherit;
        }

        .product-card:hover {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .product-card__image {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .product-card__title {
            font-size: 18px;
            margin: 10px 0;
            color: #333;
        }

        .product-card__price {
            font-size: 16px;
            color: #333;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .product-card__category {
            font-size: 14px;
            color: #777;
        }

        .auth-buttons {
            margin-bottom: 20px;
        }

        .auth-buttons > a {
            margin-right: 10px;
        }

        @media (max-width: 768px) {
            .product-card {
                width: calc(50% - 20px);
            }
        }

        @media (max-width: 576px) {
            .product-card {
                width: 100%;
            }
        }
    </style>
@endpush


@section('content')
    <div class="product-catalog">
        @foreach($products as $product)
            <a class="product-card" href="{{ route('products.show', $product->id) }}">
                <img class="product-card__image" src="{{ asset($product->main_image) }}" alt="Фото {{ $product->name }}">
                <h2 class="product-card__title">{{ $product->name }}</h2>
                <div class="product-card__price">{{ $product->price }} руб.</div>
                <div class="product-card__category">{{ $product->category->name }}</div>
            </a>
        @endforeach
    </div>
@endsection
