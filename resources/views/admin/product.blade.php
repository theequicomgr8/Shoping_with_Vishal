@extends('admin.layout.app')
@section('heading','Product')
@section('product','active')
@section('content')
<a href="{{Route('admin.product.form')}}"  class="btn btn-info" style="float:right;">Add Product</a>
<table class="table table-bordered" id="posts">
<thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Slug</th>
        <th>Image</th>
        <th>Action</th>
    </tr>
</thead>
<tbody></tbody>
</table> 



@endsection


@section('script')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#posts').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "{{ url('admin/product') }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "{{csrf_token()}}"}
                   },
            "columns": [
                { "data": "id" },
                { "data": "name" },
                { "data": "slug" },
                { "data": "image" },
				{ "data": "options" }
            ]	 

        });
    });
</script>
@endsection