#!/usr/bin/perl
use strict;
use lib '/var/www/html/perl/WebApp/libs';
use MyLib::Simple;

print "content-type: text/html\n\n";
print "hello world\n";

my $webapp = MyLib::Simple->new(
  PARAMS => {
    cfg_file => ['simple.ini'],
    format => 'equal',
  },
);

$webapp->run();