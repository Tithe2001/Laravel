<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        // Join stocks with products to get product name
        $stocks = Stock::with('product')->orderBy('id', 'desc')->get();

        return view('pages.erp.stock.index', compact('stocks'));
    }
}
