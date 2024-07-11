@extends('Backend.layouts.parent')

@section('title', 'Create Product')

@section('content')
    <div class="col-12">
        {{--  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div> 
        @endif--}}
        @include('Backend.includes.messages')
    </div>
    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="col-6">
                <label for="name_en">Name En</label>
                <input type="text" name="name_en" id="name_en" class="form-control" placeholder=""
                    aria-describedby="helpId">
                @error('name_en')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-6">
                <label for="name_ar">Name Ar</label>
                <input type="text" name="name_ar" id="name_ar" class="form-control" placeholder=""
                    aria-describedby="helpId">
                @error('name_ar')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="col-4">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" class="form-control" placeholder=""
                    aria-describedby="helpId">
                @error('price')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-4">
                <label for="quantity">Quantity</label>
                <input type="text" name="quantity" id="quantity" class="form-control" placeholder=""
                    aria-describedby="helpId">
                @error('quantity')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-4">
                <label for="code">Code</label>
                <input type="text" name="code" id="code" class="form-control" placeholder=""
                    aria-describedby="helpId">
                @error('code')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="col-4">
                <label for="status">status</label>
                <select name="status" id="status" class="form-control">
                    <option value='1'>Active</option>
                    <option value='2'>Not Active</option>

                </select>
                @error('status')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-4">
                <label for="brand_id">Brand</label>
                <select name="brand_id" id="brand_id" class="form-control">
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name_en }}</option>
                    @endforeach


                </select>
                @error('brand_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-4">
                <label for="Subcategory_id">Subcategory</label>
                <select name="subcategories_id" id="subcategory_id" class="form-control">
                    @foreach ($subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}">{{ $subcategory->name_en }}</option>
                    @endforeach

                </select>
                @error('subcategories_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>
        <div class="form-row">
            <div class="col-6">
                <label for="desc_ar">Description Ar</label>
                <textarea name="desc_ar" id="desc_ar" class="form-control" cols="30" rows="10"></textarea>
                @error('desc_en')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-6">
                <label for="desc_en">Description En</label>

                <textarea name="desc_en" id="desc_en" class="form-control" cols="30" rows="10"></textarea>
                @error('desc_en')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="col-4">
                <label for="image">Product Image</label>
                <input type="file" name="image" id="image" class="form-control">
                @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="form-row my-2">
            <div class="col-2">
                <button class="btn btn-primary" name="page">Create</button>
            </div>

        </div>

    </form>
@endsection
