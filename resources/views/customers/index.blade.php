@extends('layout.main')
@section('title')
Customers
@endsection
@section('content')
<div class="card card-rounded-3 p-3">
    <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible mt-1 mb-2">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
       @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible  mt-1 mb-2">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <p>{{ $message }}</p>
                </div>
         @endif
        <a class="btn btn-sm btn-success mb-2"><i class="fa fa-plus-circle" data-toggle="modal" data-target="#add_customer"> Add New Customer</i></a>
        <div class="table-responsive">
            <table class="table  pt-3 table-bordered" id="customers">
                <thead class="thead-light">
                    <tr style="background-color: #2d2847;">
                        <th style="background-color: #2d2847; color: white;">#</th>
                        <th style="background-color: #2d2847; color: white;">Name</th>
                        <th style="background-color: #2d2847; color: white;">Address</th>
                        <th style="background-color: #2d2847; color: white;">Created Date</th>
                        <th style="background-color: #2d2847; color: white;">Username</th>
                        <th style="background-color: #2d2847; color: white;">Balance</th>
                        <th style="background-color: #2d2847; color: white;">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- ADD CUSTOMER MODAL --}}
<div id="add_customer" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5><strong>Add New Customer</strong></h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('add_customer')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="allocation_status">Ful Name</label>
                        <input type="text" class="form-control" name="name" required
                            id="">
                    </div>
                    <div class="form-group">
                        <label for="allocation_status">Address</label>
                        <textarea name="address" id="address" cols="10" rows="3" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="email" class="form-control" name="username"  required
                            id="">
                    </div>
                    <div class="form-group">
                        <label for="">Balance</label>
                        <input type="text" class="form-control" name="balance"  required
                            id="">
                    </div>
                   <div class="modal-footer">
                    <button type="submit" class="btn  btn-sm btn-success">Add</button> &nbsp;<a href="#" data-dismiss="modal" id="update_profile" class="btn  btn-sm btn-secondary">Cancel</a>
                   </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    {{-- END OF ADD CUSTOMER MODAL --}}
    {{-- EDIT CUSTOMER MODAL --}}
<div id="edit_customer" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5><strong>Edit Customer</strong></h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('add_customer')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="allocation_status">Ful Name</label>
                        <input type="text" class="form-control" name="name" id="name" required
                            id="">
                    </div>
                    <div class="form-group">
                        <label for="allocation_status">Address</label>
                        <textarea name="address" id="address" cols="10" rows="3" id="address" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="email" class="form-control" name="username" id="username"  required
                            id="">
                    </div>
                    <div class="form-group">
                        <label for="">Balance</label>
                        <input type="text" class="form-control" name="balance"  id="balance" required
                            id="">
                    </div>
                   <div class="modal-footer">
                    <button type="submit" class="btn  btn-sm btn-success">Add</button> &nbsp;<a href="#" data-dismiss="modal" id="update_profile" class="btn  btn-sm btn-secondary">Cancel</a>
                   </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    {{-- END OF EDIT CUSTOMER MODAL --}}
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        var table = $('#customers').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('getcustomers') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    print: true,
                    className: 'text-center'
                },
                {
                    data: 'name',
                    name: 'name',
                    orderable: true,
                    searchable: true,
                    print: true,
                    className: 'text-center'
                },
                {
                    data: 'address',
                    name: 'address',
                    orderable: true,
                    searchable: true,
                    print: true,
                   
                },
                {
                    data: 'date_created',
                    name: 'date_created',
                    orderable: true,
                    searchable: true,
                    print: true,
                    className: 'text-center'
                },
                {
                    data: 'username',
                    name: 'username',
                    orderable: true,
                    searchable: true,
                    print: true,
                    className: 'text-center'
                },
                {
                    data: 'balance',
                    name: 'balance',
                    orderable: true,
                    searchable: true,
                    print: true,
                    className: 'text-center'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    print: false,
                    className: 'text-center'
                },

            ]

        });

    });//END DOCUMENT READY FUNCTION
</script>
<script>
   $(document).ready(function () {
        $('body').on('click', '#edit', function() {
            var customer_id = $(this).data('id');
            var  url = "{{ route('find_customer',['id'=>':id']) }}";
             url = url.replace(':id',customer_id);
            $.get(url, function(data) {
                    console.log(data);
                    $('#address').val(data.address);
                    $('#name').val(data.name);
                    $('#username').val(data.username);
                    $('#balance').val(data.balance);
                    $('#edit_customer').modal('show');
            })
        });
   });
</script>
@endsection