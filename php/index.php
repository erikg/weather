<HTML>
<HEAD>
<TITLE>SMLUC Weather Stuff</TITLE>
</HEAD>
<BODY BGCOLOR=#333333 TEXT=#FFFFFF LINK=#9999FF VLINK=#FF99FF ALINK=#FF9999>
<?
	if($zone)
	{
		if($start){$Start="&start=$start";}
		if($end){$End="&end=$end";}
		if(!$tempscale){$tempscale="K";}
		if($tempscale){
			$ts="&scale=$tempscale";
			if($tempscale=="F"){$tempscalename="Fahrenheit";}
			else if($tempscale=="R"){$tempscalename="Rankines";}
			else if($tempscale=="C"){$tempscalename="Celcius";}
			else {$tempscale="K"; $tempscalename="Kelvin";}
			}
		print "Temperature (in $tempscalename).. also available in ";
		if($tempscale!="F"){printf("[<A HREF=\"?zone=$zone$Start$End&tempscale=F\">Fahrenheit</A>] ");}
		if($tempscale!="C"){printf("[<A HREF=\"?zone=$zone$Start$End&tempscale=C\">Celcius</A>] ");}
		if($tempscale!="K"){printf("[<A HREF=\"?zone=$zone$Start$End&tempscale=K\">Kelvin</A>] ");}
		if($tempscale!="R"){printf("[<A HREF=\"?zone=$zone$Start$End&tempscale=R\">Rankines</A>] ");}
		print "<BR><IMG WIDTH=497 HEIGHT=161 ALT=\"Temp\" SRC=\"tmp.php?zone=$zone$Start$End$ts\"><BR>";
		print "Humidity (%)<BR><IMG WIDTH=497 HEIGHT=161 ALT=\"Humidity\" SRC=\"hum.php?zone=$zone$Start$End\"><BR>";
		print "Rainfall (in meters)<BR><IMG WIDTH=497 HEIGHT=161 ALT=\"Rainfall\" SRC=\"rainfall.php?zone=$zone$Start$End\"><BR>";
		print "Pressure (in pa)<BR><IMG WIDTH=497 HEIGHT=161 ALT=\"Pressure\" SRC=\"pressure.php?zone=$zone$Start$End\"><BR>";
		print "Visibility (in meters)<BR><IMG WIDTH=497 HEIGHT=161 ALT=\"Visibility\" SRC=\"visibility.php?zone=$zone$Start$End\"><BR>";
		print "Wind (in meters per second)<BR><IMG WIDTH=497 HEIGHT=161 ALT=\"Wind\" SRC=\"wind.php?zone=$zone$Start$End\"><BR>";
		print "Wind Direction (in degrees)<BR><IMG WIDTH=497 HEIGHT=161 ALT=\"Wind Dir\" SRC=\"windir.php?zone=$zone$Start$End\"><BR>";
	}
	else
	{
		$fh = fopen("/var/spool/rrd/weather/db","r");
		while(!feof($fh))
		{
			$line = fgets($fh,4096);
			$ar = explode("|",$line);
			print "<A HREF=\"?zone=$ar[0]\">$ar[0]</A><BR>\n";
		}
		fclose($fh);
	}
?>
</BODY></HTML>
