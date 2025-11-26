<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Saya - Sederhana & Bagus</title>
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
</head>

<body>

    @include('layout.header')

    <section class="hero">
        <h1>Temukan Kualitas Terbaik.</h1>
        <p>Diskon spesial 20% untuk semua produk baru!</p>
        <a href="#products" class="cta-button">Belanja Sekarang</a>
    </section>

    <section id="products" class="products-container">
        <h2>Produk Unggulan</h2>

        @foreach ($produks as $produk)
            <div class="product-card" data-product-id="{{ $produk->id }}" data-price="{{ $produk->harga }}">
                <a href="{{ route('user.detail', $produk->id) }}">
                    <img src="{{ $produk->gambar }}" alt="{{ $produk->nama }}">
                    <h3>{{ $produk->nama }}</h3>
                </a>
                <p class="price">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>

                <form action="{{ route('user.keranjang.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $produk->id }}">
                    <button type="submit" class="add-to-cart">Tambah ke Keranjang</button>
                </form>
            </div>
        @endforeach

    </section>

    <div id="cart-modal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h3>Isi Keranjang Anda</h3>
            <ul id="cart-items">
            </ul>
            <p class="cart-total">Total: <span id="total-price">Rp 0</span></p>
            <button class="checkout-button">Lanjut ke Pembayaran</button>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 StoreApp. Hak Cipta Dilindungi.</p>
    </footer>

</body>

</html>

<script>
    // Ensure qty inputs never go below 1
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.qty-input').forEach(function(el) {
            el.addEventListener('change', function() {
                if (parseInt(this.value) < 1 || isNaN(parseInt(this.value))) this.value = 1;
            });
        });
    });
</script>
