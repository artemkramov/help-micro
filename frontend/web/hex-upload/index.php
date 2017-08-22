<?php
require_once 'auth.php';
?>

<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Загрузка HEX-прошивки</title>

  <link rel="stylesheet" href="css/bootstrap.min.css?v=1.0">
  <link rel="stylesheet" href="css/style.css?v=1.0">

  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
</head>

<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h1 class="title">Загрузка HEX-прошивки</h1>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="form-group" id="alert-message">
				</div>
				<form id="form-hex">
					<div class="form-group">
						<label for="file-hex">Выберите файл для загрузки:</label>
						<input type="file" id="file-hex" name="file-hex" accept=".hex" required />
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">
							<span class="glyphicon glyphicon-upload"></span> Загрузить
						</button>
					</div>
				</form>
			</div>
		</div>

		<div class="hidden" id="template-alert">
			<div class="alert alert-dismissible">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <div class="alert-content"></div>
			</div>
		</div>

	</div>

	<div class="file-loader" id="progress">
	    <div class="progress-wrapper">
	        <label id="progress-title"></label>
	        <div class="progress">
	            <div class="progress-bar progress-bar-striped active" role="progressbar"
	                 aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
	            </div>
	        </div>
	    </div>
	</div>

	<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" 
		crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>	
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/Buffer.js"></script>
	<script type="text/javascript" src="js/IntelHex.js"></script>
  	<script src="js/App.js"></script>
</body>
</html>