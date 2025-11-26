<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        if (!session('user_id') || session('user_role') !== 'admin') {
            abort(403, 'Anda tidak memiliki akses admin.');
        }
    }

    public function index()
    {
        return view('admin.index');
    }
}
