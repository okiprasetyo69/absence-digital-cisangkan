@extends('layout.home')
@section('title', 'User Settings')
@section('content')
    <!-- Start div layoutSidenav_content-->
    <div id="layoutSidenav_content">
        <!-- Start main content -->
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">User Setting</h1>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        List Users
                    </div>
                    <div class="card-body">
                        <!-- Button trigger modal  -->
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="search" class="form-control" id="search" placeholder="Search name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="table-responsive">
                                    <table class="table table-responsive table-striped table-bordered text-center" id="tableUser" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="rowData">
        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> 
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <button type="button" class="btn btn-primary btn-md float-right" style="border-radius:50%;" data-toggle="modal" onclick="addUser()">
                                    <i class="fas fa-user-plus"></i>
                                </button>
                            </div>
                        </div>   
                    </div>
                </div>
            </div>
        </main>
        <!-- end main content -->
        @include("users.modal.add_user")

@endsection
@section('pagespecificscripts')
    <script type="text/javascript" src="{{ asset('js/user/index.js') }}" defer></script>
@stop
