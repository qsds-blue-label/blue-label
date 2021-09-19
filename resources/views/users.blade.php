@extends('layouts.master')
@section('title', 'Home')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Users Page</h1>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">List of Users</h3>

            <div class="card-tools flexHorizontal pr-3">
                <button type="button" class="btn btn-block btn-info" data-toggle="modal" data-target="#modal-default">Add</button>
            </div>
        </div>
        <div class="card-body">
        
            <table id="data-table-users" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Enabled</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    @php
                        $type = '';
                        $typeName = '';
                        if($user->role === 1) {
                            $type = 'bg-danger';
                            $typeName = 'Admin';
                        } elseif ($user->role === 2) {
                            $type = 'bg-info';
                            $typeName = 'Viewer';
                        } elseif ($user->role === 3) {
                            $type = 'bg-primary';
                            $typeName = 'Uploader';
                        }
                    @endphp
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td style="text-align: center">
                                <span class="badge {{ $type }}">{{ $typeName }}</span>
                            </td>
                            <td style="text-align: center">
                                
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" {{ $user->role === 1 ? 'disabled' : '' }} {{$user->enabled ? 'checked' : ''}} class="custom-control-input" onchange="changeEnabled(this, {{$user->id}})" id="customSwitch{{$user->id}}">
                                        <label class="custom-control-label" for="customSwitch{{$user->id}}"></label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Enabled</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card -->

        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" action="save-user">
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title">Add User</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter name" required>
                            </div>
                            <div class="form-group">
                                <label>Email address</label>
                                <input type="email" class="form-control" name="email" placeholder="Enter email" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" id="pass" class="form-control" name="password" placeholder="Enter password" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" id="confirmPass" class="form-control" name="confirm_password" placeholder="Enter password" required onchange="validatePassword()">
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectRounded0">Role</label>
                                <select class="custom-select rounded-0" name="role" required>
                                  <option value="2">Viewer</option>
                                  <option value="3">Uploader</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button id="subButton" type="submit" class="btn btn-info">Save changes</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
</section>
<!-- /.content -->
</div>

@endsection