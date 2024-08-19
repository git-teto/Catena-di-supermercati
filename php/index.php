<?php
require_once("comuni/funzioni.php");
session_start();
$con = connect_DB();

//super
    print("<table cellspacing=\"5\", cellpadding=\"0\">");
	print("<form action=\"./inserisci.php\" method=\"POST\">");
	print("<tr/><td/>REGISTRA SUPERMERCATO<td/></tr>");
	print("<tr/><td/>Via:<td/><input type=\"text\" name=\"viasup1\" required placeholder=\"max 20 lettere\">");
	print("<tr/><td/>Orario Apertura Ordinaria:<td/><input type=\"text\" name=\"oao\" required placeholder=\"hh:mm:ss\">");
	print("<tr/><td/>Orario Apertura Straordinaria:<td/><input type=\"text\" name=\"oas\" required placeholder=\"hh:mm:ss\">");
	print("<tr/><td/><input type=\"submit\" value=\"Invio\"><td/><input type=\"reset\" name=\"Cancella\">");
	print("</form>");
	print("</table>");
//reparto	
	$query1 = "SELECT * FROM supermercati";
    $query_res1 = pg_query($con, $query1);
    if(!$query_res1)  {
	echo "Errore: ".pg_last_error($con);
	exit;
    }
    while ($row1 = pg_fetch_assoc($query_res1)) { 
	$array1[]=$row1; 
	$_SESSION["arraysuper"]=$array1;
}
	print("</br>");
	print("<table cellspacing=\"5\", cellpadding=\"0\">");
	print("<form action=\"./inserisci.php\" method=\"POST\">");
	print("<tr/><td/>REGISTRA Reparto<td/></tr>");
	print("<td/>Nome:<td/><input type=\"text\" name=\"nomerep2\" required placeholder=\"max 20 lettere\">");
	print("<tr/><td/>Nel Super di :<td/><select name=\"superrep2\" required >");
	$elencosuper="";
	$countsuper=0;
	foreach($array1 as $value1){
		$elencosuper=$elencosuper."<option value=".$countsuper.">".$value1[indirizzo]."</option>";
		$countsuper=$countsuper+1;	
	}
	print($elencosuper);
	print("</select>");
	print("<tr/><td/><input type=\"submit\" value=\"Invio\"><td/><input type=\"reset\" name=\"Cancella\">");
	print("</form>");
	print("</table>");
	
	//impiegato	
	$queryrep = "SELECT distinct nome FROM reparti";
    $query_resrep = pg_query($con, $queryrep);
    if(!$query_resrep)  {
	echo "Errore: ".pg_last_error($con);
	exit;
    }
    while ($rowrep = pg_fetch_assoc($query_resrep)) { 
	$arrayrep[]=$rowrep; 
	$_SESSION["arrayrep"]=$arrayrep;
}
	print("</br>");
	print("<table cellspacing=\"5\", cellpadding=\"0\">");
	print("<form action=\"./inserisci.php\" method=\"POST\">");
	print("<tr/><td/>REGISTRA Impiegato<td/></tr>");
	print("<tr/><td/>Nel Super di :<td/><select name=\"superimp3\" required >");
	print($elencosuper);
	print("</select>");
	print("<tr/><td/>Nel Reparto di :<td/><select name=\"repartoimp3\" required >");
	$elencoreparti="";
	$countreparti=0;
	foreach($arrayrep as $valuerep){
		
		$elencoreparti=$elencoreparti."<option value=".$countreparti.">".$valuerep[nome]."</option>";
		$countreparti=$countreparti+1;	
	}
	print($elencoreparti);
	print("</select>");
	print("<tr><td/>Nome:<td/><input type=\"text\" name=\"nomeimp3\" required placeholder=\"max 20 lettere\">");
	print("<tr><td/>Cognome:<td/><input type=\"text\" name=\"cognomeimp3\" required placeholder=\"max 20 lettere\">");
	print("<tr><td/>Codice Fiscale:<td/><input type=\"text\" name=\"cfimp3\" required placeholder=\"max 16 lettere\">");
	print("<tr><td/>Mansione:<td/><input type=\"text\" name=\"mansioneimp3\" required placeholder=\"max 20 lettere\">");
	print("<tr><td/>Data nascita :<td/><input type=\"date\" name=\"datanascitaimp3\" required >");
	print("<tr><td/>Data assunzione :<td/><input type=\"date\" name=\"dataassunzioneimp3\" required >");
	print("<tr><td/>Email :<td/><input type=\"email\" name=\"emailimp3\" required placeholder=\"max 20 lettere\">");
	print("<tr><td/>Livello :<td/><input type=\"number\" min=\"1\" max=\"20\" name=\"livelloimp3\" required >");
	print("<tr><td/>Indirizzo:<td/><input type=\"text\" name=\"indirizzoimp3\" required placeholder=\"max 20 lettere\">");
	print("<tr><td/>Telefono:<td/><input type=\"text\" name=\"telimp3\" required placeholder=\"max 20 lettere\">");
	print("<tr/><td/><input type=\"submit\" value=\"Invio\"><td/><input type=\"reset\" name=\"Cancella\">");
	print("</form>");
	print("</table>");
	
	//capo reparto	
	$querydipliberi = "select  impiegati.codFiscale from impiegati except select responsabili.codfiscale from responsabili";
    
	$query_resdipliberi = pg_query($con, $querydipliberi);
	if(!$query_resdipliberi)  {
	echo "Errore: ".pg_last_error($con);
	exit;
    }
    while ($rowdl = pg_fetch_assoc($query_resdipliberi)) { 
	$arraydl[]=$rowdl; 
	$_SESSION["arraydl"]=$arraydl;
}
	print("</br>");
	print("<table cellspacing=\"5\", cellpadding=\"0\">");
	print("<form action=\"./inserisci.php\" method=\"POST\">");
	print("<tr/><td/>REGISTRA Capo Reparto<td/></tr>");
	print("<tr/><td/>CodFiscale del  dipendente:<td/><select name=\"cfcp4\" required >");
	$elencodipliberi="";
	$countdipliberi=0;
	foreach($arraydl as $valuedl){
		$elencodipliberi=$elencodipliberi."<option value=".$valuedl[codfiscale].">".$valuedl[codfiscale]."</option>";
		$countreparti=$countreparti+1;	
	}
	print($elencodipliberi);
	print("</select>");
	print("<tr/><td/>Nel Super di :<td/><select name=\"supercp4\" required >");
	print($elencosuper);
	print("</select>");
	print("<tr/><td/>Nel Reparto di :<td/><select name=\"repartocp4\" required >");
	print($elencoreparti);
	print("</select>");
	print("<tr/><td/><input type=\"submit\" value=\"Invio\"><td/><input type=\"reset\" name=\"Cancella\">");
	print("</form>");
	print("</table>");

