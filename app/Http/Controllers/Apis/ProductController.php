<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\traits\ApiTrait;
use App\Http\traits\media;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{ use media,ApiTrait;
    //using elequent model
    public function index(){
       $products = Product::all();//select * from products
       return $this->data(compact('products'));//compact converts the products var into an assoc arr with key"products"
    }
    public function create(){
        $brands=Brand::all();
        $subcategories = Subcategory::select('id','name_en')->get();
        return $this->data(compact('brands','subcategories'));
        
    }
   
    public function store(StoreProductRequest $request)
    {
        //storeproductrequest to validate automatic on the form fields
        //dd($request->all()); 
        $ProductData = $request->except('image');
        //upload image to the server
        $photoName = $this->UploadPhoto($request->image, 'products');
        $ProductData['image'] = $photoName;

        //insert to db
        //to used create(), we must apply a guarded or fillable to the specified colomns in the model used
        Product::create($ProductData);
        return $this->SuccessMessage('product stored successfuly',201);//201 for create
}
 public function edit($ProductId){
        //$product = Product::select()->where('id',$ProductId);
        //$product = Product::find($ProductId);
        //fist validate on the id 
        $product = Product::findOrFail($ProductId);
        $brands=Brand::all();
        $subcategories = Subcategory::select('id','name_en')->get();
        return $this->data(compact('product','brands','subcategories'));

        
}

public function update(Request $request, $id)
{
    $product = Product::find($id);
    if($product){
    $ProductData = $request->except( 'image','_method');
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
        $OldPhoto = Product::find($id)->image;
        //delete photo
        $photoPath = public_path('dist/img/products/').$OldPhoto;
        $this->DeletePhoto($photoPath);
        //upload the new image to the server
        $PhotoName =  $this->UploadPhoto($request->image, 'products');
        $ProductData['image'] = $PhotoName;
    }
    //insert 
  Product::where('id', $id)->update($ProductData);

  return $this->SuccessMessage('product updated successfuly');
}
else{
    return $this->ErrorMessage(['id'=>'The Id Is Invalid'],'The given data was invalid.',422); // return Error message

}}

public function destroy($id)
{
    
    //check if the id in url is in dv
    $product = Product::find($id);
    if($product){
    //delete product photo -> then delete the product from db
    $OldPhoto = Product::find($id)->image;
    $photoPath = public_path('dist/img/products/').$OldPhoto;
    $this->DeletePhoto($photoPath);
    //delete the product
    Product::where('id', $id)->delete();

    return $this->SuccessMessage('product deleted successfuly');
}

else{
    return $this->ErrorMessage(['id'=>'The Id Is Invalid'],'The given data was invalid.',422); // return Error message

}
}
}
