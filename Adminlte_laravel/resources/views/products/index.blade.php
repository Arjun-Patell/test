@extends('layouts')
@section('content')

<a class=" btn btn-success dropdown-item" style="margin-left: 900px;background-color: #28a745;width: 18%;color: white;"  href="{{ route('logout') }}"
onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <div class="form-price-range-filter">
        <div class="pull-left"  >
            <h2>Product Table</h2>
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('pro_create') }}"> Create Product</a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="container mt-2">
            
            <table class="table table-bordered" id="example1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>SKU</th>
                        <th>Image</th>
                        <th>Detail</th>
                        <th>Category</th>
                        <th>Created at</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    @endsection
    @section('scripts')
    <script type="text/javascript">
        $(document).ready( function () {
            $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        //alert('hi');
    $('#example1').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "{{ route('products') }}",
        "columns": [
            {data: 'id', name: 'id', 'visible': false},
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
            { data: 'name', name: 'name' },
            { data: 'price', name: 'price' },
            { data: 'sku', name: 'sku' },
            {data: 'image', name: 'image', orderable: false},
            { data: 'detail', name: 'detail' },
            { data: 'categorys', name: 'categories.cat_name' },          
            { data: 'created_at', name: 'created_at' },
            {data: 'action', name: 'action', orderable: false},
        ],  
        order: [[0, 'desc']]
    });
    $('body').on('click', '.delete', function () {
        if (confirm("Delete Record?") == true) {
            var id = $(this).data('id');
            $.ajax({
                type:"POST",
                url: "{{ url('delete_product') }}",
                data: { id: id},
                dataType: 'json',
                success: function(res){
                    var oTable = $('#example1').dataTable();
                    oTable.fnDraw(false);
                }
            });
        }
    });
});
</script>
@endsection