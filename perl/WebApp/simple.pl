#!/usr/bin/perl
use strict;
use lib '/var/cgi-bin/scalabrine/libs';
use ScalabrineLib::Scalabrine;

my $scalabrine = ScalabrineLib::Scalabrine->new(
  PARAMS => {
    cfg_file => ['scalabrine.ini'],
    format => 'equal',
  },
);

$scalabrine->run();