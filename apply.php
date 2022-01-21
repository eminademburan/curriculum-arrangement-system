<?php

session_start();
require_once "config.php";

$num = $_GET['id1'];
$sid = $_GET['id2'];

//control whether a student applies more than 3 company
if( $num >= 3 )
{
	echo '<script>alert("You cannot apply more than 3 internship")</script>';
	//if number of companies is greater than 3 redirecct to welcome page
	echo "<script LANGUAGE='JavaScript'>
          window.location.href = 'welcome.php';
          </script>";	
}
else
{
	//take the companies that student can apply
	$query = "SELECT cid, cname, quota FROM company WHERE quota > 0 AND cid NOT IN (SELECT cid FROM apply WHERE sid='$sid')";
	$result = mysqli_query($adress, $query);
	
	//make table to show student companies that he/she can apply
	echo '<h1 style="text-align: center;">Companies You Can Apply</h1>';
	echo '<div style="display: flex; flex-direction: column; justify-content: center;">';
	echo '<table><thead><tr>';
	echo '<th style="text-align: center;">Company ID</th>';
	echo '<th style="text-align: center;">Company Name</th>';
	echo '<th style="text-align: center;">Company Quota</th>';
	echo '</tr></thead><tbody>';

	//for each company create a row
	while($row = mysqli_fetch_array($result))
     	{
        	echo '<tr>';
		echo '<td style="text-align: center;">'.$row[0].'</td>';
		echo '<td style="text-align: center;">'.$row[1].'</td>';
		echo '<td style="text-align: center;">'.$row[2].'</td>';
		echo '</tr>';
     	}

	echo '</tbody></table>';
	echo '</div>';
	echo '<br>';
	//make input field and button
	echo '<div align="center">';
	echo '<form method="POST">';
	echo '<label>Company ID</label>';
	echo '<input name="companyID" placeholder="Company Id" />';
	echo '<h1></h1>';
	echo '<input type="submit" name="test" value="Submit" />';
	echo '</form>';
	echo '</div>';
	echo '<div align="center">';
	//give necessary links to redirect between pages
	echo '<a style="text-align: center;" href="welcome.php">Turn to Welcome Page</a>';
	echo '<br>';
	echo '<a style="text-align: center;" href="index.php">Logout</a>';
	echo '</div>';
	
	//control whether button is clicked or not
	if( array_key_exists('test', $_POST) ){

		$compID = $_POST['companyID'];
		$sqlQuery = "SELECT quota FROM company WHERE cid='$compID'";
		$result2 =mysqli_query($adress, $sqlQuery);
		
		//control whether a student can apply to company with given id
		if( $result2 )
		{
			$query3 = "SELECT cid, cname, quota FROM company WHERE quota > 0 AND cid NOT IN (SELECT cid FROM apply WHERE sid='$sid')";
			$result3 = mysqli_query($adress, $query3);
			$canApply = false;
			$row2 = mysqli_fetch_array($result2);
			

			while($row3 = mysqli_fetch_array($result3) )
     			{
        			if( $row3[0] == $compID )
				{
					$canApply = true;
				}
					
     			}	

			$quotaNum = $row2[0];
		
			if( ($row2[0] > 0) and $canApply )
			{
				//if  student can apply country make necessary insertions
				$result4 = mysqli_query($adress, "INSERT INTO apply (sid, cid) VALUES ('$sid', '$compID')" );
				
				if( $result4 )
				{
					$quotaNum = $quotaNum - 1;
					$query5= "UPDATE company SET quota=$quotaNum WHERE cid='$compID'";
					$result5= mysqli_query($adress, $query5);
					$num = $num + 1;
					echo '<script>alert("You applied successfuly to company with id '.$compID. '")</script>';
					echo "<script LANGUAGE='JavaScript'>
              					window.location.href = 'welcome.php';
        					</script>";						
				}	
				else
				{
					echo '<script>alert("You could not applied  to company with id '.$compID. '")</script>';
				}
				
			}
			//give meaninful error message if student cannot apply
			else
			{
				echo '<script>alert("You could not applied  to company with id '.$compID. '")</script>';
			}
			
		}
		
		
	}
}


?>