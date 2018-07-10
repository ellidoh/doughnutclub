<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<title>Doughnut Club - Wine Store</title>
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
  <h2>Please search our wine selections below.</h2>
  <p><img src="images/wine-for-sale.jpg" alt="wine-for-sale.jpg" /></p>
  <form action="wines.php" method="GET">
    <br><br>
    <table>
      <tr>
	<td>Wine Name: </td>
	<td><input type="text" id="wineName" name="wineName"/></td>
      </tr>
      <tr>
	<td>Wine Type: </td>
	<td><input type="text" id="wineType" name="wineType"/></td>
      </tr>
      <tr>
      <?php
	 require_once "db.inc";
	 require "wine_do.php"; // selectDistinct() function found in here

         // Connect to MySQL
         if ( !( $connection = @ mysql_connect( $hostName, $username, $password ) ) )                      
            //die( "Could not connect to database </div></body></html>" );
	  showerror();
   
         // open Products database
         if ( !mysql_select_db( $databaseName, $connection ) )
            //die( "Could not open the database </div></body></html>" );
	  showerror();
	
	 // print "\n\t<td>Wine Type:</td>\n\t<td> ";
	 // wineTypeRadio($connection, "wine_type", "wine_type", "wineType", "All");
	 // print "</td>\n      </tr>";
	 
	  print "\n\t<td>Region:</td>\n\t<td> ";

	 selectDistinct($connection, "region", "region_name", "regionName", "All");
	 print "</td>\n      </tr>";
      print "\n\t<tr><td>Max Price:</td>\n\t<td>";
      //print "\n\t<input type=\"text\" list=\"max_price\" />";
	 dataListDistinct($connection, "inventory", "cost", "max_price", "9999");
      //minMaxPrice($connection, "inventory", "cost", "min_price", "0", "max_price", "9999");
      ?><!-- end PHP script -->
  <!--<script>
    /*$('#max_price').on('input', function() {
      this.pattern = '[\\w\\s+#]{${this.value.length}}';
    });*/
    /*document.querySelector("#max_price").oninput = function() {
      this.pattern = '[\\w\\s+#]{${this.value.length}}';
    }*/
  </script>-->
    <!--<tr>
	<td>Vintage Year: </td>
	<td><input type="year" id="year" name="year"/></td>
      </tr>-->
      <tr>
	<td><input type="submit" value="Show Wines" onclick="return wineTypeValidator(this);"/></td>
      </tr>
    <script>
      function wineTypeValidator(e) {
	if($('#wineType').val() == "") {
	  alert('Wine Type cannot be empty!');
	  e.preventDefault();
      };
    </script>
    </table>
  </form>
 </div>
 <br/><br/><br/><br/><br/><br/><br/>
</body>
</html>