//turni settimanali
    $querymodimp1 = "SELECT codfiscale FROM impiegati";
    $query_resmodimp1 = pg_query($con, $querymodimp1);
    if(!$query_resmodimp1)  {
	echo "Errore: ".pg_last_error($con);
	exit;
    }
    while ($rowmodimp1 = pg_fetch_assoc($query_resmodimp1)) { 
	$arraymodimp1[]=$rowmodimp1; 
	$_SESSION["arrayimp1"]=$arraymodimp1;
     }
    print("</br>");
	print("<table cellspacing=\"5\", cellpadding=\"0\">");
	print("<form action=\"./inserisci.php\" method=\"POST\">");
	print("<tr/><td/>Inserisci orario<td/></tr>");
	print("<tr/><td/>Codice Fiscale:<td/><select name=\"cfturniset\" required >");
	$elencoimpturni="";
	foreach($arraymodimp1 as $valueturni){
		$elencoimpturni=$elencoimpturni."<option value=".$valueturni['codfiscale'].">".$valueturni['codfiscale']."</option>";	
	}
	print($elencoimpturni);
	print("</select>");
	print("<tr><td/>Giorno inizio turno:<td/><input type=\"date\" name=\"git\" required >");
	print("<tr/><td/>Orario inizio turno:<td/><input type=\"text\" name=\"oit\" required placeholder=\"hh:mm:ss\">");
	print("<tr><td/>Giorno fineturno:<td/><input type=\"date\" name=\"gft\" required >");
	print("<tr/><td/>Orario fine turno:<td/><input type=\"text\" name=\"oft\" required placeholder=\"hh:mm:ss\">");
	print("<tr/><td/><input type=\"submit\" value=\"Invio\"><td/><input type=\"reset\" name=\"Cancella\">");
	print("</form>");
	print("</table>");

