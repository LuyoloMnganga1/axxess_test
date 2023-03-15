@extends('layout.main')
@section('title')
Invoices & Payments
@endsection
@section('content')
<div class="card card-rounded-3 p-3">
    <div class="card-header">
            <!-- Tabs navs -->
             <nav>
                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-invoice-tab" data-toggle="tab" href="#nav-invoices" role="tab" aria-controls="nav-invoices" aria-selected="true">Invoices</a>
                        <a class="nav-item nav-link" id="nav-payments-tab" data-toggle="tab" href="#nav-payments" role="tab" aria-controls="nav-payments" aria-selected="false">Payments</a>
                    </div>
            </nav>
            <!-- Tabs navs -->
    </div>
    <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
       @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <p>{{ $message }}</p>
                </div>
         @endif
         <!-- Tabs content -->
         <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-invoices" role="tabpanel" aria-labelledby="nav-invoices-tab">
                <h1 class="text-dark h1">All Invoices</h1>
                <div class="table-responsive">
                    <table class="table  pt-3 table-bordered data-table" id="tb_invoice">
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
            <div class=" tab-content tab-pane fade" id="nav-payments" role="tabpanel" aria-labelledby="nav-payments-tab">
                <h1 class="text-dark h1">All Payments</h1>
                <div class="table-responsive">
                    <table class="table  pt-3 table-bordered data-table" id="tb_payments" style="width: 100%">
                        <thead class="thead-light">
                            <tr style="background-color: #2d2847;">
                                <th style="background-color: #2d2847; color: white;">#</th>
                                <th style="background-color: #2d2847; color: white;">Customer name</th> 
                                <th style="background-color: #2d2847; color: white;">Payament Date</th>
                                <th style="background-color: #2d2847; color: white;">Payment Amount</th>
                                <th style="background-color: #2d2847; color: white;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Tabs content -->
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {

        var table = $('#tb_payments').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('getpayments') }}",
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

        var table1 = $('#tb_invoice').DataTable({
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
<script>
   $(document).ready(function(){
        $(".nav-link").click(function(){
          var me = $(this);
          var panel = $('#' + this.hash.substr(1).toLowerCase());
          if(me.hasClass('active')){
             me.removeClass('active');
            panel.removeClass('active');     
                return false;
          }
        });
    });
</script>
@endsection