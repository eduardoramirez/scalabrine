package MyLib::Login;

use strict;
use base 'CGI::Application';

use CGI::Application::Plugin::AutoRunmode;
use CGI::Application::Plugin::DBH(qw/dbh_config dbh/);
use CGI::Application::Plugin::Session;
use CGI::Application::Plugin::Authentication;
use CGI::Application::Plugin::Redirect;
use CGI::Application::Plugin::ConfigAuto (qw/cfg/);
use Digest::MD5 qw(md5_hex);

sub setup {
  my $self = shift;

  $self->mode_param(
    path_info => 1,
    param => 'rm',
  );
}

sub cgiapp_init {
  my $self = shift;

  my %CFG = $self->cfg;

  $self->tmpl_path(['./templates']);

  # open database connection
  $self->dbh_config(
    $CFG{'DB_DSN'},    # "dbi:mysql:database=webapp",
    $CFG{'DB_USER'},   # "webadmin",
    $CFG{'DB_PASS'},   # ""
  );

  $self->session_config(
    CGI_SESSION_OPTIONS => [
      "driver:mysql;serializer:Storable;id:md5",
      $self->query, {Handle => $self->dbh},
    ],

    DEFAULT_EXPIRY => '+1h',
#    COOKIE_PARAMS => {
#      -name => 'MYCGIAPPSID',
#      -expires => '+24h',
#      -path => '/',
#    },
  );

  # configure authentication parameters
  $self->authen->config(
    DRIVER => [ 'DBI',
      DBH         => $self->dbh,
      TABLE       => 'user_info',
      CONSTRAINTS => {
        'user_info.username'     => '__CREDENTIAL_1__',
        'MD5:user_info.password' => '__CREDENTIAL_2__'
      },
    ],

    STORE                => 'Session',
    LOGOUT_RUNMODE       => 'logout',
    LOGIN_RUNMODE        => 'login',
    POST_LOGIN_RUNMODE   => 'okay',
    RENDER_LOGIN         => \&my_login_form,
  );

  # define runmodes (pages) that require successful login:
  $self->authen->protected_runmodes(
    'mustlogin',
  );

}

sub teardown {
  my $self = shift;
  $self->dbh->disconnect(); # close database connection
}

sub mustlogin : Runmode {
  my $self = shift;
  my $url = $self->query->url;
  return $self->redirect($url);
}

sub okay : Runmode {
  my $self = shift;

  my $url = $self->query->url;
#  my $user = $self->authen->username;
  my $dest = $self->query->param('destination') || 'index';

  if ($url =~ /^https/) {
    $url =~ s/^https/http/;
  }

  return $self->redirect("$url/$dest");
}

sub login : Runmode {
  my $self   = shift;
  my $url = $self->query->url;

  my $user = $self->authen->username;
  if ($user) {
    my $message = "User $user is already logged in!";
    my $template = $self->load_tmpl('default.html');
    $template->param(MESSAGE => $message);
    $template->param(MYURL => $url);
    return $template->output;
  } else {
    my $url = $self->query->self_url;
    unless ($url =~ /^https/) {
      $url =~ s/^http/https/;
      return $self->redirect($url);
    }
    return $self->my_login_form;
  }
}

sub my_login_form {
  my $self = shift;
  my $template = $self->load_tmpl('login_form.html');

  (undef, my $info) = split(/\//, $ENV{'PATH_INFO'});
  my $url = $self->query->url;

  my $destination = $self->query->param('destination');

  unless ($destination) {
    if ($info) {
      $destination = $info;
    } else {
      $destination = "index";
    }
  }

  my $error = $self->authen->login_attempts;

  $template->param(MYURL => $url);
  $template->param(ERROR => $error);
  $template->param(DESTINATION => $destination);
  return $template->output;
}

sub logout : Runmode {
  my $self = shift;
  if ($self->authen->username) {
    $self->authen->logout;
    $self->session->delete;
  }
  return $self->redirect($self->query->url);
}

sub myerror : ErrorRunmode {
  my $self = shift;
  my $error = shift;
  my $template = $self->load_tmpl("default.html");
  $template->param(NAME => 'ERROR');
  $template->param(MESSAGE => $error);
  $template->param(MYURL => $self->query->url);
  return $template->output;
}

sub AUTOLOAD : Runmode {
  my $self = shift;
  my $rm = shift;
  my $template = $self->load_tmpl("default.html");
  $template->param(NAME => 'AUTOLOAD');
  $template->param(MESSAGE =>
    "<p>Error: could not find run mode \'$rm\'<br>\n");
  $template->param(MYURL => $self->query->url);
  return $template->output;
}


1;
