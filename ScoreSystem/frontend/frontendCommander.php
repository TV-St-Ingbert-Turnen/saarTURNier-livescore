<?php
	session_start();
	//weiterleitung zu anderen seiten pruefen
	require("../db.class.php");
	$db = new db();
	/*if(db->command)
		header(db->command);
		exit();
	*/
	
	$cmd = $db->popCommand();
	$_SESSION["cmd"] = !$cmd?(isset($_SESSION["cmd"])?$_SESSION["cmd"]:""):$cmd;
	
	switch($_SESSION["cmd"]){
		case "teams":$_SESSION["view"]=showTeams();break;
		case "teams_score": $_SESSION["view"]=showTeamsWithScore();break;
		default: $_SESSION["view"]=getDefault();break;
	}
	
	
	function showTeams(){
		global $db;
		$teams = $db->getTeams();
		$view = "<div>";
		foreach($teams as $team){
			$view .= "<p><h1>$team</h1></p>";
		}
		$view .= "</div>";
		return $view;
	}
	
	function showTeamsWithScore(){
		global $db;
		$teams = $db->getTeamsWithScore();
		$view = "<div>";
		foreach($teams as $tkey => $tvalue){
			$view .= "<p><h1>$tkey</h1><br>";
			foreach($tvalue as $akey => $avalue){
				$view .= "<h2>$akey : $avalue</h2><br>";
			}
			$view .= "</p>";
		}
		$view .= "</div>";
		return $view;
	}
	
	function showApparatus($id){
		global $db;
		//TODO erst copy paste
		$teams = $db->getTeamsWithScore();
		$view = "<div>";
		foreach($teams as $tkey => $tvalue){
			$view .= "<p><h1>$tkey</h1><br>";
			foreach($tvalue as $akey => $avalue){
				$view .= "<h2>$akey : $avalue</h2><br>";
			}
			$view .= "</p>";
		}
		$view .= "</div>";
		return $view;
	}

	function getDefault(){
		return "<h1>Bitte Kommando schicken!</h1>";
	}

	
?>