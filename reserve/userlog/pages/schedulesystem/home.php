<?php

// php select option value from database

$hostname = "localhost";
$username = "root";
$password = "";
$databaseName = "qrcode";

// connect to mysql database

$connect = mysqli_connect($hostname, $username, $password, $databaseName);

// mysql select query
$query = "SELECT * FROM `course`";

// for method 1

$result1 = mysqli_query($connect, $query);

// for method 2
$query = "SELECT * FROM `faculty`";
$result2 = mysqli_query($connect, $query);

$options = "";

while($row2 = mysqli_fetch_array($result2))
{
    $options = $options."<option>$row2[1]</option>";
}
?>
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
	background-color: white;
    overflow-x: hidden; /* Hide horizontal scrollbar */
}
.row {
    position: relative;
    align-items:center;
    left:300px;
    

}
@media only screen and (max-width: 800px) {
  .row {
     position: relative;
     left:0;
     display:inline;
  }
}

@media only screen and (max-width: 600px) {
  .row {
     position: relative;
     left:0;
     display:inline;
  }
}
</style>
</head>
<body>
<br><div class="container">
	
  <div class="row" align="center">
    <div class="col-lg-6">
		<div class="jumbotron">
		Here you can add details schedules
		<form class="form-horizontal" method= "post" action = "add.home.php">
			<fieldset>

			<!-- Form Name -->
			<legend> Schedule</legend>


        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>

    <body>
        
		<!-- Method Two -->
        <div class="form-group">
			<label class="col-md-4 control-label" for="faculty">Faculty</label> 
			<div class="col-md-5">
		<select id="faculty" name="faculty" class="form-control">
            <?php echo $options;?>
        </select>
		</div>
		</div>
		
        <!--Method One-->
        <div class="form-group">
			<label class="col-md-4 control-label" for="Course">Course</label> 
			<div class="col-md-5">
		<select  id="course" name="course"  class="form-control">

            <?php while($row1 = mysqli_fetch_array($result1)):;?>

            <option  value="<?php echo $row1[2];?>"><?php echo $row1[2];?></option>

            <?php endwhile;?>

        </select>
        
        

		</div>		
    </div>
    </body>
</head>
</html>

<?php

// php select option value from database

$hostname = "localhost";
$username = "root";
$password = "";
$databaseName = "qrcode";

// connect to mysql database

$connect = mysqli_connect($hostname, $username, $password, $databaseName);

// mysql select query
$query = "SELECT * FROM `rooms`";

// for method 1

$result1 = mysqli_query($connect, $query);

// for method 2
$query = "SELECT * FROM `subject`";
$result2 = mysqli_query($connect, $query);


$options = "";

while($row2 = mysqli_fetch_array($result2))
{
    $options = $options."<option>$row2[2]</option>";
}

?>


<html>
<head>
</head>
<body>


        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>

    <body>
        
		<!-- Method Two -->
        <div class="form-group">
			<label class="col-md-4 control-label" for="subject">Subject</label> 
			<div class="col-md-5">
		<select  id="subject" name="subject"  class="form-control">
            <?php echo $options;?>
        </select>
		</div>
		</div>
		
        

            <?php while($row2 = mysqli_fetch_array($result2)):;?>

            <option value="<?php echo $row2[0];?>"><?php echo $row2[2];?></option>

            <?php endwhile;?>

        </select> 
		<?php

// php select option value from database

$hostname = "localhost";
$username = "root";
$password = "";
$databaseName = "qrcode";

// connect to mysql database

$connect = mysqli_connect($hostname, $username, $password, $databaseName);

// mysql select query
$query = "SELECT * FROM `rooms`";

// for method 1

$result1 = mysqli_query($connect, $query);

// for method 2
$query = "SELECT * FROM `rooms`";
$result2 = mysqli_query($connect, $query);


$options = "";

while($row2 = mysqli_fetch_array($result2))
{
    $options = $options."<option>$row2[1]</option>";
}

 
?>



<html>
<head>
</head>
<body>
<meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>

    <body>
        
		<!-- Method Two -->
        <div class="form-group">
			<label class="col-md-4 control-label" for="room">Room</label> 
			<div class="col-md-5">
		<select  id="room" name="room"  class="form-control">
            <?php echo $options;?>
        </select>
		</div>
		</div>
<div class="form-group">
    <label class="col-md-4 control-label" for="day">Day</label>
    <div class="col-md-5">
        <select id="day" name="day" class="form-control">
            <option value="Monday">Monday</option>
            <option value="Tuesday">Tuesday</option>
            <option value="Wednesday">Wednesday</option>
            <option value="Thursday">Thursday</option>
            <option value="Friday">Friday</option>
        </select>
    </div>
</div>



        <!--Method One-->
        
       

            <?php while($row2 = mysqli_fetch_array($result2)):;?>

            <option value="<?php echo $row2[0];?>"><?php echo $row2[1];?></option>
			

            <?php endwhile;?>

        </select>
        
	
        



<?php

// php select option value from database

$hostname = "localhost";
$username = "root";
$password = "";
$databaseName = "qrcode";

// connect to mysql database

$connect = mysqli_connect($hostname, $username, $password, $databaseName);

// mysql select query
$query = "SELECT * FROM `timer`";

// for method 1

$result1 = mysqli_query($connect, $query);

// for method 2
$query = "SELECT * FROM `timer`";
$result2 = mysqli_query($connect, $query);


$options = "";

while($row2 = mysqli_fetch_array($result2))
{
    $options = $options."<option>$row2[1]</option>";
}

 
?>



<html>
<head>
</head>
<body>
<meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>

    <body>
        
		
		
        <!--Method One-->
        <div class="form-group">
			<label class="col-md-4 control-label" for="start_time">Start time</label> 
			<div class="col-md-5">
		<select  id="start_time" name="start_time" class="form-control">
		  <?php echo $options;?>
       

            <?php while($row2 = mysqli_fetch_array($result2)):;?>

            <option value="<?php echo $row2[0];?>"><?php echo $row2[1];?></option>
			

            <?php endwhile;?>

        </select>
        
		</div>		
    </div>
    </body>
</head>

</html>
        

<?php

// php select option value from database

$hostname = "localhost";
$username = "root";
$password = "";
$databaseName = "qrcode";

// connect to mysql database

$connect = mysqli_connect($hostname, $username, $password, $databaseName);

// mysql select query
$query = "SELECT * FROM `timer`";

// for method 1

$result1 = mysqli_query($connect, $query);

// for method 2
$query = "SELECT * FROM `timer`";
$result2 = mysqli_query($connect, $query);


$options = "";

while($row2 = mysqli_fetch_array($result2))
{
    $options = $options."<option>$row2[2]</option>";
}

?>





        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>

    <body>
        
		<!-- Method Two -->
        <div class="form-group">
			<label class="col-md-4 control-label" for="end_time">End time</label> 
			<div class="col-md-5">
		<select  id="end_time" name="end_time" class="form-control">
            <?php echo $options;?>
        </select>
		</div>
		</div>
		
       

            <?php while($row2 = mysqli_fetch_array($result2)):;?>

            <option value="<?php echo $row2[0];?>"><?php echo $row2[1];?></option>

            <?php endwhile;?>

        </select>
		<!-- Button -->
				<!--<div class="form-group"  align="right">
				  <label class="col-md-4 control-label" for="submit"></label>
				  <div class="col-md-5">
					<button id="submit" name="insert" class="btn btn-primary"> Set </button>
				  </div>
				</div>-->
        
        
</fieldset>
			</form>
			
		</div>		
    </div>
    </body>
	
	
</head>

</html>





