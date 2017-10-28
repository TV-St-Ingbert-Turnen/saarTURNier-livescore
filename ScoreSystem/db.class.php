<?php
class db{
	
	private static $mysqli; 

	function __construct(){
		self::$mysqli = new mysqli("localhost", "root", "vt1881", "scoresystem");
	}
	
	function clearInput(){
		if(!self::$mysqli->query("TRUNCATE participants") ||
			!self::$mysqli->query("TRUNCATE teams")){
			echo "Table truncation failed: (" . self::$mysqli->errno . ") " . self::$mysqli->error;
		}
	}
	
	function addParticipant($name, $gender, $team){
		if(!($stmt = self::$mysqli->prepare("INSERT INTO participants(name,gender,team) VALUES(?,?,?)"))){
			echo "Prepare failed: (" . self::$mysqli->errno . ") " . self::$mysqli->error;
		}
		if (!$stmt->bind_param("ssi", $name, $gender, $team)) {
			echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}
		if (!$stmt->execute()) {
			echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		}
	}
	
	function addTeam($id,$name,$year){
		if(!($stmt = self::$mysqli->prepare("INSERT INTO teams(id,name,year) VALUES(?,?,?)"))){
			echo "Prepare failed: (" . self::$mysqli->errno . ") " . self::$mysqli->error;
		}
		if (!$stmt->bind_param("isi", $id, $name, $year)) {
			echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}
		if (!$stmt->execute()) {
			echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		}
	}
	
	function getTeams(){
		$array = array();
		if(!($result = self::$mysqli->query("SELECT * FROM teams ORDER BY id"))){
				echo "Select Team failed: (" . self::$mysqli->errno . ") " . self::$mysqli->error;
			}
		while($row = $result->fetch_array()){
			$array[] = $row["name"];
		}
		return $array;
	}
	
	function getApparatusConcat(){
		$array = array();
		if(!($result = self::$mysqli->query("SELECT eID, GROUP_CONCAT(name SEPARATOR '/') FROM gymnastic_apparatus GROUP BY eID ORDER BY eID"))){
			echo "Select Apparatus failed: (" . self::$mysqli->errno . ") " . self::$mysqli->error;
		}
		while($row = $result->fetch_row()){
			$array[] = array($row["0"],$row["1"]);
		}
		return $array;
	}
	
