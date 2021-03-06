<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<title>Doughnut Club - Home</title>
	<link href="../styles/doughnutclub.css" rel="stylesheet" type="text/css"/>
	<script>var __adobewebfontsappname__="dreamweaver"</script>
	<script src="http://use.edgefonts.net/source-sans-pro:n2,n4:default.js" type="text/javascript"></script>
	<script>
		window.jQuery || 
			document.write('<script src="../jquery-3.3.1.min.js"><\/script>')
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
		$("#menu-placeholder").load("../menu.html");
		var current = new Date();
		$("#datetime").html("<p>The date and time is " + current.toLocaleString() + "</p>");
	});
	</script>

<div class="branding">
	<!--<div id="logo" class="noprint">
	    <div id="long"><img src="images/doughnut.jpg" alt="Doughnuts!" /></div>
	</div>-->
	<!--<div id="userDetails" class="noprint">
		<div id="userName">
		</div>
		<div id="userGroup">
		</div>
	</div>-->
	<div id="title">
		<div id="name"><b>Doughnut Club </b></div>
		<div id="term"><b> Spring 2018</b></div>
	</div>
   	<div id="menu-placeholder" class="noprint"></div>
</div>

<div id="wrapper">
	<h2>Welcome to the Doughnut Club!</h2>
	<p><img src="../images/doughnut.jpg" alt="Doughnuts!" /></p>
    <p>Doughnut Club aims to inform you of all things doughnut.</p>
	<p>Please login to enter the site. No account? Register today for free!</p>
	<span id="datetime"></span>
 </div>
 <br/><br/><br/><br/>
</body>
</html>
