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
                <h1>Votes Page</h1>
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
            <h3 class="card-title">List of Votes</h3>
        </div>
        <div class="card-body">
            
            <table id="data-table" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Voter's</th>
                    <th>Date Voted </th>
                    <th>Candidate </th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($list as $k) { ?>
                        <tr>
                            <td>
                              <b><?= $k->voters_name ?></b>  - <small><?= $k->precent ?></small>
                              <p><?= $k->voters_address ?></p>
                              <p><?= $k->barangay ?>, <?= $k->municipality ?> <?= $k->district ?></p>
                            </td>
                            <td><?= $k->date ?></td>
                            <td><b><?= $k->cadidate_code ?></b> - <?= $k->cadidate_name ?></td>
                        </tr>
                     <?php } ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Voter's</th>
                    <th>Date Voted </th>
                    <th>Candidate </th>
                  </tr>
                  </tfoot>
                </table>
        </div>
        <!-- /.card -->
</section>
<!-- /.content -->
</div>

@endsection