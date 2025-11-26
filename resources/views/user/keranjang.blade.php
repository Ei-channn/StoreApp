<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang</title>
    <link rel="stylesheet" href="{{ asset('css/keranjang.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('layout.header')
    <div class="container py-4">
        <h1>Keranjang Belanja</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if (empty($cart) || count($cart) === 0)
            <div class="alert alert-info">Keranjang kosong. <a href="{{ route('user.index') }}">Belanja sekarang</a>
            </div>
        @else
            <div class="cart-container" id="cartContainer">
                <div class="cart-items">
                    <div class="cart-header">
                        <h1>Keranjang Belanja</h1>
                        <span class="item-count"><span id="itemCount">{{ count($cart) }}</span> item</span>
                    </div>
                    <div id="cartItemsList">
                        @foreach ($cart as $id => $item)
                            <div class="cart-item" data-id="{{ $id }}" data-price="{{ $item['harga'] }}">
                                <img src="{{ $item['gambar'] }}" alt="{{ $item['nama'] }}" class="item-image">

                                <div class="item-details">
                                    <div class="item-name">{{ $item['nama'] }}</div>
                                    <div class="item-price">Rp {{ number_format($item['harga'], 0, ',', '.') }}</div>
                                </div>

                                <div class="item-actions">
                                    <div class="quantity-controls">
                                        <form method="POST" action="{{ route('user.keranjang.remove', $id) }}"
                                            style="display:inline;">
                                            @csrf
                                            <button type="button" class="quantity-btn"
                                                onclick="this.parentElement.parentElement.parentElement.nextElementSibling.value--; this.parentElement.parentElement.parentElement.nextElementSibling.dispatchEvent(new Event('change'));">−</button>
                                        </form>
                                        <input type="number" class="quantity-input" value="{{ $item['qty'] }}"
                                            min="1" id="qty-{{ $id }}"
                                            data-product-id="{{ $id }}">
                                        <button class="quantity-btn"
                                            onclick="this.parentElement.previousElementSibling.value++; this.parentElement.previousElementSibling.dispatchEvent(new Event('change'));">+</button>
                                    </div>
                                    <form method="POST" action="{{ route('user.keranjang.remove', $id) }}"
                                        style="display:inline;">
                                        @csrf
                                        <button type="submit" class="remove-btn" title="Hapus">🗑️</button>
                                    </form>
                                </div>

                                <div class="item-total">
                                    <div class="item-total-price" id="total-{{ $id }}">Rp
                                        {{ number_format($item['harga'] * $item['qty'], 0, ',', '.') }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="cart-summary">
                    <h2 class="summary-title">Ringkasan Belanja</h2>

                    @php
                        $subtotal = 0;
                        foreach ($cart as $item) {
                            $subtotal += ($item['harga'] ?? 0) * ($item['qty'] ?? 0);
                        }
                        $shipping = 25000;
                        $total = $subtotal + $shipping;
                    @endphp

                    <div class="summary-row">
                        <span>Subtotal (<span id="summaryCount">{{ count($cart) }}</span> item)</span>
                        <span id="subtotal">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>

                    <div class="summary-row">
                        <span>Ongkos Kirim</span>
                        <span id="shipping">Rp {{ number_format($shipping, 0, ',', '.') }}</span>
                    </div>

                    <div class="summary-row total">
                        <span>Total</span>
                        <span id="grandTotal">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <div class="promo-code">
                        <div class="promo-input-group">
                            <input type="text" class="promo-input" placeholder="Kode Promo" id="promoInput">
                            <button class="promo-btn">Terapkan</button>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('user.keranjang.checkout') }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="checkout-btn">Lanjut ke Pembayaran</button>
                    </form>

                    <div class="secure-checkout">Transaksi Aman & Terenkripsi</div>
                </div>
            </div>
        @endif
    </div>
</body>

</html>
