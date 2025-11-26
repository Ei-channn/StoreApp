<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
<<<<<<< HEAD
    public function __construct()
    {
        if (!session('user_id') || session('user_role') !== 'admin') {
            abort(403, 'Anda tidak memiliki akses admin.');
        }
    }

=======
>>>>>>> 6f7eed0abc486500d07b7cc398c5c840bd7c88a5
    public function index()
    {
        return view('admin.index');
    }
}
