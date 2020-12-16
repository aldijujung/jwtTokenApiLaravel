@extends('layouts.master')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Access Info</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Access Info</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">About Me</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <strong><i class="fas fa-lock mr-1"></i> Bearer Token</strong>

              <p class="text-muted">
                {{ session()->get('token')['access_token'] }}
              </p>

              <hr>

              <strong><i class="fas fa-user mr-1"></i> Name</strong>

              <p class="text-muted">{{ session()->get('token')['user']['name'] }}</p>

              <hr>

              <strong><i class="fas fa-envelope mr-1"></i> Email</strong>

              <p class="text-muted">{{ session()->get('token')['user']['email'] }}</p>

              <hr>


              <strong><i class="fas fa-low-vision mr-1"></i> Role Access</strong>

              <p class="text-muted">{{ session()->get('token')['user']['accessrole'] }}</p>
            </div>
            <!-- /.card-body -->
          </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


@endsection
@push('page-scripts')
@endpush
