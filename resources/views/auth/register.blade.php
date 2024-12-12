@extends('layouts.app')

@section('title', 'Регистрация')

@push('styles')
<style>
    .registration {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: calc(100vh - 160px);
    }
    .registration__form {
        width: 300px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f9f9f9;
    }
    .registration__label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    .registration__input {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ddd;
        border-radius: 3px;
        box-sizing: border-box;
    }
    .registration__button {
        width: 100%;
        padding: 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }
    .registration__error-message {
        color: red;
        margin-bottom: 10px;
    }
    .registration__error-list {
        padding-left: 20px;
    }
</style>
@endpush

@section('content')
<div class="registration">
    <form class="registration__form" action="{{ route('register') }}" method="POST">
        @csrf
        @if ($errors->any())
            <div class="registration__error-message">
                <ul class="registration__error-list">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div>
            <label class="registration__label" for="name">Логин</label>
            <input class="registration__input" type="text" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div>
            <label class="registration__label" for="email">Почта</label>
            <input class="registration__input" type="email" id="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div>
            <label class="registration__label" for="password">Пароль</label>
            <input class="registration__input" type="password" id="password" name="password" required>
        </div>

        <div>
            <label class="registration__label" for="password_pass">Подтверждение пароля</label>
            <input class="registration__input" type="password" id="password_confirmation" name="password_pass" required>
        </div>

        <button class="registration__button" type="submit">Зарегистрироваться</button>
    </form>
</div>
@endsection
