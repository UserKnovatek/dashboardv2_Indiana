<?php
/*
  Template Name: Twitter Template--V2
 */

include_once('header-v2.php');
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

    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class=twi-box>
                    <?php echo do_shortcode('[custom-twitter-feeds]'); ?>
                </div>
            </div>
        </div>
    </div>

</div>
<?php include_once('footer-v2.php'); ?>