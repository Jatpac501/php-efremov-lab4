@extends('layouts.app')

@section('title', 'Авторизация')

@push('styles')
<style>
    .login {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: calc(100vh - 160px);
    }
    .login__form {
        width: 300px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f9f9f9;
    }

    .login__label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .login__input {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ddd;
        border-radius: 3px;
        box-sizing: border-box;
    }

    .login__button {
        width: 100%;
        padding: 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }

    .login__error-message {
        color: red;
        margin-bottom: 10px;
    }
</style>
@endpush

@section('content')
<div class="login">
    <form class="login__form" action="{{ route('login') }}" method="POST">
        @csrf

        @if (!empty($message))
            <div class="login__error-message">{{ $message }}</div>
        @endif


        <div>
            <label class="login__label" for="name">Логин</label>
            <input class="login__input" type="text" id="name" name="name" required>
        </div>

        <div>
            <label class="login__label" for="password">Пароль</label>
            <input class="login__input" type="password" id="password" name="password" required>
        </div>

        <button class="login__button" type="submit">Войти</button>
    </form>
</div>
@endsection
