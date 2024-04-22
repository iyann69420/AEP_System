<?php 
 include_once("header.php");
?>

<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<style type="text/css">
   .navbar-default {
        background-color: #4d4855;
        border-color: #4d4855;
        color: white;
    }

    .navbar-default .navbar-brand {
        color: white;
    }

    .navbar-default .navbar-nav > li > a {
        color: white;
    }

    .navbar-default .navbar-nav > li > a:hover,
    .navbar-default .navbar-nav > li > a:focus {
        
    }

    .navbar-default .navbar-nav > .active > a,
    .navbar-default .navbar-nav > .active > a:hover,
    .navbar-default .navbar-nav > .active > a:focus {
        
        color: white;
    }

    .navbar-default .navbar-nav > .open > a,
    .navbar-default .navbar-nav > .open > a:hover,
    .navbar-default .navbar-nav > .open > a:focus {
        
        color: white;
    }

    .navbar-default .navbar-toggle {
        
    }

    .navbar-default .navbar-toggle:hover,
    .navbar-default .navbar-toggle:focus {
        ;
    }

    .navbar-default .navbar-toggle .icon-bar {
        background-color: white;
    }

    .navbar-default .navbar-collapse,
    .navbar-default .navbar-form {
        
    }

    .navbar-default .navbar-link {
        color: white;
    }

    .navbar-default .navbar-link:hover {
        color: #000000;
    }

    .navbar-right {
        margin-right: 15px;
    }
</style>
<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
   <!-- <div class="navbar-header">
      <a class="navbar-brand" href="home.php"> Create Your Schedule</a>
    </div>-->
    <div>
	
	
    <ul class="nav navbar-nav">
       <!-- <li><a href="home.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>-->
        <li><a href="addsubject.php"><span class="glyphicon glyphicon-plus-sign"></span> Subjects</a></li>
        <li><a href="addfaculty.php"><span class="glyphicon glyphicon-plus-sign"></span> Faculty</a></li> 
        <li><a href="addcourse.php"><span class="glyphicon glyphicon-plus-sign"></span> Course</a></li>
		<li><a href="addroom.php"><span class="glyphicon glyphicon-asterisk"></span> Room</a></li>
		<li><a href="addtime.php"><span class="glyphicon glyphicon-time"></span> Time</a></li>
        <!--<li><a href="list.php"><span class="glyphicon glyphicon-list"></span> List</a></li>
        <li><a href="tablelist.php"><span class="glyphicon glyphicon-calendar"></span> Print Schedule</a></li>
		        <li><a href="http://localhost/track-wise/student2/pages/schedindex.php"><span class="glyphicon glyphicon-calendar"></span> My Schedule</a></li>-->
		
    	</ul>
		<ul class="nav navbar-nav navbar-right">
		<li><a href="/track-wise/admin2/pages/dashboard.php"><span class="glyphicon glyphicon-log-out"></span> Back</a></li>
    </ul></div>
  </div>
</nav>

</body>
</html>





