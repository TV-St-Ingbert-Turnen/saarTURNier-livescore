<?php
	class design{
		
		const backend_full_design = "backend_full";
		private $design_output;
		private $header;
		private $body;
		
		function __construct($property){
			$design_output = "";
			
			if($property == self::backend_full_design){
				$header = self::createBackendHeader();
				$body = self::createTopBanner();
				$body .= self::createBackendMenu();
			}
			$design_output .= '<!DOCTYPE html>
									<html lang="de">';
			$design_output .= '<header>';
			$design_output .= $header;
			$design_output .= '</header><body>';
			$design_output .= $body;
			$design_output .= '</html>';
			
			print($design_output);
		}
		
		function footer(){
		
			print('</body>');
		}
		
		function createBackendHeader(){
		//<link rel="stylesheet" type="text/css" href="css/backend_design.css">
			$ret = '
				<meta charset="UTF-8"> 
				<link rel="stylesheet" type="text/css" href="js/jquery-ui-1.11.4.custom/jquery-ui.css">
				<link rel="stylesheet" type="text/css" href="js/bootstrap-3.3.5-dist/css/bootstrap.min.css">
				<script language="javascript" type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
				<script language="javascript" type="text/javascript" src="js/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
				<script language="javascript" type="text/javascript" src="js/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
				<script language="javascript" type="text/javascript" src="js/custom.js"></script>
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<title>TV St. Ingbert | ScoreSystem</title>
			';
			return $ret;
		}
		
		function createTopBanner(){
			$ret = '
				
			';
			return $ret;
		}
		
		function createBackendMenu(){
			$ret = '
			<nav class="navbar navbar-inverse navbar-fixed-top">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="controlBoard.php">
						<img alt="Brand" src="img/temp.png" width="20px">
					  </a>
					</div>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li><a class="menu-link" href="controlBoard.php">Home</a></li>
							<li><a class="menu-link" href="participantsAdministration.php">Ergebnis Erfassung</a></li>
							<li><a class="menu-link" href="frontendControler.php">Anzeigesteuerung</a></li>
							<li><a class="menu-link" href="index.html">Zurück zum Startmenü</a></li>
					</div>
				</div>
			</nav>
			';
			return $ret;
		}
	}
?>