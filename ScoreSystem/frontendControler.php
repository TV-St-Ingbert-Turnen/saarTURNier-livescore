<?php
	require("design.class.php");
	$design = new design("backend_full");
	
	require("db.class.php");
	$db = new db();
	foreach($_POST as $key=>$value){
		$db->pushCommand($key);
	}
	
	
	print('
	<div class="content">
	<form method="POST">
		<input type="submit" name="teams" value="Team Namen anzeigen">
		<input type="submit" name="teams_score" value="Teams mit Gerätewertung">
	</form>
	</div>
	');
	
	$design->footer();
?>