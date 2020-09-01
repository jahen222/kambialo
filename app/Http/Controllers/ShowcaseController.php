<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Product;
use App\Favorite;

class ShowcaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('showcase.index');
    }

    public function data()
    {
        return [
            'products' => $this->_search()->get(),
            'categories' => \App\Category::all(),
        ];
    }

    private function _search()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return Product::leftJoin('favorites', function($join) use ($user){
            $join->on('products.id', '=', 'favorites.product_id');
            $join->on('favorites.user_id', '=', \Illuminate\Support\Facades\DB::raw($user->id));
        })->where('products.user_id', '!=', $user->id)->whereNull('favorites.id')->with('images')->withCount('favorites');
    }


    public function search(Request $request)
    {
        $products = $this->_search();
        if ($request->input('category'))
            $products->where('category_id', '=', $request->input('category'));

        $products->where(function ($query) use ($request) {
            $query->orWhere('name', 'like', $request->input('search') . '%')
                ->orWhere('description', 'like', $request->input('search') . '%');
        });
        return $products->get();
    }

    public function favorite(Request $request)
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        $favorite = Favorite::where('product_id', $request->input('id'))->where('user_id', $user->id)->first();
        if(!$favorite)
            $favorite = Favorite::create(['product_id' => $request->input('id'), 'user_id' => $user->id]);
        
        return ['success' => (bool) $favorite];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
