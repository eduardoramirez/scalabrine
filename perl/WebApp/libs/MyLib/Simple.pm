package MyLib::Simple;
use strict;

use lib '/var/www/html/perl/WebApp/libs';
use base 'MyLib::Login';

sub cgiapp_init {
  my $self = shift;

  $self->SUPER::cgiapp_init;

  # define runmodes (pages) that require successful login:
  $self->authen->protected_runmodes(
    'private',
    'private2',
  );

}

sub index : StartRunmode {
  my $self = shift;
  my $template = $self->load_tmpl("index.html");
  $template->param({
      NAME  => 'INDEX',
      MYURL => $self->query->url(),
      USER  => $self->authen->username,
  });
  return $template->output;
}

sub public : Runmode {
  my $self = shift;
  my $template = $self->load_tmpl("default.html");
  my $msg = "You can see this without logging in.<br>";
  $template->param(MESSAGE => $msg);
  $template->param(NAME => 'Public');
  $template->param(MYURL => $self->query->url);
  return $template->output;
}

sub public2 : Runmode {
  my $self = shift;
  my $template = $self->load_tmpl("default.html");
  my $msg = "You can see this without logging in.<br>";
  $template->param(MESSAGE => $msg);
  $template->param(NAME => 'Public2');
  $template->param(MYURL => $self->query->url);

### die "made it here\n";

  return $template->output;
}

sub private : Runmode {
  my $self = shift;
  my $template = $self->load_tmpl("default.html");
  my $msg = "You must log in to see this.";
  $template->param(MESSAGE => $msg);
  $template->param(NAME => 'Private');
  $template->param(MYURL => $self->query->url);
  return $template->output;
}

sub private2 : Runmode {
  my $self = shift;
  my $template = $self->load_tmpl("default.html");
  my $msg = "You must log in to see this.";
  $template->param(MESSAGE => $msg);
  $template->param(NAME => 'Private2');
  $template->param(MYURL => $self->query->url);
  return $template->output;
}


1;