//prodotto

	print("</br>");
	print("<table cellspacing=\"5\", cellpadding=\"0\">");
	print("<form action=\"./inserisci.php\" method=\"POST\">");
	print("<tr/><td/>REGISTRA Prodotto<td/></tr>");
	print("<tr/><td/>Nel Super di :<td/><select name=\"suprp\" required >");
	print($elencosuper);
	print("</select>");
	print("<tr/><td/>Nel Reparto di :<td/><select name=\"reprp\" required >");
	print($elencoreparti);
	print("</select>");
	print("<tr><td/>Nome Prodotto: <td/><input type=\"text\" name=\"nomerp\" required placeholder=\"max 20 lettere\">");
	print("<tr><td/>Cod interno: <td/><input type=\"text\" name=\"codrp\" required placeholder=\"max 20 lettere\">");
	print("<tr><td/>categoria: <td/><input type=\"text\" name=\"catrp\" required placeholder=\"max 20 lettere\">");
	print("<tr><td/>Scadenza: <td/><input type=\"date\" name=\"scadrp\" required >");
	print("<tr><td/>Prezzo al pubblico: <td/><input type=\"text\" name=\"prezpubrp\" required placeholder=\"ddddd.cc\">");
	print("<tr><td/>qta in mag: <td/><input type=\"number\" min=\"0\" max=\"9999999\" name=\"qtarp\" required >");
	print("<tr><td/>soglia riordino: <td/><input type=\"number\" min=\"0\" max=\"9999999\" name=\"srrp\" required >");
	print("<tr><td/>punti ottenibili: <td/><input type=\"number\" min=\"0\" max=\"99999\" name=\"porp\" required value='0'>");
	print("<tr><td/>Prezzo ingrosso:<td/><input type=\"text\" name=\"pringrp\"  placeholder=\"ddddd.cc\">");
	print("<tr><td/>cod Rifornitore:<td/><input type=\"text\" name=\"codrifrp\"  placeholder=\"max 20 lettere\">");
	print("<tr/><td/><input type=\"submit\" value=\"Invio\"><td/><input type=\"reset\" name=\"Cancella\">");
	print("</form>");
	print("</table>");

//assemblati
	$queryprd = "SELECT * FROM prodotti";
    $query_resprd = pg_query($con, $queryprd);
    if(!$query_resprd)  {
	echo "Errore: ".pg_last_error($con);
	exit;
    }
    while ($rowprd = pg_fetch_assoc($query_resprd)) { 
	$arrayprd[]=$rowprd; 	
    }
	$_SESSION["arrayprd"]=$arrayprd;
	
	$queryprd2 = "SELECT nome,codiceinternosuper FROM prodotti where codrif is null";
    $query_resprd2 = pg_query($con, $queryprd2);
    if(!$query_resprd2)  {
	echo "Errore: ".pg_last_error($con);
	exit;
    }
    while ($rowprd2 = pg_fetch_assoc($query_resprd2)) { 
	$arrayprd2[]=$rowprd2; 
	}
	$_SESSION["arrayprd2"]=$arrayprd2;
	
	print("</br>");
	print("<table cellspacing=\"5\", cellpadding=\"0\">");
	print("<form action=\"./inserisci.php\" method=\"POST\">");
	print("<tr/><td/>Crea Prodotto Assemblato<td/></tr>");
	
	print("<tr/><td/>Nome :<td/><select name=\"nomeassemb\" required >");
	$elencoprd2="";
	
	foreach($arrayprd2 as $valueprd2){
		$codprd2=$valueprd2['codiceinternosuper'];
		$elencoprd2=$elencoprd2."<option value=".$codprd2.">".$valueprd2[nome]."</option>";
	}
	print($elencoprd2);
	print("</select>");
	print("<tr/><td/>Composto da :<td/><select name=\"compostassmb\" required >");
	$elencoprd="";
	foreach($arrayprd as $valueprd){
		$codprd=$valueprd['codiceinternosuper'];
		$elencoprd=$elencoprd."<option value=".$codprd.">".$valueprd[nome]."</option>";
	}
	print($elencoprd);
	print("</select>");
	
	print("<tr><td/>Quantità :<td/><input type=\"number\" min=\"1\" max=\"20\" name=\"qtaassmb\" required value=1 >");
	print("<tr/><td/><input type=\"submit\" value=\"Invio\"><td/><input type=\"reset\" name=\"Cancella\">");
	print("</form>");
	print("</table>");

