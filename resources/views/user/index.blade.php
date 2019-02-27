@extends('layout.master')
@section('content')
<div class="row">
<div class="col-6">
    <h1>Data User</h1>
</div>
<div class="col-6" style="padding:12px" >
<button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
  Add User
</button>
</div>
<table class="table table-hover">
<tr>
    <th>Email</th>
    <th>Full Name</th>
    <th>password</th>
    <th>Created</th>
    <th>Action</th>
    @foreach($data_user as $us)
    <tr>
    <td>{{$us->email}}</td>
    <td>{{$us->fullname}}</td>
    <td>{{$us->password}}</td>
    <td>{{$us->created_at}}</td>
    <td><a href="/use/{{$us->id}}/edit" class="btn btn-warning btn-sm">Edit</a>
    <a href="/use/{{$us->id}}/delete" class="btn btn-danger btn-sm">delete</a></td>
    </tr>
</tr>
@endforeach
<div class="text-right">{!!$data_user->links()!!}</div>
</table>
</div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="/user/create" method="post">
      {{csrf_field()}}
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="FullName">Full Name</label>
    <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Insert Full Name" >
    </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Insert Password">
  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
  @endsection

