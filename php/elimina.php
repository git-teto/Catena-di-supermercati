<?php
    require_once("comuni/funzioni.php");
    session_start();
    $con = connect_DB();
         
		 
		 $tab=$_SESSION["tab"];
		 $value=$_POST['toDelete'];
		 $attributo=$_SESSION["att"];
		 echo "DELETE FROM ".$tab."  where  ".$attributo."=".$value;
        $query = "DELETE FROM $tab where $attributo='$value'";
        $query_res = pg_query($con, $query);
        if(!$query_res)  {
	        echo "Errore: ".pg_last_error($con);
	        exit;
        }
		else
		{
			echo "Eliminato!";
		}


?>