//fornitore
	print("</br>");
	print("<table cellspacing=\"5\", cellpadding=\"0\">");
	print("<form action=\"./inserisci.php\" method=\"POST\">");
	print("<tr/><td/>REGISTRA Fornitore<td/></tr>");
	print("<tr><td/>Partita iva:<td/><input type=\"text\" name=\"pivaf\" required placeholder=\"max 20 lettere\">");
	print("<tr><td/>Ragione Sociale:<td/><input type=\"text\" name=\"ragsf\" required placeholder=\"max 20 lettere\">");
	print("<tr><td/>Maodalità pagamento:<td/><input type=\"text\" name=\"modpagf\" required placeholder=\"max 20 lettere\">");
	print("<tr><td/>Email :<td/><input type=\"email\" name=\"emailf\" required placeholder=\"max 20 lettere\">");
	print("<tr><td/>Indirizzo:<td/><input type=\"text\" name=\"indirizzof\" required placeholder=\"max 20 lettere\">");
	print("<tr><td/>Telefono:<td/><input type=\"text\" name=\"telf\" required placeholder=\"max 20 lettere\">");
	print("<tr/><td/><input type=\"submit\" value=\"Invio\"><td/><input type=\"reset\" name=\"Cancella\">");
	print("</form>");
	print("</table>");

//ordini
	
	$arrayprd3=$_SESSION["arrayprd2"];
	
	$queryfr = "SELECT partitaiva,ragsoc FROM fornitori";
    $query_resfr = pg_query($con, $queryfr);
    if(!$query_resfr)  {
	echo "Errore: ".pg_last_error($con);
	exit;
    }
    while ($rowfr = pg_fetch_assoc($query_resfr)) { 
	$arrayfr[]=$rowfr; 
	}
	$_SESSION["arrayfr"]=$arrayfr;
	
	$queryprdf = "SELECT nome,codiceinternosuper FROM prodotti where codrif is not null";
    $query_resprdf = pg_query($con, $queryprdf);
    if(!$query_resprdf)  {
	echo "Errore: ".pg_last_error($con);
	exit;
    }
    while ($rowprdf = pg_fetch_assoc($query_resprdf)) { 
	$arrayprdf[]=$rowprdf; 
	}
	$_SESSION["arrayprdf"]=$arrayprdf;
	
	print("</br>");
	print("<table cellspacing=\"5\", cellpadding=\"0\">");
	print("<form action=\"./inserisci.php\" method=\"POST\">");
	print("<tr/><td/>Ordina prodotto<td/></tr>");
	
	print("<tr/><td/>prodotto: <td/><select name=\"prodord\" required >");
	$elencoprdf="";
	foreach($arrayprdf as $valueprdf){
		$codprdf=$valueprdf['codiceinternosuper'];
		$elencoprdf=$elencoprdf."<option value=".$codprdf.">".$valueprdf['nome']."</option>";
	}
	print($elencoprdf);
	print("</select>");
	print("<tr/><td/>Fornitore: <td/><select name=\"forntord\" required >");
	$elencofrt="";
	foreach($arrayfr as $valuefr){
		$codfr=$valuefr['partitaiva'];
		$ragsoc=$valuefr['ragsoc'];
		$elencofrt=$elencofrt."<option value=".$codfr.">".$ragsoc."</option>";
	}
	print($elencofrt);
	print("</select>");
	print("<tr><td/>codice ordine: <td/><input type=\"number\" min=\"0\" max=\"9999999999\" name=\"codord\" required >");
	print("<tr><td/>Data acquisto :<td/><input type=\"date\"  name=\"dateacqord\" required >");
	print("<tr><td/>Quantità:<td/><input type=\"number\" min=\"0\" max=\"99999\" name=\"qtaord\" required value=0 >");
	
	print("<tr><td/>Data consegna :<td/><input type=\"date\"  name=\"dateconsord\" required >");
	print("<tr/><td/><input type=\"submit\" value=\"Invio\"><td/><input type=\"reset\" name=\"Cancella\">");
	print("</form>");
	print("</table>");




