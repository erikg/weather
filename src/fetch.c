/*
 * TODO: fix mem shit so it doesn't overrun the buffer while reading.
 */

/*
 * $Id: fetch.c,v 1.2 2005/01/11 15:18:36 erik Exp $
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

#if 0
#define SERVER "www.nws.noaa.gov"
#else
#define SERVER "weather.gov"
#endif

#define DOUBLEMEM() blks*=2; buf = (char *)realloc(buf, blks)

void *
memdup(void *s, size_t len)
{
    void *buf;
    buf = malloc(len);
    memcpy(buf,s,len);
    return buf;
}

char *
fetch (char *ac)
{
    int fd, blks = 0, siz = 0;
    static struct sockaddr_in *s = NULL;
    struct sockaddr *ss;
    char *buf=NULL, *off;

    if (s == NULL)
    {
	struct hostent *h;
	s = (struct sockaddr_in *)malloc (sizeof (struct sockaddr_in));
	memset (s, 0, sizeof (struct sockaddr_in));
	s->sin_family = AF_INET;
	s->sin_port = htons (80);
	if ((h = gethostbyname (SERVER)) == NULL)
	{
	    perror ("gethostbyname");
	    return NULL;
	}
	s->sin_addr = *((struct in_addr *)h->h_addr_list[0]);
    }

    ss = (struct sockaddr *)memdup(s,sizeof(struct sockaddr));
    if ((fd = socket (AF_INET, SOCK_STREAM, 0)) == -1)
    {
	perror ("socket");
	return NULL;
    }

    if (connect (fd, ss, sizeof (struct sockaddr)) == -1)
    {
	perror ("connect");
	return NULL;
    }

    blks=BUFSIZ;
    DOUBLEMEM();

    snprintf (buf, BUFSIZ, "GET /data/current_obs/%s.xml HTTP/1.0\n\n", ac);
    write (fd, buf, strlen (buf));

    off = buf;
    while ((siz = read (fd, off, BUFSIZ)) != 0)
    {
	if(siz==-1)
	{
	    perror("Bad read in fetch");
	    exit(-1);
	}
	off += siz;
    }

    *off = 0;
    shutdown (fd, SHUT_RDWR);
    close (fd);

    /*
     * find the end of the http header 
     */
    off = buf;
    while (!(off[0] == '\n' && off[1] == '\r' && off[2] == '\n'))
	++off;
    while (*off != '<')
	++off;

    off = strdup(off);
    free(buf);
    return off;
}
