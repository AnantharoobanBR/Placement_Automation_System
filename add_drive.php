<?php
include "includes/header.php";

if(isset($_SESSION['name'])&&isset($_SESSION['email'])){
    header("Location: profile.php");
}

$set_value = 0;
$error = '0';
if(isset($_REQUEST['drive_title'])&&isset($_REQUEST['comp_id'])&&
    isset($_REQUEST['position'])&&isset($_REQUEST['job_profile'])&&
    isset($_REQUEST['dod'])&&isset($_REQUEST['salary'])&&
    isset($_REQUEST['ssc_result'])&&isset($_REQUEST['hsc_result'])&&
    isset($_REQUEST['graduation_result'])){
    $drive_title = trim($_REQUEST['drive_title']);
    $comp_id = trim($_REQUEST['comp_id']);
    $position = trim($_REQUEST['position']);
    $job_profile = trim($_REQUEST['job_profile']);
    $job_profile = htmlspecialchars(str_replace("'"," ",$job_profile));
    $dod = trim($_REQUEST['dod']);
    $salary = trim($_REQUEST['salary']);
    $ssc_result = trim($_REQUEST['ssc_result']);
    $hsc_result = trim($_REQUEST['hsc_result']);
    $graduation_result = trim($_REQUEST['graduation_result']);
    $sql = "INSERT INTO drive
            (drive_title, comp_id, job_position, job_profile, dod, salary,
             ssc_result, hsc_result, graduation_result)
             VALUES ('$drive_title', '$comp_id', '$position', '$job_profile', '$dod',
             '$salary', '$ssc_result', '$hsc_result', '$graduation_result')";
    if ($result = mysqli_query($con, $sql)) {
        echo "<script>alert('Success!');</script>";
        header("Location: profile.php");
    }else
        $error = mysqli_error($con);
        echo "<script>alert('1');</script>";
}
?>
<div class="col-md-9 main">
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <ul class="nav navbar-nav">
                <li><a href="dashboard.php">VIEW ALL DRIVES</a></li>
                <li class="active"><a href="add_drive.php">ADD NEW DRIVE</a></li>
                <li><a href="add_company.php ">ADD COMPANY</a></li>
                <li><a href="all_student.php">VIEW ALL STUDENTS</a></li>
            </ul>
        </div>
    </nav>
    <div class="clearfix"> </div>

    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="col-md-1">
        </div>
        <div class="col-md-8"">
        <h4>DRIVE INFORMATION</h4>
        <style>
            table {
                border-collapse: collapse;
                width: 100%;
            }

            th, td {
                text-align: left;
                padding: 8px;
            }

            tr:nth-child(even){background-color: #f2f2f2}

            th{
                background-color: rgba(18, 149, 201, 0.69);
                color: white;
            }
            input[type="text"]{
                width: 100%;
                box-sizing: border-box;
                -webkit-box-sizing:border-box;
                -moz-box-sizing: border-box;
            }
            input[type=date] {
                height: 35px;
                margin: 0 auto;
                width: 100%;
                font-family: arial, sans-serif;
                font-size: 18px;
                font-weight: bold;
                text-transform: uppercase;
                outline: none;
                border: 0;
                border-radius: 3px;
                padding: 0 3px;
                color: #748b88;
            }
            textarea {
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                resize: none;
                width: 100%;}
        </style>
        <form method="post" action="add_drive.php" id="add_drive_form">
            <table border="3px" width="100%">
                <tr>
                    <th>DRIVE TITLE</th>
                    <td><input type="text" name="drive_title" required></td>
                </tr>
                <tr>
                    <th>COMPANY</th>
                    <td>
                        <select class="form-control" name="comp_id" required>
                            <option value=''>Select Company</option>
                            <?php
                            $sql = "SELECT * FROM company ORDER BY comp_id DESC ";
                            $result = mysqli_query($con, $sql);
                            while($row = mysqli_fetch_assoc($result)) {
                                $id = $row['comp_id'];
                                $name = $row['comp_name'];
                                echo "<option value='$id'>$name</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>JOB POSITION | ROLE</th>
                    <td><input type="text" name="position" required></td>
                </tr>
                <tr>
                    <th>JOB PROFILE</th>
                    <td><textarea rows="9" form="add_drive_form" name="job_profile" required></textarea></td>
                </tr>
                <tr>
                    <th>DATE OF THE DRIVE</th>
                    <td><input type="date" name="dod"required></td>
                </tr>
                <tr>
                    <th>SALARY IN INR</th>
                    <td><input type="number" name="salary" required></td>
                </tr>
            </table>
            <br>
            <h4>BASIC CRITERIA FOR THIS DRIVE</h4>
            <table border="3px" width="100%">
                <tr>
                    <th>SSC RESULT (%)</th>
                    <td><input type="number" step="any" name="ssc_result" min="0" max="100" required></td>
                </tr>
                <tr>
                    <th>HSC RESULT (%)</th>
                    <td><input type="number" step="any" name="hsc_result" min="0" max="100" required></td>
                </tr>
                <tr>
                    <th>GRADUATION RESULT (cgpa)</th>
                    <td><input type="number" step="any" name="graduation_result" min="0" max="100" required></td>
                </tr>
            </table>
            <br><br><center><a href="edit_profile.php"><input type="submit" value="SAVE THIS DRIVE" class="btn-info"></a>
                </center></a><br>
        </form>
    </div>
    <div class="col-md-1"></div>
</div>
<!-- //main -->
<div class="clearfix"> </div>
