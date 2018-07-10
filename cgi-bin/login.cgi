#!/usr/bin/perl -wT
use strict; 
use CGI; 
use Fcntl qw(:flock);

my $cgi = new CGI;

my $username = $cgi->param( "username" ) // "";
my $password = $cgi->param( "password" ) // ""; 
my $login = "fail";
		
my $salt = "21";
my $enpass = crypt($password,$salt);
open(PASSWDDATA, "<passwd.txt") or die "Can not open passwd.txt";

break: while(<PASSWDDATA>)
{
	my $line = $_;
	my @namepass = split(' ',$line);
	if($namepass[0] eq $username && $namepass[1] eq $enpass)
	{
	  $login = "success";
	  last break;
	}
		  
}
close(PASSWDDATA);
if($login eq "success")
{		
#	print $cgi->redirect('http://cs99.bradley.edu/~dcrump/doughnutclub');
	displayOtherHTMLPage($cgi);
	print("<meta http-equiv='refresh' content='2;url=http://cs99.bradley.edu/~dcrump/doughnutclub'/>");

}
else
{
	print $cgi->header( "text/html" );
	print("<meta http-equiv='refresh' content='2;url=http://cs99.bradley.edu/~dcrump/doughnutclub/login.html' />");
	print $cgi->start_html( "Welcome to Doughnut Club" ),
	$cgi->h2(" Sorry! Login Failed, Automatically you will be redirected to login page"),
	$cgi->end_html;
}


# creates the Other page
sub displayOtherHTMLPage {
	my( $cgi ) = @_;
	my @username = split('@',$cgi->param( "username" ));
	my $user = $username[0];
	
	print $cgi->header( "text/html" ),
	$cgi->start_html(
        	-title    => "Welcome To Doughnut Club",			
		-topmargin =>"0"
        ),
	
	$cgi->h1("Welcome to Doughnut Club, $user!"),
	$cgi->end_html;    
}
