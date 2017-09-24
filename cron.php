<?php

/**
*This script will handle the removal of expired post
*it will be executed by the server every minute
*Cron needs to be enabled on your server for this to work
**/
fetch();
function fetch()
{

	//TO DO: Include a connection to your database here first
	//$con = mysqli_connect("host","user","password","database");
	$query = "SELECT * FROM ubers WHERE 1";

	$result = mysqli_query($conn,$query);
	//echo mysqli_num_rows($result);
	if (mysqli_num_rows($result) > 0) {
		 while($row = mysqli_fetch_assoc($result)){
		 	$id = $row['id'];
		 	$tyme= $row['tyme'];
		 	//$minutes = (int)((time()-strtotime($minutes))/60);
			
			if ($tyme <=0) {
				$qry = "DELETE FROM ubers WHERE id ='$id'";
				$rslt = mysqli_query($conn,$qry);
			}
			else{
				if(($tyme-2)<0){
					$tyme = $tyme - 1;
					$qry = "UPDATE ubers SET tyme = '$tyme' WHERE id ='$id'";
					$rslt = mysqli_query($conn,$qry);
				}
				else{
					$tyme = $tyme - 2;
					$qry = "UPDATE ubers SET tyme = '$tyme' WHERE id ='$id'";
					$rslt = mysqli_query($conn,$qry);
				}
			}
		}
	}
}

?>
