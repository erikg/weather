
/*
 * $Id: fetch.c,v 1.1 2005/01/10 18:09:07 erik Exp $
 */

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <sys/types.h>
#include <unistd.h>
#include <sys/socket.h>
#include <sys/uio.h>
#include <netinet/in.h>
#include <netdb.h>

#include "fetch.h"

char *
fetch (char *ac)
{
    int fd, blks = 0, siz = 0;
    struct sockaddr_in s;
    struct sockaddr *ss = (struct sockaddr *)&s;
    struct hostent *h;
    char *buf = NULL, *off;

    memset (&s, 0, sizeof (s));
    if ((fd = socket (AF_INET, SOCK_STREAM, 0)) == -1)
    {
	perror ("socket");
	return NULL;
    }

    if ((h = gethostbyname ("weather.gov")) == NULL)
    {
	perror ("gethostbyname");
	return NULL;
    }

    s.sin_family = AF_INET;
    s.sin_port = htons (80);
    s.sin_addr = *((struct in_addr *)h->h_addr_list[0]);
    if (connect (fd, ss, sizeof (struct sockaddr)) == -1)
    {
	perror ("connect");
	return NULL;
    }

    buf = (char *)malloc ((++blks) * BUFSIZ);
    off = buf;
    snprintf (buf, BUFSIZ, "GET /data/current_obs/%s.xml HTTP/1.0\n\n", ac);
    write (fd, buf, strlen (buf));

    while ((siz = read (fd, off, BUFSIZ)) != 0)
    {
	printf ("size: %d\n", siz);
	off += siz;

/*	buf = (char *)realloc (buf, (++blks) * BUFSIZ);*/
    }
    printf ("bigsize: %d\n", strlen (buf));
    off = buf;

    shutdown (fd, SHUT_RDWR);
    close (fd);

    /*
     * find the end of the http header 
     */
    while (!(off[0] == '\n' && off[1] == '\r' && off[2] == '\n'))
	++off;
    while (*off != '<')
	++off;

    off = strdup (off);
    free (buf);
    return off;
}
