<?
header("Content-Type: image/png");
if($start){ $Start="--start=$start"; }
if($end){ $End="--end=$end"; }
fpassthru($fh = popen("/usr/bin/rrdtool graph -ia PNG $Start $End - DEF:visibility=/var/spool/rrd/weather/$zone.rrd:visibility:AVERAGE LINE2:visibility#000000" ,"r"));
pclose($fh);
?>
