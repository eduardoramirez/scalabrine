#!/usr/bin/perl -T
use CGI;
use DBI;
use strict;
use warnings;

use Crypt::PBKDF2;

# read the CGI params
my $cgi = CGI->new;
my $username = $cgi->param("username");
my $email = $cgi->param("email");
my $password = $cgi->param("password");
my $confirm_password = $cgi->param("confirm_password");

# connect to the database
my $con = DBI->connect("DBI:mysql:database=scalabrinedb;host=localhost;port=3306",  
  "root", "Tw0sof+9Ly") 
  or die $DBI::errstr;

if($password eq $confirm_password)
{
  # Check username is unique
  my $statement = qq{SELECT username FROM users WHERE username=?};
  my $sth = $con->prepare($statement)
    or die $con->errstr;
  $sth->execute($username)
    or die $sth->errstr;

  if($sth->rows == 0)
  {
    my $pbkdf2 = Crypt::PBKDF2->new(
      hash_class =>'HMACSHA2',
      hash_args => {
        sha_size = 512,
      },
      iterations => 10000,
      salt_len => 22,
    );

    $h_password = $pbkdf2->generate($password);

    # add to db
    $statement = qq{INSERT INTO users (username, email, password) VALUES (?, ?, ?)}

    $sth = $con->prepare($statement)
      or die $con->errstr;

    $sth->execute($username, $email, $h_password)
    $sth->finish;
  }
  else
  {
    # username exists
  }
}
else
{
  # passwords do not match
}

my ($userID) = $sth->fetchrow_array;
my $json = ($userID) ? 
  qq{{"success" : "login is successful", "userid" : "$userID"}} : 
  qq{{"error" : "username or password is wrong"}};

$con->disconnect;
