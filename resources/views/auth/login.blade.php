<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - StoreApp</title>
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
    <style> .form-container{max-width:420px;margin:40px auto;padding:16px;border:1px solid #eee;border-radius:6px;} .form-field{width:100%;padding:8px;margin-bottom:10px;} </style>
</head>
<body>
    <div class="form-container">
        <h2>Login</h2>
        <form action="{{ route('login.perform') }}" method="POST">
            @csrf
            <input class="form-field" type="email" name="email" placeholder="Email" required>
            <input class="form-field" type="password" name="password" placeholder="Password" required>
            <button type="submit">Masuk</button>
        </form>

        <p>Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
    </div>
</body>
</html>
