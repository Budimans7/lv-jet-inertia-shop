<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Inertia::render('Product/Index', [
            'products' => Product::withTrashed()->get()->map(function ($product) {
                return [
                    'code' => $product->code,
                    'name' => $product->name,
                    'amount' => $product->amount,
                    'desc' => $product->desc,
                    'photo' => asset('storage/'.$product->photo),
                    'disable' => $product->deleted_at,
                    'qty' => 100,
                    'edit_url' => route('collection.edit', $product),
                    'disable_url' => route('collection.disable', $product),
                    'restore_url' => route('collection.restore', $product),
                ];
            }),
            'create_url' => route('collection.create'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return Inertia::render('Product/Create', [
            'store_url' => route('collection.store'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        //
        $image_path = '';

        if ($request->hasFile('photo')) {
            $image_path = $request->file('photo')->store('product-photos', 'public');
        }
        $product = Product::create([
            'code' => $request->code,
            'name' => $request->name,
            'amount' => $request->amount,
            'desc' => $request->desc,
            'photo' => $image_path,
        ]);
        if($product){
            session()->flash('flash.banner', 'Yoho hoo!, your product added succesfully.');
            session()->flash('flash.bannerStyle', 'success');
            return redirect()->route('collection');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product, $id)
    {
        //
        $product = $product->withTrashed()->where('id', $id)->first();
        $img_url = null;
        if($product->photo != null){
            $img_url = asset('storage/'.$product->photo);
        }
        return Inertia::render('Product/Edit', [
            'product' => $product,
            'img_url' => $img_url,
            'update_url' => route('collection.update', $id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product, $id)
    {
        //
        $image_path = '';
        $request->validate([
            'code' => 'required|unique:products,code,'.$id,
            'name' => 'required|unique:products,name,'.$id,
            'amount' => 'required|numeric',
            'desc' => 'max:100',
            'photo' => 'image|mimes:jpeg,jpg,png,gif,svg|max:2048',
        ]);

        if ($request->hasFile('photo') && $request->photo != null) {
            $product = $product->where('id', $id)->first();
            if(Storage::disk('public')->exists($product['photo'])){
                Storage::disk('public')->delete($product['photo']);
            }

            $image_path = $request->file('photo')->store('product-photos', 'public');
        }

        $update = $product->update([
            'code' => $request->code,
            'name' => $request->name,
            'amount' => $request->amount,
            'desc' => $request->desc,
            'photo' => $image_path,
        ]);

        if($update){
            session()->flash('flash.banner', 'Cool!, your product updated succesfully.');
            session()->flash('flash.bannerStyle', 'success');
            return redirect()->route('collection');
        }
    }

    /**
     * Remove the specified resource from product order.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function disable(Product $product, $id)
    {
        //
        $disable = $product->where('id', $id)->delete();
        if($disable){
            return redirect()->back();
        }
    }

    /**
     * Restore the disbaled resource from product order.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function restore(Product $product, $id)
    {
        //
        $restore = $product->where('id', $id)->restore();
        if($restore){
            return redirect()->route('collection');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, $id)
    {
        //
        $delete = $product->where('id', $id)->purge();
        if($delete){
            session()->flash('flash.banner', 'Well Done!, your product deleted permanently.');
            session()->flash('flash.bannerStyle', 'success');
            return redirect()->route('collection');
        }
    }
}
