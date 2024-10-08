@extends('layouts.admin')
@section('title')
    Change Password
@endsection

@section('admin_content')
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-8 mt-5">
          <div class="card card-primary py-5">
            <div class="card-header">
              <h3 class="card-title">Change Your Password</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="{{route('admin.password.update')}}" method="Post">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Old Password</label>
                  <input type="password" class="form-control  @error('old_password') is-invalid @enderror"
                    name="old_password" id="exampleInputEmail1" placeholder="Old Password"
                    value="{{old('old_password')}}">
                  @error('old_password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword2">New Password</label>
                  <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                    id="exampleInputPassword2" placeholder="New Password" value="{{old('password')}}">
                  @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword3">Confirm Password</label>
                  <input type="password" class="form-control" name="password_confirmation" id="exampleInputPassword3"
                    placeholder="Confirm Password">
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update Password</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!--/. container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection