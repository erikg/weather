
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
WS		[	 ]|&nbsp;

%%

RS		{ printf("\nROWSTART!\n"); /*return ROWSTART; */}
RE		{ printf("\nROWEND!\n"); /*return ROWEND; */}
\n		{ weatherlineno++; }
{TAG}+		{ printf("%s\n", yytext); }
{WS}|{TAG}	{ /* comment */ }
.		{ printf("%s", yytext); /*yylval.s = yytext; return STR;*/ }

%%

int yywrap(){ return 1; }

int yyerror(char *err){ printf("Error:%d: %s\n", weatherlineno, err); return 1; }
