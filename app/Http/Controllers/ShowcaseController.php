<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Product;
use App\Favorite;
use App\Match;

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

    public function data(Request $request)
    {
        return [
            'products' => $this->_search()->where('category_id', $request->input('category'))->get(),
            'categories' => \App\Category::all(),
            'comunas' => \App\Comuna::all(),
            'tags' => \App\Tag::all()
        ];
    }

    private function _search()
    {
        $_query = Product::distinct()->join('users', 'users.id', '=', 'products.user_id')
        ->leftJoin('product_tag', 'product_tag.product_id', '=', 'products.id')
        ->leftJoin('tags', 'product_tag.tag_id', '=', 'tags.id')->with('images')->withCount('favorites');
        if(!auth()->user())
            return $_query;
        return $_query->where('products.user_id', '!=', auth()->user()->id);        
    }


    public function search(Request $request)
    {
        $products = $this->_search();
        if ($request->input('categories'))
            $products->whereIn('category_id', $request->input('categories'));

        if ($request->input('comunas'))
            $products->whereIn('comuna_id', $request->input('comunas'));

        if ($request->input('tags'))
            $products->whereIn('tag_id', $request->input('tags'));

        $products->where(function ($query) use ($request) {
            $query->orWhere('products.name', 'like', $request->input('search') . '%')
                ->orWhere('products.description', 'like', $request->input('search') . '%');
        });
        return $products->get();
    }

    public function favorite(Request $request)
    {
        $favoriteMessage = 'Agregado a favorito';
        if(!auth()->user())
            $favoriteMessage = 'Debe iniciar sesion para agregar a favorito';
        else{
            $user_id = auth()->user()->id;
            $user = User::find($user_id);
    
            $product = Product::where('id', $request->input('id'))->first();
            $userProduct = $product->user()->first();
    
            $favorite = $user->favorites()->where('product_id', $product->id)->first();
            if (!$favorite)
                $favorite = Favorite::create(['product_id' => $request->input('id'), 'user_id' => $user->id]);
    
            $match = Match::whereIn('user_id_1', [$user->id, $userProduct->id])->whereIn('user_id_2', [$user->id, $userProduct->id])->first();
            if (!$match) {
                if ($allUserProducts = $userProduct->favorites()->get()->toArray()) {
                    if ($user->products()->whereIn('id', array_column($allUserProducts, 'product_id'))->get())
                        $match = Match::create(['user_id_1' => $user->id, 'user_id_2' => $userProduct->id]);
                }
            }
        }

        return [
            'favorite' => (bool) ($favorite ?? false),
            'favoriteMessage' => $favoriteMessage,
            'match' => (bool) ($match ?? false),
            'matchMessage' => '',
        ];
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
