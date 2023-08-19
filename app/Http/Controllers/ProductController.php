<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('product.index', compact('products'));
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
        request()->validate([
            'productName'=>'required',
            'brandName'=>'required',
            'categoryName'=>'required',
            'file'  => 'required|mimes:png,jpg,jpeg|max:2048',
          ]);
     
          $product = new Product();
          $product->productName = $request->productName;
          $product->brandName = $request->brandName;
          $product->categoryName = $request->categoryName;

           if ($files = $request->file('file')) {
                $fileName = $files->getClientOriginalName();
                $path = 'images';
               //store file into document folder
               $file = $request->file->move($path,$fileName);
    
               //store your file into database
               
               $product->image = $fileName;
               $product->save();
                 
               return Response()->json([
                   "success" => true,
                   "file" => $file
               ]);
     
           }
     
           return Response()->json([
                   "success" => false,
                   "file" => ''
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
    public function edit(Request $request)
    {
        $data  = Product::find($request->id);

        return response()->json([
            'data'=>$data
        ]);
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
        

        request()->validate([
            'productName'=>'required',
            'brandName'=>'required',
            'categoryName'=>'required',
            
          ]);
     
          $product = Product::find($request->updateId);

          $product->productName = $request->productName;
          $product->brandName = $request->brandName;
          $product->categoryName = $request->categoryName;

           if ($files = $request->file('file')) {

                $imgPath = 'images/'.$product->image;
                if(File::exists($imgPath))
                {
                    File::delete($imgPath);
                }
                $fileName = $files->getClientOriginalName();
                $path = 'images';
               //store file into document folder
               $file = $request->file->move($path,$fileName);
    
               //store your file into database
               
               $product->image = $fileName;
               $product->save();
                 
               return Response()->json([
                   "success" => true,
                   "file" => $file
               ]);
     
           }
     
           return Response()->json([
                   "success" => false,
                   "file" => ''
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
        $product  = Product:: find($request->id);
        
        $imgPath = 'images/'.$product->image;
        if(File::exists($imgPath))
        {
            File::delete($imgPath);
        }
        $product->delete();
        return response()->json([
            'status' => 'success',
        ]);
    }
}
