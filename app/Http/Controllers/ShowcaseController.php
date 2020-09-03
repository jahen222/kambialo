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

    public function data()
    {
        return [
            'products' => $this->_search()->get(),
            'categories' => \App\Category::all(),
            'comunas' => \App\Comuna::all(),
            'tags' => \App\Tag::all()
        ];
    }

    private function _search()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return Product::distinct()->leftJoin('favorites', function ($join) use ($user) {
            $join->on('products.id', '=', 'favorites.product_id');
            $join->on('favorites.user_id', '=', \Illuminate\Support\Facades\DB::raw($user->id));
        })->join('users', 'users.id', '=', 'products.user_id')->where('products.user_id', '!=', $user->id)
            ->leftJoin('product_tag', 'product_tag.product_id', '=', 'products.id')
            ->leftJoin('tags', 'product_tag.tag_id', '=', 'tags.id')
            ->whereNull('favorites.id')->with('images')->withCount('favorites');
    }


    public function search(Request $request)
    {
        $products = $this->_search();
        if ($request->input('category'))
            $products->where('category_id', '=', $request->input('category'));

        if ($request->input('comuna'))
            $products->where('comuna_id', '=', $request->input('comuna'));

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
        return ['success' => (bool) $favorite, 'match' => (bool) $match];
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
