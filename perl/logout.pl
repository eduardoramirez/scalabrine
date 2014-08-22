#!/usr/bin/perl -T
use CGI;
use DBI;

$s = CGI::Session->load() or die CGI::Session->errstr();

$s->delete;
$s->flush;