<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qrcode";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['logout'])) {
    $email = $_SESSION['email'];
    $logout_time = date("Y-m-d H:i:s");
    $update_query = "UPDATE adminlogs SET time_out = '$logout_time' WHERE email = '$email'";
    $conn->query($update_query);

    session_destroy();
    header("Location: ../index.php");
    exit();
}

$email = $_SESSION['email'];
$select_query = "SELECT profile_pictures FROM adminlogs WHERE email = '$email'";
$result = $conn->query($select_query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $profilePicturePath = $row['profile_pictures'];
} else {
    $profilePicturePath = 'default_profile_picture.jpg';
}
?>

<style type="text/css">
    #dash-text {
        color: #fff;
    }
</style>

<div class="bg-sidebar vh-100% w-50 position-fixed" style="background-color: #4d4855;
background-image: linear-gradient(147deg, #4d4855 0%, #000000 74%);
">
    <div class="log d-flex justify-content-between" id="dash-text">
        <h1 class="E-classe text-start ms-3 ps-1 mt-3 h6 fw-bold">Administrator</h1>
        <i class="far fa-times h4 me-3 close align-self-end d-md-none"></i>
    </div>
    <div class="img-admin d-flex flex-column align-items-center text-center gap-2">
        <img class="rounded-circle" src="<?php echo $profilePicturePath; ?>" alt="img-admin" height="120" width="120">
        <h2 class="h6 fw-bold" id="dash-text"><?php echo $_SESSION['name']; ?></h2>
		   <span class="h7 admin-color" id="side-text" style="color: #04b7ee;">Admin</span>
    </div>
            <div class=" bg-list d-flex flex-column align-items-center fw-bold gap-2 mt-4 " >
                <ul class="d-flex flex-column list-unstyled" >
                        <li class="h7"><a class="nav-link text-dark" href="dashboard.php" ><i
                            class="fal fa-home-lg-alt me-2" id="dash-text"></i> <span id="dash-text" >Home</span></a></li>
                   <!-- <li class="h7"><a class=" nav-link text-dark" href="course.php"><i
                                class="fal fa-bookmark me-2"></i> <span>Reports</span></a></li>-->
                   
                            <!-- <li class="h7"><a class=" nav-link text-dark" href="unitlogs.php"><i
                                class="fas fa-cube me-2" id="dash-text"></i> <span id="dash-text">Unit Log 302</span></a></li>
								      <li class="h7"><a class=" nav-link text-dark" href="unitlogs2.php"><i
                                class="fas fa-cube me-2" id="dash-text"></i> <span id="dash-text">Unit Log 303</span></a></li>
								<li class="h7"><a class=" nav-link text-dark" href="unitsave302.php"><i
                                class="fas fa-user-graduate me-2" id="dash-text"></i> <span id="dash-text"> Unit Log 302 Archives</span></a></li>
								<li class="h7"><a class=" nav-link text-dark" href="unitsave303.php"><i
                                class="fas fa-user-graduate me-2" id="dash-text"></i> <span id="dash-text"> Unit Log 303 Archives</span></a></li>-->
								<li class="h7"><a class=" nav-link text-dark" href="unitreports.php"><i
                                class="fas fa-cube me-2" id="dash-text"></i> <span id="dash-text">UNIT Reports</span></a></li>
								<li class="h7"><a class=" nav-link text-dark" href="/track-wise/admin2/pages/Genereateunitqr/"><i
                                class="fas fa-cube me-2" id="dash-text"></i> <span id="dash-text">Generate Unit Qr</span></a></li>
					
                    <li class="h7"><a class=" nav-link text-dark" href="adminlogs.php"><i
                                class="fas fa-user-shield me-2"id="dash-text"></i> <span id="dash-text">Admin accounts</span></a></li>
								<li class="h7"><a class=" nav-link text-dark" href="facultylogs.php"><i
                                class="fas fa-chalkboard-teacher me-2" id="dash-text"></i> <span id="dash-text">Faculty Accounts</span></a></li>
								<li class="h7"><a class=" nav-link text-dark" href="studentlogs.php"><i
                                class="fas fa-user-graduate me-2" id="dash-text"></i> <span id="dash-text">Student accounts</span></a></li>
									
								  <li class="h7"><a class=" nav-link text-dark" href="\track-wise/admin2/pages/schedulesystem/home.php"><i
                                class="fas fa-calendar-plus me-2" id="dash-text"></i> <span id="dash-text">Add Schedules</span></a></li>
								 <li class="h7"><a class=" nav-link text-dark" href="adminregistration.php"><i
                                class="fas fa-user-plus me-2"id="dash-text"></i> <span id="dash-text">Registration</span></a></li>
								 <li class="h7"><a class=" nav-link text-dark" href="profile.php"><i
                                class="fas fa-user-plus me-2"id="dash-text"></i> <span id="dash-text">Profile</span></a></li>
								<!--  <li class="h7"><a class=" nav-link text-dark" href="resetindex.php"><i
                                class="fas fa-calendar-plus me-2" id="dash-text"></i> <span id="dash-text">Reset all</span></a></li>-->
                </ul>
              <ul class="logout d-flex justify-content-start list-unstyled">
            <!-- Add an id to the logout link -->
            <li class="h7">
                <a id="logout-link" class="nav-link text-dark" href="?logout=1">
                    <span id="dash-text">Logout</span><i class="fal fa-sign-out-alt ms-2" id="dash-text"></i>
                </a>
            </li>
        </ul>
            </div>

        </div>