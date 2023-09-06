@extends('admin.layout.app')
@section('heading','Product')
@section('product','active')
@section('content')
<a href="{{Route('admin.product.form')}}"  class="btn btn-info" style="float:right;">Add Product</a>

  
        
            <form class="row" action="{{Route('admin.add.product')}}" method="post" enctype="multipart/form-data">
                @csrf 
                <div class="col-xl-6">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}">
                        @error('name')
                        <span>{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="form-group">
                        <label for="">Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control" value="{{old('slug')}}">
                        @error('slug')
                        <span>{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="form-group">
                        <label for="">Category</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <span>{{$message}}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-xl-6">
                <div class="form-group">
                    <label for="">Brand</label>
                    <input type="text" name="brand" id="brand" class="form-control" value="{{old('brand')}}">
                </div>
                </div>

                <div class="col-xl-6">
                <div class="form-group">
                    <label for="">Modal</label>
                    <input type="text" name="modal" id="modal" class="form-control" value="{{old('modal')}}">
                </div>
                </div>

                <div class="col-xl-6">
                <div class="form-group">
                    <label for="">Short Desc</label>
                    <input type="text" name="short_desc" id="short_desc" class="form-control" value="{{old('short_desc')}}">
                </div>
                </div>

                <div class="col-xl-6">
                <div class="form-group">
                    <label for="">Description</label>
                    <input type="text" name="desc" id="desc" class="form-control" value="{{old('desc')}}">
                </div>
                </div>

                <div class="col-xl-6">
                <div class="form-group">
                    <label for="">Keywords</label>
                    <input type="text" name="keywords" id="keywords" class="form-control" value="{{old('keywords')}}">
                </div>
                </div>

                <div class="col-xl-6">
                <div class="form-group">
                    <label for="">Technical Specification</label>
                    <input type="text" name="technical_specification" id="technical_specification" class="form-control" value="{{old('technical_specification')}}">
                </div>
                </div>

                <div class="col-xl-6">
                <div class="form-group">
                    <label for="">User</label>
                    <input type="text" name="users" id="users" class="form-control" value="{{old('users')}}">
                </div>
                </div>

                <div class="col-xl-6">
                <div class="form-group">
                    <label for="">Warranty</label>
                    <input type="text" name="warranty" id="warranty" class="form-control" value="{{old('warranty')}}">
                </div>
                </div>

                <div class="col-xl-6">
                <div class="form-group">
                    <label for="">Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                    @error('image')
                    <span>{{$message}}</span>
                    @enderror
                </div>
                </div>

                <div class="append">
                <fieldset class="row">
                <legend>Product Attribute:</legend>
                <div class="col-xl-4">
                    <div class="form-group">
                        <label for="">SKU</label>
                        <input type="text" name="sku[]" id="sku" class="form-control">
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="form-group">
                        <label for="">Image</label>
                        <input type="file" name="attr_image[]" id="attr_image" class="form-control">
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="form-group">
                        <label for="">MRP</label>
                        <input type="text" name="mrp[]" id="mrp" class="form-control">
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="form-group">
                        <label for="">Price</label>
                        <input type="text" name="price[]" id="price" class="form-control">
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="form-group">
                        <label for="">QTY</label>
                        <input type="text" name="qty[]" id="qty" class="form-control">
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="form-group">
                        <label for="">Size</label>
                        <select name="size_id[]" id="size_id" class="form-control">
                            <option value="">Select Size</option>
                            @foreach($sizes as $size_value)
                            <option value="{{$size_value->id}}">{{$size_value->size}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="form-group">
                        <label for="">Color</label>
                        <select name="color_id[]" id="color_id" class="form-control">
                            <option value="">Select Color</option>
                            @foreach($colors as $color)
                            <option value="{{$color->id}}">{{$color->color_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                </fieldset>
                </div>
                <div class="col-xl-12">
                    <span class="btn btn-info pull-right add">Add</span>
                </div>
                <input type="submit" value="Save" class="btn btn-info">
            </form>
        
    



@endsection


@section('script')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script>
    
   $(".add").click(function(){
        
        var html="";
        html+='<fieldset class="row">';
        html+='<legend>Product Attribute:</legend>';
        html+='<div class="col-xl-4">';
        html+='<div class="form-group">';
        html+='<label for="">SKU</label>';
        html+='<input type="text" name="sku[]" id="sku" class="form-control">';
        html+='</div>';
        html+='</div>';
        html+='<div class="col-xl-4">';
        html+='<div class="form-group">';
        html+='<label for="">Image</label>';
        html+='<input type="file" name="attr_image[]" id="attr_image" class="form-control">';
        html+='</div>';
        html+='</div>';
        html+='<div class="col-xl-4">';
        html+='<div class="form-group">';
        html+='<label for="">MRP</label>';
        html+='<input type="text" name="mrp[]" id="mrp" class="form-control">';
        html+='</div>';
        html+='</div>';
        html+='<div class="col-xl-4">';
        html+='<div class="form-group">';
        html+='<label for="">Price</label>';
        html+='<input type="text" name="price[]" id="price" class="form-control">';
        html+='</div>';
        html+='</div>';
        html+='<div class="col-xl-4">';
        html+='<div class="form-group">';
        html+='<label for="">QTY</label>';
        html+='<input type="text" name="qty[]" id="qty" class="form-control">';
        html+='</div>';
        html+='</div>';
        html+='<div class="col-xl-4">';
        html+='<div class="form-group">';
        html+='<label for="">Size</label>';
        html+='<select name="size_id[]" id="size_id" class="form-control">';
        html+='<option value="">Select Size</option>';
        @foreach($sizes as $size_value)
        html+='<option value="{{$size_value->id}}">{{$size_value->size}}</option>';
        @endforeach
        html+='</select>';
        html+='</div>';
        html+='</div>';
        html+='<div class="col-xl-4">';
        html+='<div class="form-group">';
        html+='<label for="">Color</label>';
        html+='<select name="color_id[]" id="color_id" class="form-control">';
        html+='<option value="">Select Color</option>';
        @foreach($colors as $color)
        html+='<option value="{{$color->id}}">{{$color->color_name}}</option>';
        @endforeach
        html+='</select>';
        html+='</div>';
        html+='</div>';
        html+='</fieldset>';
        $(".append").append(html);
   }); 
</script>
@endsection