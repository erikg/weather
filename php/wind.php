<?
header("Content-Type: image/png");
if($start){ $Start="--start=$start"; }
if($end){ $End="--end=$end"; }
fpassthru($fh = popen("/usr/bin/rrdtool graph -ia PNG $Start $End - DEF:wind_speed=/var/spool/rrd/weather/$zone.rrd:wind_speed:AVERAGE DEF:wind_gust=/var/spool/rrd/weather/$zone.rrd:wind_gust:AVERAGE LINE2:wind_speed#000000 LINE2:wind_gust#CC0000" ,"r"));
pclose($fh);
?>
