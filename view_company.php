<?php
include "includes/header.php";

if(!isset($_SESSION['name'])&&!isset($_SESSION['email'])){
    header("Location: login.php");
}
if(isset($_SESSION['admin'])){
    header("Location: dashboard.php");
}

$comp_name = "Current_Placements";
if(isset($_GET['id'])) {
    $get_id = trim($_GET['id']);
    $sql = "SELECT * FROM company WHERE company.comp_id='$get_id'";
    if($result = mysqli_query($con, $sql)){
        $row = mysqli_fetch_assoc($result);
        $comp_name = $row['comp_name'];
    }
}else{
    header("Location: home.php");
}

?>
    <div class="col-md-9 main">
        <!--banner-section-->
        <div class="banner-section">
            <h3 class="tittle"><?php echo $comp_name; ?><i class="glyphicon glyphicon-"></i></h3>
            <!--/top-currents-->
            <div class="top-news">
                <div class="top-inner">
                    <?php
                    $sql = "SELECT * FROM drive,company 
                            WHERE drive.comp_id=company.comp_id 
                            AND company.comp_id='$get_id'";
                    $result = mysqli_query($con, $sql);
                    while($row = mysqli_fetch_assoc($result)) {
                        $drive_id = trim($row['drive_id']);
                        $drive_title = trim($row['drive_title']);
                        $comp_name = trim($row['comp_name']);
                        $comp_city = trim($row['comp_city']);
                        $comp_link = trim($row['comp_link']);
                        $position = trim($row['job_position']);
                        $job_profile = trim($row['job_profile']);
                        $dod = trim($row['dod']);
                        $salary = trim($row['salary']);
                        $ssc_result = trim($row['ssc_result']);
                        $hsc_result = trim($row['hsc_result']);
                        $graduation_result = trim($row['graduation_result']);
                        echo '<div class="col-md-5 top-text" style="border: #d58512 solid 1px; padding: 20px;margin: 25px">
                                <a href="drive.php?id='.$drive_id.'">
                                <img src="comp_image.php?name='.$comp_name.'&branch='.$comp_city.'&salary='.$salary.'&date='.$dod.'"
                                 class="img-responsive btn-social"  alt=""></a>
                                <h5 class="top"><a href="drive.php?id='.$drive_id.'">'.$drive_title.'</a></h5>
                                    <p></p>
                                    <p>On '.$dod.'<a class="span_link">
                                    <a class="span_link" href="drive.php?id='.$drive_id.'">
                                    <span class="glyphicon glyphicon-circle-arrow-right"></span> Apply Now</a></p>
                                </div>';
                    }
                     ?>
                    <div class="clearfix"> </div>
                </div>
            </div>
            <!--//top-current-->
        </div>
        <!--//banner-section-->
        <div class="banner-right-text">
            <h3 class="tittle">TOPiijokp'k;lmknm COMPANIES</h3>
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
                                        <div class="col-md-10 item-details" style="border: #14bcd5 solid 1px; padding: 10px;margin: 10px">
                                    <h4 class="inner two"><a href="view_company.php?id='.$id.'">'.$name.'</a>
                                    </h4>
                                    <h5>&nbspBranch: '.$branch.'&nbsp&nbsp&nbsp
                                    <a href="http://'.$url.'" target="_blank">'.$url.'</a>
                                    </h5>
                                </div>
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
        <div class="clearfix"> </div>
        <!--/footer-->
<?php
include "includes/footer.php";
?>

<!--

    company(comp_id, name)
    drive(drive_id, comp_id)

-->
