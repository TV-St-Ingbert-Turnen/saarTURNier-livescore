<?php
	require("db.class.php");
	$db = new db();
	
	
	$tID = $_POST["tID"];
	
	foreach($_POST["pID"] as $p){
		for($i=1;$i<7;$i++){
			$aIDs_d[$i]=isset($_POST[$p."_".$i."_d"])?$_POST[$p."_".$i."_d"]:"";
			$aIDs_e[$i]=isset($_POST[$p."_".$i."_e"])?$_POST[$p."_".$i."_e"]:"";
		}
		
		for($i=1;$i<7;$i++){
			if($aIDs_d[$i] != "" && $aIDs_e[$i] != ""){
				$db->saveScore($p,$i,$aIDs_d[$i],$aIDs_e[$i]);
			}
		}
	}
	
	header("location: participantsAdministration.php");
?>