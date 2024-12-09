<style>
    form {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 300px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f9f9f9;
    }
    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    input {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ddd;
        border-radius: 3px;
    }
    button {
        width: 100%;
        padding: 10px;
        background-color: #f44336;
        color: white;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }
</style>

<form action="{{ route('login') }}" method="POST">
    @csrf
    @if ($message)
        <div>{{ $message }}</div>
    @endif
    <div>
        <label>Логин</label>
        <input type="text" name="name" required>
    </div>
    <div>
        <label>Пароль</label>
        <input type="password" name="password" required>
    </div>
    <button type="submit">Войти</button>
</form>