	function getTeamsWithScore(){
		$array = array();
		$gender = array("m","w");
		//$apparatus = array(1,2,3,4);
		$apparatus = self::getApparatusConcat();
		if(!($result = self::$mysqli->query("SELECT * FROM teams ORDER BY id"))){
				echo "Select Team failed: (" . self::$mysqli->errno . ") " . self::$mysqli->error;
			}
		while($row_teams = $result->fetch_array()){
			foreach($apparatus as $a){
				$array[$row_teams[1]][$a[1]] = 0;
				foreach($gender as $g){
					if(!($result2 = self::$mysqli->query("SELECT p.team, a.eID, pa.pID, pa.score
														FROM participant_apparatus AS pa, participants AS p, gymnastic_apparatus AS a
														WHERE p.id = pa.pID AND a.id = pa.aID AND p.team = ".$row_teams[0]." AND p.gender = '".$g."' AND a.eID = ".$a[0]."
														ORDER BY pa.score DESC
														LIMIT 2"))){
						echo "Select Team failed: (" . self::$mysqli->errno . ") " . self::$mysqli->error;
					}
					while($row_score = $result2->fetch_array()){
						$array[$row_teams[1]][$a[1]] += $row_score["score"];
					}
				}
			}
		}
		return $array;
	}
	
	function getParticipants($year){
		$array = array();
		if(!($result = self::$mysqli->query("SELECT * FROM teams WHERE year=$year ORDER BY id"))){
				echo "Select Team failed: (" . self::$mysqli->errno . ") " . self::$mysqli->error;
			}
		while($row = $result->fetch_array()){
			$array[$row["id"]] = array($row["name"],array());
		}
		
		
		if(!($result = self::$mysqli->query("SELECT `p`.`team` AS `team`, `p`.`name` AS `name`, `p`.`gender` AS `gender`, `p`.`id` as `id` \n"
		. "FROM `participants` AS `p` JOIN `teams` AS `t` ON `p`.`team`=`t`.`id` \n"
		. "WHERE `t`.`year`=$year \n"
		. "ORDER BY `p`.`team`,`p`.`gender`,`p`.`name`"))){
				echo "Select Participants failed: (" . self::$mysqli->errno . ") " . self::$mysqli->error;
			}
		while($row = $result->fetch_array()) {
			if (key_exists($row["team"], $array)) {
				$array[$row["team"]][1][] = array($row["name"], $row["gender"], $row["id"]);
			}
		}
		return $array;
	}
	
	function getApparatus(){
		$array = array();
		if(!($result = self::$mysqli->query("SELECT * FROM gymnastic_apparatus ORDER BY id"))){
				echo "Select Team failed: (" . self::$mysqli->errno . ") " . self::$mysqli->error;
			}
		while($row = $result->fetch_array()){
			$array[] = array($row["name"],$row["gender"],$row["id"]);
		}
		return $array;
	}
	
	function getAllScore(){
		$array = array();
		if(!($result = self::$mysqli->query("SELECT * FROM participant_apparatus"))){
				echo "Select Team failed: (" . self::$mysqli->errno . ") " . self::$mysqli->error;
			}
		while($row = $result->fetch_array()){
			$array[$row["pID"]][$row["aID"]]["d"] =$row["d_value"];
			$array[$row["pID"]][$row["aID"]]["e"] =$row["e_value"];
			$array[$row["pID"]][$row["aID"]]["sum"] =$row["score"];
		}
		return $array;
	}
	
	function getTeamRanking($year){
		$sql = "SELECT `r`.`team` AS `tid`, `t`.`name`, COUNT( DISTINCT(`ga`.`eID`)) AS `done`, SUM(`r`.`SUM(v.score)`) AS `score` \n"
     . "FROM `v_team_apparatus` AS `r` JOIN `teams` AS `t` ON `r`.`team` = `t`.`id` JOIN `gymnastic_apparatus` AS `ga` ON `ga`.`id` = `r`.`aID` \n"
	 . "WHERE `t`.`year`=$year \n"
     . "GROUP BY `r`.`team`\n"
     . "ORDER BY `score` DESC";
		$array = array();
		if(!($result = self::$mysqli->query($sql))){
				echo "Select Team Rank failed: (" . self::$mysqli->errno . ") " . self::$mysqli->error;
			}
		while($row = $result->fetch_array()){
			$array[] = $row;
		}
		return $array;
	}
	
	function saveScore($pID, $aID, $d_value, $e_value){
		$d_value = str_replace(",",".",$d_value);
		$e_value = str_replace(",",".",$e_value);
		
		if(!($stmt = self::$mysqli->prepare("INSERT INTO participant_apparatus(pID,aID,d_value,e_value) VALUES(?,?,?,?) ON DUPLICATE KEY UPDATE d_value=VALUES(d_value), e_value=VALUES(e_value)"))){
			echo "Prepare failed: (" . self::$mysqli->errno . ") " . self::$mysqli->error;
		}
		if (!$stmt->bind_param("iidd", $pID, $aID, $d_value, $e_value)) {
			echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}
		if (!$stmt->execute()) {
			echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		}
	}
	
	function popCommand(){
		if(!($result = self::$mysqli->query("SELECT * FROM command ORDER BY timestamp ASC LIMIT 1"))){
				echo "Pop command failed: (" . self::$mysqli->errno . ") " . self::$mysqli->error;
			}
		if($result->num_rows == 0)
			return false;
		$row = $result->fetch_array();
		
		if(!($result = self::$mysqli->query("DELETE FROM command WHERE cmd='".$row[0]."' AND timestamp='".$row[1]."'"))){
				echo "Pop command failed: (" . self::$mysqli->errno . ") " . self::$mysqli->error;
			}
		
		
		return $row[0];
	}
	
	function pushCommand($cmd){
		if(!($stmt = self::$mysqli->prepare("INSERT INTO command(cmd) VALUES(?)"))){
				echo "Prepare failed: (" . self::$mysqli->errno . ") " . self::$mysqli->error;
			}
			if (!$stmt->bind_param("s", $cmd)) {
				echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
			}
			if (!$stmt->execute()) {
				echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
			}
	}
}

?>