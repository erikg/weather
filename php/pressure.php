<?
header("Content-Type: image/png");
if($start){ $Start="--start=$start"; }
if($end){ $End="--end=$end"; }
fpassthru($fh = popen("/usr/bin/rrdtool graph -ia PNG $Start $End - DEF:pressure=/var/spool/rrd/weather/$zone.rrd:pressure:AVERAGE LINE2:pressure#000000" ,"r"));
pclose($fh);
?>
