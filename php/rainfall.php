<?
header("Content-Type: image/png");
if($start){ $Start="--start=$start"; }
if($end){ $End="--end=$end"; }
fpassthru($fh = popen("/usr/bin/rrdtool graph -ia PNG $Start $End - DEF:rainfall=/var/spool/rrd/weather/$zone.rrd:rainfall:AVERAGE LINE2:rainfall#0000CC" ,"r"));
pclose($fh);
?>
