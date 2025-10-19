<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style> .is-invalid {
            color: red;
        } </style>
</head>
<body>
@if($user)
    <h2>Здравствуйте, {{ $user->name }}</h2>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Выйти из системы</button>
    </form>
@else
    <h2>Вход в систему</h2>
    <form method="POST" action="{{route('auth')}}">
        @csrf
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}"/>
        @error('email')
        <div class="is-invalid">{{ $message }}</div>
        @enderror
        <br>
        <label>Пароль</label>
        <input type="password" name="password" autocomplete="current-password"/>
        @error('password')
        <div class="is-invalid">{{ $message }}</div>
        @enderror
        <br>
        <button type="submit">Войти</button>
    </form>
    @error('error')
    <div class="is-invalid">{{ $message }}</div>
    @enderror
@endif
</body>
</html>
