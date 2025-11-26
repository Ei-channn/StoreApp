<header class="main-header">
    <div class="logo">StoreApp</div>
    <nav>
        <a href="{{ route('user.index') }}">Beranda</a>
        <a href="#">Produk</a>
        <a href="#">Kontak</a>
    </nav>
    <div class="cart-icon">
        @php
            $cart = session('cart', []);
            $cartCount = collect($cart)->sum('qty') ?: 0;
            $userId = session('user_id');
            $userName = session('user_name');
            $userRole = session('user_role');
        @endphp

        <a href="{{ route('user.keranjang') }}">Keranjang (<span id="cart-count">{{ $cartCount }}</span>)</a>

        @if($userId)
            <span style="margin-left:12px">Halo, {{ $userName }}</span>
            @if($userRole === 'admin')
                <a style="margin-left:8px; font-weight:600;" href="{{ route('admin.index') }}">(Admin)</a>
            @endif
            <form action="{{ route('logout') }}" method="POST" style="display:inline; margin-left:8px">
                @csrf
                <button type="submit" style="background:none;border:none;color:inherit;cursor:pointer">Logout</button>
            </form>
        @else
            <a style="margin-left:12px" href="{{ route('login') }}">Login</a>
            <a style="margin-left:8px" href="{{ route('register') }}">Register</a>
        @endif
    </div>
</header>
