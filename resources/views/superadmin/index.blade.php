@extends('layout.home')
@section('title', 'Dashboard')
@section('content')
    <!-- Start div layoutSidenav_content-->
    <div id="layoutSidenav_content">
        <!-- Start main content -->
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Dashboard</h1>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        List Absence
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-2">
                                <div class="form-group"> 
                                    <button type="button" class="btn btn-md btn-success btn-block" onclick="exportSignExcel()" style="border-radius:50px;"> 
                                        <i class="far fa-file-pdf"></i>  
                                        Export
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" name="absence_date" class="form-control" id="absence_date" placeholder="" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="search" class="form-control" id="search" placeholder="Search name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="table-responsive">
                                    <table class="table table-responsive table-striped table-bordered text-center" id="tableListAbsence" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Absence Date</th>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Email</th>
                                                <th>Topic</th>
                                                <th>Signature</th>
                                            </tr>
                                        </thead>
                                        <tbody class="">
        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- end main content -->
        @include("superadmin.modal.signature")
        @include("superadmin.modal.export_excel")
@endsection
@section('pagespecificscripts')
    <script type="text/javascript" src="{{ asset('js/dashboard/index.js') }}" defer></script>
@stop
