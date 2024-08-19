<?php
require_once("comuni/funzioni.php");
session_start();
$con = connect_DB();
/* if(isset($_SESSION['arraysuper']))
echo $_POST['nome'];
 $index=(int)$_POST['super'];
$array1=$_SESSION['arraysuper'];
$scelta=$array1[$index];
 print_r($scelta['indirizzo']);
 unset($_POST['super']); */
 
 // inserisci super
 if(isset($_POST['viasup1']) and isset($_POST['oao']) and isset($_POST['oas'])){
	 $via=$_POST['viasup1'];
	 $oao=$_POST['oao'];
	 $oas=$_POST['oas'];
	 
	 $query1 = "INSERT INTO supermercati VALUES('$via','$oao','$oas')";
     $query_res1 = pg_query($con, $query1);
      if(!$query_res1)  {
	  echo "Errore: ".pg_last_error($con);
	   exit;
        }
		else
		{
			echo "Il Super di ".$via." è stato inserito correttamente!";
		}
    }
	
	//inserisci reparto
	if(isset($_POST['nomerep2']) and isset($_POST['superrep2'])){
	 $nomerep2=$_POST['nomerep2'];
	 $index2=$_POST['superrep2'];
	 $arraysuper2=$_SESSION["arraysuper"];
	 $super2=$arraysuper2[$index2]['indirizzo'];
	
	 $query1 = "INSERT INTO reparti VALUES('$nomerep2','$super2')";
     $query_res1 = pg_query($con, $query1);
      if(!$query_res1)  {
	  echo "Errore: ".pg_last_error($con);
	   exit;
        }
		else
		{
			echo "Il Reparto  ".$nomerep2." del super di ".$super2." è stato inserito correttamente!";
		}  
   } 
	
	
   //inserisci impiegato
	if(isset($_POST['nomeimp3']) and isset($_POST['cognomeimp3']) and isset($_POST['cfimp3'])and isset($_POST['mansioneimp3'])
		and isset($_POST['datanascitaimp3'])and isset($_POST['dataassunzioneimp3'])and isset($_POST['emailimp3'])
	and isset($_POST['livelloimp3'])and isset($_POST['indirizzoimp3'])and isset($_POST['telimp3'])
	and isset($_POST['superimp3'])and isset($_POST['repartoimp3'])){
	 $indexsuperimp3=$_POST['superimp3'];
	 $indexrepartoimp3=$_POST['repartoimp3'];
	 $nomeimp3=$_POST['nomeimp3'];
	 $cognomeimp3=$_POST['cognomeimp3'];
	 $superimp3=$_SESSION["arraysuper"][$indexsuperimp3]['indirizzo'];
	 $repartoimp3=$_SESSION["arrayrep"][$indexrepartoimp3]['nome'];
	 $cfimp3=$_POST['cfimp3'];
	 $mansioneimp3=$_POST['mansioneimp3'];
	 $datanascitaimp3=$_POST['datanascitaimp3'];
	 $dataassunzioneimp3=$_POST['datanascitaimp3'];
	 $emailimp3=$_POST['emailimp3'];
	 $livelloimp3=$_POST['livelloimp3'];
	 $indirizzoimp3=$_POST['indirizzoimp3'];
	 $telimp3=$_POST['telimp3'];
	 
	 $queryimp = "INSERT INTO impiegati VALUES('$cfimp3','$repartoimp3','$superimp3','$mansioneimp3','$datanascitaimp3','$emailimp3','$dataassunzioneimp3','$livelloimp3','$indirizzoimp3','$nomeimp3','$cognomeimp3','$telimp3')";
     $query_resimp = pg_query($con, $queryimp);
      if(!$query_resimp)  {
	  echo "Errore: ".pg_last_error($con);
	   exit;
        }
		else
		{
			echo "Ho inserito ".$repartoimp3." ".$superimp3." ".$nomeimp3." ".$cognomeimp3." ".$cfimp3." ".$mansioneimp3." ".$datanascitaimp3." ".$dataassunzioneimp3." ".$emailimp3." ".$livelloimp3." ".$indirizzoimp3." ".$telimp3;
		} 
            		
   } 
   
   //inserisci capo reparto
	if(isset($_POST['cfcp4']) and isset($_POST['supercp4'])and isset($_POST['repartocp4'])){
	 $cfcp4=$_POST['cfcp4'];
	 $supercp4=$_SESSION['arraysuper'][$_POST['supercp4']]['indirizzo'];
	 $repcp4=$_SESSION["arrayrep"][$_POST['repartocp4']]['nome'];
     
	 
	
	 $querycp4 = "INSERT INTO responsabili VALUES('$cfcp4','$repcp4','$supercp4')";
     $query_rescp4 = pg_query($con, $querycp4);
      if(!$query_rescp4)  {
	  echo "Errore: ".pg_last_error($con);
	   exit;
        }
		else
		{
			echo "Il dip ".$cfcp4." è diventato responsabile nel reparto ".$repcp4." del super di ".$supercp4;
		}  
		
   }
   
   //inserisci orario impiegato
   if(isset($_POST['cfturniset']) and isset($_POST['git'])and isset($_POST['oit'])
	   and isset($_POST['gft'])and isset($_POST['oft'])){
	$git=$_POST['git'];
	$oit=$_POST['oit'];
	$gft=$_POST['gft'];
	$oft=$_POST['oft'];
	$cfoi=$_POST['cfturniset'];
	echo "cf ".$cfoi;
	 $queryoi = "select reparto,supermercato from impiegati where codfiscale='$cfoi'";
     $query_resoi = pg_query($con, $queryoi);
      if(!$query_resoi)  {
	  echo "Errore: ".pg_last_error($con);
	   exit;
        }
          $rowoi = pg_fetch_assoc($query_resoi);
		  print_r($rowoi);
         $superoi=$rowoi['supermercato'];
         $repoi=$rowoi['reparto'];	 
		 
		 $queryinsert = "INSERT INTO turnisettimanali VALUES('$cfoi','$repoi','$superoi','$git','$oit','$gft','$oft')";
        $query_resinsert = pg_query($con, $queryinsert);
      if(!$query_resinsert)  {
	  echo "Errore: ".pg_last_error($con);
	   exit;
        }
		else
		{
			echo "Orario Inserito";
		} 
		
   }
   //inserisci prodotto
	if(isset($_POST['suprp'])){
	 $indexsuperrp=$_POST['suprp'];
	 $indexrepartorp=$_POST['reprp'];
	 $codintsup=$_POST['codrp'];
	 $nomerp=$_POST['nomerp'];
	 $categoriarp=$_POST['catrp'];
	 $prezzoap=$_POST['prezpubrp'];
	 $scadenza=$_POST['scadrp'];
	 $qtamg=$_POST['qtarp'];
	 $sogliariord=$_POST['srrp'];
	 $puntiottenibili=$_POST['porp'];
	$prezzoing=$_POST['pringrp'];
	$codicerifornitore=$_POST['codrifrp'];
	//if($_POST['pringrp']){$prezzoing=$_POST['pringrp'];}else{$prezzoing=0;}
	// if($_POST['codrifrp']){$codicerifornitore=$_POST['codrif'];}else{$codicerifornitore='no_code';}
	 $reprp=$_SESSION["arrayrep"][$indexrepartorp]['nome'];
	 $superrp=$_SESSION["arraysuper"][$indexsuperrp]['indirizzo'];
	 if($_POST['pringrp'] and $_POST['codrifrp']){
		 $queryip = "INSERT INTO prodotti VALUES('$codintsup','$nomerp','$categoriarp','$prezzoap','$scadenza','$qtamg','$sogliariord','$puntiottenibili','$prezzoing','$codicerifornitore','$reprp','$superrp')"; 
	 }
	 else{
		  $queryip = "INSERT INTO prodotti(codiceinternosuper,nome,categoria,prezzoAP,scadenza,qtamag,sogliariordino,puntiottenibili,nomereparto,nomesupermercato) VALUES('$codintsup','$nomerp','$categoriarp','$prezzoap','$scadenza','$qtamg','$sogliariord','$puntiottenibili','$reprp','$superrp')";
	 }
	
     $query_resip = pg_query($con, $queryip);
      if(!$query_resip)  {
	  echo "Errore: ".pg_last_error($con);
	   exit;
        }
		else
		{
			echo "Inserito ".$nomerp ;
		}        		
   }
   
   //inserisci assemblati
	if(isset($_POST['nomeassemb'])){
	 $indexsuperrp=$_POST['nomeassemb'];
	 $indexrepartorp=$_POST['compostassmb'];
	 $qtaprd=$_POST['qtaassmb'];
	 
	 
	 $queryass = "INSERT INTO assemblati VALUES('$indexsuperrp','$indexrepartorp','$qtaprd')";
     $query_resass = pg_query($con, $queryass);
      if(!$query_resass)  {
	  echo "Errore: ".pg_last_error($con);
	   exit;
        }
		else
		{
			echo "Creato prodotto assemblato!" ;
		}        		
   }
   
   //inserisci fornitore
	if(isset($_POST['pivaf'])){
	 $pivaf=$_POST['pivaf'];
	 $ragsf=$_POST['ragsf'];
	 $modpag=$_POST['modpagf'];
	 $emailf=$_POST['emailf'];
	 $indirizzof=$_POST['indirizzof'];
	 $indirizzof=$_POST['telf'];
	
	 $queryf = "INSERT INTO fornitori VALUES('$pivaf','$ragsf','$modpag','$emailf','$indirizzof','$indirizzof')";
     $query_resf = pg_query($con, $queryf);
      if(!$query_resf)  {
	  echo "Errore: ".pg_last_error($con);
	   exit;
        }
		else
		{
			echo "Fornitore inserito!";
		}       		
   }
	
	//inserisci ordine
	if(isset($_POST['prodord'])){
	 $prodotord=$_POST['prodord'];
	 $forntord=$_POST['forntord'];
	 $dateconsord=$_POST['dateconsord'];
	 $qtaord=$_POST['qtaord'];
	 $codord=$_POST['codord'];
	 $dataord=$_POST['dateacqord'];
	 
	
	 $queryord = "INSERT INTO ordini VALUES('$codord','$prodotord','$dataord','$dateconsord','$forntord','$qtaord')";
     $query_resord = pg_query($con, $queryord);
      if(!$query_resord)  {
	  echo "Errore: ".pg_last_error($con);
	   exit;
        }
		else
		{
			echo "Ordine effetuato!";
		}       		
   }
   
   //inserisci cliente
	if(isset($_POST['nomecl'])){
	 $nomecl=$_POST['nomecl'];
	 $cognomecl=$_POST['cognomecl'];
	 $cfcl=$_POST['cfcl'];
	 $codtcl=$_POST['codtcl'];
	 $datanascitacl=$_POST['datanascitacl'];
	 $emailcl=$_POST['emailcl'];
	 $punticl=$_POST['punticl'];
	 $indirizzocl=$_POST['indirizzocl'];
	 $telcl=$_POST['telcl'];
	 
	 $querycl = "INSERT INTO clienti VALUES('$codtcl','$punticl','$emailcl','$datanascitacl','$indirizzocl','$nomecl','$cognomecl','$telcl','$cfcl')";
     $query_rescl = pg_query($con, $querycl);
      if(!$query_rescl)  {
	  echo "Errore: ".pg_last_error($con);
	   exit;
        }
		else
		{
			echo "Cliente inserito correttamente!";
		}         		
   } 
   
      //simula acquisto
   if(isset($_POST['prodacqu'])){
	 $prodacqu=$_POST['prodacqu'];
	 $codscontrin=$_POST['codscontr'];
	 if($_POST['clientacq']=='null'){
		 $cliente=null;
	 }
	 else{
		 $cliente=$_POST['clientacq'];
	 }
	 $dataacquist=$_POST['dateacq'];
	 $quantità=$_POST['qtaacq'];
	 
	 $prodottoarray;
	$arrayprd444=$_SESSION["arrayprd"];
	foreach( $arrayprd444 as $value){
		if($value['codiceinternosuper']==$_POST['prodacqu'] ){
			$prodottoarray=$value;
		}
	}
	$prezzo=$prodottoarray['prezzoap']*$quantità;
	 
	 if($cliente){
		
		$queryacq = "INSERT INTO acquisti VALUES('$prodacqu','$codscontrin','$cliente','$dataacquist','$quantità','$prezzo')"; 
	 }
	 else
	 {
		
		 $queryacq = "INSERT INTO acquisti(prodotto,codscontrino,dataacquisto,quantità,prezzo) VALUES('$prodacqu','$codscontrin','$dataacquist','$quantità','$prezzo')";
	 } 
	 
     $query_resacq = pg_query($con, $queryacq);
      if(!$query_resacq)  {
	  echo "Errore: ".pg_last_error($con);
	   exit;
        }
		else
		{
			echo "Acquisto avvenuto con successo!";
		} 	
print("</br>");	

	$puntiaggiunti=$prodottoarray['puntiottenibili'];
	$codprod=$prodottoarray['codiceinternosuper'];
	
	$querypunti="update clienti set punti=punti+'$puntiaggiunti' where codtessera='$cliente'";
	$query_respunti = pg_query($con, $querypunti);
      if(!$query_respunti)  {
	  echo "Errore: ".pg_last_error($con);
	   exit;
        }
		else
		{
			echo "punti aggiornati";
		} 
		
		$queryaggqtamag="update prodotti set qtamag=qtamag-'$quantità' where codiceinternosuper='$codprod'";
	$query_resaggqtamag = pg_query($con, $queryaggqtamag);
      if(!$query_resaggqtamag)  {
	  echo "Errore: ".pg_last_error($con);
	   exit;
        }
		else
		{
			echo " Qta aggiornata";
		} 
	 	
   }
   
   
   
   
   	 //inserisci premio
	if(isset($_POST['codprem'])){
	 $codprem=$_POST['codprem'];
	 $nomeprem=$_POST['nomeprem'];
	 
	 if($_POST['cleintprem']=='null'){
		 $cleintprem=null;
	 }
	 else{
		 $cleintprem=$_POST['cleintprem'];
	 }
	 
	 $puntiprem=$_POST['puntiprem'];
	
	 if($cleintprem){
		 $queryprem = "INSERT INTO premi VALUES('$codprem','$nomeprem','$puntiprem','$cleintprem')";
	 }
	 else{
		 $queryprem = "INSERT INTO premi(codpremio,nome,punti) VALUES('$codprem','$nomeprem','$puntiprem')";
	 }
	 
     $query_resprem = pg_query($con, $queryprem);
      if(!$query_resprem)  {
	  echo "Errore: ".pg_last_error($con);
	   exit;
        }
		else
		{
			echo "Premio inserito correttamente!";
		}         		
   }
   
   //simula ritiro premio
   if(isset($_POST['clienteritprem'])){
	
	    $cliente=$_POST['clienteritprem'];
	    $premritprem=$_POST['premritprem'];
	 
	    $arraypremio;
	    $arrayelencopremi=$_SESSION["arrayprem"];
	    foreach( $arrayelencopremi as $value){
		    if($value['codpremio']==$premritprem ){
			    $arraypremio=$value;
		    }
	    }
	    $puntisottratti=$arraypremio['punti'];
	    $arraycliente;
	    $arrayclienti=$_SESSION["arrayclt"];
		//print_r($arrayclienti);
		
	    foreach( $arrayclienti as $value){
		    
			if($value['codtessera']==$cliente){
			    $arraycliente=$value;
		    }
	    }
	    $punticlient=$arraycliente['punti'];
	    //echo $punticlient." > ".$puntisottratti;
		if($punticlient>=$puntisottratti){
		    $queryritprem = "UPDATE premi set cliente='$cliente' where codpremio='$premritprem'"; 
            $query_resritprem = pg_query($con, $queryritprem);
            if(!$query_resritprem)  {
	            echo "Errore: ".pg_last_error($con);
	            exit;
            }
		    else
		    {
			    echo "Premio ritirato!";
		    } 	
            print("</br>");	
	        $querypuntisottartti="update clienti set punti=punti-'$puntisottratti' where codtessera='$cliente'";
	        $query_respuntisottratti = pg_query($con, $querypuntisottartti);
            if(!$query_respuntisottratti)  {
	            echo "Errore: ".pg_last_error($con);
	            exit;
            }
		    else
		    {
			    echo "punti aggiornati";
		    } 
	    }
	    else{
		    echo "Hai pochi punti per questo premio!";
	    }	
   }
	
	session_unset();
?>