<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::latest()->get();
       return view('brand.index',['brands' => $brands]);
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
        $request->validate([
            'name'=>'required|unique:brands',
                
            ],
            [
                'name.required'=>'Brand Name is required',
                'name.unique'=>'Brand already exists'
                
            ]);

        $brands = new Brand();
        $brands->name = $request->name;
        $brands->save();

        return response()->json([
            'status'=>'success',
           ]);


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
       


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      
        //dd($request->all());
        $request->validate([
            'up_brand_name'=>'required|unique:brands,name,'.$request->up_brand_id,
                
            ],
            [
                'up_brand_name.required'=>'Brand Name is required',
                'up_brand_name.unique'=>'Brand already exists'
                
            ]);

        $brands = Brand::find($request->up_brand_id);
        $brands->name = $request->up_brand_name;
        $brands->update();

        return response()->json([
            'status'=>'success',
           ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        
        $brands = Brand::find($request->brand_id);
        $brands->delete();
        return response()->json([
            'status'=>'success',
           ]);
    }
}
