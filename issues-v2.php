<?php
/*
  Template Name: Issues Template--V2
 */

include_once('header-v2.php');
include_once("votesmart/VoteSmart.php");
include_once("candi-issues.php");
?>

<?php

$getDetailedBio = new VoteSmart('CandidateBio.getDetailedBio', array('candidateId' => $_GET['can_id']));
// $getDetailedBio = new VoteSmart('CandidateBio.getDetailedBio', Array('candidateId' => '148534'));
$response_getDetailedBio = json_decode($getDetailedBio->getXml(), true);


$bio = $response_getDetailedBio['bio']['candidate'];
?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <!-- /.col -->
                <!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <?php include_once('menuhr-v2.php');    ?>

    <div class="container myclass1">
        <div id="tab-1" class="tab-content current">
            <h3>Issues</h3>
            <?php
            get_candidate_issues();
            ?>
        </div>
    </div>

</div>



<!--  -->


<!--  -->
<?php include_once('footer-v2.php'); ?>