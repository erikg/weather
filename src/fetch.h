/*
 * $Id: fetch.h,v 1.2 2005/01/10 18:52:05 erik Exp $
 */

#ifndef FETCH_H
# define FETCH_H

/* fetch raw xml data from noaa.
 * http://weather.gov/data/current_obs/<ac>.xml
 */
char *fetch(char *ac);

#endif
