<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Absence Digital Cisangkan</title>
    <link href="{{ asset('') }}css/styles.css" rel="stylesheet" />
    <link href="{{ asset('') }}css/custom.css" rel="stylesheet" />
    <!-- TODO : Resolve this datatable css, still on CDN -->
    <link href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" rel="stylesheet" crossorigin="anonymous" />
    <!-- TODO : Cannot save inti local project cz some image stored in cloud -->
    <link type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
    <link rel="stylesheet" href="{{ asset('') }}assets/jqueryconfirm/jquery-confirm.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}assets/jquerysignature/jquery.signature.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="theme-color" content="white"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Base Project">
    <meta name="msapplication-TileImage" content="images/hello-icon-144.png">
    <meta name="msapplication-TileColor" content="#FFFFFF">

    <script src="{{asset('')}}assets/fontawesome/font-awesome-5.15.1-all.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset('')}}assets/jquery/jquery-1.12.4.min.js"></script> 
    <script type="text/javascript" src="{{asset('')}}assets/plugins/jquery-ui/1.12.1/jquery-ui.min.js"></script>
    <script src="{{ asset('') }}assets/jqueryconfirm/jquery-confirm.min.js"></script>
    <script src="{{ asset('') }}assets/plugins/moment/moment.min.js"> </script>
    @yield('custom-css')
  </head>
  <body>
      <div class="container">
        <div class="row">
            <div class="col text-center">
                <h1>Absence Digital Cisangkan</h1>
            </div>
        </div>
        <br>
        <form id="frm-add">  
          @csrf
            <div class="form-group d-frex">
                <input type="text" name="absence_date" id="absence_date" class="form-control"  placeholder="Enter absence date" readonly>
                <input type="text" name="name" class="form-control" id="name"  placeholder="Enter name">
            </div>
            <div class="form-group">
                <label for="">Name : </label>
            </div>
            <div class="form-group">
                <label for="">Positions : </label>
                <input type="text" name="position" class="form-control" id="position"  placeholder="Enter position">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Signature: </label>
                <div id="signaturePad" ></div>
                <button id="clear" class="btn btn-danger btn-sm">Clear Signature</button>
                <textarea id="signature64" name="signed" style="display: none"></textarea>
            </div>
        
            <button type="button" id="btnSave" class="btn btn-primary">
                <i class="far fa-save"></i> Save
            </button>
        </form>
      </div>
      
      
      <script src="{{ asset('') }}assets/plugins/bootstrap/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
      <script src="{{ asset('') }}js/scripts.js"></script>
      <script src="/main.js"></script>
      <script src="{{ asset('') }}assets/jquery/datatables.min.js"></script>
      <script type="text/javascript" src="{{asset('')}}assets/jquerysignature/jquery.signature.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
      <script type="text/javascript" src="{{ asset('js/absence/absence_home.js') }}"></script>
    </body>
</html>