<?
header("Content-Type: image/png");

$CF="AVERAGE";
$file="/var/spool/rrd/phoenix.smluc.org/perf.rrd";

if($start){ $Start="--start=$start"; }
if($end){ $End="--end=$end"; }
$fh = popen(
"/usr/bin/rrdtool graph -ia PNG $Start $End - \
DEF:nice=$file:nice:$CF \
CDEF:n=nice,LAST,- \
DEF:user=$file:user:$CF \
CDEF:u=user,LAST,- \
DEF:system=$file:system:$CF \
CDEF:s=system,LAST,- \
AREA:n#00cc00 \
STACK:u#0000CC \
STACK:s#CC0000\
" ,"r");
fpassthru($fh);
pclose($fh);
?>
