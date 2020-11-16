<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\Match;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Category;
use App\Tag;
use App\ProductImage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $products = $user->products();

        if ($request->input('category'))
            $products->where('category_id', '=', $request->input('category'));

        //        if ($request->input('search'))
        $products->where(function ($query) use ($request) {
            $query->orWhere('name', 'like', $request->input('search') . '%')
                ->orWhere('description', 'like', $request->input('search') . '%');
        });

        $products = $products->paginate(10);

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();

        return view('products.create')->with('tags', $tags)->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description'  => 'required',
            'cover_image' => 'image'
        ]);

        $user = User::find(auth()->user()->id);

        $quote = $user->subscription()->get()[0]->quote;
        $count = count($user->products()->get());

        if ($count >= $quote) {
            return redirect('/products')->with('error', 'Tu suscripción no te permite tener mas productos.');
        }

        $product = new Product;

        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            $filename = str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME));
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $file->move(public_path() . '/images/', $fileNameToStore);
        } else {
            $fileNameToStore = 'default.jpg';
        }

        $product->cover_image = $fileNameToStore;

        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->user()->associate($user);
        $category = Category::find($request->input('category'));
        $product->category()->associate($category);
        $product->save();

        if ($request->hasFile('images') && $images = $request->file('images')) {
            foreach ($images as $key => $value) {
                $filenameWithExt = $value->getClientOriginalName();
                $filename = str_replace(' ', '_', pathinfo($filenameWithExt, PATHINFO_FILENAME));
                $extension = $value->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $value->move(public_path() . '/images/', $fileNameToStore);

                $image = new ProductImage();
                $image->product()->associate($product);
                $image->image = $fileNameToStore;
                $image->save();
            }
        }

        if ($request->tags != null) {
            $product->tags()->sync($request->tags);
        }

        return redirect('/products')->with('success', 'Producto creado con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $user = User::find(auth()->user()->id);

        return view('products.show')->with('product', $product)->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tags = Tag::all();
        $categories = Category::all();
        $product = Product::find($id);

        return view('products.edit')->with('tags', $tags)->with('categories', $categories)->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'description'  => 'required',
            'cover_image' => 'image'
        ]);

        $product = Product::find($id);

        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $file->move(public_path() . '/images/', $fileNameToStore);
            $product->cover_image = $fileNameToStore;
        }

        if ($request->hasFile('images') && $images = $request->file('images')) {
            foreach ($images as $key => $value) {
                $filenameWithExt = $value->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $value->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $value->move(public_path() . '/images/', $fileNameToStore);

                if (isset($product->images[$key])) {
                    //updating an instance
                    $image = $product->images[$key];
                } else {
                    //creating new instance
                    $image = new ProductImage();
                    $image->product()->associate($product);
                }
                $image->image = $fileNameToStore;
                $image->save();
            }
        }

        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $category = Category::find($request->input('category'));
        $product->category()->associate($category);
        $product->update();

        if ($request->tags != null) {
            $product->tags()->sync($request->tags);
        }

        return redirect('/products')->with('success', 'Producto editado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (auth()->user()->id !== $product->user_id) {
            return back()->with('error', 'No puedes hacer eso.');
        }

        if ($product->cover_image !== 'noimage.jpg') {
            Storage::delete(config('constants.publicUrl') . 'images/' . $product->image);
        }

        foreach ($product->images as $image) {
            Storage::delete(config('constants.publicUrl') . 'images/' . $image->image);
        }
        ProductImage::where('product_id', $id)->delete();

        foreach (Favorite::where('product_id', $id)->get() as $favorite) {
            $match = Match::where('user_id_1', $favorite->user_id)->orWhere('user_id_2', $favorite->user_id)->first();

            if (!is_null($match)) {
                $match->delete();
            }
            $favorite->delete();
        }
        $product->delete();

        return redirect('/products')->with('success', 'Producto eliminado con éxito.');
    }
}
