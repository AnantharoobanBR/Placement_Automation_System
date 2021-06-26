<?php
include "includes/header.php";
$set_value = 1;
$error = '0';
if(isset($_GET['id'])){
    $id = trim($_GET['id']);
    $sql = "SELECT *
               FROM users,profile
               WHERE user_id='$id' AND user_id=uid";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    $name = $row['user_name'];
    $email = $row['user_email'];

    if($row['resume']=="")
        $resume = 'dr.pdf';
    else
        $resume = $row['resume'];

    if($row['profile_image']=="")
        $profile_image = 'co.png';
    else
        $profile_image = $row['profile_image'];

    if($row['mobile']=="")
        $mobile = 'Incomplete profile';
    else
        $mobile = $row['mobile'];

    if($row['dob']=="")
        $dob = 'Incomplete profile';
    else
        $dob = $row['dob'];

    if($row['ssc_marks']==0)
        $ssc_marks = 'Incomplete profile';
    else
        $ssc_marks = $row['ssc_marks'];

    if($row['hsc_marks']==0)
        $hsc_marks = 'Incomplete profile';
    else
        $hsc_marks = $row['hsc_marks'];

    if($row['graduation']=="")
        $graduation = 'Incomplete profile';
    else
        $graduation = $row['graduation'];

    if($row['graduation_discipline']=="")
        $graduation_discipline = 'Incomplete profile';
    else
        $graduation_discipline = $row['graduation_discipline'];

    if($row['graduation_marks']==0)
        $graduation_marks = 'Incomplete profile';
    else
        $graduation_marks = $row['graduation_marks'];

    if($row['gender']=="")
        $gender = 'Incomplete profile';
    else
        $gender = $row['gender'];
}
?>
    <div class="col-md-12 main" style="padding-top: 20px;">
        <!-- login-page -->
        <div class="col-md-3" >
            <center>
                <img src="image_uploads/<?php echo $profile_image; ?>" width="150px" class="img-responsive" alt="profile-Image">
            </center>
        </div>
        <div class="col-md-5">
            <div class="outer">
                <div class="middle">
                    <div class="inner">
                        <h1><?php echo $name; ?></h1>
                        <p><?php echo $email; ?></p>
                        <br>
                        <div class="col-md-6">
                            <h4><a href="resume_uploads/<?php echo $resume; ?>" target="_blank"><u><i class="glyphicon glyphicon-file"></i>View Resume</u></a></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="col-md-12 main" style="padding-top: 20px;">
        <div class="col-md-1">
        </div>
        <div class="col-md-8"">
        <h4>ADMIN VIEW - PERSONAL INFORMATION</h4>
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

            th {
                background-color: rgba(18, 149, 201, 0.69);
                color: white;
            }
        </style>
        <table border="3px" width="100%">
            <tr>
                <th>NAME</th>
                <td><?php echo $name; ?></td>
            </tr>
            <tr>
                <th>MAIL-ID</th>
                <td><?php echo $email; ?></td>
            </tr>
            <tr>
                <th>CONTACT NO.</th>
                <td><?php echo $mobile; ?></td>
            </tr>
            <tr>
                <th>DATE OF BIRTH</th>
                <td><?php echo $dob; ?></td>
            </tr>
            <tr>
                <th>GENDER</th>
                <td><?php echo $gender; ?></td>
            </tr>
        </table>
        <br>
        <h4>ADMIN VIEW - EDUCATIONAL INFORMATION</h4>
        <table border="3px" width="100%">
            <tr>
                <th>SSC % SCORED</th>
                <td><?php echo $ssc_marks; ?></td>
            </tr>
            <tr>
                <th>HSC % SCORED</th>
                <td><?php echo $hsc_marks; ?></td>
            </tr>
            <tr>
                <th>GRADUATION - DEGREE</th>
                <td><?php echo $graduation; ?></td>
            </tr>
            <tr>
                <th>&nbsp&nbsp&nbsp&nbsp&nbspGRADUATION DISCIPLINE - FIELD OF STUDY</th>
                <td><?php echo $graduation_discipline; ?></td>
            </tr>
            <tr>
                <th>&nbsp&nbsp&nbsp&nbsp&nbspGRADUATION CGPA SCORED</th>
                <td><?php echo $graduation_marks; ?></td>
            </tr>
        </table>
        <br><br>
    </div>
<div class="clearfix"></div>
    <div class="col-md-1"></div>
    <div class="col-md-10">
    <h4>ADMIN VIEW - Companies that are enrolled in ::</h4>
        <?php
        $sql = "SELECT * FROM company 
                WHERE comp_id IN 
                (
                  SELECT comp_id
                  FROM drive
                  WHERE drive_id IN 
                  (
                    SELECT drive_id
                    FROM enrolled_students
                    WHERE user_id='$id'
                  )
                )";
        $result = mysqli_query($con, $sql);
        while($row = mysqli_fetch_assoc($result)){
            $id = $row['comp_id'];
            $name = $row['comp_name'];
            $branch = $row['comp_city'];
            $url = $row['comp_link'];
            echo '
                            <div class="editor-pics">
                                <div class="col-md-10 item-details" style="border: #14bcd5 solid 1px; padding: 10px">
                                    <h4 class="inner two"><a href="view_company.php?id='.$id.'">'.$name.'</a>
                                    </h4>
                                    <h5>&nbspBranch: '.$branch.'&nbsp&nbsp&nbsp
                                    <a href="http://'.$url.'" target="_blank">'.$url.'</a>
                                    </h5>
                                </div>
                            </div><br><br>
                        ';
        }
        ?>
    </div>
    <div class="col-md-1"></div>
<div class="clearfix"></div>
    </div>
    </div>
    <!-- //login-page -->
    <div class="clearfix"> </div>