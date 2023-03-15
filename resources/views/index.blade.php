@extends('layout.main')
@section('title')
Dashboard
@endsection
@section('content')
<div class="row">
    <div class="col-lg-6  mt-3 text-success">
        <div class="card card card-rounded-3 p-3">
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
        <div class="card card card-rounded-3 p-3">
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
</div>
@endsection
@section('script')

@endsection