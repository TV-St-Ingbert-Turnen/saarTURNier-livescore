<?php
	require("design.class.php");
	$design = new design("backend_full");
	
	print('
	<div class="jumbotron">
	<div class="container">
	  <h1>ControlBoard <small>of ScoreSystem</small></h1>
	  <p><a class="btn btn-primary btn-lg" href="participantsAdministration.php" role="button">Ergebnisse erfassen...</a></p>
	</div>
	</div>
	');
	
	$design->footer();
?>