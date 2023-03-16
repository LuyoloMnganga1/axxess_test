@extends('layout.main')
@section('title')
Dashboard
@endsection
@section('content')
<style>
    body{
        background-color: whitesmoke !important;
    }
</style>
<div class="row mt-5">
    <div class="col-lg-6  mt-3 text-success">
        <div class="card card card-rounded-3 p-3 border  border-success mb-5 shadow-lg">
               <div class="row">
                    <div class="col-lg-10">
                        Operators
                    </div>
                    <div class="col-lg-2">
                        {{ $operators }}
                    </div>
               </div>
        </div>
    </div>
    <div class="col-lg-6 mt-3 text-primary">
        <div class="card card card-rounded-3 p-3 border  border-primary mb-5 shadow-lg">
               <div class="row">
                    <div class="col-lg-10">
                        Customers
                    </div>
                    <div class="col-lg-2">
                        {{ $customers }}
                    </div>
               </div>
        </div>
    </div>
    <div class="col-lg-6 mt-3 text-info">
        <div class="card card card-rounded-3 p-3 border  border-info mb-5 shadow-lg">
               <div class="row">
                    <div class="col-lg-10">
                        invoices
                    </div>
                    <div class="col-lg-2">
                        {{ $invoices }}
                    </div>
               </div>
        </div>
    </div>
    <div class="col-lg-6 mt-3 text-warning">
        <div class="card card card-rounded-3 p-3 border  border-warning mb-5 shadow-lg">
               <div class="row">
                    <div class="col-lg-10">
                        Payments
                    </div>
                    <div class="col-lg-2">
                        {{ $payments }}
                    </div>
               </div>
        </div>
    </div>
</div>
@endsection
@section('script')

@endsection