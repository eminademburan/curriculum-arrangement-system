<?php

	session_start();
	require_once "config.php";
	$userName = $_SESSION['userName'];
	$userPassword = $_SESSION['userPassword'];

	$numberOfApply  =0;

	$query = "SELECT sid ,cid, cname, quota FROM student NATURAL JOIN apply NATURAL JOIN company WHERE sid='$userPassword'";
	$result = mysqli_query($adress, $query);

	//create table
	echo '<div class="comp" style=" display: flex; flex-direction: column; justify-content: center;">'; 
	echo '<h1 style="text-align: center;">Your InternShip Applications</h1>';
	echo '<br>';
	echo '<table><thead><tr>';
	echo '<th style="text-align: center;">Company ID</th>';
	echo '<th style="text-align: center;">Company Name</th>';
	echo '<th style="text-align: center;">Company Quota</th>';
	echo '<th style="text-align: center;">Cancel Application</th>';
	echo '</tr></thead><tbody>';

	//create table row each element of company table
	while($row = mysqli_fetch_array($result))
     	{
		$numberOfApply = $numberOfApply + 1;
        	echo '<tr>';
		echo '<td style="text-align: center;">'.$row[1].'</td>';
		echo '<td style="text-align: center;">'.$row[2].'</td>';
		echo '<td style="text-align: center;">'.$row[3].'</td>';
		echo '<td style="text-align: center;"><a href="delete.php?id1='.$row[0].'&id2='.$row[1].'">Cancel</a></td>';
		echo '</tr>';
     	}

	echo '</tbody></table>';

	echo '<br>';
	
	//give necessary links to direct between pages
	echo '<a style="text-align: center;" href="apply.php?id1='.$numberOfApply.'&id2='.$userPassword.'">Apply For New Internship</a></table>';
	echo '<br>';
	echo '<a style="text-align: center;" href="index.php">Logout</a></table>';
	echo '</div>';

?>
