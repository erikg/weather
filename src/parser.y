/*
 * yacc grammar file for the rdr 'lithp' files
 *
 * 200309 Erik Greenwald <erikg@arl.army.mil> <erik.greenwald@us.army.mil>
 *
 * $Id: parser.y,v 1.1 2003/11/04 20:03:58 erik Exp $
 */

%{
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
%}

%union
{
  int i;
  float f;
  char *s;
}

%token FLT INT STR ROWSTART ROWEND
%type <f> FLT
%type <i> INT
%type <s> STR

%%

LINE:
	| ROW LINE	{ printf("\n"); } 
	| LINE mvals
	;

ROW:	ROWSTART pmvals ROWEND
	;

pmvals: 
	| pmvals pvals
	| pvals
	;

pvals: 	FLT		{ printf("%f", $1); }
	| INT		{ printf("%d", $1); }
	| STR		{ printf("%s", $1); }
	;
mvals: 
	| mvals vals
	| vals
	;

vals: 	FLT		{}
	| INT		{}
	| STR		{}
	;

%%

