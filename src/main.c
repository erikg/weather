
/*
 * $Id: main.c,v 1.6 2005/01/11 15:18:54 erik Exp $
 */

#include <stdio.h>
#include <stdlib.h>
#include <string.h>

#include <unistd.h>
#include <fcntl.h>

#include "expat.h"

#include "fetch.h"

void
dumpfile(char *name, char *val)
{
    int fd;
    char buf[1024];
    snprintf(buf, 1024, "%s.xml", name);
    fd = open(buf, O_WRONLY|O_CREAT, 0600);
    if(fd<1)
    {
	perror("");
	exit(-1);
    }
    write(fd,val,strlen(val));
    close(fd);
    return;
}

int
main (int argc, char **argv)
{
    char *poo;

    while (--argc)
    {
	int res;
	XML_Parser p = XML_ParserCreate (NULL);

	poo = fetch (argv[argc]);
	dumpfile(argv[argc], poo);
	res = XML_Parse(p, poo, strlen(poo), 1);
	printf("%s Parsed: %d\n", argv[argc], res);
	if(res==0)
	{
	    printf("error; %s\n", XML_ErrorString(XML_GetErrorCode(p)));
	}
	free (poo);
	XML_ParserFree (p);
    }

    return EXIT_SUCCESS;
}
