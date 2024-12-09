<style>
    .product-details {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f9f9f9;
    }

    .product-main-image img {
        width: 100%;
        height: auto;
        border-radius: 5px;
    }

    .product-info {
        margin-top: 20px;
    }

    .product-info h1 {
        font-size: 28px;
        margin-bottom: 10px;
        color: #333;
    }

    .product-info .description {
        font-size: 16px;
        margin-bottom: 20px;
        color: #666;
    }

    .product-info .price {
        font-size: 24px;
        color: #f44336;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .product-gallery {
        margin-top: 30px;
    }

    .product-gallery h2 {
        font-size: 20px;
        margin-bottom: 15px;
        color: #333;
    }

    .gallery-images {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .gallery-images img {
        width: calc(33.333% - 10px);
        height: auto;
        border-radius: 5px;
    }

    .category {
        font-size: 16px;
        color: #777;
        margin-top: 10px;
    }

    .back-button {
        display: inline-block;
        margin-top: 20px;
        background-color: #4CAF50;
        color: white;
        padding: 10px 15px;
        text-decoration: none;
        border-radius: 5px;
    }

    .back-button:hover {
        background-color: #45a049;
    }
</style>

<div class="product-details">
    <div class="product-main-image">
        <img src="{{ asset($product->main_image) }}" alt="Изображение {{ $product->name }}">
    </div>

    <div class="product-info">
        <h1>{{ $product->name }}</h1>
        <p class="description">{{ $product->description }}</p>
        <div class="price">{{ $product->price }} руб.</div>
        <div class="category">Категория: {{ $product->category->name }}</div>
    </div>

    <div class="product-gallery">
        <h2>Галерея</h2>
        <div class="gallery-images">
            @foreach(json_decode($product->gallery_images) as $image)
                <img src="{{ asset($image) }}" alt="Галерея {{ $product->name }}">
            @endforeach

        </div>
    </div>

    <a href="{{ route('product.index') }}" class="back-button">Назад к каталогу</a>
</div>

