@extends('layout.home')
@section('title', 'Event Name')
@section('content')
    <!-- Start div layoutSidenav_content-->
    <div id="layoutSidenav_content">
        <!-- Start main content -->
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Event Name</h1>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        List Topics
                    </div>
                    <div class="card-body">
                        <!-- Button trigger modal  -->
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-2"></div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" name="event_date_filter" class="form-control" id="event_date_filter" placeholder="" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="search" class="form-control" id="search" placeholder="Search topic name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="table-responsive">
                                    <table class="table table-responsive table-striped table-bordered text-center" id="tableTopic" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Topic Name</th>
                                                <th>Event Date</th>
                                                <th>Location</th>
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

                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <button type="button" class="btn btn-primary btn-md float-right" style="border-radius:50%;" data-toggle="modal" onclick="addTopic()">
                                    <i class="fas fa-plus-circle"></i>
                                </button>
                            </div>
                        </div>   
                    </div>
                </div>
            </div>
        </main>
        <!-- end main content -->
        @include("topic.modal.add_topic")

@endsection
@section('pagespecificscripts')
    <script type="text/javascript" src="{{ asset('js/topic/index.js') }}" defer></script>
@stop
