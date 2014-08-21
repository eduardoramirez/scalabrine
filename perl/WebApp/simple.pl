#!/usr/bin/perl
use strict;
use lib '/var/www/html/perl/WebApp/libs';
use MyLib::Simple;

my $scalabrine = MyLib::Simple->new(
  PARAMS => {
    cfg_file => ['simple.ini'],
    format => 'equal',
  },
);

$scalabrine->run();