<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $produk->nama }} - Detail Produk</title>
    <link rel="stylesheet" href="{{ asset('css/user-detail.css') }}">
</head>

<body>
    @include('layout.header')
    <br><br>

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

                <form action="{{ route('user.keranjang.add') }}" method="POST" id="add-to-cart-form">
                    @csrf
                    <div class="quantity-controls">
                        <button type="button" class="quantity-btn" id="incqtyy">−</button>
                        <input type="number" class="quantity-input" value="1" min="1"
                            max="{{ $produk->stok }}" id="quantity" name="qty">
                        <button type="button" class="quantity-btn" id="incqty">+</button>
                        <input type="hidden" name="product_id" value="{{ $produk->id }}">
                        <span class="stock-info">Stok: {{ $produk->stok }} tersedia</span>
                    </div>

                    <div class="action-buttons">
                        <button type="submit" class="add-to-cart-btn">Tambah ke Keranjang</button>
                        <button type="button" class="buy-now-btn">Beli Sekarang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer style="padding:16px; text-align:center;">
        <p>&copy; 2025 StoreApp. Hak Cipta Dilindungi.</p>
    </footer>
</body>

</html>
<script>
    let quantityInput = document.getElementById('quantity');

    document.getElementById('incqtyy').addEventListener('click', function(e) {
        e.preventDefault();
        let currentValue = parseInt(quantityInput.value);
        let minValue = parseInt(quantityInput.min);
        if (currentValue > minValue) {
            quantityInput.value = currentValue - 1;
        }
    });

    document.getElementById('incqty').addEventListener('click', function(e) {
        e.preventDefault();
        let currentValue = parseInt(quantityInput.value);
        let maxValue = parseInt(quantityInput.max);
        if (currentValue < maxValue) {
            quantityInput.value = currentValue + 1;
        }
    });
</script>
