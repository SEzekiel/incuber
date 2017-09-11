<?php


fetch();
function fetch()
{

	$conn = mysqli_connect("sql112.epizy.com","epiz_20077928","agnes123","epiz_20077928_incuber");
	$query = "SELECT * FROM ubers WHERE 1";

	$result = mysqli_query($conn,$query);
	//echo mysqli_num_rows($result);
	if (mysqli_num_rows($result) > 0) {
		 while($row = mysqli_fetch_assoc($result)){
		 	$id = $row['id'];
		 	$minutes = $row['time'];
		 	$minutes = (int)((time()-strtotime($minutes))/60);
			
			if ($minutes >= 60) {
				$qry = "DELETE FROM ubers WHERE id ='$id'";

				$rslt = mysqli_query($conn,$qry);
			}
		}
	}
}

?>