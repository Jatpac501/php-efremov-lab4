<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Заголовок по умолчанию')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }
        .page {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .page__container {
            max-width: 1366px;
            margin: 0 auto;
            padding: 20px;
            flex: 1;
        }
        .header {
            background-color: #f0f0f0;
            padding: 10px;
            text-align: center;
        }
        .footer {
            background-color: #f0f0f0;
             padding: 10px;
            text-align: center;
        }
        .page-title {
            margin-bottom: 10px;
        }
        .auth-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .button {
            display: inline-block;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            color: #fff;
            background-color: #007bff;
        }
        .button--primary {
             background-color: #007bff;
        }
    </style>
    @stack('styles')
</head>
<body class="page">
    <header class="header">
        <h1 class="page-title">Добро пожаловать@auth, {{ Auth::user()->name }}@endauth!</h1>
        <div class="auth-buttons">
            <a class="button button--primary" href="{{ route('products.index') }}">Главная</a>
            <a class="button button--primary" href="{{ route('categories.index') }}">Категории</a>
            @if (Route::has('login'))
                @auth
                    @if (Auth::user()->isAdmin())
                        <a class="button button--primary" href="{{ route('admin') }}">Админ-панель</a>
                    @endif
                    <a class="button button--primary" href="{{ route('logout') }}">Выйти</a>
                @else
                    <a class="button button--primary" href="{{ route('login') }}">Войти</a>
                    @if (Route::has('register'))
                        <a class="button button--primary" href="{{ route('register') }}">Регистрация</a>
                    @endif
                @endauth
            @endif
        </div>
    </header>
    <div class="page__container">
        @yield('content')
    </div>
    <footer class="footer">
        <p>Улитин Евгений - ИСдо-43</p>
    </footer>
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
