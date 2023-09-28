<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function main()
    {
        $promotions = Promotion::where('is_active', 1)->get();

        return view('main', [
            'promotions' => $promotions
        ]);
    }

    public function about()
    {
        return view('about');
    }

}
