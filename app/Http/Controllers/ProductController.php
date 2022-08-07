<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use DataTables;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::all();
        return view('Product.index',compact('products'));
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
        $this->validate($request,[
            'NamaBarang' => 'required',
            'HargaBeli' => 'required|numeric',
            'HargaJual' => 'required|numeric',
            'Stok' => 'required|numeric',
            'FotoBarang.*' => 'required|image|mimes:jpg,png|max:100',
        ]);

        $product = new Product;
        $product->NamaBarang = $request->input('NamaBarang');
        $product->HargaBeli = $request->input('HargaBeli');
        $product->HargaJual = $request->input('HargaJual');
        $product->Stok = $request->input('Stok');
        $product->FotoBarang = $request->file('FotoBarang')->store('post-image');

        $product->save();

        return redirect('/product')->with('toast_success', 'Data Saved');

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
        $product = Product::find($id);
        return view('Product.edit',compact('product'));
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
        $this->validate($request,[
            'NamaBarang' => 'required|string',
            'HargaBeli' => 'required|numeric',
            'HargaJual' => 'required|numeric',
            'Stok' => 'required|numeric',
            'FotoBarang.*' => 'required|image|mimes:jpg,png|max:100',
        ]);

        $product = Product::findOrFail($id);
        $product->NamaBarang = $request->NamaBarang;
        $product->HargaBeli = $request->HargaBeli;
        $product->HargaJual = $request->HargaJual;
        $product->Stok = $request->Stok;
        

        if($request->file('FotoBarang')){
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $product->FotoBarang = $request->file('FotoBarang')->store('post-image');
        }

        $product->update();

        return redirect('/product')->with('toast_success', 'Data Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->FotoBarang){
            Storage::delete($product->FotoBarang);
        }

        $delete = Product::destroy($product->id);
        
        if($delete){
            //redirect dengan pesan sukses
            return redirect('/product')->with(['toast_success' => 'Data Deleted!']);
         }else{
           //redirect dengan pesan error
           return redirect('/product')->with(['toast_error' => 'Data Failed Deleted!']);
         }
    }
}
