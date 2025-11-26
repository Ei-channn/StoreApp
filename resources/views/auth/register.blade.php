<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - StoreApp</title>
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
    <style> .form-container{max-width:420px;margin:40px auto;padding:16px;border:1px solid #eee;border-radius:6px;} .form-field{width:100%;padding:8px;margin-bottom:10px;} </style>
</head>
<body>
    <div class="form-container">
        <h2>Daftar</h2>
        <form action="{{ route('register.perform') }}" method="POST">
            @csrf
            <input class="form-field" type="text" name="name" placeholder="Nama" value="{{ old('name') }}" required>
            <input class="form-field" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
            <input class="form-field" type="password" name="password" placeholder="Password" required>
            <input class="form-field" type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
            <button type="submit">Daftar</button>
        </form>

        <p>Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></p>
    </div>
</body>
</html>
