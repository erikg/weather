
SPOOL=weatherupdate rainfall byzip createit fetch hum tmp weathergather
PHP=wind.php table.php pressure.php rainfall.php hum.php tmp.php windir.php index.php visibility.php

PHPDIR=/var/www/weather
SPOOLDIR=/var/spool/rrd/bin

install-php:
	mkdir -p ${PHPDIR}
	for a in ${PHP} ; do install $$a ${PHPDIR} ; done

install-spool:
	mkdir -p ${SPOOLDIR}
	for a in ${SPOOL} ; do install $$a ${SPOOLDIR} ; done

install:
	make install-php
	make install-spool
