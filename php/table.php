<HTML><BODY>
<TABLE CELLSPACING=4 CELLPADDING=4 BORDER=2>
<?
$fh = popen("/usr/bin/rrdtool fetch /var/spool/rrd/weather/$zone.rrd AVERAGE | sed 's/ [ ]*/ /g' | grep -v '^$' | sed 's/^ /Time /' | sed -e 's, ,</TD><TD>,g' -e 's,.*,<TR><TD>&</TD></TR>,'","r");
fpassthru($fh);
print "</TABLE>";
pclose($fh);
?>
</BODY></HTML>
