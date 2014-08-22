#!/usr/bin/perl -T
use CGI;
use DBI;
use Crypt::PBKDF2;

# read the CGI params
my $cgi = CGI->new;

$session = CGI::Session()->new(undef, $cgi, {Directory=>'/var/cgi-bin/'});
$CGISESSID = $session->id();

print $session->header();

my $json = qq{{"success" : "login is successful"}} : 

my $username = $cgi->param("username");
my $password = $cgi->param("password");

# connect to the database
my $con = DBI->connect("DBI:mysql:database=scalabrinedb;host=localhost;port=3306",  
  "root", "Tw0sof+9Ly") 
  or die $DBI::errstr;

my $statement = qq{SELECT username, password FROM users WHERE username=?};
my $sth = $con->prepare($statement)
  or die $con->errstr;
$sth->execute($username)
  or die $sth->errstr;

my @user_row = $sth->fetchrow_array;
my ($db_username, $db_password) = @user_row;
$sth->finish;

if($username eq $db_username)
{
  my $pbkdf2 = Crypt::PBKDF2->new;

  if($pbkdf2->validate($db_password, $password))
  {
    # valid
    # add the user time of login and username to session variables
     my $json = qq{{"success" : "login is successful"}};
  }
  else
  {
    my $json = qq{{"error" : "password is wrong"}};
  }
}
else
{
  my $json = qq{{"error" : "username does not exist"}};
}

$con->disconnect;

print $cgi->header(-type => "application/json", -charset => "utf-8");
print $json;