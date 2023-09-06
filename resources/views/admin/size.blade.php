@extends('admin.layout.app')
@section('heading','Size')
@section('size','active')
@section('content')
<button data-toggle="modal" data-target="#myModal" class="btn btn-info" style="float:right;">Add Size</button>
<table class="table table-bordered" id="posts">
<thead>
    <tr>
        <th>ID</th>
        <th>Size</th>
        <th>Action</th>
    </tr>
</thead>
<tbody></tbody>
</table> 



@endsection
<!-- modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Size</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form id="category-form" method="post" action="{{Route('admin.add.size')}}">
            @csrf
            <div class="form-group">
                <label>Size : </label>
                <input type="text" name="size" id="size" class="form-control" required>
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
@section('script')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#posts').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "{{ url('admin/size') }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "{{csrf_token()}}"}
                   },
            "columns": [
                { "data": "id" },
                { "data": "size" },
				{ "data": "options" }
            ]	 

        });
    });
</script>
@endsection