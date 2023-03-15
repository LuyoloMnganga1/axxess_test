@extends('layout.main')
@section('title')
Invoices
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
        <div class="table-responsive">
            <table class="table  pt-3 table-bordered data-table">
                <thead class="thead-light">
                    <tr style="background-color: #2d2847;">
                        <th style="background-color: #2d2847; color: white;">#</th>
                        <th style="background-color: #2d2847; color: white;">Customer name</th>
                        <th style="background-color: #2d2847; color: white;">Customer Address</th>
                        <th style="background-color: #2d2847; color: white;">Invoice Description</th>
                        <th style="background-color: #2d2847; color: white;">Invoice Date</th>
                        <th style="background-color: #2d2847; color: white;">Invoice Amount</th>
                        <th style="background-color: #2d2847; color: white;">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
script>
    $(document).ready(function() {

        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('getinvoices') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    print: true,
                    className: 'text-center'
                },
                {
                    data: 'customer_name',
                    name: 'customer_name',
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
                    className: 'text-center'
                },
                {
                    data: 'description',
                    name: 'description',
                    orderable: false,
                    searchable: true,
                    print: true,
                    className: 'text-center'
                },
                {
                    data: 'date_created',
                    name: 'date_created',
                    orderable: false,
                    searchable: true,
                    print: true,
                    className: 'text-center'
                },
                {
                    data: 'amount',
                    name: 'amount',
                    orderable: false,
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
@endsection