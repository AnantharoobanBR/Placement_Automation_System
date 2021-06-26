<?php
include "includes/header.php";

if(isset($_SESSION['admin'])){
    header("Location: dashboard.php");
}
if(isset($_SESSION['name'])&&isset($_SESSION['email'])){
    header("Location: profile.php");
}

$set_value = 0;
$error = '0';
if(isset($_REQUEST['email'])&&isset($_REQUEST['pass'])){
    $email = trim($_REQUEST['email']);
    $pass = trim($_REQUEST['pass']);
    if($email=="admin@gmail.com"&&$pass=="admin"){
        $_SESSION['admin'] = true;
        header("Location: dashboard.php");
    }
    $pass = trim($_REQUEST['pass']);
    $sql = "SELECT *
               FROM users
               WHERE user_email='$email'
               AND user_pass='$pass'";
    $result = mysqli_query($con, $sql);
    $num_rows = mysqli_num_rows($result);
    if($num_rows>0)
    {
        $row = mysqli_fetch_array($result);
        $_SESSION['id'] = $row['user_id'];
        $_SESSION['name'] = $row['user_name'];
        $_SESSION['email'] = $row['user_email'];
        header("Location: home.php");
    } 
    else
    {
        $set_value = 1;
        $error = "Invalid Email or Password";
    }
}
?>
<div class="col-md-9 main">
	<!-- login-page -->
	<div class="login">
		<div class="login-grids">
			<div class="col-md-6 log">
					 <h3 class="tittle" id = "signin">LOGIN <i class="glyphicon glyphicon-lock"></i></h3>
					 <p id="login_instructions" style="display: block">WELCOME! Please enter the following Credentials,</p>
            <?php
            if($set_value==1){
                echo '<div id="error" style="display: block;">
                        <div class="alert alert-danger" role="alert"">
                        <i class="glyphicon glyphicon-lock"></i>
                        <strong>Error! : </strong> <span id="error_message">'.$error.'</span>
                        </div>
                        </div>';
            }
            ?>
                    <div id = "form-area" style="display: block">
                         <form id = "form" method="post" action="login.php">
                             <h5>REGISTERED MAIL ID :</h5>
                             <input type="email" name="email" value="" id="input-email" placeholder="Enter Your Email ID" required>
                             <h5>PASSWORD :</h5>
                             <input type="password" name="pass" value="" id="input-pass" placeholder="Enter Your Password" required>
                             <input type="submit" value="SIGN IN" id="input-submit" style="display: block">
                         </form>
                        <a href="#">FORGOT THE PASSWORD ?</a>
                    </div>
			</div>
            <div class="col-md-6 login-right">
                <h3 class="tittle">NOT REGISTERD YET ? <i class="glyphicon glyphicon-file"></i></h3>
                <p>Then, please register with our PLACEMENT AUTOMATION SYSTEM to move through the recruitment process faster,
                    view and apply to various companies by yourself and many more.</p>
                <a href="registration.php" class="hvr-bounce-to-bottom button">SIGN UP | REGISTER</a>
            </div>
            <div class="clearfix"></div>
		</div>
    </div>
</div>
<!-- //login-page -->
			<div class="clearfix"> </div>
<?php
include "includes/footer.php";
?>