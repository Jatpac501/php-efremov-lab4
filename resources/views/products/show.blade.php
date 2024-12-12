@extends('layouts.app')

@section('title', $product->name)

@push('styles')
<style>
    .product {
        max-width: 800px;
        margin: 30px auto;
        padding: 20px;
        border: none;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        background-color: #fff;
    }
    .product__image-main img {
        width: 100%;
        height: auto;
        border-radius: 8px;
        margin-bottom: 20px;
    }
    .product__title {
        font-size: 2em;
        margin-bottom: 10px;
        color: #333;
    }
    .product__description {
        font-size: 1.1em;
        line-height: 1.6;
        margin-bottom: 20px;
        color: #666;
    }
    .product__price {
        font-size: 1.5em;
        color: #333;
        font-weight: bold;
        margin-bottom: 20px;
    }
    .product__gallery {
        margin-top: 30px;
    }
    .product__gallery-title {
        font-size: 1.3em;
        margin-bottom: 15px;
        color: #333;
    }
    .product__gallery-images {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
    }
    .product__gallery-image {
         width: 100%;
        height: auto;
        border-radius: 8px;
    }
    .product__category {
        font-size: 1.1em;
        color: #777;
        margin-bottom: 10px;
    }
    .button--back {
        display: inline-block;
        margin-bottom: 20px;
        background-color: #4CAF50;
        color: white;
        padding: 10px 15px;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }
    .button--back:hover {
        background-color: #45a049;
    }
    .comments__list {
         margin-top: 20px;
    }
     .comment {
        border: 1px solid #eee;
        padding: 15px;
        margin-bottom: 15px;
        border-radius: 8px;
        background-color: #f9f9f9;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
     .comment__author {
        font-weight: bold;
        margin-bottom: 5px;
    }
     .comment__date {
        font-size: 0.9em;
        color: #999;
        margin-bottom: 10px;
    }
    .comment__content {
        line-height: 1.6;
    }
    .comment__reply {
        margin-left: 20px;
        padding-left: 20px;
        border-left: 2px solid #eee;
    }
    .reply-form {
        display: none;
        margin-top: 10px;
         border: 1px solid #eee;
        padding: 15px;
        border-radius: 8px;
        background-color: #f5f5f5;
    }
     .reply-form textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
     .reply-button {
        color: #4285F4;
        text-decoration: none;
        cursor: pointer;
        transition: color 0.3s ease;
    }
     .reply-button:hover {
         color: #357ae8;
     }
    .form-group textarea,
    .form-group input {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        resize: vertical;
    }
    @media (max-width: 768px) {
        .product {
            max-width: 90%;
        }
         .product__gallery-images {
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        }
    }
</style>
@endpush
@section('content')
<div class="product">
    <a href="{{ route('products.index') }}" class="button--back">Назад к каталогу</a>
    <div class="product__category">
        Категория:
        @foreach($product->category->getFullChain() as $index => $categoryName)
                {{ $categoryName }}
            @if(!$loop->last)
                >
            @endif
        @endforeach
    </div>
    <h1 class="product__title">{{ $product->name }}</h1>
    <div class="product__image-main">
        <img src="{{ asset($product->main_image) }}" alt="Изображение {{ $product->name }}">
    </div>
    <div class="product__gallery">
        <h2 class="product__gallery-title">Галерея</h2>
        <div class="product__gallery-images">
            @foreach(json_decode($product->gallery_images) as $image)
                <img class="product__gallery-image" src="{{ asset($image) }}" alt="Галерея {{ $product->name }}">
            @endforeach
        </div>
    </div>
    <div class="product__info">
        <div class="product__price">{{ $product->price }} руб.</div>
        <p class="product__description">{{ $product->description }}</p>
    </div>

    <h2 class="comments__title">Комментарии</h2>
    <form action="{{ route('comments.store', $product->id) }}" method="POST" class="comments__form">
        @csrf
        <div class="form-group">
            <textarea name="content" class="form-group" placeholder="Добавьте комментарий..." required>{{ old('content') }}</textarea>
        </div>
        <button type="submit" class="button">Отправить</button>
    </form>

    <div class="comments__list">
        @foreach ($product->comments as $comment)
            @if (is_null($comment->parent_id))
                <div class="comment">
                    <strong class="comment__author">{{ $comment->user->name }}</strong> <span class="comment__date">({{ $comment->created_at->diffForHumans() }}):</span>
                    <p class="comment__content">{{ $comment->content }}</p>
                    <button class="reply-button" data-comment-id="{{ $comment->id }}">Ответить</button>
                    <form action="{{ route('comments.store', $product->id) }}" method="POST" class="reply-form" style="display: none;" data-comment-id="{{ $comment->id }}">
                        @csrf
                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                        <div class="form-group">
                            <textarea name="content" class="form-group" placeholder="Ваш ответ..." required>{{ old('content') }}</textarea>
                        </div>
                        <button type="submit" class="button">Отправить</button>
                    </form>
                    @include('partials.replies', ['comments' => $comment->replies, 'level' => 1])
                 </div>
            @endif
        @endforeach
    </div>
</div>



@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const replyButtons = document.querySelectorAll('.reply-button');
        replyButtons.forEach(button => {
            button.addEventListener('click', function () {
                const commentId = this.getAttribute('data-comment-id');
                const form = document.querySelector(`.reply-form[data-comment-id="${commentId}"]`);
                if (form) {
                    form.style.display = form.style.display === 'none' ? 'block' : 'none';
                }
            });
        });
    });
</script>
@endpush
@endsection
