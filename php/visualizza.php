<?php

    require_once("comuni/funzioni.php");
    session_start();
    $con = connect_DB();
    
     //Visualizza personale
	if(isset($_POST['vispersup'])){
	 
	 $reparto=$_SESSION["arrayrep"][$_POST['visperrep']]['nome'];
	 $super=$_SESSION["arraysuper"][$_POST['vispersup']]['indirizzo']; 
	 $array1=array();
	 $query1 = "select * from impiegati where supermercato='$super'and reparto='$reparto' ";
     $_SESSION["tab"]='impiegati';
	 $_SESSION["att"]='codfiscale';
	$query_res1 = pg_query($con, $query1);
	if(!$query_res1)  {
	echo "Errore: ".pg_last_error($con);
	exit;
    }
    while ($row1 = pg_fetch_assoc($query_res1)) { 
	$array1[]=$row1; 
	}
	if($array1){
	print("<table cellspacing=\"5\", cellpadding=\"5\">");
	print("<tr/>Visualizza personale nel reparto ".$reparto." del super di ".$super."</tr>");
	echo "<tr><td> codice fiscale </td><td> reparto </td><td> supermercato </td><td> mansione </td><td> data nascita </td><td> email </td><td> data assunzione </td><td> livello </td><td> indirizzo </td><td> nome </td><td> cognome </td><td> tel </td></tr>";

	echo "<tr>";
	foreach($array1 as $value){
		//print_r($value);
		$coffisc=$value['codfiscale'];
		foreach($value as $value1){	
		echo "<td>";
        echo $value1;
        echo "</td>";
		}
		echo "<td>";
		echo '<FORM METHOD="POST" ACTION="elimina.php">';
        echo '<INPUT TYPE="HIDDEN" NAME="toDelete" VALUE='.$coffisc.'>';
         
        echo '<INPUT TYPE="SUBMIT" VALUE="Elimina">';
        echo '</FORM>';
		echo "</td>";
	     echo "</tr>";
		
	  }
	  print("</table>");
	}
	else {
		echo "Nessun risultato!";
		}
	 }
	 
	 //Visualizza mansioni del personale
	if(isset($_POST['vismansrep'])){
     	  	   
	    $reprp=$_SESSION["arrayrep"][$_POST['vismansrep']]['nome'];
	    $superrp=$_SESSION["arraysuper"][$_POST['vismansup']]['indirizzo'];
	    $mansione="";
	     $_SESSION["tab"]='impiegati';
		$query = "SELECT * FROM impiegati where supermercato='$superrp' and reparto='$reprp'";
        $query_res = pg_query($con, $query);
        if(!$query_res)  {
	        echo "Errore: ".pg_last_error($con);
	        exit;
        }
		
        while ($row = pg_fetch_assoc($query_res)) { //per ogni impiegato
	        $array[]=$row; 
	        
        } 
		
		if($array){
		print("<table cellspacing=\"5\", cellpadding=\"5\">");
	    print("<tr/>Visualizza mansioni del personale nel reparto ".$reprp." del super di ".$superrp."</tr>");
        foreach($array as $row) { //per ogni impiegato
            
			if(strcmp($row["mansione"],$mansione)==0){
		        echo '<tr><td></td><td>nome: '.$row["nome"].'</td><td>cognome: '.$row["cognome"].'</td><td> codice fiscale: '.$row["codfiscale"].'<td></tr>';
	        }
	        else{
		        echo '<tr><td>'.$row["mansione"].'</td><td>nome: '.$row["nome"].'</td><td> cognome: '.$row["cognome"].'</td><td> codice fiscale: '.$row["codfiscale"].'</td>';
		        $mansione=$row["mansione"];
	        }    
        }  
	    echo '</table>';
	    }	
        else{
			echo "Nessun risultato!";
		}		
	}
	 
	 //turni settimanali
	 if(isset($_POST['repturni'])){
     	  	   
	    $rept=$_SESSION["arrayrep"][$_POST['repturni']]['nome'];
	    $supert=$_SESSION["arraysuper"][$_POST['superturni']]['indirizzo'];
	    $_SESSION["tab"]='turnisettimanali';
	   $query = "SELECT * FROM turnisettimanali where supermercato='$supert' and reparto='$rept'";
        $query_res = pg_query($con, $query);
        if(!$query_res)  {
	        echo "Errore: ".pg_last_error($con);
	        exit;
        }
		
        while ($row = pg_fetch_assoc($query_res)) { //per ogni impiegato
	        $array[]=$row; 
	       
        } 
		if($array){
		print("<table cellspacing=\"5\", cellpadding=\"5\">");
	    print("<tr/>Visualizza turni del personale nel reparto ".$rept." del super di ".$supert."</tr>");
		echo "<tr><td> codice fiscale </td><td> reparto </td><td> supermercato </td><td> Giorno Inizio Turno </td><td> Orario Inizio Turno</td><td> Giorno fine turno </td><td> Orario Fine Turno </td></tr>";
        foreach($array as $row) { //per ogni impiegato           
		   echo "<tr>";
		   foreach($row as $row1) {
			   echo "<td>";
               echo $row1;
               echo "</td>";
		   }
			echo "</tr>";		  
        }  
	    echo '</table>';
	 }
	 else
	 {
		 echo "Nessun risultato!";
	 }
	 
	}
	
	//visualizza tabelle
	 if(isset($_POST['visualizzatabelle'])){
		 
		 if($_POST['visualizzatabelle']=='ppunti'){		 
		 $query77 = "select * from prodotti where puntiottenibili>0";
        $query_res77 = pg_query($con, $query77);
        if(!$query_res77)  {
	        echo "Errore: ".pg_last_error($con);
	        exit;
             }
			 while ($row = pg_fetch_assoc($query_res77)) { 
	        $array[]=$row; 	       
        }
		
		print("<table cellspacing=\"5\", cellpadding=\"5\">");
	    print("<tr/>Visualizza prodotti che danno punti</tr>");
		echo "<tr><td> codice </td><td> nome </td><td> punti </td></tr>";
		foreach($array as $row) {                     		 
		  echo "<tr>";
			   echo "<td>".$row['codiceinternosuper']."</td><td>".$row['nome']."</td><td>".$row['puntiottenibili']."</td>";              
		 	 echo "</tr>";		  
        }  
	    echo '</table>';		 
		 }
		 else
		{
		 $tabellavis=$_POST['visualizzatabelle'];		 
		 $query = "SELECT * FROM $tabellavis";
        $query_res = pg_query($con, $query);
        if(!$query_res)  {
	        echo "Errore: ".pg_last_error($con);
	        exit;
        }
		
        while ($row = pg_fetch_assoc($query_res)) { 
	        $array[]=$row; 	       
        }
		print("<table cellspacing=\"5\", cellpadding=\"5\">");
	    print("<tr/>Visualizza $tabellavis</tr>");
       $_SESSION["tab"]=$tabellavis;
	   if($tabellavis=='supermercati'){
		   $_SESSION["att"]='indirizzo';
		   echo "<tr><td> indirizzo</td><td> orario apertura ordinaria </td><td> orario apertura straordinaria </td>";
	   }
	   else
	   {
		   $_SESSION["att"]='codfiscale';
		   echo "<tr><td> codice fiscale </td><td> reparto </td><td> supermercato </td>";
	   }
	   foreach($array as $row) {          
			 $val=$row[$_SESSION["att"]]; 
            		 
		  echo "<tr>";
		   foreach($row as $row1) {
			   echo "<td>";
               echo $row1;
               echo "</td>";
		   }
			echo "<td>";
		    echo '<FORM METHOD="POST" ACTION="elimina.php">';
            echo '<INPUT TYPE="HIDDEN" NAME="toDelete" VALUE='.$val.'>';        
            echo '<INPUT TYPE="SUBMIT" VALUE="Elimina">';
            echo '</FORM>';
		     echo "</td>";
			echo "</tr>";		  
        }  
	    echo '</table>';
	 }
		
	 }
	 
	
	?>