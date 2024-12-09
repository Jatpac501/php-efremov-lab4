<style>
    h1 {
        color: #333;
        font-size: 24px;
        margin-bottom: 20px;
    }

    .catalog {
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
    }

    .product-card img {
        width: 100%;
        height: auto;
        border-radius: 5px;
    }

    .product-card h2 {
        font-size: 18px;
        margin: 10px 0;
        color: #333;
    }

    .product-card .price {
        font-size: 16px;
        color: #333;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .product-card .category {
        font-size: 14px;
        color: #777;
    }

    .add-button {
        background-color: #4CAF50;
        color: white;
        padding: 10px 15px;
        text-align: center;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        display: inline-block;
        margin-bottom: 20px;
        font-size: 16px;
        cursor: pointer;
    }

    .add-button:hover {
        background-color: #45a049;
    }
</style>

<h1>Добро пожаловать!</h1>
@if (Route::has('login'))
        @auth
            <a class="add-button" href="{{ route('admin') }}"> Админ-панель </a>
        @else
            <a class="add-button" href="{{ route('login') }}"> Войти </a>
        @if (Route::has('register'))
            <a class="add-button" href="{{ route('register') }}"> Регистрация </a>
        @endif
        @endauth
    @endif
<div class="catalog">
    @foreach($products as $product)
    <a class="product-card" href="{{ route('product.show', $product->id) }}">
        <img src="{{ $product->main_image }}" alt="Фото {{ $product->name }}">
        <h2>{{ $product->name }}</h2>
        <div class="price">{{ $product->price }} руб.</div>
        <div class="category">{{ $product->category->name }}</div>
    </a>
@endforeach
</div>
