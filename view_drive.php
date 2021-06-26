<?php
include "includes/header.php";

$total =0;
if(!isset($_SESSION['admin']))
{
    header("Location: login.php");
}
if(isset($_GET['delete']))
{
    $id = trim($_GET['delete']);
    $result = "DELETE FROM enrolled_students WHERE drive_id = '$id'";
    if(mysqli_query($con, $result)) 
    {
        $result = "DELETE FROM drive WHERE drive_id = '$id'";
        if (mysqli_query($con, $result)) 
        {
            echo "<script>alert('User Deleted Successfully')</script>";
            header("Location: all_student.php");
        } 
        else 
        {
            echo "<script>alert('Database Error Could not able to execute')</script>";
        }
    }
}
if(isset($_GET['id']))
{
    $get_id = trim($_GET['id']);
    $sql = "SELECT * FROM drive,company WHERE drive.comp_id=company.comp_id AND drive_id='$get_id'";
    $result = mysqli_query($con, $sql);
    if($row = mysqli_fetch_assoc($result)) {
        $drive_id = trim($row['drive_id']);
        $drive_title = trim($row['drive_title']);
        $comp_name = trim($row['comp_name']);
        $comp_city = trim($row['comp_city']);
        $comp_link = trim($row['comp_link']);
        $position = trim($row['job_position']);
        $job_profile = trim($row['job_profile']);
        $job_profile = htmlspecialchars(str_replace("'"," ",$job_profile));
        $dod = trim($row['dod']);
        $salary = trim($row['salary']);
        $ssc_result = trim($row['ssc_result']);
        $hsc_result = trim($row['hsc_result']);
        $graduation_result = trim($row['graduation_result']);
        $sql = "SELECT count(user_id) as total FROM enrolled_students WHERE drive_id='$drive_id'";
        $result = mysqli_query($con,$sql);
        if($row3 = mysqli_fetch_assoc($result))
            $total = $row3['total'];
    }
    else
    {
        header("Location: dashboard.php");
    }
}
else
{
    header("Location: dashboard.php");
}

?>
    <div class="col-md-9 main">
    <!--banner-section&nbsp&nbsp&nbsp-->
    <div class="banner-section">
        <h3 class="tittle">DRIVE INFORMATION
           <a href="view_drive.php?id=<?php echo $drive_id; ?>&delete=<?php echo $drive_id; ?>"><i class="glyphicon glyphicon-trash"></i></h3>
        <!--/top-currents-->
        <div class="top-news">
            <div class="top-inner">
                <?php
                    echo '
                    <div class="row">
                        <div class="col-md-4 top-text" style="padding: 20px">
                            <h4 class="top">'.$drive_title.'</h4>
                                <div style="font-size: medium;font-weight: initial;padding: 10px;">
                                    <p>On '.$dod.'</p>
                                </div>
                        </div>
                        <div class="col-md-6 top-text" style="padding: 20px">
                            <h4>ELIGIBILITY CRITERION</h4>
                                <div style="font-size: medium;font-weight: initial;padding: 10px;">
                                    <p>MINIMUM SSC % : '.$ssc_result.'</p>
                                    <p>MINIMUM HSC % : '.$hsc_result.'</p>
                                    <p>MINIMUM GRADUATION cgpa : '.$graduation_result.'</p>
                                </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 top-text" style="padding: 20px">
                            <h4>JOB PROFILE</h4>
                                <div style="font-size: medium;font-weight: initial;padding: 10px;">
                                    <p>'.$job_profile.'</p>
                                 </div>
                        </div>
                        <div class="col-md-8 top-text" style="padding: 20px">
                            <h4>COMPANY DETAILS </h4>
                                <div style="font-size: medium;font-weight: initial;padding: 10px;">
                                    <p>COMPANY NAME: '.$comp_name.'</p>
                                    <p>CITY LOCATION: '.$comp_city.'</p>
                                    <p style="color: #d58512"><u><i><a href="http://'.$comp_link.'" target="_blank"> '.$comp_link.'</a></u></i></p>
                                </div>
                        </div>
                    </div>
                    <div class="row">  
                        <div class="col-md-4 top-text" style="padding: 20px">
                            <h4>ENROLLED STUDENTS</h4>
                                <div style="font-size: medium;font-weight: initial;padding: 10px;">
                                    <p>TOTAL # STUDENTS - APPLIED:: '.$total.'</p><br>
                                    <a href="view_student.php?id='.$drive_id.'"> <button class="btn-primary">VIEW STUDENTS - APPLIED</button></a>
                                </div>
                        </div>
                    </div>   
                                ';
                ?>
            </div>
                <div class="clearfix"> </div>
        </div>
        <!--//top-current-->
    </div>
    <!--//banner-section-->
    <div class="banner-right-text">
        <h3 class="tittle">TOP COMPANIES</h3>
        <!--/general-news-->
        <div class="general-news">
            <div class="general-inner">
                <div class="edit-pics">
                    <?php
                    $sql = "SELECT *
                                    FROM company,drive 
                                    WHERE company.comp_id=drive.comp_id
                                    GROUP BY drive.comp_id
                                    ORDER BY count(drive.comp_id) desc
                                    LIMIT 5";
                    $result = mysqli_query($con, $sql);
                    while($row = mysqli_fetch_assoc($result)) { {
                        $id = $row['comp_id'];
                        $name = $row['comp_name'];
                        $branch = $row['comp_city'];
                        $url = $row['comp_link'];

                        echo '
                                    <div class="editor-pics">
                                        <div class="col-md-10 item-details" style="border: #14bcd5 solid 1px; padding: 10px">
                                    <h4 class="inner two"><a href="view_company.php?id='.$id.'">'.$name.'</a>
                                    </h4>
                                    <h5>LOCATION: '.$branch.'&nbsp&nbsp&nbsp
                                    <a href="http://'.$url.'" target="_blank">'.$url.'</a>
                                    </h5>
                                </div>
                                    <div class="clearfix"></div>
                                    ';
                    }
                    }
                    ?>
                </div>
                </div>
                </div>
                </div>

                </div>
            </div>
        </div>
        <!--/companies-->
    </div>
    <div class="clearfix"> </div>
    <!--/footer-->
<?php
include "includes/footer.php";
?>