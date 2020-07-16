<?php

namespace App\Http\Controllers;

use App\Favorite;
use Illuminate\Http\Request;
use App\User;
use App\Product;
use App\Match;


class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $favorites = $user->favorites()->paginate(10);

        return view('favorites.index', compact('favorites'));
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
        $user = User::find(auth()->user()->id);
        $product = Product::find($request->input('product'));
        $favorite = $user->favorites()->where('product_id', '=', $product->id)->first();
        $userProduct = $product->user()->first();
        
        $match = Match::whereIn('user_id_1', [$user->id, $userProduct->id])->whereIn('user_id_2', [$user->id, $userProduct->id])->first();
        if (!empty($favorite)) {
            $favorite->delete();
            
            if (!is_null($match)) {
                $productIds = [];
                foreach ($user->favorites()->get() as $favorite) {
                    array_push($productIds, $favorite->product_id);
                }

                if (empty($userProduct->products()->whereIn('id', $productIds)->first())) {
                    $match->delete();
                }
            }

            return back()->withInput()->with('success', 'Producto retirado de favoritos.');

        } else {
            $favorite = new Favorite;
            $favorite->user()->associate($user);
            $favorite->product()->associate($product);
            $favorite->save();

            if (is_null($match)) {
                $productIds = [];
                foreach ($userProduct->favorites()->get() as $upf) {
                    array_push($productIds, $upf->product_id);
                }
                
                if (!empty($user->products()->whereIn('id', $productIds)->first())) {
                    $userMatcher = new Match;
                    $userMatcher->user1()->associate($user);
                    $userMatcher->user2()->associate($userProduct);
                    $userMatcher->save();

                    return back()->withInput()->with('success', 'Producto agregado a favoritos e hiciste match con otra persona.');
                }
            }
        }
        
        return back()->withInput()->with('success', 'Producto agregado a favoritos.');
    }

    public function storeHome(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $product = Product::find($request->input('product'));
        $favorite = $user->favorites()->where('product_id', '=', $product->id)->first();
        $userProduct = $product->user()->first();
        
        $match = Match::whereIn('user_id_1', [$user->id, $userProduct->id])->whereIn('user_id_2', [$user->id, $userProduct->id])->first();
        if (!empty($favorite)) {
            $favorite->delete();
            
            if (!is_null($match)) {
                $productIds = [];
                foreach ($user->favorites()->get() as $favorite) {
                    array_push($productIds, $favorite->product_id);
                }

                if (empty($userProduct->products()->whereIn('id', $productIds)->first())) {
                    $match->delete();
                }
            }
        } else {
            $favorite = new Favorite;
            $favorite->user()->associate($user);
            $favorite->product()->associate($product);
            $favorite->save();

            if (is_null($match)) {
                $productIds = [];
                foreach ($userProduct->favorites()->get() as $upf) {
                    array_push($productIds, $upf->product_id);
                }
                
                if (!empty($user->products()->whereIn('id', $productIds)->first())) {
                    $userMatcher = new Match;
                    $userMatcher->user1()->associate($user);
                    $userMatcher->user2()->associate($userProduct);
                    $userMatcher->save();
                }
            }
        }

        return response('Success', 200);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function show(Favorite $favorite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function edit(Favorite $favorite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Favorite $favorite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Favorite $favorite)
    {
        //
    }
}
