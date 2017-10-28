<?php
    $year = intval(isset($_GET['year']) ? $_GET['year'] : 2015);
	require("design.class.php");
	$design = new design("frontend_full", null);
	
	print('
	<div class="jumbotron">
		<div class="container" style="margin-top: 20px">
			<div class="row" >
				<div class="col-md-4">
					<img src="ScoreSystem/img/STLogo.jpg" alt="SaarTURNier Logo" class="img-responsive">
				</div>
				<div class="col-md-6">
					<h1>Ergebnisse</h1>
					<p>Hier kannst du dir die Einzel- und Teamergebnisse der letzten Jahre ansehen. Einfach auf die entsprechende Schaltfläche klicken und los geht\'s.</p>
					<h2>2015</h2>
					<div class="row" >
						<div class="col-xs-6 col-md-6">
							<a href="resultsView.php?year=2015" class="btn btn-warning btn-block btn-lg" role="button">Einzel</a>
						</div>
						<div class="col-xs-6 col-md-6">
							<a href="teamResultView.php?year=2015" class="btn btn-warning btn-block btn-lg" role="button">Team</a>
						</div>
					</div>
					<h2>2016</h2>
					<div class="row" >
						<div class="col-xs-6 col-md-6">
							<a href="resultsView.php?year=2016" class="btn btn-warning btn-block btn-lg" role="button">Einzel</a>
						</div>
						<div class="col-xs-6 col-md-6">
							<a href="teamResultView.php?year=2016" class="btn btn-warning btn-block btn-lg" role="button">Team</a>
						</div>
					</div>
				</div>
			</div>
			<div class="row" style="margin-top: 48px">
				<div class="alert alert-info" role="alert">
					<strong>Hinweis</strong> Die WLAN-Verbindung erlaubt keine Verbindung mit dem Internet. Um eine Internetverbindung herzustellen muss die WLAN-Verbindung getrennt werden.
				</div>
			</div>
		</div>
	</div>
	');
	
	$design->footer();
?>