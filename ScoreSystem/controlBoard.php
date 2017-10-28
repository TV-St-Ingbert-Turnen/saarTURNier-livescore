<?php
    $year = intval(isset($_GET['year']) ? $_GET['year'] : 2015);
	require("design.class.php");
	$design = new design("backend_full", $year);
	
	print('
	<div class="jumbotron">
	<div class="container">
	  <h1>ControlBoard <small>of ScoreSystem</small></h1>
	  <p><a class="btn btn-primary btn-lg" href="participantsAdministration.php?year=2015" role="button">Ergebnisse 2015</a></p>
	  <p><a class="btn btn-primary btn-lg" href="participantsAdministration.php?year=2016" role="button">Ergebnisse 2016</a></p>
	  <p><a class="btn btn-primary btn-lg" href="participantsAdministration.php?year=2017" role="button">Ergebnisse 2017</a></p>
	</div>
	</div>
	');
	
	$design->footer();
?>