//inserisci cliente
	print("</br>");
	print("<table cellspacing=\"5\", cellpadding=\"0\">");
	print("<form action=\"./inserisci.php\" method=\"POST\">");
	print("<tr/><td/>REGISTRA Cliente<td/></tr>");
	print("<tr><td/>Nome:<td/><input type=\"text\" name=\"nomecl\" required placeholder=\"max 20 lettere\">");
	print("<tr><td/>Cognome:<td/><input type=\"text\" name=\"cognomecl\" required placeholder=\"max 20 lettere\">");
	print("<tr><td/>Codice Fiscale:<td/><input type=\"text\" name=\"cfcl\" required placeholder=\"max 16 lettere\">");
	print("<tr><td/>Codice Tessera:<td/><input type=\"number\" name=\"codtcl\" required placeholder=\"max 20 lettere\">");
	print("<tr><td/>Data nascita :<td/><input type=\"date\" name=\"datanascitacl\" required >");
	print("<tr><td/>Email :<td/><input type=\"email\" name=\"emailcl\" required placeholder=\"max 20 lettere\">");
	print("<tr><td/>Punti :<td/><input type=\"number\" min=\"0\" max=\"99999\" name=\"punticl\" required value=0 >");
	print("<tr><td/>Indirizzo:<td/><input type=\"text\" name=\"indirizzocl\" required placeholder=\"max 20 lettere\">");
	print("<tr><td/>Telefono:<td/><input type=\"text\" name=\"telcl\" required placeholder=\"max 20 lettere\">");
	print("<tr/><td/><input type=\"submit\" value=\"Invio\"><td/><input type=\"reset\" name=\"Cancella\">");
	print("</form>");
	print("</table>");

//acquisto
	
	$queryclt = "SELECT * FROM clienti ";
    $query_resclt = pg_query($con, $queryclt);
    if(!$query_resclt)  {
	echo "Errore: ".pg_last_error($con);
	exit;
    }
    while ($rowclt = pg_fetch_assoc($query_resclt)) { 
	$arrayclt[]=$rowclt; 
	}
	$_SESSION["arrayclt"]=$arrayclt;
	
	print("</br>");
	print("<table cellspacing=\"5\", cellpadding=\"0\">");
	print("<form action=\"./inserisci.php\" method=\"POST\">");
	print("<tr/><td/>Simula acquisto<td/></tr>");
	print("<tr/><td/>Prodotto: <td/><select name=\"prodacqu\" required >");
	print($elencoprd);
	print("</select>");

	print("<tr/><td/>Cliente: <td/><select name=\"clientacq\"  >");
	
	$elencoclt="";
	foreach($arrayclt as $valueclt){
		$codclt=$valueclt['codtessera'];
		$elencoclt=$elencoclt."<option value=".$codclt.">".$codclt."</option>";
	}
	print($elencoclt);
	print("<option value='null'>non registrato</option>");
	print("</select>");
	print("<tr><td/>codice scontrino: <td/><input type=\"number\" min=\"0\" max=\"9999999999\" name=\"codscontr\" required >");
	print("<tr><td/>Data acquisto :<td/><input type=\"date\"  name=\"dateacq\" required >");
	print("<tr><td/>Quantità:<td/><input type=\"number\" min=\"0\" max=\"99999\" name=\"qtaacq\" required value=0 >");
	print("<tr/><td/><input type=\"submit\" value=\"Invio\"><td/><input type=\"reset\" name=\"Cancella\">");
	print("</form>");
	print("</table>");
	
	//premio
	$arrayclt2=$_SESSION["arrayclt"];
	
	print("</br>");
	print("<table cellspacing=\"5\", cellpadding=\"0\">");
	print("<form action=\"./inserisci.php\" method=\"POST\">");
	print("<tr/><td/>INSERISCI PREMIO<td/></tr>");
    print("<tr><td/>Codice premio:<td/><input type=\"number\" name=\"codprem\" required placeholder=\"max 20 lettere\">");
	print("<tr><td/>Nome premio:<td/><input type=\"text\" name=\"nomeprem\" required placeholder=\"max 20 lettere\">");
	print("<tr/><td/>Cliente: <td/><select name=\"cleintprem\"  >");
	print("<option value='null'>non registrato</option>");
	print($elencoclt);
	print("</select>");
	print("<tr><td/>Punti per vincerlo: <td/><input type=\"number\" min=\"0\" max=\"9999999999\" name=\"puntiprem\" required >");
	print("<tr/><td/><input type=\"submit\" value=\"Invio\"><td/><input type=\"reset\" name=\"Cancella\">");
	print("</form>");
	print("</table>");


 //simula ritiro premio
	$queryprem	= "select * from premi where cliente is null";
    $query_resprem = pg_query($con, $queryprem);
    if(!$query_resprem)  {
	echo "Errore: ".pg_last_error($con);
	exit;
    }
    while ($rowprem = pg_fetch_assoc($query_resprem)) { 
	$arrayprem[]=$rowprem; 
	}
	$_SESSION["arrayprem"]=$arrayprem;
	print("</br>");
	print("<table cellspacing=\"5\", cellpadding=\"0\">");
	print("<form action=\"./inserisci.php\" method=\"POST\">");
	print("<tr/><td/>Simularitiro premio<td/></tr>");
	print("<tr/><td/>Cliente: <td/><select name=\"clienteritprem\"  >");
	print($elencoclt);
	print("</select>");
	print("<tr/><td/>Premio: <td/><select name=\"premritprem\"  >");
	$elencoprem="";
	foreach($arrayprem as $valueprem){
		$codprem=$valueprem['codpremio'];
		$elencoprem=$elencoprem."<option value=".$codprem.">".$valueprem['nome']."</option>";
	}
	print($elencoprem);
	print("</select>");
	print("<tr/><td/><input type=\"submit\" value=\"Invio\"><td/><input type=\"reset\" name=\"Cancella\">");
	print("</form>");
	print("</table>");

