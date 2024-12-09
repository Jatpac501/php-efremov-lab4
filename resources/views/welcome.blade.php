<div class="">
    @if (Route::has('login'))
        @auth
            <a href="{{ url('/admin') }}"> Админ-панель </a>
        @else
            <a href="{{ route('login') }}"> Войти </a>
        @if (Route::has('register'))
            <a href="{{ route('register') }}"> Регистрация </a>
        @endif
        @endauth
    @endif
</div>

<style>
    div {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>

