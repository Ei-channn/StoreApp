<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class KeranjangController extends Controller
{
    // Tampilkan isi keranjang
    public function index()
    {
        $cart = session('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += ($item['harga'] ?? 0) * ($item['qty'] ?? 0);
        }

        return view('user.keranjang', compact('cart', 'total'));
    }

    // Tambah produk ke keranjang (menggunakan product id dan qty)
    public function add(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|integer|exists:produks,id',
            'qty' => 'nullable|integer|min:1'
        ]);

        $qty = $data['qty'] ?? 1;
        $product = Produk::find($data['product_id']);
        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        $cart = session('cart', []);

        $id = $product->id;
        if (isset($cart[$id])) {
            $cart[$id]['qty'] += $qty;
        } else {
            $cart[$id] = [
                'id' => $product->id,
                'nama' => $product->nama,
                'harga' => $product->harga,
                'qty' => $qty,
                'gambar' => $product->gambar,
            ];
        }

        session(['cart' => $cart]);

        return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang.');
    }

    // Hapus item dari keranjang
    public function remove($id)
    {
        $cart = session('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session(['cart' => $cart]);
            return redirect()->back()->with('success', 'Item dihapus dari keranjang.');
        }

        return redirect()->back()->with('error', 'Item tidak ditemukan di keranjang.');
    }

    // Checkout sederhana: kosongkan keranjang
    public function checkout()
    {
        session()->forget('cart');
        return redirect()->route('user.keranjang')->with('success', 'Checkout berhasil. Terima kasih!');
    }
}
