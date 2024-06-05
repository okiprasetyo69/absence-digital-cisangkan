<!doctype html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<meta name="viewport" content="minimal-ui, width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1, shrink-to-fit=no">
  	<title>Absence Digital Cisangkan</title>
	<link href="{{ asset('') }}css/styles.css" rel="stylesheet" />
	<link href="{{ asset('') }}css/custom.css" rel="stylesheet" />
	<link type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="theme-color" content="white"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Absence Digital Cisangkan">
    <meta name="msapplication-TileImage" content="images/hello-icon-144.png">
    <meta name="msapplication-TileColor" content="#FFFFFF">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="{{asset('')}}assets/home/css/style.css">
	<link rel="stylesheet" href="{{ asset('') }}assets/jqueryconfirm/jquery-confirm.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}assets/jquerysignature/jquery.signature.css">

	<script src="{{asset('')}}assets/fontawesome/font-awesome-5.15.1-all.min.js" crossorigin="anonymous"></script>
	<!-- Jquery -->
	<script type="text/javascript" src="{{asset('')}}assets/jquery/jquery-1.12.4.min.js"></script>  	
	<style>
		body{
    		background-color: #007bff !important;
		}
		.required-color{
			color: red;
		}
	</style>
	</head>
	<body class="layout-top-nav layout-navbar-fixed" style="height: auto;">
		<div class="container">
			<div class="row">
				<div class="col-md mt-3">
					<form id="frm-add-abs" class="" enctype="multipart/form-data" action="#">
						@csrf
					<div class="card" style="border-radius:15px;">
						<input type="hidden" class="form-control" name="topic_id" id="topic_id">
						<div class="card-header text-center">
							<img class="card-img-top img-fluid rounded mx-auto d-block" src="{{asset('')}}images/users.png" style="height: 100px; width:115px;">
							<div class="badge badge-primary" style="width: 12rem;" id="topic_name">
								Absence Digital Cisangkan
							</div>
						</div>
						<div class="card-body" style="margin-top:-15px;">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group"> 
										<label>Name <span class="required-color">*</span> : </label>
										<input type="text" name="name" class="form-control" id="name"  placeholder="Enter name">
										<span id="err_name"> </span>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group"> 
										<label>Position <span class="required-color">*</span> : </label>
										<input type="text" name="position" class="form-control" id="position"  placeholder="Enter position">
										<span id="err_position"> </span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group"> 
										<label>Date <span class="required-color">*</span> : </label>
										<input type="text" name="absence_date" id="absence_date" class="form-control"  placeholder="Enter absence date" readonly> 
										<span id="err_absence_date"> </span>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group"> 
										<label>Email <span class="required-color">*</span> : </label>
										<input type="email" name="email" class="form-control" id="email"  placeholder="Enter email">
										<span id="err_email"> </span>
									</div>
								</div>
							</div>
							<div class="row"> 
								<div class="col"> 
									<label> Signature <span class="required-color">*</span> : </label>
									<div><span id="err_signed"> </span> </div>
									<div id="signature">
										<canvas id="signature-pad" class="signature-pad" height="250px"></canvas>
										<textarea id="signature64" name="signed"  style="display: none;"></textarea>
									</div>
								</div>
							</div>	
						</div>
						<div class="card-footer" style="margin-top:-15px;">
							<div class="row">
								<div class="col-md-6">
									<button type="button" id="clear" class="btn btn-success btn-block rounded-pill text-light">Clear Signature</button>
								</div>
								<div class="col-md-6">
									<button type="submit" id="btnSave" class="btn btn-primary btn-block rounded-pill text-light">
										<i class="fas fa-save"></i> Save
									</button>
								</div>
							</div>
						</div>
					</div>
					</form>
				</div>
			</div>
		</div>

		<script src="{{ asset('') }}assets/plugins/bootstrap/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
		<script src="{{ asset('') }}js/scripts.js"></script>
		<script src="/main.js"></script>
		<script type="text/javascript" src="{{asset('')}}assets/plugins/jquery-ui/1.12.1/jquery-ui.min.js"></script>
		<script type="text/javascript" src="{{asset('')}}assets/jquerysignature/jquery.signature.js"></script>
		<script src="{{ asset('') }}assets/jqueryconfirm/jquery-confirm.min.js"></script>
		<script src="{{asset('')}}assets/jquerysignature/signature_pad.js"></script>
		
		<script type="text/javascript" src="{{ asset('')}}js/absence/absence_home.js"></script>
		</body>
</html>

