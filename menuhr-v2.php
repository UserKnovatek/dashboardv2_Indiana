<?php

include_once( "votesmart/VoteSmart.php");

//$getDetailedBio = new VoteSmart('CandidateBio.getDetailedBio', Array('candidateId' => $_GET['can_id']));

$getDetailedBio = new VoteSmart('CandidateBio.getDetailedBio', Array('candidateId' => $_GET['can_id']));

//print_r($getDetailedBio);

$response_getDetailedBio = json_decode($getDetailedBio->getXml(), true);



$bio = $response_getDetailedBio['bio']['candidate'];

?>

<div class="container-fluid align">

	<div class="topimg"></div>

</div>

<div class="container sec">

	<div class="row">

	<div class="col-md-2">
     <?php if($bio['photo']){ ?>
      <img src="<?php echo $bio['photo']; ?>"  class="img-responsive img1"  >
        <?php } else{?>
        <img src="<?php echo home_url(); ?>/wp-content/uploads/2022/04/not_avail.png" class="img-responsive img1">
      <?php }?>
   </div>

		

	

	<div class="col-md-4">

		<div class="myalignmt">

		<h2><b><?php echo $bio['firstName'].' '.$bio['lastName']; ?></b></h2>

		<h6 style="color:#f90;"><?php echo $response_getDetailedBio['bio']['election']['parties']; ?></h6>
           <div class="template-demo">
                  <button type="button" class="btn btn-social-icon btn-outline-facebook"><i class="fa fa-facebook"></i></button>                                      
                  <button type="button" class="btn btn-social-icon btn-outline-twitter"><i class="fa fa-twitter"></i></button>
                  <button type="button" class="btn btn-social-icon btn-outline-google"><i class="fa fa-google"></i></button>
            </div></br>
            <div class="Contacicon">
                    <p class="inlive">  <button type="button" class="btn btn-warning nw"> <i class="fa fa-envelope"></i>
                     </button> <a href="mailto:Indian@gmail.com">indianacitizen@gmail.com</a></p>
                    <p class="inlive">  <button type="button" class="btn btn-warning nw"> <i class="fa fa-globe"></i>
                     </button> <a href="https://dev.indianacitizen.org/">www.indianacitizen.org</a></p>
                    <p class="inlive"> <button type="button" class="btn btn-warning nw"> <i class="fa fa-phone"></i>
                     </button> Tel: 123456789</p>
            </div>

		</div>

	</div>



<div class="col-md-5">

	<div class="btnclass">

		<a href="<?php echo get_home_url();?>/dashboard/my-representative">

		<button type="button" class="btn btn-warning new2">See More Candidate</button>

		</a>

	</div>

<!-- 	<input type="submit" name="SUBMIT" value="See More Candidate" class="btn btn-warning btn1"> -->

	

</div>

</div>

</div>

<br>

<?php

$user=$_GET["can_id"];

?>

<div class="container cst">

<?php

$uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));



?>

<ul class="nav nav-tabs">

  <li class="nav-item">

    <a class="nav-link <?php if($uriSegments[2] == 'candidate-summary'){echo 'active cstact';}?> " href="<?php echo get_home_url();?>/my-representative/candidate-summary?can_id=<?php echo $user; ?>">Bio</a>

  </li>

  <!-- <li class="nav-item">

    <a class="nav-link " href="<?php echo get_home_url();?>/my-representative/candidate-bio">Key Votes Org</a>

  </li> -->

  <li class="nav-item">

    <a class="nav-link <?php if($uriSegments[3] == 'key-votes'){echo 'active cstact';}?>" href="<?php echo get_home_url();?>/my-representative/key-votes?can_id=<?php echo $user; ?>">Key Votes</a>

  </li> 

  <!-- <li class="nav-item">

    <a class="nav-link " href="<?php echo get_home_url();?>/my-representative/#">Professional Career</a>

  </li> -->

  <!-- <li class="nav-item">

    <a class="nav-link " href="<?php echo get_home_url();?>/my-representative/#">Education</a>

  </li>

  <li class="nav-item">

    <a class="nav-link " href="<?php echo get_home_url();?>/my-representative/#">Committees</a>

  </li>

  <li class="nav-item">

    <a class="nav-link " href="<?php echo get_home_url();?>/my-representative/#">District Info</a>

  </li> -->

  <li class="nav-item">

    <a class="nav-link <?php if($uriSegments[3] == 'ratingsab'){echo 'active cstact';}?>" href="<?php echo get_home_url();?>/my-representative/ratingsab?can_id=<?php echo $user; ?>">Ratings</a>

  </li>

  <li class="nav-item">

    <a class="nav-link <?php if($uriSegments[3] == 'issues'){echo 'active cstact';}?>" href="<?php echo get_home_url();?>/my-representative/issues?can_id=<?php echo $user; ?>">Issues</a>

  </li>

  <li class="nav-item">

    <a class="nav-link <?php if($uriSegments[3] == 'tweets'){echo 'active cstact';}?>" href="<?php echo get_home_url();?>/my-representative/tweets?can_id=<?php echo $user; ?>">Social</a>

  </li>

</ul>

</div>