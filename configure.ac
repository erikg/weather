AC_INIT(src/main.c)
AC_CANONICAL_SYSTEM
AM_INIT_AUTOMAKE(weather,1.0)

AC_PROG_CC
AC_PROG_INSTALL

dnl autosearch /usr/local
AC_MSG_CHECKING([for /usr/local])
if test -d /usr/local/include ; then
	AC_MSG_RESULT([found, adding /usr/local to search paths])
	CPPFLAGS="$CPPFLAGS -I/usr/local/include"
	if test -d /usr/local/lib ; then
		LDFLAGS="$LDFLAGS -L/usr/local/lib"
	fi
else
	AC_MSG_RESULT([not found])
fi

dnl autosearch fink paths
AC_MSG_CHECKING([for fink in /sw])
if test -d /sw/include ; then
	AC_MSG_RESULT([found, adding /sw to search paths])
	CPPFLAGS="$CPPFLAGS -I/sw/include"
	if test -d /sw/lib ; then
		LDFLAGS="$LDFLAGS -L/sw/lib"
	fi
else
	AC_MSG_RESULT([not found])
fi

AC_CHECK_HEADER(expat.h, , AC_ERROR(expat is required))
AC_CHECK_LIB(expat, XML_ParserCreate, , AC_ERROR(expat is required))

AC_OUTPUT(Makefile src/Makefile)
