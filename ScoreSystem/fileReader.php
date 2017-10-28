<?php
	$file_participants = "input/participants.csv";
	$file_teams = "input/teams.csv";
	
	require("db.class.php");
	$db = new db();
	$db->clearInput();
	
	//read teams
	if(($f = fopen($file_teams,"r")) !== FALSE){
		while(($row = fgetcsv($f,1000,";")) !== FALSE){
			$db->addTeam($row[0],$row[1],$row[2]);
		}
		fclose($f);
	}
	
	//read participants
	if(($f = fopen($file_participants,"r")) !== FALSE){
		while(($row = fgetcsv($f,1000,";")) !== FALSE){
			$db->addParticipant($row[0],$row[1],$row[2]);
		}
		fclose($f);
	}
	

?>