<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        // Ambil kategori unik untuk filter
        $categories = Portfolio::select('category')->distinct()->pluck('category');
        $portfolios = Portfolio::latest()->get();
        
        return view('landing.portfolio', compact('portfolios', 'categories'));
    }
}