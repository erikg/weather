<?
header("Content-Type: image/png");
if($start){ $Start="--start=$start"; }
if($end){ $End="--end=$end"; }
fpassthru($fh = popen("/usr/bin/rrdtool graph -ia PNG $Start $End --lower=0 --upper=360 --rigid - DEF:wind_dir=/var/spool/rrd/weather/$zone.rrd:wind_dir:AVERAGE LINE2:wind_dir#CC0000" ,"r"));
pclose($fh);
?>
