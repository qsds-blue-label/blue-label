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
              <h1>Blank Page</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Blank Page</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
  
      <!-- Main content -->
      <section class="content">
  
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Title</h3>
  
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="panel-body">
                    <span id="message"></span>
                    <form id="sample_form" method="POST" enctype="multipart/form-data" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Select CSV File</label>
                            <input type="file" name="file" id="file" />
                        </div>
                        <div class="form-group" align="center">
                            <input type="hidden" name="hidden_field" value="1" />
                            <input type="submit" name="import" id="import" class="btn btn-info" value="Import" />
                        </div>
                    </form>
                    <div class="form-group" id="process" style="display: none;">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"><span id="process_data">0</span> - <span id="total_data">0</span></div>
                        </div>
                    </div>
                </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            Footer
          </div>
          <!-- /.card-footer-->
        </div>
        <!-- /.card -->
  
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    
@endsection