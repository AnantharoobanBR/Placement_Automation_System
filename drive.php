<?php
include "includes/header.php";


if(!isset($_SESSION['name'])&&!isset($_SESSION['email'])){
    header("Location: profile.php");
}
$done =1;
if(isset($_GET['id'])){
    $get_id = trim($_GET['id']);
    $user_id = trim($_SESSION['id']);
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
    }else{
        header("Location: dashboard.php");
    }
    $sql = "SELECT * FROM enrolled_students WHERE user_id=$user_id AND drive_id=$get_id";
    $result = mysqli_query($con, $sql);
    if($row = mysqli_fetch_assoc($result)) {
        $done = 0;
    }

}else{
    header("Location: dashboard.php");
}

?>
    <div class="col-md-9 main">
    <!--banner-section-->
    <div class="banner-section">
        <h3 class="tittle"><a href="home.php"><span class="glyphicon glyphicon-arrow-left"></span> </a> Apply Now
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
                        <div class="col-md-4 top-text" style="padding: 20px">
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
                                        <p>'.nl2br($job_profile).'</p>
                                    </div>
                        </div>
                        <div class="col-md-4 top-text" style="padding: 20px">
                                    <h4>COMPANY DETAILS </h4>
                                    <div style="font-size: medium;font-weight: initial;padding: 10px;">
                                        <p>COMPANY NAME: '.$comp_name.'</p>
                                        <p>CITY LOCATION: '.$comp_city.'</p>
                                        <h4 style="color: #d58512"><u><i><a href="http://'.$comp_link.'" target="_blank"> '.$comp_link.'</a></u></i></h4>
                </div>
                                        ';
                if($done==1)
                echo '
                                        <div style="font-size:25px;font-weight: initial;padding-top: 25px;">
                                            <button class="btn-info"><a href="apply_now.php?id='.$drive_id.'">Enroll Now</a></button>
                                        </div>
                ';
                else
                    echo "<h4 style='padding-top: 20px'>You are Enrolled </h4>";

                echo '
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
                                    <h5>&nbspBranch: '.$branch.'&nbsp&nbsp&nbsp
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
        <!--/companies-->
    </div>
    </div>
    </div>
    <div class="clearfix"> </div>
    <!--/footer-->
<?php
include "includes/footer.php";
?>