//modifica impiegati  	
	$querymodimp = "SELECT codfiscale FROM impiegati";
    $query_resmodimp = pg_query($con, $querymodimp);
    if(!$query_resmodimp)  {
	echo "Errore: ".pg_last_error($con);
	exit;
    }
    while ($rowmodimp = pg_fetch_assoc($query_resmodimp)) { 
	$arraymodimp[]=$rowmodimp; 
	$_SESSION["arrayimp"]=$arraymodimp;
}
	print("</br>");
	print("<table cellspacing=\"5\", cellpadding=\"0\">");
	print("<form action=\"./modifica.php\" method=\"POST\">");
	print("<tr/><td/>MODIFICA IMPIEGATO<td/></tr>");
	print("<tr/><td/>Codice Fiscale:<td/><select name=\"cfmodimp\" required >");
	$elencoimp="";
	foreach($arraymodimp as $valuemodimp){
		$elencoimp=$elencoimp."<option value=".$valuemodimp['codfiscale'].">".$valuemodimp['codfiscale']."</option>";	
	}
	print($elencoimp);
	print("</select>");
	print("<tr/><td/><input type=\"submit\" value=\"Invio\"><td/><input type=\"reset\" name=\"Cancella\">");
	print("</form>");
	print("</table>");
	
	//mod capo
	$querycapi = "select  codFiscale from responsabili ";
    
	$query_rescapi = pg_query($con, $querycapi);
	if(!$query_rescapi)  {
	echo "Errore: ".pg_last_error($con);
	exit;
    }
    while ($rowcapi = pg_fetch_assoc($query_rescapi)) { 
	$arraycapi[]=$rowcapi; 
	$_SESSION["arraycapi"]=$arraycapi;
}
	print("</br>");
	print("<table cellspacing=\"5\", cellpadding=\"0\">");
	print("<form action=\"./modifica.php\" method=\"POST\">");
	print("<tr/><td/>Modifica Capo Reparto<td/></tr>");
	print("<tr/><td/>CodFiscale del  dipendente:<td/><select name=\"cfmodcp\" required >");
	$elencocapi="";
	
	foreach($arraycapi as $valuecapi){
		$elencocapi=$elencocapi."<option value=".$valuecapi[codfiscale].">".$valuecapi[codfiscale]."</option>";	
	}
	print($elencocapi);
	print("</select>");
	print("</select>");
	print("<tr/><td/>Nel Super di :<td/><select name=\"supermodcp\" required >");
	print($elencosuper);
	print("</select>");
	print("<tr/><td/>Nel Reparto di :<td/><select name=\"repartomodcp\" required >");
	print($elencoreparti);
	print("</select>");
	print("<tr/><td/><input type=\"submit\" value=\"Invio\"><td/><input type=\"reset\" name=\"Cancella\">");
	print("</form>");
	print("</table>");
	
	//mod super
	
	print("</br>");
	print("<table cellspacing=\"5\", cellpadding=\"0\">");
	print("<form action=\"./modifica.php\" method=\"POST\">");
	print("<tr/><td/>MODIFICA SUPER<td/></tr>");
	print("<tr/><td/>Nel Super di :<td/><select name=\"modsuper\" required >");
	print($elencosuper);
	print("</select>");
	print("<tr/><td/><input type=\"submit\" value=\"Invio\"><td/><input type=\"reset\" name=\"Cancella\">");
	print("</form>");
	print("</table>");
	
	
	
	//mod reparto	
	print("</br>");
	print("<table cellspacing=\"5\", cellpadding=\"0\">");
	print("<form action=\"./modifica.php\" method=\"POST\">");
	print("<tr/><td/>MODIFICA REPARTO<td/></tr>");
	print("<tr/><td/>Nel Super di :<td/><select name=\"supermodrep\" required >");
	print($elencosuper);
	print("</select>");
	print("<tr/><td/>Nel Reparto di :<td/><select name=\"repartomodrep\" required >");
	print($elencoreparti);
	print("</select>");
	print("<tr/><td/><input type=\"submit\" value=\"Invio\"><td/><input type=\"reset\" name=\"Cancella\">");
	print("</form>");
	print("</table>");
	
	/* // mod ORARIO impiegato
         	print("</br>");
	print("<table cellspacing=\"5\", cellpadding=\"0\">");
	print("<form action=\"./modifica.php\" method=\"POST\">");
	print("<tr/><td/>MODIFICA ORARIO IMPIEGATO<td/></tr>");
	print("<tr/><td/>Codice Fiscale:<td/><select name=\"cfmodorimp\" required >");
	print($elencoimp);
	print("</select>");
	print("<tr/><td/><input type=\"submit\" value=\"Invio\"><td/><input type=\"reset\" name=\"Cancella\">");
	print("</form>");
	print("</table>");	*/
	
	// mod prodotto
         	print("</br>");
	print("<table cellspacing=\"5\", cellpadding=\"0\">");
	print("<form action=\"./modifica.php\" method=\"POST\">");
	print("<tr/><td/>MODIFICA Prodotto<td/></tr>");
	print("<tr/><td/>Codice Fiscale:<td/><select name=\"codmodprod\" required >");
	print($elencoprd);
	print("</select>");
	print("<tr/><td/><input type=\"submit\" value=\"Invio\"><td/><input type=\"reset\" name=\"Cancella\">");
	print("</form>");
	print("</table>");	
	
	/* // mod prod assmb
	print("</br>");
	print("<table cellspacing=\"5\", cellpadding=\"0\">");
	print("<form action=\"./modifica.php\" method=\"POST\">");
	print("<tr/><td/>MODIFICA Prodotto assemblato<td/></tr>");
	print("<tr/><td/>Composto:<td/><select name=\"modcomposto\" required >");
	print($elencoprd2);
	print("</select>");
	print("<tr/><td/>Componente:<td/><select name=\"modcomponente\" required >");
	print($elencoprd);
	print("</select>");
	print("<tr/><td/><input type=\"submit\" value=\"Invio\"><td/><input type=\"reset\" name=\"Cancella\">");
	print("</form>");
	print("</table>"); */
	
	/* // mod fornitore
         	print("</br>");
	print("<table cellspacing=\"5\", cellpadding=\"0\">");
	print("<form action=\"./modifica.php\" method=\"POST\">");
	print("<tr/><td/>MODIFICA Fornitore<td/></tr>");
	print("<tr/><td/>Composto:<td/><select name=\"modcomposto\" required >");
	print($elencofrt);
	print("</select>");
	print("<tr/><td/><input type=\"submit\" value=\"Invio\"><td/><input type=\"reset\" name=\"Cancella\">");
	print("</form>");
	print("</table>"); */
	
	/* // mod clienti
		print("</br>");
	print("<table cellspacing=\"5\", cellpadding=\"0\">");
	print("<form action=\"./modifica.php\" method=\"POST\">");
	print("<tr/><td/>MODIFICA Cliente<td/></tr>");
	print("<tr/><td/>Cod cliente:<td/><select name=\"modclient\" required >");
	print($elencoclt);
	print("</select>");
	print("<tr/><td/><input type=\"submit\" value=\"Invio\"><td/><input type=\"reset\" name=\"Cancella\">");
	print("</form>");
	print("</table>"); */
	
	 //mod premio
	$querypremi = "select * from premi ";
    
	$query_respremi = pg_query($con, $querypremi);
	if(!$query_respremi)  {
	echo "Errore: ".pg_last_error($con);
	exit;
    }
    while ($rowpremi = pg_fetch_assoc($query_respremi)) { 
	$arraypremi[]=$rowpremi; 
	}
	$_SESSION["arraypremi"]=$arraypremi;
	/*print("</br>");
	print("<table cellspacing=\"5\", cellpadding=\"0\">");
	print("<form action=\"./modifica.php\" method=\"POST\">");
	print("<tr/><td/>MODIFICA Premio<td/></tr>");
	print("<tr/><td/>CodPremio:<td/><select name=\"codpremio\" required >");
	$elencopremi="";
	foreach($arraypremi as $valuepremi){
		$codprem=$valuepremi[codpremio];
		$elencopremi=$elencopremi."<option value=".$codprem.">".$valuepremi[nome]."</option>";	
	}
	print($elencopremi);
	print("</select>");
	print("<tr/><td/><input type=\"submit\" value=\"Invio\"><td/><input type=\"reset\" name=\"Cancella\">");
	print("</form>");
	print("</table>"); */
	
	
