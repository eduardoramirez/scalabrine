#!/usr/bin/perl
use CGI;
use DBI;

# read the CGI params
my $cgi = CGI->new;

my $username = $cgi->param("username");
my $password = $cgi->param("password");

# connect to the database
my $con = DBI->connect("DBI:mysql:database=scalabrinedb;host=localhost;port=3306",  
  "root", "Tw0sof+9Ly") 
  or die $DBI::errstr;

my $statement = qq{SELECT username, email, password FROM users WHERE username=?};
my $sth = $con->prepare($statement)
  or die $con->errstr;
$sth->execute($username)
  or die $sth->errstr;

my ($user_id) = $sth->fetchrow_array;


my $now = localtime();

# create a JSON string according to the database result
my $json = ($password eq "opensesame") ?
  qq{{"success" : "login is successful", "userid" : "$username", "time" : "$now"}} :
  qq{{"error" : "username or password is wrong"}};

# return JSON string
print $cgi->header;
print $json;
             