@include('layout.header')
<style>
    
    .myactive{
        color: white;
        background-color: #896ef3;
    }
    .mynavcolor {
        color: white;
    }
    .navik:hover {
        color: white;
        background-color: #abb1ac;
    }
    
.pagination > .active > a,
.pagination > .active > a:focus,
.pagination > .active > a:hover,
.pagination > .active > span,
.pagination > .active > span:focus,
.pagination > .active > span:hover {
    background-color: #2d2847 !important;
    border-color: #2d2847 !important;
}
</style>
<body style="background-color: rgb(138, 136, 136);">
    <div class="row" style="background-color: #2d2847">
       <div class="col-lg-9 mt-3 mb-3">
         <h1 class="text-center text-bold h1 text-light">{{ strtoupper('Customer Control System') }}</h1>
       </div>
       <div class="col-lg-3 mt-4 mb-3">
       <span class="nav-link "   ><i class="fa fa-user" style="color: #f6f5fc"></i> &nbsp;  <span class="badge badge-info"> <a href="{{ route('user_profile') }}" class="text-light">{{ Auth::user()->name}}</a></span>  &nbsp; &nbsp; &nbsp;<a href="{{ route('logout') }}"> <i class="fa fa-sign-out text-light"></i> </a></span>
       </div>
    </div>

<main>

<nav style="background-color: #2d2847;  text-align: justified; border: 3px solid #896ef3" class="navbar  navbar-expand-md  p-0"  >
    <div class="container-fluid" style="background-color: #2d2847; color: white; text-align: justified;">

      <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="navbar-collapse collapse" id="navbarsExample07" >
        <ul class="navbar-nav mx-auto mynavcolor " style="color: white; ">
          <li class="nav-item outline border-danger px-4" >
            <a class="nav-link navik {{ request()->is('dashboard') ? 'myactive' : ''}} mynavcolor" aria-current="page" href="{{route('dashboard')}}"><strong>Dashboard</strong></a>
          </li>
          <li class="nav-item px-4">
            <a class="nav-link navik mynavcolor {{ request()->is('customers') ? 'myactive' : ''}}" href="{{url('customers')}}"> <strong>Customers</strong></a>
          </li>
          <li class="nav-item px-4">
            <a class="nav-link navik mynavcolor {{ request()->is('invoices_payments') ? 'myactive' : ''}}" href="{{url('invoices_payments')}}"> <strong>Invoices & Payments</strong></a>
          </li>
          {{-- <li class="nav-item px-4">
            <a class="nav-link navik mynavcolor {{ request()->is('login') ? 'myactive' : ''}}" href="{{route('login')}}" ><strong></strong></a>
          </li> --}}
        </ul>
      </div>

    </div>
  </nav>

</main>
<div class="container-fluid mt-2">
   @yield('content')
</div>
    {{-- DELETE RECORD MODAL --}}
    <div id="delete_confirm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5><strong>Are you sure you want to delete this record?</strong></h5>
                  <button class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <p>Note: Deleting this record will clear all the infomation related to this record</p>
                  </div>
                     <div class="modal-footer">
                      <a type="submit" class="btn  btn-sm btn-danger" id="yes">Yes</a> &nbsp;<a href="#" data-dismiss="modal" id="no" class="btn  btn-sm btn-secondary">No</a>
                     </div>
                  </form>
              </div>
          </div>
      </div>
      </div>
      {{-- END OF EDIT CUSTOMER MODAL --}}
@include('layout.footer')

