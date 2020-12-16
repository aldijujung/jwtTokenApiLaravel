@extends('layouts.master')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Access Menu</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Access menu</li>
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
              <h3 class="card-title">Menu</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Menu</th>
                            <th>Access Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sessioncek = session()->get('token')['user']['accessrole'];
                            $menu = DB::select("SELECT  menu.name, roleaccess.name as rolename
                                                    FROM menuaccess
                                                    JOIN roleaccess ON menuaccess.accessroleId=roleaccess.id
                                                    JOIN menu ON menuaccess.menuId=menu.id
                                                    WHERE roleaccess.name = '$sessioncek'");
                        @endphp

                        @foreach ($menu as $key => $item)
                        <tr>
                            <td>{{$key++}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->rolename}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>
            <!-- /.card-body -->
          </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


@endsection
{{-- @push('page-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>
@endpush --}}
