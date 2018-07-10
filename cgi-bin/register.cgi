#!/usr/bin/perl -wT
use strict; 
use CGI; 

my $obj = new CGI;
my $datastring ="";
my @errors = ();

# read information from form
my $username = $obj->param( "username" ) // "";
my $password = $obj->param( "password" ) // "";
my $password2 = $obj->param( "password2" ) // "";

my $firstname = $obj->param( "firstname" ) // "";
my $lastname = $obj->param( "lastname" ) // "";
my $birthdate = $obj->param( "birthdate" ) // "";
my $email = $obj->param( "email" ) // "";
my $homephone = $obj->param( "homephone" ) // "";
my $cellphone = $obj->param( "cellphone" ) // "";
my $gender = $obj->param( "gender" ) // "";
my @doughnutsources = $obj->param( "doughnutsources" );
my $doughnutsources2="";
foreach my $source (@doughnutsources) {
  $doughnutsources2 .= "$source ";
}
my @emaillist = $obj->param( "maillist" );
my $emaillist2="";
foreach my $lst (@emaillist) {
  $emaillist2 .= "$lst ";
}
if($emaillist2 eq "") {
  $emaillist2 = "No";
}
my $comments = $obj->param( "comments" ) // "";

#my $userexists = "false";
my $salt = "21";
my $enpass = crypt($password,$salt);
my $enpass2 = crypt($password2,$salt);
#my $debug = "true";

if(length($username) < 4)
{
  push @errors, "User name must be 4 characters or longer!";
}
if(length($password) < 6) {
  push @errors, "Password must be 6 characters or longer!";
}
if($enpass ne $enpass2) {
  push @errors, "Passwords do not match!";
}
if(@errors == 0) {
  open(PASSWDDATA, "<passwd.txt") or die "Can not open passwd.txt";
  break: while(<PASSWDDATA>)
  {
    my $line = $_;
    my @namepass = split(' ',$line);
    if($namepass[0] eq $username)
    {
      #$userexists = "true";
      push @errors, "That user name is already taken!";
      last break;
    }
  }
  close(PASSWDDATA);
}
  #if($userexists eq "false" && @errors == 0)
  if(@errors == 0)
  {
    my $namepass = "$username $enpass\n";
  
    # Save the data into a text file
    $datastring = "Saved Data\n\nUser name: $username\nFirst Name: $firstname\nLast Name: $lastname\nBirthdate: $birthdate\nEmail: $email\nHome Phone: $homephone\nCell Phone: $cellphone\nGender: $gender\nDoughnut Sources: $doughnutsources2\nEmail List: $emaillist2\nComments: $comments\n\n";
    open(PASSWDDATA, ">>passwd.txt") or die "Can not open passwd.txt";
    print PASSWDDATA $namepass;
    close(PASSWDDATA);
    open(OUTDATA, ">>data.txt") or die "Error in opening file data.txt";
    print OUTDATA $datastring;
    close(OUTDATA); 

    #Send the info back
    print $obj->header( "text/html" ),
      $obj->start_html(
        -title => "Form Data",			
        -topmargin =>"0"
      ),	
      $obj->h1("Submitted Form Data Detail"),
      $obj->p("User Name:  $username"),
      $obj->p("First Name:  $firstname"),
      $obj->p("Last Name:  $lastname"),
      $obj->p("Birthdate:  $birthdate"),
      $obj->p("Email:  $email"),
      $obj->p("Home Phone:  $homephone"),
      $obj->p("Cell Phone:  $cellphone"),
      $obj->p("Gender:  $gender"),
      $obj->p("Methods of Doughnut Acquisition:  $doughnutsources2"),
      $obj->p("Email List: $emaillist2"),
      $obj->p("Comments: $comments"),
      $obj->end_html;
  } 
  if(@errors != 0) {
  	my $errmsg = "<ul>";
  	foreach my $err (@errors) {
      $errmsg .= "<li>$err</li>";
    }
    $errmsg .= "</ul>";
    print $obj->header( "text/html" ),
      $obj->start_html(
        -title => "Registration Error",			
        -topmargin =>"0"
      ),
      $obj->h2(" Sorry! Registration Failed!"),
      $obj->p("$errmsg"),
      $obj->p("<a href=javascript:history.back()>BACK</a>"),
      $obj->end_html;
  }
