@extends('layouts.app')

@section('content')
<head>
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/44.0.0/ckeditor5.css" crossorigin>
</head>
<style>
    .product-form {
        max-width: 960px;
        margin: 20px auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f9f9f9;
    }

    .product-form__group {
        margin-bottom: 15px;
    }

    .product-form__label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .product-form__input,
    .product-form__textarea,
    .product-form__select {
         box-sizing: border-box;
        resize: vertical;
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 3px;
    }

    .product-form__textarea {
        min-height: 120px;
    }

    .product-form__button {
        width: 100%;
        padding: 10px;
        background-color: #f44336;
        color: white;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }
    .product-form__title {
        text-align: center;
        margin-bottom: 20px;
    }
</style>


<form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="product-form">
    @csrf
    @method('PUT')

    <h1 class="product-form__title">Редактировать товар</h1>

    <div class="product-form__group">
        <label for="name" class="product-form__label">Название</label>
        <input type="text" name="name" id="name" class="product-form__input" value="{{ old('name', $product->name) }}" required>
    </div>

    <div class="product-form__group">
        <label for="description" class="product-form__label">Описание</label>
        <textarea id="description" name="description" class="product-form__textarea" required>{{ old('description', $product->description) }}</textarea>
    </div>

    <div class="product-form__group">
        <label for="price" class="product-form__label">Цена</label>
        <input type="number" name="price" id="price" class="product-form__input" value="{{ old('price', $product->price) }}">
    </div>

    <div class="product-form__group">
        <label for="main_image" class="product-form__label">Основное изображение</label>
        <input type="file" name="main_image" id="main_image" class="product-form__input">
    </div>

    <div class="product-form__group">
        <label for="gallery_images" class="product-form__label">Галерея изображений</label>
        <input type="file" name="gallery_images[]" id="gallery_images" class="product-form__input" multiple>
    </div>

    <div class="product-form__group">
        <label for="category_id" class="product-form__label">Категория</label>
        <select name="category_id" id="category_id" class="product-form__select" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="product-form__button">Сохранить изменения</button>
</form>
@endsection
