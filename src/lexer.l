
%{
	#include <stdio.h>
	#include <stdlib.h>
	#include <string.h>
	#include "parser.h"

	int weatherlineno = 1;
%}

N		[0-9]
RS		<TR[^>]*>
RE		</TR>
TAG		<[^>]*>
WS		[	 \n]|&nbsp;

%%

RS		{ printf("ROWSTART!\n"); return ROWSTART; }
RE		{ printf("ROWEND!\n"); return ROWEND; }
{WS}		{ /* comment */ }
.		{ yylval.s = yytext; return STR; }

%%

int yywrap(){ return 1; }

int yyerror(char *err){ printf("Error:%d: %s\n", weatherlineno, err); return 1; }
