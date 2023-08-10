<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $data = [
            'title' => 'Dashboard Client',
        ];
        return view('client.dashboard.index', $data);
    }
}
