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
              <h1>DASHBOARD</h1>
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
            <h3 class="card-title">Graph Data</h3>
            <div class="card-tools flexHorizontal">
              <div class="row">
                <div class="input-group">
                  <button type="button" onclick="rangeFilter()" class="btn btn-default float-right" id="daterange-btn">
                    <i class="far fa-calendar-alt"></i> Date filter
                    <i class="fas fa-caret-down"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <!-- DONUT CHART -->
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">OverAll Result</h3>
                  </div>
                  <div class="card-body">
                    <canvas id="donutChart" style="min-height: 500px; height: 500px; max-height: 500px; max-width: 100%;"></canvas>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <!-- BAR CHART -->
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Monthly Data Count</h3>
                  </div>
                  <div class="card-body">
                    <div class="chart">
                      <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <div class="col-md-12">
              <!-- STACKED BAR CHART -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Per Barangay</h3>
                </div>
                <div class="card-body">
                  <div class="chart">
                    <canvas id="stackedBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
                </div>
              <div class="col-md-12">
              <!-- STACKED BAR CHART -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Per Municipality</h3>
                </div>
                <div class="card-body">
                  <div class="chart">
                    <canvas id="data-muni" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
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