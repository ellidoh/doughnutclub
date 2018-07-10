<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<title>Doughnut Club - Home</title>
	<link href="styles/doughnutclub.css" rel="stylesheet" type="text/css"/>
	<script>var __adobewebfontsappname__="dreamweaver"</script>
	<script src="http://use.edgefonts.net/source-sans-pro:n2,n4:default.js" type="text/javascript"></script>
	<script>
		window.jQuery || 
			document.write('<script src="jquery-3.3.1.min.js"><\/script>')
	</script>
</head>

<footer id="footer" class="noprint">
	<div>
		Please send feedback to
		<a href="mailto:dcrump@mail.bradley.edu?subject=Doughnut%20Club%20Feedback">
		dcrump@mail.bradley.edu</a>
	</div>
</footer>

<body>
	<script>
	$(function(){
		$("#menu-placeholder").load("menu.html");
		var current = new Date();
		$("#datetime").html("<p>The date and time is " + current.toLocaleString() + "</p>");
	});
	</script>

<div class="branding">
	<div id="title">
		<div id="name"><b>Doughnut Club </b></div>
		<div id="term"><b> Spring 2018</b></div>
	</div>
   	<div id="menu-placeholder" class="noprint"></div>
</div>

<div id="wrapper">
  <?php
    require_once "db.inc";

    function displayWinesList($connection, $query, $wineName, $wineType, $regionName, $year, $price)
    {
     // Run the query on the server
     if (!($result = @ mysql_query ($query, $connection)))
        showerror();

     // Find out how many rows are available
     $rowsFound = @ mysql_num_rows($result);

     // If the query has results ...
     if ($rowsFound > 0)
     {
         // ... print out a header
         print "<br>Wines found<br>";//of $regionName<br>";

         // and start a <table>.
         print "\n<table class=\"wines\">\n<thead>\n<tr>" .
               "\n\t<th>Wine ID</th>" .
               "\n\t<th>Wine Name</th>" .
               "\n\t<th>Wine Type</th>" .
               "\n\t<th>Year</th>" .
               "\n\t<th>Winery</th>" .
               "\n\t<th>Description</th>" .
               "\n\t<th>Price</th>\n</tr>\n</thead>\n<tbody>";

         // Fetch each of the query rows
         while ($row = @ mysql_fetch_array($result))
         {
            // Print one row of results
            print "\n<tr>\n\t<td>{$row["wine_id"]}</td>" .
                  "\n\t<td>{$row["wine_name"]}</td>" .
                  "\n\t<td>{$row["wine_type"]}</td>" .
                  "\n\t<td>{$row["year"]}</td>" .
                  "\n\t<td>{$row["winery_name"]}</td>" .
                  "\n\t<td>{$row["description"]}</td>" .
                  "\n\t<td>{$row["cost"]}</td>\n</tr>";
         } // end while loop body

         // Finish the <table>
         print "\n</tbody></table>";
     } // end if $rowsFound body

     // Report how many rows were found
     print "{$rowsFound} records found matching your criteria<br>";
  } // end of function

  // Connect to the MySQL server
  if (!($connection = @ mysql_connect($hostName, $username, $password)))
     die("Could not connect");

  // Secure the user parameter $regionName
  $regionName = mysqlclean($_GET, "regionName", 30, $connection);

  // Secure the user parameter $wineType
  $wineType = mysqlclean($_GET, "wineType", 30, $connection);

  // Secure the user parameter $wineName
  $wineName = mysqlclean($_GET, "wineName", 30, $connection);

  // Secure the user parameter $year
  $year = mysqlclean($_GET, "year", 30, $connection);

  // Secure the user parameter $year
  $price = mysqlclean($_GET, "cost", 30, $connection);

  if (!mysql_select_db($databaseName, $connection))
     showerror();

  // Start a query ...
  $query = "SELECT wine.wine_id, wine_name, description, year, winery_name, wine_type.wine_type, cost
            FROM   winery, region, wine, wine_type, inventory
            WHERE  winery.region_id = region.region_id 
            AND    wine.winery_id = winery.winery_id
            AND    inventory.wine_id = wine.wine_id
            AND    wine_type.wine_type_id = wine.wine_type";

   // ... then, if the user has specified a region, add the regionName 
   // as an AND clause ...
   if (isset($regionName) && $regionName != "All")
     $query .= " AND region_name = \"{$regionName}\"";

   // ... then, if the user has specified a type, add the wineType
   // as an AND clause ...
   if (isset($wineType) && $wineType != "All")
     $query .= " AND wine_type.wine_type = \"{$wineType}\"";

   // ... then, if the user has specified a wine name, add the wineName 
   // as an AND clause ...
   if (isset($wineName) && $wineName != "")
     //$query .= " AND wine_name = \"{$wineName}\"";
     $query .= " AND wine_name COLLATE UTF8_GENERAL_CI LIKE \"%{$wineName}%\"";

   // ... then, if the user has specified a year, add the wineName 
   // as an AND clause ...
   if (isset($year) && $year != "")
     $query .= " AND year = \"{$year}\"";

   // ... then, if the user has specified a wine name, add the wineName 
   // as an AND clause ...
   if (isset($price) && $price != "")
     $query .= " AND cost = \"{$price}\"";

   // ... and then complete the query.
   $query .= " ORDER BY wine_name, wine_type, region_name";

   // run the query and show the results
   //displayWinesList($connection, $query, $regionName);
   displayWinesList($connection, $query, $wineName, $wineType, $regionName, $year, $price);
?> 
 </div>
 <br/><br/><br/><br/>
</body>
</html>
