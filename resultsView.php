<?php
	require("ScoreSystem/db.class.php");
	$db = new db();

    $year = intval(isset($_GET['year']) ? $_GET['year'] : 2015);


	require("design.class.php");
	$design = new design("frontend_full", $year);


	
	$apparatus = $db->getApparatus();
	$partic = $db->getParticipants($year);
	$score = $db->getAllScore($year);


?>
	
<div class="container" style="margin-top:5em">

    <div class="row" >
		<div class="col-md-4">
        	<h1><?php echo "$year"; ?></h1>
		</div>
    </div>


<div id='accordion' style='heightStyle: "content"'>

<?php
	foreach($partic as $tkey=>$team){
		print("<h3>".$team[0]."</h3><div>");
		print("<table class='table table-hover'><thead><tr><th><span class='label label-default'>D</span> <span class='label label-primary'>E</span> <span class='label label-success'>Gesamt</span></th>");
		foreach($apparatus as $a){
			print("<th class='row text-center'><img src='ScoreSystem/img/".$a[0].".png' title='".$a[0]."' alt='".$a[0]."'></th>");
		}
		print("</tr></thead><tbody>");

			foreach($team[1] as $p){
				print("<tr><th scope='row'><input type='hidden' name='tID' value='".$tkey."'><input type='hidden' name='pID[]' value='".$p[2]."'>".$p[0]."</th>");
				foreach($apparatus as $a){
					print("<td><div class='row text-center'>");
					if($a[1] == "b" || $a[1] == $p[1]){
						print("<span class='label label-default'>".
						(array_key_exists($p[2],$score)?(array_key_exists($a[2],$score[$p[2]])?number_format($score[$p[2]][$a[2]]["d"], 2):""):"").
						"</span></br><span class='label label-primary'>".
						(array_key_exists($p[2],$score)?(array_key_exists($a[2],$score[$p[2]])?number_format($score[$p[2]][$a[2]]["e"], 2):""):"").
						"</span></br><span class='label label-success'>".
						(array_key_exists($p[2],$score)?(array_key_exists($a[2],$score[$p[2]])?number_format($score[$p[2]][$a[2]]["sum"], 2):""):"").
						"</span>");
					}
					print("</div></td>");
				}
				print("</tr>");
			}
		
		print('</tbody></table></div>');
	}
	print('</div>');

	$design->footer();
?>