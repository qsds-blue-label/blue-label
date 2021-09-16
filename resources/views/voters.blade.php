@extends('layouts.master')
@section('title', 'Home')
@section('content')
<!-- Content Wrapper. Contains page content -->
<style>
    input[type=file]:focus,.custom-file-input:focus~.custom-file-label {
        outline:none!important;
        border-color: transparent;
        box-shadow: none!important;
    }
    .custom-file,
    .custom-file-label,
    .custom-file-input {
        cursor: pointer;
    }
</style>
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Voters Page</h1>
            </div>
            <div class="col-sm-6 ">
                <!-- <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-upload">
                    Import New Excel
                </button> -->
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
            <h3 class="card-title">List of Voters</h3>
        </div>
        <div class="card-body">
            
            <table id="data-table" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Voter Name</th>
                    <th>Voters Address</th>
                    <th>Legend</th>
                    <th>Precinct</th>
                    <th>Barangay</th>
                    <th>City/Municipality </th>
                    <th>District </th>
                    <th>Age </th>
                    <th>Actions </th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($list as $k) { ?>
                        <tr>
                            <td><?= $k->voters_name ?></td>
                            <td><?= $k->voters_address ?></td>
                            <td><?= $k->legend ?></td>
                            <td><?= $k->precent ?></td>
                            <td><?= $k->municipality ?></td>
                            <td><?= $k->barangay ?></td>
                            <td><?= $k->district ?></td>
                            <td><?= $k->age ?></td>
                            <td class="text-center"><button class="btn btn-primary btn-outline-primary" onclick="details()">Viwe Details</button></td>
                        </tr>
                     <?php } ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Voter Name</th>
                    <th>Voters Address</th>
                    <th>Legend</th>
                    <th>Precinct</th>
                    <th>Barangay</th>
                    <th>City/Municipality </th>
                    <th>District </th>
                    <th>Age </th>
                    <th>Actions </th>
                  </tr>
                  </tfoot>
                </table>
        </div>
        <!-- /.card -->
</section>
<!-- /.content -->
</div>

@endsection