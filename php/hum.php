<?
header("Content-Type: image/png");
if($start){ $Start="--start=$start"; }
if($end){ $End="--end=$end"; }
fpassthru($fh = popen("/usr/bin/rrdtool graph -ia PNG --lower=0 --upper=100 --rigid $Start $End - DEF:hum=/var/spool/rrd/weather/$zone.rrd:humidity:AVERAGE LINE2:hum#00CC00:Humidity" ,"r"));
pclose($fh);
?>
