/*
 * $Id: main.c,v 1.5 2005/01/10 18:52:41 erik Exp $
 */

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include "expat.h"

#include "fetch.h"

int
main (int argc, char **argv)
{
    char *poo;

    while (--argc)
    {
	XML_Parser p = XML_ParserCreate(NULL);
	poo = fetch (argv[argc]);
	free (poo);
    }

    return EXIT_SUCCESS;
}
