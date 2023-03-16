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
                <div class="row">
                    <div class="col-lg-10">
                        <h1 class="text-dark h1">All Invoices</h1>
                    </div>
                    <div class="col-lg-2">
                        <a class="btn btn-sm btn btn-success mt-2"><i class="fa fa-plus-circle" id="new_invoice"> Add New Invoice</i></a>
                    </div>
                </div>
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
{{-- ADD INVOICE MODAL --}}
<div id="add_invoice" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5><strong>Add New Invoice</strong></h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="add_invoice_modal_body">
                <form action="{{route('add_invoice')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Customer</label>
                        <select name="customer_id" id="customer_id" class="form-control">
                            <option value="" disabled> Select Customer</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Invoice Subject</label>
                        <input type="text" class="form-control" name="invoice_subject"  required
                            id="">
                    </div>
                    <input type="hidden" name="line_number" id="line_number_id" value="1">
                    <div class="form-group">
                        <label for="">Invoive line 1</label>
                        <textarea name="invoice_line" id="address" cols="10" rows="3" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Invoive line 1 Amount</label>
                        <input type="text" class="form-control" name="invoice_line_amount"  required
                            id="">
                    </div>
                    <div id="multiple_invoice_line">

                    </div>
                    <a  class="btn btn-sm btn-secondary" id="add_new_invoice_line"><i class="fa fa-plus-circle"></i></a>
                   <div class="modal-footer">
                    <button type="submit" class="btn  btn-sm btn-success">Add</button> &nbsp;<a href="#" data-dismiss="modal" id="update_profile" class="btn  btn-sm btn-secondary">Cancel</a>
                   </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    {{-- END OF ADD INVOICE MODAL --}}
    {{-- VIEW INVOICE MODAL --}}
<div id="view_invoice" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5><strong>Invoice Details</strong></h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="add_invoice_modal_body">
                    <div class="form-group">
                        <label for="">Customer</label>
                       <input type="text" class="form-control" name="customer" id="custromer" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Invoice Subject</label>
                        <input type="text" class="form-control" name="view_invoice_subject"  readonly
                            id="view_invoice_subject">
                    </div>
                    <div id="view_multiple_invoice_line">

                    </div>
                   <div class="modal-footer">
                    <a href="#" data-dismiss="modal" id="update_profile" class="btn  btn-sm btn-secondary">Cancel</a>
                   </div>
            </div>
        </div>
    </div>
    </div>
    {{-- END OF VIEW INVOICE MODAL --}}
      {{--  PAY MODAL --}}
<div id="pay_invoice" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5><strong>Invoice Payment</strong></h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="add_invoice_modal_body">
                <form action="{{ route('make_payment') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Customer</label>
                       <input type="text" class="form-control" name="customer" id="custromer_name" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Invoice Description</label>
                       <input type="text" class="form-control" name="description" id="invoice_description" readonly>
                    </div>
                    <input type="hidden" name="customer_id" id="pay_customer_id">
                    <input type="hidden" name="invoice_id" id="pay_invoice_id">
                    <div class="form-group">
                        <label for="">Payment Amount</label>
                        <input type="text" class="form-control" name="amount"   required
                            id="">
                    </div>
                    <a  class="btn btn-sm btn-secondary" id="add_new_invoice_line"><i class="fa fa-plus-circle"></i></a>
                   <div class="modal-footer">
                    <button type="submit" class="btn  btn-sm btn-success">Pay</button> &nbsp;<a href="#" data-dismiss="modal" id="update_profile" class="btn  btn-sm btn-secondary">Cancel</a>
                   </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    {{-- END OF  PAY MODAL --}}
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
                }
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
    $(document).ready(function() {
        $('#new_invoice').click(function() {
            var url = "{{ route('all_customers') }}";
            $.get(url, function(data) {
                $('#customer_id').empty();
                $('#multiple_invoice_line').empty();
                $.each(data, function(index, value) {
                    $('#customer_id').append( '<option value=\"' + value.id + '\">' + value.name + '</option>' );
                });
                 $('#add_invoice').modal('show');
            })
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#add_new_invoice_line').on('click',function(){
            var line_number = parseInt($('#line_number_id').val());
            var new_line_number = line_number + 1;
            $('#line_number_id').val(new_line_number);
            $('#multiple_invoice_line').append('<div class="form-group"><label for="">Invoive line '+new_line_number+'</label><textarea name="invoice_line'+new_line_number+'" id="address" cols="10" rows="3" class="form-control" required></textarea></div> <div class="form-group"><label for="">Invoive line '+new_line_number+' Amount</label><input type="text" class="form-control" name="invoice_line_amount'+new_line_number+'"  required id=""></div>');
        });
    });
</script>
<script>
    $(document).ready(function () {
         //oclick of view button
         $('body').on('click', '#view', function() {
            $('#view_multiple_invoice_line').empty();
            var url = $(this).data('href');
            $.get(url, function(data) {
                $('#custromer').val(data.invoice.name);
                $('#view_invoice_subject').val(data.invoice.description);
                $.each(data.invoice_lines,function(index, value){
                    $('#view_multiple_invoice_line').append('<div class="form-group"><label for="">Invoive line '+(index+1)+'</label><textarea name="invoice_line'+(index+1)+'" id="address" cols="10" rows="3" class="form-control" readonly>'+value.description+'</textarea></div> <div class="form-group"><label for="">Invoive line '+(index+1)+' Amount</label><input type="text" class="form-control" name="invoice_line_amount'+(index+1)+'" value="'+value.amount+'"  readonly id=""></div>');
                });
                    $('#view_invoice').modal('show');
            })
        });

         //oclick of pay button
         $('body').on('click', '#pay', function() {
            var url = $(this).data('href');
            $.get(url, function(data) {
                $('#custromer_name').val(data.invoice.name);
                $('#pay_customer_id').val(data.invoice.customer_id);
                $('#pay_invoice_id').val(data.invoice.id);
                $('#invoice_description').val(data.invoice.description);
                    $('#pay_invoice').modal('show');
            })
        });
    });
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