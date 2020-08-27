<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);
        $categories = Category::all();

        return view('home', compact('products', 'categories'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchCategory(Request $request)
    {
        $category = Category::find($request->input('search'));
        if ($category->name == "Todos") {
            $products = Product::latest()->paginate(10);
        }
        else{
          $products = $category->products;
        }
        $categories = Category::all();

        return view('home', compact('products', 'categories'));
    }
}
