<?php
 function dataListDistinct ($connection, $tableName, $attributeName,
                           $pulldownName, $defaultValue)
  {
     $defaultWithinResultSet = FALSE;
     // Query to find distinct values of $attributeName in $tableName
     $distinctQuery = "SELECT DISTINCT {$attributeName} FROM
                       {$tableName} ORDER BY {$attributeName} DESC";

     // DEBUG line
     //print "\n<BR>Query=\"{$distinctQuery}\"<BR>";
     // Run the distinctQuery on the databaseName
     if (!($resultId = @ mysql_query ($distinctQuery, $connection)))
        showerror();

     // Insert text input, to be used with datalist.

     print "\n\t<input type=\"text\" list=\"{$pulldownName}List\" name=\"{$pulldownName}\" id=\"{$pulldownName}\" />";

     // Start the datalist widget.
     print "\n<datalist id=\"{$pulldownName}List\" name=\"{$pulldownName}List\">";

     // Retrieve each row from the query
     while ($row = @ mysql_fetch_array($resultId))
     {
       // Get the value for the attribute to be displayed
       $result = $row[$attributeName];

       // Check if a defaultValue is set and, if so, is it the
       // current database value?
       if (isset($defaultValue) && $result == $defaultValue)
          // Yes, show as selected
          print "\n\t<option selected value=\"{$result}\">{$result}";
       else
          // No, just show as an option
          print "\n\t<option value=\"{$result}\">{$result}";
       print "</option>";
     }
     print "\n</datalist>";
  } // end of function
 function selectDistinct ($connection, $tableName, $attributeName,
                           $pulldownName, $defaultValue)
  {
     $defaultWithinResultSet = FALSE;
     // Query to find distinct values of $attributeName in $tableName
     $distinctQuery = "SELECT DISTINCT {$attributeName} FROM
                       {$tableName} ORDER BY {$attributeName} DESC";

     // DEBUG line
     //print "\n<BR>Query=\"{$distinctQuery}\"<BR>";
     // Run the distinctQuery on the databaseName
     if (!($resultId = @ mysql_query ($distinctQuery, $connection)))
        showerror();

     // Start the select widget
     print "\n<select name=\"{$pulldownName}\">";

     // Retrieve each row from the query
     while ($row = @ mysql_fetch_array($resultId))
     {
       // Get the value for the attribute to be displayed
       $result = $row[$attributeName];

       // Check if a defaultValue is set and, if so, is it the
       // current database value?
       if (isset($defaultValue) && $result == $defaultValue)
          // Yes, show as selected
          print "\n\t<option selected value=\"{$result}\">{$result}";
       else
          // No, just show as an option
          print "\n\t<option value=\"{$result}\">{$result}";
       print "</option>";
     }
     print "\n</select>";
  } // end of function
 function wineTypeRadio ($connection, $tableName, $attributeName,
                           $radioName, $defaultValue)
  {
     $defaultWithinResultSet = FALSE;
     // Query to find distinct values of $attributeName in $tableName
     $radioQuery = "SELECT DISTINCT {$attributeName} FROM
                       {$tableName}";

     // DEBUG line
     //print "\n<BR>Query=\"{$distinctQuery}\"<BR>";
     // Run the distinctQuery on the databaseName
     if (!($resultId = @ mysql_query ($radioQuery, $connection)))
        showerror();

     // Start the select widget
     //print "\n<select name=\"{$radioName}\">";

     // Retrieve each row from the query
     while ($row = @ mysql_fetch_array($resultId))
     {
       // Get the value for the attribute to be displayed
       $result = $row[$attributeName];

       // Check if a defaultValue is set and, if so, is it the
       // current database value?
//DEBUG line
//print "<br>defaultValue:\"{$defaultValue}\"</br>";
       if (isset($defaultValue) && $result == $defaultValue)
          // Yes, show as selected
          print "\n\t<input type=\"radio\" checked=\"checked\" name=\"{$radioName}\" id=\"{$result}\" value=\"{$result}\"/><label for=\"{$result}\">{$result}</label>";
       else
          // No, just show as an option
          //print "\n\t<option value=\"{$result}\">{$result}";
          print "\n\t<input type=\"radio\" name=\"{$radioName}\" id=\"{$result}\" value=\"{$result}\"/><label for=\"{$result}\">{$result}</label>";
       //print "</option>";
     }
     //print "\n</select>";
  } // end of function
 function minMaxPrice ($connection, $tableName, $attributeName,
                   $minName, $defaultMin, $maxName, $defaultMax)
  {
     $defaultWithinResultSet = FALSE;
     // Query to find values of $attributeName in $tableName
     $query = "SELECT MIN({$attributeName}) AS minCost, MAX({$attributeName}) AS maxCost FROM {$tableName}";

     // DEBUG line
     //print "\n<BR>Query=\"{$query}\"<BR>";
     // Run the distinctQuery on the databaseName
     if (!($resultId = @ mysql_query ($query, $connection)))
        showerror();


     // Retrieve each row from the query
     while ($row = @ mysql_fetch_array($resultId))
     {
       // Get the value for the attribute to be displayed
       $minCost = $row['minCost'];
       $maxCost = $row['maxCost'];

     // Set up Min Price
     print "\n<input type=\"number\" placeholder=\"0.00\" id=\"{$minName}\" name=\"{$minName}\" min=\"0\" value=\"0\" step=\"0.01\" title=\"Currency\" pattern=\"^\d+(?:\.\d{1,2})?$\" onblur=\"this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.text(this.value)?'inherit':'red'\"/></td>\n\t</tr>";
      print "\n\t<tr><td>Max Price:</td>\n\t<td>";
     
      // Set up Max Price
     print "\n<input type=\"number\" placeholder=\"0.00\" id=\"{$maxName}\" name=\"{$maxName}\" max=\"{$maxCost}\" value=\"{$maxCost}\" step=\"0.01\" title=\"Currency\" pattern=\"^\d+(?:\.\d{1,2})?$\" onblur=\"this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.text(this.value)?'inherit':'red'\"/></td>\n\t</tr>";
     }
  } // end of function
?>
