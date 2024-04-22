<?php
  $path = $_SERVER['DOCUMENT_ROOT'];
   $path .= "header.php";
   include_once("header.php");
   include_once("navbar.php");
?>
<html>
<head>
<style>
    body {
      background: url('picsched.gif') no-repeat center center fixed;
      background-size: cover;
      overflow: hidden; /* Prevent scrollbar due to the snowfall */
    }

    .snowfall {
      position: fixed;
      top: 0;
      left: 0;
      pointer-events: none; /* Make sure the snow doesn't interfere with user interaction */
      z-index: 9999; /* Set a high z-index to make sure it's above other elements */
      width: 100%;
      height: 100%;
      background-image: url('snow.gif'); /* Replace 'snow.gif' with the actual path to your snow GIF */
      animation: snowfall 10s linear infinite; /* Adjust animation duration as needed */
    }

    @keyframes snowfall {
      to {
        transform: translateY(100%);
      }
    }
  </style>
</head>
<body>
 
 <br><div class="container"> 
  <div class="row" align="center">
    <div class="col-lg-6">
		<div class="jumbotron">
                Here you will Assign your lecture time 
				<form class="form-horizontal" method= "post" action="add.time.php">
				<fieldset>

				<!-- Form Name -->
				<legend>Set Time</legend>
				
				<!-- Text input-->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="starttime">Start time</label>  
				  <div class="col-md-5">
				  <input id="starttime" name="starttime" type="text" placeholder="" class="form-control input-md" required="">
					
				  </div>
				</div>
				
				<!-- Text input-->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="endtime">End time</label>  
				  <div class="col-md-5">
				  <input id="endtime" name="endtime" type="text" placeholder="" class="form-control input-md" required="">
					
				  </div>
				</div>

				
				
				<!-- Button -->
				<div class="form-group"  align="right">
				  <label class="col-md-4 control-label" for="submit"></label>
				  <div class="col-md-5">
					<button id="submit" name="submit" class="btn btn-success">Add Time</button>
				  </div>
				</div>

				</fieldset>
				</form>
		</div>		
    </div>




<?php
  $path = $_SERVER['DOCUMENT_ROOT'];
   $path .= "footer.php";
   include_once("footer.php");
   include_once("navbar.php");
?>