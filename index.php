<?php
	//provide gravatar image for header here since we have no template
	$email = "finespun1@gmail.com";
	$default = ""; // absolute url to default image goes here or leave empty for default gravatar image
	$size = 200;
	$grav_url = "http://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "?d=" . urlencode($default) . "&s=" . $size;
	$img = '<img src="'.$grav_url.' width="40px" height="40px" class="gravatar" >';
?>
<!DOCTYPE html>
<html>
<head>
<title>Numbers Example</title>
</head>

<body>
<!--nav-->
 <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <span class="navbar-brand"><?php echo $img;?></span>
          <a class="navbar-brand" href="#"> Numbers, Numbers, Numbers</a>
        </div>
      </div>
    </nav>

<!--end nav-->

<!---body-->
<div class="container body">
  <h2 style="margin-left: -15px;">Pick 3 Sets of Numbers</h2>
  <p class="text-muted smaller">ASSIGNMENT:
Write a web application that randomly generates 3 set of 6 numbers where each number is a value from 1 to 49.   A button is clicked to request the 3 sets for display.  The user is allowed to select 1 set or regenerate 3 new sets.  Once the user selects a set of numbers, that set is stored in a table.
 <br>
On each iteration of generating 3 sets, the application verifies that no set has more than 3 matching values of a previously selected set (not generated, only compared to sets selected and saved in the table).  If a generated set has 1, 2 or 3 matching value to a previous set, it is displayed on the screen for the user to see during the selection process.</p>

  <div class="row button">
  <button class="btn btn-lg btn-primary" onclick="javascript:get_sets();" id="start">Start Playing!</button>
  <button class="btn btn-lg btn-primary"  id="clear">Clear</button>
  <button class="btn btn-lg btn-primary" onclick="javascript:get_sets();" id="choose_next">Choose Next Set</button>
	<div id="game_over"></div>
  </div>


  <div class="row">
  <div class="panel panel-info col-md-6">
    <div class="panel-heading">Choose a set of numbers:</div>
    <div class="panel-body myheight">
    <div id="gen_nums"></div>
    	
    </div>
  </div>
  <div class="panel panel-info col-md-6">
    <div class="panel-heading">Chosen sets:</div>
    <div class="panel-body copied_height">
    	<div id="chosen"></div>
    </div>
  </div>
  </div>
</div>
<!--end body-->

<div style="clear:both;margin-bottom: 20px;">

<!--footer-->
<footer class="footer">
      <div class="container">
        <span class="text-muted">Dashboard: This dashboard will keep track of all the duplicate tiles generated for each round of three turns.</span>
        
        <div id="dash" class="text-muted">
	        <div id="dupe_nums">
	        	<span id="dupe_label" >Duplicate Tiles for this session:</span>
			</div>
        </div>
    </div>
    </footer>


<script
  src="http://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
  
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<link href="styles.css" rel="stylesheet">

	<script src="oe.js"></script>

</body>
</html>


