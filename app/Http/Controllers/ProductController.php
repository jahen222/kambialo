<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user = User::find(auth()->user()->id);
      $products = $user->products()->paginate(10);

      return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('products.create');
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
           'image' => 'image|nullable|max:1999'
       ]);

       if($request->hasFile('image')){
           $file = $request->file('image');
           $filenameWithExt = $request->file('image')->getClientOriginalName();
           $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
           $extension = $request->file('image')->getClientOriginalExtension();
           $fileNameToStore= $filename.'_'.time().'.'.$extension;
           $file->move(public_path().'/images/',$fileNameToStore);
           //$path = $request->file('image')->storeAs('public/images', $fileNameToStore);
       } else {
           $fileNameToStore = 'noimage.jpg';
       }

       $product = new Product;
       $product->name = $request->input('name');
       $product->description = $request->input('description');
       $product->image = $fileNameToStore;
       $user = User::find(auth()->user()->id);
       $product->user()->associate($user);
       $category = Category::find($request->input('category'));
       $product->category()->associate($category);
       $product->save();

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

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return 'Tiene permiso de editar';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if(auth()->user()->id !== $product->user_id){
            return back()->with('error', 'No puedes hacer eso.');
        }

        if($product->image !== 'noimage.jpg'){
            //Delete image
            Storage::delete('public/images/'.$product->image);
        }
        $product->delete();

        return redirect('/products')->with('success', 'Producto eliminado con éxito.');
    }
}
