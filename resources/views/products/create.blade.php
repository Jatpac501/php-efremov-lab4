@extends('layouts.app')

@section('content')
<style>
    .product-form {
        max-width: 960px;
        margin: 20px auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f9f9f9;
    }
    .product-form__label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    .product-form__input,
    .product-form__textarea,
     .product-form__select {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ddd;
        border-radius: 3px;
         box-sizing: border-box;
         resize: vertical;
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


<form class="product-form" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <h1 class="product-form__title">Добавить товар</h1>
    <div>
        <label class="product-form__label">Название</label>
        <input class="product-form__input" type="text" name="name" required>
    </div>
    <div>
        <label class="product-form__label">Описание</label>
        <textarea class="product-form__textarea" name="description" required></textarea>
    </div>
    <div>
        <label class="product-form__label">Цена</label>
        <input class="product-form__input" type="number" name="price" required>
    </div>
    <div>
        <label class="product-form__label">Основное изображение</label>
        <input class="product-form__input" type="file" name="main_image" required>
    </div>
    <div>
        <label class="product-form__label">Галерея изображений</label>
        <input class="product-form__input" type="file" name="gallery_images[]" multiple>
    </div>
    <div>
        <label class="product-form__label">Категория</label>
        <select class="product-form__select" name="category_id" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <button class="product-form__button" type="submit">Добавить</button>
</form>
@endsection
