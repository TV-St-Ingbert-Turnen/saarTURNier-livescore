<?php
	require("design.class.php");
	$design = new design("frontend_full");
	
	print('
	<div class="jumbotron">
		<div class="container" style="margin-top: 20px">
			<div class="row" >
				<div class="col-md-4">
					<img src="ScoreSystem/img/STLogo.jpg" alt="SaarTURNier Logo" class="img-responsive">
				</div>
				<div class="col-md-6">
					<h1>SaarTURNier 2016</h1>
					<p>Das SaarTURNier geht in die 2. Runde. Wie letztes Jahr könnt ihr euch die Ergebnisse live ansehen. Sieh dir jederzeit die Einzel- bzw. Teamwertungen vom SaarTURNier 2016 an.</p>
					<div class="row" >
						<div class="col-xs-6 col-md-6">
							<a href="resultsView.php" class="btn btn-warning btn-block btn-lg" role="button">Einzel</a>
						</div>
						<div class="col-xs-6 col-md-6">
							<a href="teamResultView.php" class="btn btn-warning btn-block btn-lg" role="button">Team</a>
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