@extends('Backend.layouts.parent')

@section('title', 'Edit Product')

@section('content')

    {{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div> 
        @endif --}}
    <div class="row">
        <div class="col-12">
            @include('Backend.includes.messages')
        </div>
        <div class="col-12">
            <form action="{{ route('products.update', $ProductDetails->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="col-6">
                        <label for="name_en">Name En</label>
                        <input type="text" name="name_en" id="name_en" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ $ProductDetails->name_en }}">
                        @error('name_en')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="name_ar">Name Ar</label>
                        <input type="text" name="name_ar" id="name_ar" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ $ProductDetails->name_ar }}">
                        @error('name_ar')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-4">
                        <label for="price">Price</label>
                        <input type="number" name="price" id="price" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ $ProductDetails->price }}">
                        @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-4">
                        <label for="quantity">Quantity</label>
                        <input type="text" name="quantity" id="quantity" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ $ProductDetails->quantity }}">
                        @error('quantity')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-4">
                        <label for="code">Code</label>
                        <input type="text" name="code" id="code" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ $ProductDetails->code }}">
                        @error('code')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-4">
                        <label for="status">status</label>
                        <select name="status" id="status" class="form-control">
                            <option {{ $ProductDetails->status == 1 ? 'selected' : '' }} value='1'>Active</option>
                            <option {{ $ProductDetails->status == 0 ? 'selected' : '' }} value='2'>Not Active</option>
                            @error('status')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </select>
                    </div>
                    <div class="col-4">
                        <label for="brand_id">Brand</label>
                        <select name="brand_id" id="brand_id" class="form-control">
                            @foreach ($brands as $brand)
                                <option {{ $ProductDetails->brand_id == $brand->id ? 'selected' : '' }}
                                    value="{{ $brand->id }}">
                                    {{ $brand->name_en }}</option>
                            @endforeach
                            @error('brand_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </select>
                    </div>
                    <div class="col-4">
                        <label for="Subcategory_id">Subcategory</label>
                        <select name="subcategories_id" id="subcategories_id" class="form-control">
                            @foreach ($subcategories as $subcategory)
                                <option {{ $ProductDetails->subcategories_id == $subcategory->id ? 'selected' : '' }}
                                    value="{{ $subcategory->id }}">{{ $subcategory->name_en }}</option>
                            @endforeach
                            @error('subcategories_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </select>
                    </div>

                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label for="desc_ar">Description Ar</label>
                        <textarea name="desc_ar" id="desc_ar" class="form-control" placeholder=""aria-describedby="helpId">{{ $ProductDetails->desc_ar }}</textarea>
                        @error('desc_en')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="desc_en">Description En</label>
                        <textarea type="text" name="desc_en" id="desc_en" class="form-control" placeholder="" aria-describedby="helpId">{{ $ProductDetails->desc_en }}</textarea>
                        @error('desc_ar')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row my-2">
                    <div class="col-12">
                        <label for="image">Product Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6 my-3">

                        <img src="{{ url('dist/img/products/' . $ProductDetails->image) }}"
                            alt="{{ $ProductDetails->image }}" class="w-50">
                    </div>

                </div>
                <div class="form-row">
                    <div class="col-2 my-2
            ">
                        <button class="btn btn-warning" name="page">Update</button>
                    </div>

                </div>

            </form>
        </div>
    </div>
@endsection
