<?php
/*
Template Name: Newsfeed page v2
 */
ini_set('display_errors', 'off');

include_once('header-v2.php'); 

?>

<div class="content-wrapper">


<!-- nav bar end -->
<div class="container">
    <form method="POST">
        <div class="col-sm-12">
            <label class="labl2" for="postdata">Select Your Interest. </label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" id="inlineCheckbox1" type="checkbox" value="post" 
                <?php if (in_array("post", $_POST['post_type_val'])) echo "checked='checked'"; ?>
                name="post_type_val[]">
                <label class="form-check-label camp-finac " for="inlineCheckbox1">CAMPAIGN FINANCE</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" id="inlineCheckbox2" type="checkbox" value="candidates"
                <?php if (in_array("candidates", $_POST['post_type_val'])) echo "checked='checked'"; ?>
                name="post_type_val[]">
                
                <label class="form-check-label criml-justi" for="inlineCheckbox2">CRIMINAL JUSTICE</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="civic_education" 
                <?php if (in_array("civic_education", $_POST['post_type_val'])) echo "checked='checked'"; ?>
                name="post_type_val[]">
                <label class="form-check-label rnirment" for="inlineCheckbox3">ENVIRONMENT</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input data" type="checkbox" id="inlineCheckbox4" value="funcding-nonfunding"
                <?php if (in_array("funcding-nonfunding", $_POST['post_type_val'])) echo "checked='checked'"; ?> name="post_type_val[]">
                <label class="form-check-label economy" for="inlineCheckbox4">ECONOMY</label>
            </div>
            <button type="submit" name="Submit" value="Submit" class="btn btn-outline-warning">Search</button>
        </div>
    </form>


</div>
<br>
<div class="container">
    <div class="row">
        <?php
        if (isset($_POST['Submit'])) {
            $newarry = $_POST['post_type_val'];
            $args_query = array(
                'post_type' => $newarry,
                'order' => 'DESC',
                'posts_per_page' => -1,
                'post_status' => 'publish',
            );
            $query = new WP_Query($args_query);
            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    if (isset($_POST['Submit'])) { ?>
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-header1" id="colorname1">
                                    <?php echo $name = get_post_type(); ?>
                                </div>
                                <div class="card-body">
                                    <?php $blogLayoutColImgz = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); ?>
                                    <!--  <img src="<?php // echo $blogLayoutColImgz[0]; 
                                                    ?>"  class="img-fluid1"/>  -->
                                    <h5 class="card-title1"><?php the_title(); ?></h5>
                                    <a href="<?php the_permalink(''); ?>">
                                        <button type="button" class="btn btn-primary btn-sm cntr">Know More </button>
                                    </a></br><hr>
                                    <h5 class="CurrentDta"><?php the_time('F jS, Y') ?></h5>
                                    <h5 class="postCatg">
                                        <?php
                                        $category = get_the_category($post->ID);
                                        if ($category) {
                                            echo $category[0]->cat_name;
                                        } else {
                                            echo $category[0]->cat_name;
                                        }
                                        ?>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
            } else {
                echo "<h3></h3>";
            }
        }
        wp_reset_postdata();
        ?>
    </div>
    
</div>

</div>


<?php include_once('footer-v2.php'); ?>