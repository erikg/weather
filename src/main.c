#include <stdio.h>
#include <stdlib.h>
#include <string.h>

#include "fetch.h"

int
main (int argc, char **argv)
{
    char *poo;

    while (--argc)
    {
	FILE *fd;
	fd = fopen(argv[argc], "w");
	poo = fetch (argv[argc]);
	fwrite(poo, strlen(poo), 1, fd);
	free (poo);
	fclose(fd);
    }

    return EXIT_SUCCESS;
}
