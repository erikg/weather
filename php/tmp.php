<?
header("Content-Type: image/png");

if($start){ $Start="--start=$start"; }
if($end){ $End="--end=$end"; }

if($scale=="F") {
	$CDEF="CDEF:t=tmp,1.8,*,459.67,- CDEF:d=dp,1.8,*,459.67,- CDEF:h=hi,1.8,*,459.67,-";
	$SCALE="Fahrenheit";
} else if($scale=="C"){
	$CDEF="CDEF:t=tmp,273.15,- CDEF:d=dp,273.15,- CDEF:h=hi,273.15,-";
	$SCALE="Celcius";
} else if($scale=="R"){
	$CDEF="CDEF:t=tmp,1.8,* CDEF:d=dp,1.8,* CDEF:h=hi,1.8,*";
	$SCALE="Rankines";
} else{
  $scale="K";
	$CDEF="CDEF:t=tmp CDEF:d=dp CDEF:h=hi";
	$SCALE="Kelvin";
}

$GAUR1="CDEF:tmp=ptmp,250,LT,UNKN,ptmp,IF";
$GAUR2="CDEF:dp=pdp,250,LT,UNKN,pdp,IF";
$GAUR3="CDEF:hi=phi,250,LT,UNKN,phi,IF";
$GAURD="$GAUR1 $GAUR2 $GAUR3";

$fh = popen("/usr/bin/rrdtool graph -ia PNG $Start $End - DEF:ptmp=/var/spool/rrd/weather/$zone.rrd:temp:AVERAGE DEF:phi=/var/spool/rrd/weather/$zone.rrd:heat_index:AVERAGE DEF:pdp=/var/spool/rrd/weather/$zone.rrd:dew_point:AVERAGE $GAURD $CDEF LINE3:t#000000:Temp\ \($SCALE\) LINE3:h#880000:Heat\ Index\ \($SCALE\) LINE3:d#000088:Dew\ Point\ \($SCALE\)" ,"r");

fpassthru($fh);
pclose($fh);
?>
