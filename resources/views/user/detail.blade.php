<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $produk->nama }} - Detail Produk</title>
    <link rel="stylesheet" href="{{ asset('css/user-detail.css') }}">
</head>

<body>
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
                $cartCount = collect($cart)->sum('qty');
            @endphp
            <a href="{{ route('user.keranjang') }}">🛒 Keranjang (<span id="cart-count">{{ $cartCount }}</span>)</a>
        </div>
    </header>

    <div class="product-detail">
        <div class="product-detail-content">
            <div class="product-gallery">
                <img src="{{ $produk->gambar }}" alt="{{ $produk->nama }}" class="main-image">
            </div>

            <div class="product-info">
                <h1 class="product-title">{{ $produk->nama }}</h1>

                <div class="product-rating">
                    <span class="stars">★★★★★</span>
                    <span class="review-count">(254 ulasan)</span>
                </div>

                <p class="product-price" style="font-size:1.25rem; font-weight:600;">Rp
                    {{ number_format($produk->harga, 0, ',', '.') }}</p>

                <p class="product-description">{{ $produk->deskripsi }}</p>

                <div class="quantity-controls">
                    <form action="{{ route('user.keranjang.add') }}" method="POST" style="margin-right:16px;">
                        @csrf
                        <button class="quantity-btn" onclick="decreaseQuantity()">−</button>
                        <input type="number" class="quantity-input" value="1" min="1"
                            max="{{ $produk->stok }}" id="quantity">
                        <button class="quantity-btn" onclick="increaseQuantity()">+</button>
                        <input type="hidden" name="product_id" value="{{ $produk->id }}">
                    </form>
                    <span class="stock-info">Stok: {{ $produk->stok }} tersedia</span>
                </div>
            </div>

            <div class="action-buttons">
                <button type="submit" class="add-to-cart-btn">Tambah ke Keranjang</button>
                <button type="button" class="buy-now-btn">Beli Sekarang</button>
            </div>
        </div>
    </div>

    <footer style="padding:16px; text-align:center;">
        <p>&copy; 2025 StoreApp. Hak Cipta Dilindungi.</p>
    </footer>

    <script>
        let quantityInput = document.getElementById('quantity');

        function decreaseQuantity() {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        }

        function increaseQuantity() {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue < {{ $produk->stok }}) {
                quantityInput.value = currentValue + 1;
            }
        }
    </script>
</body>

</html>
--}}