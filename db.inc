<?php
   // This file is the same as example 6-7, but includes mysqlclean() and shellclean() 
   // Remember to set up real credentials, pointing to an appropriate database, to proceed.
   $hostName = "localhost";
   $databaseName = "db_name";
   $username = "db_user";
   $password = "dB_Pa55w0rd";
   
   function showerror()
   {
      die("Error " . mysql_errno() . " : " . mysql_error());
   }

   function mysqlclean($array, $index, $maxlength, $connection)
   {
     if (isset($array["{$index}"]))
     {
        $input = substr($array["{$index}"], 0, $maxlength);
        $input = mysql_real_escape_string($input, $connection);
        return ($input);
     }
     return NULL;
   }

   function shellclean($array, $index, $maxlength)
   {
     if (isset($array["{$index}"]))
     {
       $input = substr($array["{$index}"], 0, $maxlength);
       $input = EscapeShellArg($input);
       return ($input);
     }
     return NULL;
   }
?>
