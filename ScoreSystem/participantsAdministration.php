<?php
    $year = intval(isset($_GET['year']) ? $_GET['year'] : 2015);
	require("db.class.php");
	$db = new db();
	require("design.class.php");
	$design = new design("backend_full", $year);
	
	print('
	<div class="container" style="margin-top:5em">');

	$apparatus = $db->getApparatus();
	$partic = $db->getParticipants($year);
	$score = $db->getAllScore();
	
	print("<div id='accordion'>");
	foreach($partic as $tkey=>$team){
		print("<h3>".$team[0]."</h3><div><form method='POST' action='saveScore.php'>");
		print("<table class='table table-hover'><thead><tr><th><input type='submit' name='save' value='speichern'></th>");
		foreach($apparatus as $a){
			print("<th>".$a[0]."</th>");
		}
		print("</tr></thead><tbody>");

			foreach($team[1] as $p){
				print("<tr><th scope='row'><input type='hidden' name='tID' value='".$tkey."'><input type='hidden' name='pID[]' value='".$p[2]."'>".$p[0]."</th>");
				foreach($apparatus as $a){
					print("<td><div class='row'>");
					if($a[1] == "b" || $a[1] == $p[1]){
						print("<div class='input-group'><span class='input-group-addon' id='basic-addon1'>D</span><input type='text' name='".$p[2]."_".$a[2]."_d' size='5' value='".
						(array_key_exists($p[2],$score)?(array_key_exists($a[2],$score[$p[2]])?$score[$p[2]][$a[2]]["d"]:""):"").
						"'></div>
						<div class='input-group'><span class='input-group-addon' id='basic-addon1'>E</span><input type='text' name='".$p[2]."_".$a[2]."_e' size='5' value='".
						(array_key_exists($p[2],$score)?(array_key_exists($a[2],$score[$p[2]])?$score[$p[2]][$a[2]]["e"]:""):"").
						"'></div>");
					}
					print("</div></td>");
				}
				print("</tr>");
			}
		
		print('</tbody></table></form></div>');
	}
	print('</div>');
	
	$design->footer();
?>