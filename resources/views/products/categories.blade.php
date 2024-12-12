@extends('layouts.app')
@section('title', 'Категории')
@section('content')
<style>
    .categories {
        padding: 20px;
    }
    .categories__title {
        margin-bottom: 20px;
    }
    .categories__list {
        list-style: none;
        padding: 0;
    }
    .categories__item {
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }
    .categories__item:last-child {
        border-bottom: none;
    }
    .categories__link {
        text-decoration: none;
        color: #333;
        font-weight: bold;
        display: block;
        padding: 5px 0;
    }
    .subcategories__list {
        list-style: none;
        padding-left: 20px;
        margin-top: 5px;
    }
    .subcategories__item {
        margin-bottom: 5px;
    }
     .subcategories__item:last-child {
        margin-bottom: 0;
    }
    .subcategories__link {
        text-decoration: none;
        color: #666;
        display: block;
         padding: 3px 0;
    }
</style>

<div class="categories">
    <h1 class="categories__title">Категории</h1>
    <ul class="categories__list">
        @foreach($categories as $category)
            <li class="categories__item">
                <a class="categories__link" href="{{ route('categories.show', $category->id) }}">
                    {{ $category->name }}
                </a>
                @if($category->children->isNotEmpty())
                    <ul class="subcategories__list">
                        @foreach($category->children as $subcategory)
                            <li class="subcategories__item">
                                <a class="subcategories__link" href="{{ route('categories.show', $subcategory->id) }}">
                                    {{ $subcategory->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
</div>
@endsection
