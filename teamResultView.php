<?php
	require("ScoreSystem/db.class.php");
	$db = new db();

	$year = intval(isset($_GET['year']) ? $_GET['year'] : 2015);

	require("design.class.php");
	$design = new design("frontend_full", $year);

	$score = $db->getTeamRanking($year);
?>
	
<div class="container" style="margin-top:5em">

<?php
	print("<table class='table table-striped'>");
	print("<thead><tr><th>#</th><th>Team</th><th>Punkte</th><th>Wettkampffortschritt</th></tr></thead>");
	print("<tbody>");
	foreach($score as $n=>$team){
		$n += 1; // is zero based
		print("<tr>");
		print("<td>". $n .".</td>");
		print("<td>" . $team[1] . "</td>");
		print("<td>" . number_format($team[3], 2) . "</td>");
		$finished = intval($team[2]);
		$progress = round(($finished/4.0)*100);
		$color = $progress < 26 ? "danger" : ($progress < 76 ? "warning" : "success");
		print("<td><div class='progress'>
				  <div class='progress-bar progress-bar-$color progress-bar-striped' role='progressbar' aria-valuenow='$finished' aria-valuemin='0' aria-valuemax='4' style='width: $progress%'>
					". $team[2] ."/4 Geräte
				  </div>
				</div></td>");
		
		print("</tr>");
	}
	
	print('</tbody></table>');

	$design->footer();
?>