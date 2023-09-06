@extends('admin.layout.app')
@section('heading','Product')
@section('product','active')
@section('content')
<a href="{{Route('admin.product.form')}}"  class="btn btn-info" style="float:right;">Add Product</a>

<div class="container">
    <div class="row">
        <div class="col-xl-6">
            <form action="{{Route('admin.add.product')}}" method="post" enctype="multipart/form-data">
                @csrf 
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}">
                    @error('name')
                    <span>{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Slug</label>
                    <input type="text" name="slug" id="slug" class="form-control" value="{{old('slug')}}">
                    @error('slug')
                    <span>{{$message}}</span>
                    @enderror
                </div>
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
                <div class="form-group">
                    <label for="">Brand</label>
                    <input type="text" name="brand" id="brand" class="form-control" value="{{old('brand')}}">
                </div>
                <div class="form-group">
                    <label for="">Modal</label>
                    <input type="text" name="modal" id="modal" class="form-control" value="{{old('modal')}}">
                </div>
                <div class="form-group">
                    <label for="">Short Desc</label>
                    <input type="text" name="short_desc" id="short_desc" class="form-control" value="{{old('short_desc')}}">
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <input type="text" name="desc" id="desc" class="form-control" value="{{old('desc')}}">
                </div>
                <div class="form-group">
                    <label for="">Keywords</label>
                    <input type="text" name="keywords" id="keywords" class="form-control" value="{{old('keywords')}}">
                </div>
                <div class="form-group">
                    <label for="">Technical Specification</label>
                    <input type="text" name="technical_specification" id="technical_specification" class="form-control" value="{{old('technical_specification')}}">
                </div>
                <div class="form-group">
                    <label for="">User</label>
                    <input type="text" name="users" id="users" class="form-control" value="{{old('users')}}">
                </div>
                <div class="form-group">
                    <label for="">Warranty</label>
                    <input type="text" name="warranty" id="warranty" class="form-control" value="{{old('warranty')}}">
                </div>
                <div class="form-group">
                    <label for="">Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                    @error('image')
                    <span>{{$message}}</span>
                    @enderror
                </div>
                <input type="submit" value="Save" class="btn btn-info">
            </form>
        </div>
    </div>
</div>



@endsection


@section('script')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script>
    
</script>
@endsection