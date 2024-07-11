<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\traits\media;

class ProductController extends Controller
{
    use media;
    //
    public function index()
    {
        //get all products

        $products = DB::table('products')
            ->select('*')
            ->get();
        //pass them to the product view
        return view('Backend.products.index', compact('products'));
    }

    public function create()
    {
        $brands = DB::table('brands')
            ->select('id', 'name_en')
            ->where('status', '=', 1)
            ->get();
        $subcategories = DB::table('subcategories')
            ->where('status', 1)
            ->get();
        return view('Backend.products.create', compact('brands', 'subcategories'));
    }

      public function store(StoreProductRequest $request)
    {
        //storeproductrequest to validate automatic on the form fields
        //dd($request->all()); 
        $ProductData = $request->except('_token', 'page', 'image');
        //upload image to the server
        $photoName = $this->UploadPhoto($request->image, 'products');
        $ProductData['image'] = $photoName;

        //insert to db
        DB::table('products')
            ->insert($ProductData);
        return redirect()->route('products.index')->with('success', 'Successfull Operation');
       // return $this->redirectAccordingToRequest($request);
    }

    public function edit($id)
    {
        $ProductDetails = DB::table('products')
            ->where('id', $id)
            ->first(); //return row data as one object
        //dd($ProductDetails);

        $brands = DB::table('brands')
            ->select('id', 'name_en')
            ->where('status', '=', 1)
            ->get();
        $subcategories = DB::table('subcategories')
            ->where('status', 1)
            ->get();
        return view('Backend.products.edit', compact('ProductDetails', 'subcategories', 'brands'))->with('success', 'Successfull Operation');
    }

    public function update(Request $request, $id)
    {
        $ProductData = $request->except('_token', 'page', 'image', '_method');
        //dd($request->all());
        //validation
        $request->validate([
            'name_en' => ['required', 'string', 'max:256', 'min:2'],
            'name_ar' => ['required', 'string', 'max:256', 'min:2'],
            'price' => ['required', 'numeric', 'max:99999.99', 'min:2'],
            'code' => ['required', 'integer', 'digits:5', "unique:products,code,$id,id"],
            'quantity' => ['nullable', 'integer', 'max:999', 'min:1'],
            'desc_en' => ['required', 'string'],
            'desc_ar' => ['required', 'string'],
            'status' => ['required', 'integer', 'between:0,1'],
            'subcategories_id' => ['required', 'integer', 'exists:subcategories,id'],
            'brand_id' => ['required', 'integer', 'exists:brands,id'],
            'image' => ['nullable', 'max:1000', 'mimes:png,jpg,jpeg'] //max is in kb,
        ]);
        //if photo exists in the form
        if ($request->has('image')) {
            //delete the old photo then add the new one
            $OldPhoto = DB::table('products')->select('image')->where('id', $id)->first()->image;
            //delete photo
           $this->DeletePhoto(public_path('dist/img/products/').$OldPhoto);
          

            //upload image to the server
            $PhotoName =  $this->UploadPhoto($request->image, 'products');
            $ProductData['image'] = $PhotoName;
        }
        //dd($ProductData);
        //insert 
        DB::table('products')->where('id', $id)->update($ProductData);

        return redirect()->route('products.index')->with('success', 'Successfull Operation');
    }
  
    public function destroy($id)
    {
        //delete product photo -> then delete the product from db
        $OldPhoto = DB::table('products')->select('image')->where('id', $id)->first()->image;
        $this->DeletePhoto(public_path('dist/img/products/').$OldPhoto);
        //delete the product
        DB::table('products')->where('id', $id)->delete();

        return redirect()->route('products.index')->with('success', 'Successfull Operation');
    }
}
