@extends('layout.master')
@section('content')
<h1>Edit Data</h1>
<div class="row">
<div class="col-lg-12"> 
<form action="/use/{{$edit_user->id}}/update" method="post">
      {{csrf_field()}}
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label> 
    <input type="email" class="form-control" id="exampleInputEmail1"
     aria-describedby="emailHelp" name="email" placeholder="Enter email" value="{{$edit_user->email}}">
  </div>
  <div class="form-group">
    <label for="FullName">Full Name</label>
    <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Insert Full Name"  value="{{$edit_user->fullname}}" >
    </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Insert Password"  value="{{$edit_user->password}}">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">created</label>
    <input type="date" name="created" class="form-control"  value="{{$edit_user->created}}">
  </div>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
      </div>
</div>
@endsection