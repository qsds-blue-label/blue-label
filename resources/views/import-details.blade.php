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
                <h1>Import Details Page - <small>IMPORT-00002<?= $_GET['id'] ?></small></h1>
            </div>
            <div class="col-sm-6 ">
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
            <h3 class="card-title">List of imported files</h3>
        </div>
        <div class="card-body">
            
        <table id="data-table" class="table table-bordered table-striped" style="width: calc(100% - 0px) !important;">
                  <thead>
                  <tr>
                    <th>Voter's</th>
                    <th>Date Voted </th>
                    <th>Candidate </th>
                  </tr>
                  </thead>
                  <tbody>
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
<!-- /.content-wrapper -->
<div class="modal fade" id="modal-upload">
    <form id="import-form" method="POST" enctype="multipart/form-data" class="form-horizontal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Select Excel  File</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mb-4"  style="height: 300px;">
                <label>Date Of Votes</label>
                <div class="input-group mb-3">
                   <input type="text" class="form-control" placeholder="Select Date" data-toggle="datepicker"  id="date_of_votes" name="date" autocomplete="off" >
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                  </div>
                </div>
                <label>Upload Excel File</label>
                <div class="">
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Upload</span>
                    </div>
                    <div class="custom-file">
                        <input type="file"   name="file" class="custom-file-input" id="inputGroupFile01"  >
                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                    </div>
                    </div>
                    </div>

                    <span id="message"></span>
                    <div class="form-group">
                        <!-- <input type="file" name="file" id="file" /> -->
                    </div>
                    <div class="form-group" id="process" style="display: none;">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"><span id="process_data">0</span> - <span id="total_data">0</span></div>
                        </div>
                    </div>
                   
                </div>
                <div class="modal-footer justify-content-between">
                <input type="hidden" name="hidden_field" value="1" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Import File</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>
</div>
<script>
    let imported_id = "<?= $_GET['id'] ?>";
</script>
@endsection