/*print_r($_SESSION["arrayprd"]);	
print("</br>");	
$prodottoarray;
	$arrayprd444=$_SESSION["arrayprd"];
	foreach( $arrayprd444 as $value){
		if($value['codiceinternosuper']=='4' ){
			$prodottoarray=$value;
		}
	}
*/

 print("</br>");
	print("<table cellspacing=\"5\", cellpadding=\"0\">");
	print("<form action=\"./visualizza.php\" method=\"POST\">");
	print("<tr/><td/>Visualizza personale: <td/></tr>");
	print("<tr/><td/>DEL Super di :<td/><select name=\"vispersup\" required >");
	print($elencosuper);
	print("</select>");
	print("<tr/><td/>Nel Reparto di :<td/><select name=\"visperrep\" required >");
	print($elencoreparti);
	print("</select>");
	print("<tr/><td/><input type=\"submit\" value=\"Invio\"><td/><input type=\"reset\" name=\"Cancella\">");
	print("</form>");
	print("</table>");
	
	print("</br>");
	print("<table cellspacing=\"5\", cellpadding=\"0\">");
	print("<form action=\"./visualizza.php\" method=\"POST\">");
	print("<tr/><td/>Visualizza masioni: <td/></tr>");
	print("<tr/><td/>Nel Reparto di :<td/><select name=\"vismansrep\" required >");
	print($elencoreparti);
	print("</select>");
	print("<tr/><td/>DEL Super di :<td/><select name=\"vismansup\" required >");
	print($elencosuper);
	print("</select>");
	print("<tr/><td/><input type=\"submit\" value=\"Invio\"><td/><input type=\"reset\" name=\"Cancella\">");
	print("</form>");
	print("</table>");
	
	print("</br>");
	print("<table cellspacing=\"5\", cellpadding=\"0\">");
	print("<form action=\"./visualizza.php\" method=\"POST\">");
	print("<tr/><td/>Visualizza turni settimanali : <td/></tr>");
	print("<tr/><td/>Del Reparto di :<td/><select name=\"repturni\" required >");
	print($elencoreparti);
	print("</select>");
	print("<tr/><td/>DEL Super di :<td/><select name=\"superturni\" required >");
	print($elencosuper);
	print("</select>");
	print("<tr/><td/><input type=\"submit\" value=\"Invio\"><td/><input type=\"reset\" name=\"Cancella\">");
	print("</form>");
	print("</table>");
	
	
	//visualizzazione tabelle
	print("</br>");
	print("<table cellspacing=\"5\", cellpadding=\"0\">");
	print("<form action=\"./visualizza.php\" method=\"POST\">");
	print("<tr/><td/> Visualizza Tabella di :<td/><select name=\"visualizzatabelle\" required >");
	Print("<option value='supermercati'>SUPERMERCATI</option><option value='responsabili'>RESPONSABILI</option><option value='ppunti'>PRODOTTI CHE DANNO PUNTI</option>");
	print("</select>");
    	print("<tr/><td/><input type=\"submit\" value=\"Invio\"><td/><input type=\"reset\" name=\"Cancella\">");
   print("</form>");
	print("</table>");




/*
$query = "SELECT reparto,nome FROM impiegato";
$query_res = pg_query($con, $query);
if(!$query_res)  {
	echo "Errore: ".pg_last_error($con);
	exit;
}
while ($row = pg_fetch_assoc($query_res)) { //per ogni impiegato
	$array[]=$row; 
	$count=count($array);
}

echo <<<STAMPA
<h3>Impiegati nei reparti</h3>
<table>
STAMPA;
$reparto="mamma";
echo '<tr>';
    foreach($array as $row) { //per ogni impiegato
    if(strcmp($row["reparto"],$reparto)==0){
		echo '<td>'.$row["nome"].'<td>';
	}
	else{
		echo '</tr><tr><td>'.$row["reparto"].'</td><td>'.$row["nome"].'</td>';
		$reparto=$row["reparto"];
	}    
  }  
	echo '</table>'; 
	*/
	
	
	
?>
