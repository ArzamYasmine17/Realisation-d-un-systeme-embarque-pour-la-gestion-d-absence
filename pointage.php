<?php
session_start();
require_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	
	// Get the card id
	$card_id = $_GET["card_id"];

	// Get the current date and time
	$currentDate = date('Y-m-d');
	
	// Check if the card is valid
	$req1 = "SELECT * FROM etudiant WHERE card_id = '$card_id'";
	$res1 = mysqli_query($conn, $req1);

	// if the card is valid
	if ($res1 -> num_rows != 0){
		// Retreive the seance
		$req2 = "SELECT * 
				FROM seance 
				WHERE date = '$currentDate' 
				AND NOW() >= DATE_ADD(debut, INTERVAL 0 SECOND) 
				AND NOW() <= DATE_ADD(debut, INTERVAL 15 MINUTE)";
		$res2 = mysqli_query($conn, $req2);
		$seance = mysqli_fetch_array($res2);
		
		// If the seance exists
		if ($res2 -> num_rows != 0){
			$req1 = "UPDATE attendance
					JOIN etudiant ON attendance.etudiant_id = etudiant.id
					SET status = 'present'
					WHERE etudiant.card_id = '$card_id'
					AND attendance.seance_id = '{$seance['id']}'";
			$res1 = mysqli_query($conn, $req1);
			echo "0";
		}
		else {
			echo "1";
		}
	}
	
	else {
		echo "2";
	}
}