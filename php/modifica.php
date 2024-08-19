<?php

require_once("comuni/funzioni.php");
session_start();
$con = connect_DB();

if(isset($_POST['cfmodimp']))
{
//modifica impiegato

    $codfisc=$_POST['cfmodimp'];
	$querymodimp = "SELECT * FROM impiegati WHERE codfiscale='$codfisc'";
    $query_resmodimp = pg_query($con, $querymodimp);
    if(!$query_resmodimp)  {
	echo "Errore: ".pg_last_error($con);
	exit;
    }
   $rowmodimp = pg_fetch_assoc($query_resmodimp); 
	$nome= $rowmodimp['nome'];
	$cognome= $rowmodimp['cognome'];
	$codfisc=$rowmodimp['codfiscale'];
	$mansione=$rowmodimp['mansione'];
	$email=$rowmodimp['email'];
	$livello=$rowmodimp['livello'];
	$indirizzo=$rowmodimp['indirizzo'];
	$telefono=$rowmodimp['tel'];
	
	$arrayrep=$_SESSION["arrayrep"];
	$arraysuper=$_SESSION["arraysuper"];

	print("</br>");
	print("<table cellspacing=\"5\", cellpadding=\"0\">");
	print("<form action=\"./modifica.php\" method=\"POST\">");
	print("<tr/><td/>Modifica Impiegato<td/></tr>");
	print("<tr/><td/>Nel Super di :<td/><select name=\"supermodimp3\" required >");
	$elencosuper="";
	$countsuper=0;
	foreach($arraysuper as $valuesuper){
		$elencosuper=$elencosuper."<option value=".$countsuper.">".$valuesuper[indirizzo]."</option>";
		$countsuper=$countsuper+1;	
	}
	print($elencosuper);
	print("</select>");
	print("<tr/><td/>Nel Reparto di :<td/><select name=\"repartomodimp3\" required >");
	$elencoreparti="";
	$countreparti=0;
	foreach($arrayrep as $valuerep){
		$elencoreparti=$elencoreparti."<option value=".$countreparti.">".$valuerep[nome]."</option>";
		$countreparti=$countreparti+1;	
	}
	print($elencoreparti);
	print("</select>");
	echo "<tr><td/>Nome:<td/><input type=\"text\" name=\"nomemodimp3\" required value=\"$nome\">";
	echo "<tr><td/>Cognome:<td/><input type=\"text\" name=\"cognomemodimp3\" required value=\"$cognome\">";
	print("<tr><td/>Codice Fiscale:<td/><input type=\"text\" name=\"cfmodimp3\" required value=\"$codfisc\">");
	print("<tr><td/>Mansione:<td/><input type=\"text\" name=\"mansionemodimp3\" required value=\"$mansione\">");
	print("<tr><td/>Data nascita :<td/><input type=\"date\" name=\"datanascitamodimp3\" required  >");
	print("<tr><td/>Data assunzione :<td/><input type=\"date\" name=\"dataassunzionemodimp3\" required v>");
	print("<tr><td/>Email :<td/><input type=\"email\" name=\"emailmodimp3\" required value=\"$email\">");
	print("<tr><td/>Livello :<td/><input type=\"number\" min=\"1\" max=\"20\" name=\"livellomodimp3\" required value=\"$livello\">");
	print("<tr><td/>Indirizzo:<td/><input type=\"text\" name=\"indirizzomodimp3\" required value=\"$indirizzo\">");
	print("<tr><td/>Telefono:<td/><input type=\"text\" name=\"telmodimp3\" required value=\"$telefono\">");
	print("<tr/><td/><input type=\"submit\" value=\"Invio\"><td/><input type=\"reset\" name=\"Cancella\">");
	print("</form>");
	print("</table>");
	$_SESSION['cfmodimp']=$_POST['cfmodimp'];
	unset($_POST['cfmodimp']);
}
     if(isset($_POST['nomemodimp3']) and isset($_POST['cognomemodimp3'])and isset($_POST['cfmodimp3'])and isset($_POST['mansionemodimp3'])
		and isset($_POST['datanascitamodimp3'])and isset($_POST['dataassunzionemodimp3'])and isset($_POST['emailmodimp3'])
	and isset($_POST['livellomodimp3'])and isset($_POST['indirizzomodimp3'])and isset($_POST['telmodimp3'])
	and isset($_POST['supermodimp3'])and isset($_POST['repartomodimp3'])){
	
	$superimp3=$_SESSION["arraysuper"][$_POST['supermodimp3']]['indirizzo'];
	 $repartoimp3=$_SESSION["arrayrep"][$_POST['repartomodimp3']]['nome'];
	 $cfimp3=$_POST['cfmodimp3'];
	 $mansioneimp3=$_POST['mansionemodimp3'];
	 $datanascitaimp3=$_POST['datanascitamodimp3'];
	 $dataassunzioneimp3=$_POST['dataassunzionemodimp3'];
	 $emailimp3=$_POST['emailmodimp3'];
	 $livelloimp3=$_POST['livellomodimp3'];
	 $indirizzoimp3=$_POST['indirizzomodimp3'];
	 $telimp3=$_POST['telmodimp3'];
	 $nomeimp3=$_POST['nomemodimp3'];
	 $cognomeimp3=$_POST['cognomemodimp3'];
	 $oldcf=$_SESSION['cfmodimp'];
	 unset($_SESSION['cfmodimp']);
	  $query="UPDATE impiegati SET codfiscale='$cfimp3', reparto='$repartoimp3', supermercato='$superimp3', mansione='$mansioneimp3', datanascita='$datanascitaimp3', email='$emailimp3',dataassunzione='$dataassunzioneimp3', livello='$livelloimp3',indirizzo='$indirizzoimp3',nome='$nomeimp3',cognome='$cognomeimp3',tel='$telimp3' WHERE codfiscale='$oldcf'";
    $result=pg_query($con, $query);
	//codfiscale='$cfimp3', reparto='$repartoimp3', supermercato='$superimp3'
    if($result==TRUE){
      echo "MODIFICA AVVENUTA CON SUCCESSO";
    }
    else
      echo "MODIFICA FALLITA";
  session_unset();
  }
  
  //mod capo reparto
  
  if(isset($_POST['cfmodcp'])){
	 
	   $cf=$_POST['cfmodcp'];
	   $supermodcp=  $_SESSION["arraysuper"][$_POST['supermodcp']]['indirizzo'];
	   $repartomodcp=  $_SESSION["arrayrep"][$_POST['repartomodcp']]['nome'];
	   $query="UPDATE responsabili SET  reparto='$repartomodcp', supermercato='$supermodcp' WHERE codfiscale='$cf'";
	   $result=pg_query($con, $query);
	
        if($result==TRUE){
        echo "MODIFICA AVVENUTO CON SUCCESSO";
        }
        else{
        echo "MODIFICA FALLITA";
		}
	    unset($_POST['cfmodcp']); 
		session_unset();
    }  
	
	//modsuper
	if(isset($_POST['modsuper'])){
    $viasel=$_SESSION["arraysuper"][$_POST['modsuper']]['indirizzo'];
	$oaosel=$_SESSION["arraysuper"][$_POST['modsuper']]['oaord'];
	$oassel=$_SESSION["arraysuper"][$_POST['modsuper']]['oastraord'];
	print("<table cellspacing=\"5\", cellpadding=\"0\">");
	print("<form action=\"./modifica.php\" method=\"POST\">");
	print("<tr/><td/>MODIFICA SUPERMERCATO<td/></tr>");
	print("<tr/><td/>Seleionato: $viasel<td/></tr>");
	print("<tr/><td/>Via:<td/><input type=\"text\" name=\"modviasup\" required  value=\"$viasel\">");
	print("<tr/><td/>Orario Apertura Ordinaria:<td/><input type=\"text\" name=\"modoao\" required  value=\"$oaosel\">");
	print("<tr/><td/>Orario Apertura Straordinaria:<td/><input type=\"text\" name=\"modoas\" required value=\"$oassel\">");
	print("<tr/><td/><input type=\"submit\" value=\"Invio\"><td/><input type=\"reset\" name=\"Cancella\">");
	print("</form>");
	print("</table>");
	$_SESSION['modsuper']=$_POST['modsuper'];
	unset($_POST['modsuper']); 
	}
	
	if(isset($_POST['modviasup']) and isset($_POST['modoao']) and isset($_POST['modoas'])){
		$modviasup=$_POST['modviasup'];
		$modaoa=$_POST['modoao'];
		$modas=$_POST['modoas'];
		$oldviasuper=$_SESSION["arraysuper"][$_SESSION['modsuper']]['indirizzo'];
		$query="UPDATE supermercati SET  indirizzo='$modviasup', oaord='$modaoa',oastraord='$modas' WHERE indirizzo='$oldviasuper'";
	  $result=pg_query($con, $query);
	
        if($result==TRUE){
        echo "MODIFICA AVVENUTO CON SUCCESSO";
        }
        else{
        echo "MODIFICA FALLITA";
		}
		session_unset();
	}
	//mod reparto
	if(isset($_POST['supermodrep'])and isset($_POST['repartomodrep'])){
        $supermodrep=$_SESSION["arraysuper"][$_POST['supermodrep']]['indirizzo'];
	    $repmodrep=$_SESSION["arrayrep"][$_POST['repartomodrep']]['nome'];
	 
	    $querymodrep= "select * from reparti where nome='$repmodrep' and supermercato='$supermodrep'";
	    $query_resmodrep = pg_query($con, $querymodrep);
        if(!$query_resmodrep)  {
	        echo "Errore: ".pg_last_error($con);
	        exit;
        }
	    $rowmodrep = pg_fetch_assoc($query_resmodrep);
		
		if($rowmodrep){
		$arrayrep=$_SESSION["arrayrep"];
	    $arraysuper=$_SESSION["arraysuper"];
	    print("</br>");
	    print("<table cellspacing=\"5\", cellpadding=\"0\">");
	    print("<form action=\"./modifica.php\" method=\"POST\">");
	    print("<tr/><td/>Modifica reparto<td/></tr>");
	    echo "Modifico reparto ".$repmodrep." del super di ".$supermodrep;
	    print("<tr/><td/>Nome Reparto:<td/><input type=\"text\" name=\"rmrep\" required >");
	    print("<tr/><td/>Nel Super di :<td/><select name=\"smrep\" required >");
	    $elencosuper="";
	    $countsuper=0;
	    foreach($arraysuper as $value1){
		    $elencosuper=$elencosuper."<option value=".$countsuper.">".$value1[indirizzo]."</option>";
		    $countsuper=$countsuper+1;	
	        }
	    print($elencosuper);
	    print("</select>");
	    print("<tr/><td/><input type=\"submit\" value=\"Invio\"><td/><input type=\"reset\" name=\"Cancella\">");
	    print("</form>");
	    print("</table>");
	   $_SESSION['oldsupermodrep']=$supermodrep;
	   $_SESSION['oldrepmodrep']=$repmodrep;
	    unset($_POST['supermodrep']);
	    unset($_POST['repartomodrep']); 
	    }
		else
		{
			echo "Il reparto nel supermercato selezionato non esiste";
		}
	
	}
	if(isset($_POST['smrep'])and isset($_POST['rmrep'])){
		
		$oldnomesuper=$_SESSION['oldsupermodrep'];
		$oldnomerep=$_SESSION['oldrepmodrep'];
		$nomesuper=$_SESSION['arraysuper'][$_POST['smrep']]['indirizzo'];
		$nomerepmodrep=$_POST['rmrep'];
		echo $nomesuper." ".$nomerepmodrep." ".$oldnomerep." ".$oldnomesuper;
		$querymodrep2="UPDATE reparti SET  nome='$nomerepmodrep', supermercato='$nomesuper' WHERE nome='$oldnomerep' and supermercato='$oldnomesuper'";
		 $result2=pg_query($con, $querymodrep2);
	
        if($result2==TRUE){
        echo "MODIFICA AVVENUTO CON SUCCESSO";
        }
        else{
        echo "MODIFICA FALLITA";
		}
		session_unset();
	}
	
	//prodotto
     if(isset($_POST['codmodprod'])){
	
	$prodottoarray;
	$arrayprd444=$_SESSION["arrayprd"];
	foreach( $arrayprd444 as $value){
		if($value['codiceinternosuper']==$_POST['codmodprod'] ){
			$prodottoarray=$value;
		}
	}
	 $codintsup=$prodottoarray['codiceinternosuper'];
	 $nomerp=$prodottoarray['nome'];
	 $categoriarp=$prodottoarray['categoria'];
	 $prezzoap=$prodottoarray['prezzoap'];
	 $qtamag=$prodottoarray['qtamag'];
	 $sogliariord=$prodottoarray['sogliariordino'];
	 $puntiottenibili=$prodottoarray['puntiottenibili'];
	 $reprp=$prodottoarray['nomereparto'];
	 $superrp=$prodottoarray['nomesupermercato'];
	$_SESSION['codintesupprodmod']=$codintsup;
	$arrayrep=$_SESSION["arrayrep"];
	$arraysuper=$_SESSION["arraysuper"];
	print("</br>");
	print("<table cellspacing=\"5\", cellpadding=\"0\">");
	print("<form action=\"./modifica.php\" method=\"POST\">");
	print("<tr/><td/>Modifica prodotto<td/></tr>");
	print("<tr/><td/>Nel Super di :<td/><select name=\"supermodprod\" required >");
	$elencosuper="";
	$countsuper=0;
	foreach($arraysuper as $valuesuper){
		$elencosuper=$elencosuper."<option value=".$countsuper.">".$valuesuper[indirizzo]."</option>";
		$countsuper=$countsuper+1;	
	}
	print($elencosuper);
	print("</select>");
	print("<tr/><td/>Nel Reparto di :<td/><select name=\"repartomodprod\" required >");
	$elencoreparti="";
	$countreparti=0;
	foreach($arrayrep as $valuerep){
		$elencoreparti=$elencoreparti."<option value=".$countreparti.">".$valuerep[nome]."</option>";
		$countreparti=$countreparti+1;	
	}
	print($elencoreparti);
	print("</select>");
	print("<tr><td/>Nome Prodotto: <td/><input type=\"text\" name=\"nomerp2\" required value=\"$nomerp\">");
	print("<tr><td/>Cod interno: <td/><input type=\"text\" name=\"codrp2\" required value=\"$codintsup\">");
	print("<tr><td/>categoria: <td/><input type=\"text\" name=\"catrp2\" required value=\"$categoriarp\">");
	print("<tr><td/>Scadenza: <td/><input type=\"date\" name=\"scadrp2\" required >");
	print("<tr><td/>Prezzo al pubblico: <td/><input type=\"text\" name=\"prezpubrp2\" required value=\"$prezzoap\">");
	print("<tr><td/>qta in mag: <td/><input type=\"number\" min=\"0\" max=\"9999999\" name=\"qtarp2\" required value=\"$qtamag\">");
	print("<tr><td/>soglia riordino: <td/><input type=\"number\" min=\"0\" max=\"9999999\" name=\"srrp2\" required value=\"$sogliariord\">");
	print("<tr><td/>punti ottenibili: <td/><input type=\"number\" min=\"0\" max=\"99999\" name=\"porp2\" required value=\"$puntiottenibili\">");
	print("<tr/><td/><input type=\"submit\" value=\"Invio\"><td/><input type=\"reset\" name=\"Cancella\">");
	print("</form>");
	print("</table>");
	
	 }
	 
	if(isset($_POST['nomerp2'])){
		
		$codintesupprodmod=$_SESSION['codintesupprodmod'];

		$nomp=$_POST['nomerp2'];
		$codint=$_POST['codrp2'];
		$categoria=$_POST['catrp2'];
		$scad=$_POST['scadrp2'];
		$prezzopub=$_POST['prezpubrp2'];
		$qta=$_POST['qtarp2'];
		$sogliariord=$_POST['srrp2'];
		$punti=$_POST['porp2'];
		
		$supprod=$_SESSION["arraysuper"][$_POST['supermodprod']]['indirizzo'];
		$repprod=$_SESSION["arrayrep"][$_POST['repartomodprod']]['nome'];
		
		$querymodprod2="UPDATE prodotti SET nome='$nomp', codiceinternosuper='$codint', categoria='$categoria', prezzoap='$prezzopub', scadenza='$scad', qtamag='$qta', sogliariordino='$sogliariord', puntiottenibili='$punti',nomereparto='$repprod',nomesupermercato='$supprod' where  codiceinternosuper='$codintesupprodmod'";
		 $result22=pg_query($con, $querymodprod2);
	
        if($result22==TRUE){
        echo "MODIFICA AVVENUTO CON SUCCESSO";
        }
        else{
        echo "MODIFICA FALLITA";
		}
		session_unset();
	}
	
  

	
?>