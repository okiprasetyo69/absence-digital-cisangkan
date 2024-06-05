@extends('layout.home')
@section('title', 'Absence')
@section('content')
    <!-- Start div layoutSidenav_content-->
    <div id="layoutSidenav_content">
        <!-- Start main content -->
        <main>
            <div class="container-fluid">
                <h1 class="mt-4"></h1>
  
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                         Absence Form
                    </div>
                    <div class="card-body">
                        <form id="frm-add-abs" enctype="multipart/form-data" action="#">
                            @csrf
                            <!-- 
                            <input type="text" class="form-control" name="topic_id" id="topic_id">
                            -->
                            <div class="form-group">
                                <label for="">Topic</label>
                                <select class="form-control topic_id" name="topic_id" id="topic_id" style="width:100%">
                                  <option value="">-- Choose topic --</option>
                                </select>
                                <span id="err_topic_id"> </span>
                              </div>
                            <div class="form-group">
                                <label for="">Date : </label>
                                 <input type="text" name="absence_date" id="absence_date" class="form-control"  placeholder="Enter absence date" readonly> <span id="err_absence_date"> </span>
                            </div>
                            <div class="form-group">
                                <label for="">Name : </label>
                                 <input type="text" name="name" class="form-control" id="name"  placeholder="Enter name">
                                 <span id="err_name"> </span>
                            </div>
                            <div class="form-group">
                                <label for="">Email : </label>
                                 <input type="email" name="email" class="form-control" id="email"  placeholder="Enter email">
                                 <span id="err_email"> </span>
                            </div>
                            <div class="form-group">
                                 <label for="">Positions : </label>
                                 <input type="text" name="position" class="form-control" id="position"  placeholder="Enter position">
                                 <span id="err_position"> </span>
                            </div>
                            <div class="form-group">
                                <label for="">Signature: </label>
                                <div><span id="err_signed"> </span> </div>
                                <div id="signature">
                                    <canvas id="signature-pad" class="signature-pad" height="250px"></canvas>
                                   
                                    <textarea id="signature64" name="signed"  style="display: none;"></textarea>
                                </div>
                                <div class="mt-4">  
                                    <button type="button" id="clear" class="btn btn-warning btn-sm">Clear Signature</button>
                                </div>
                            </div>
                         
                            <button type="submit" id="btnSave" class="btn btn-primary">
                                <i class="far fa-save"></i> Save
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <!-- end main content -->
@endsection
@section('pagespecificscripts')
    <script type="text/javascript" src="{{ asset('js/absence/index.js') }}"></script>
@stop
