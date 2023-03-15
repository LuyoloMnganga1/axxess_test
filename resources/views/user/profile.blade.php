@extends('layout.main')
@section('title')
Profile
@endsection
@section('content')
<div class="card card-rounded-4 p-3">
    <div class="card-header" style="background-color: #2d2847;">
        <strong class="text-light">User Profile</strong>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible mt-2">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
   @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible mt-2">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <p>{{ $message }}</p>
            </div>
     @endif
    <div class="card-body">
        <div class="table-responsive">
            <table class="table  pt-3 table-bordered">
                <thead class="thead-light">
                    <tr style="background-color: #2d2847;">
                        <th style="background-color: #2d2847; color: white;">
                         Full name    
                        </th>
                        <th style="background-color: #2d2847; color: white;">
                             Username</th>
                        <th style="background-color: #2d2847; color: white;">
                            Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$data->name}} </td>
                        <td>{{$data->username}}
                        </td>
                        <td>
                            <a href="#"  id="view_user"
                                class="btn btn-sm btn-success" type="button" data-toggle="modal" data-target="#my-modal-update">Update</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- UPDATE PROFILE MODAL --}}
<div id="my-modal-update" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5><strong>Update user profile</strong></h5>
            <button class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{route('update_profile')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="allocation_status">Full name</label>
                    <input type="text" class="form-control" name="name" value="{{$data->name}}"
                        id="">
                </div>
                <div class="form-group">
                    <label for="">Username</label>
                    <input type="email" class="form-control" name="username" value="{{$data->username}}"
                        id="">
                </div>
               <div class="modal-footer">
                <button type="submit" class="btn  btn-sm btn-success">Update</button> &nbsp;<a href="#" data-dismiss="modal" id="update_profile" class="btn  btn-sm btn-secondary">Cancel</a>
               </div>
            </form>
        </div>
    </div>
</div>
</div>
{{-- END OF UPDATE PROFILE MODAL --}}
@endsection
@section('script')

@endsection