@extends('admin.layout.app')
@section('heading','Category')
@section('content')

<table class="table table-bordered" id="posts">
<thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Slug</th>
        <th>Action</th>
    </tr>
</thead>
<tbody></tbody>
</table> 

<!-- modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Category</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form id="archive_form">
            @csrf
            <div class="form-group">
                <label>Category Name : </label>
                <input type="text" name="category_name" id="category_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Category Slug : </label>
                <input type="text" name="category_slug" id="category_slug" class="form-control" required>
            </div>
            <input type="submit" class="btn btn-success">
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

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
                     "url": "{{ url('admin/category') }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "{{csrf_token()}}"}
                   },
            "columns": [
                { "data": "id" },
                { "data": "name" },
                { "data": "slug" },
				{ "data": "options" }
            ]	 

        });
    });
</script>
@endsection