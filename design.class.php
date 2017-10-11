
<?php
class design{

	const frontend_full_design = "frontend_full";
	private $design_output;
	private $header;
	private $body;

	function __construct($property){
		$design_output = "";

		if($property == self::frontend_full_design){
			$head = self::createFrontendHeader();
			$body = self::createFrontendMenu();
		}
		$design_output .= '<!DOCTYPE html>
									<html lang="de">';
		$design_output .= '<head>';
		$design_output .= $head;
		$design_output .= '</head><body>';
		$design_output .= $body;
		$design_output .= '</html>';

		print($design_output);
	}

	function footer(){

		print('</body>');
	}

	function createFrontendHeader(){
		$ret = '
				<meta charset="UTF-8"> 
				<link rel="stylesheet" type="text/css" href="ScoreSystem/js/jquery-ui-1.11.4.custom/jquery-ui.css">
				<link rel="stylesheet" type="text/css" href="ScoreSystem/js/bootstrap-3.3.5-dist/css/bootstrap.min.css">
				<script language="javascript" type="text/javascript" src="ScoreSystem/js/jquery-1.11.3.min.js"></script>
				<script language="javascript" type="text/javascript" src="ScoreSystem/js/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
				<script language="javascript" type="text/javascript" src="ScoreSystem/js/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
				<script language="javascript" type="text/javascript" src="ScoreSystem/js/custom.js"></script>
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<title>SaarTURNier Ergebnisse | TV St. Ingbert</title>
			';
		return $ret;
	}

	function createFrontendMenu(){
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
						<a class="navbar-brand" href="index.php">
						Live Ergebnisse
					  </a>
					</div>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li><a class="menu-link" href="resultsView.php">Einzelergebnisse</a></li>
							<li><a class="menu-link" href="teamResultView.php">Teamergebnisse</a></li>
					</div>
				</div>
			</nav>
			';
		return $ret;
	}
}
?>