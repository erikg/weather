#include <stdio.h>
#include <stdlib.h>

extern FILE *yyin;
void yyparse(void);

int main(int argc, char **argv)
{
	yyin = stdin;
//	yyparse();
	yylex();
	return EXIT_SUCCESS;
}
