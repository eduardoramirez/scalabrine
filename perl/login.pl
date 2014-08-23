#!/usr/bin/perl
use CGI;
use DBI;
use Crypt::PBKDF2;

# read the CGI params
my $cgi = CGI->new;

#$session = CGI::Session()->new(undef, $cgi, {Directory=>'/var/cgi-bin/'});
#$CGISESSID = $session->id();

#print $session->header();

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

# create a JSON string according to the database result
my $json = ($password eq "opensesame") ?
  qq{{"success" : "login is successful", "userid" : "$user_id"}} :
  qq{{"error" : "username or password is wrong"}};

# return JSON string
print $cgi->header;
print $json;
             