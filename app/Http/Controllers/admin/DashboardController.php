<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $data = ['title' => 'Dashboard'];
        return view('admin.dashboard.index', $data);
    }
}
