<?php

/* creo connessione al DB*/
function connect_DB() {
$con = pg_connect("host=localhost port=5433 dbname=PostgreSQL user=postgres password=unimi");

if (!$con) {
	echo "Errore nella connessione al database: " . pg_last_error($con);
    exit;
}
return $con;
}






?>
