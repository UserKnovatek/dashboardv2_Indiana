<?php
/*
  Template Name:  MY-Representative_google_csv--V2
 */
ini_set('display_errors', 'Off');
include_once('header-v2.php');

?>

<style>
    .circular--portrait img {
        width: 100%;
    }
</style>
<?php
include_once("vendor/autoload.php");

//include './vendor/autoload.php';

// Get the API client and construct the service object.

$client = new Google_Client();

$client->setApplicationName('app');

$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);

$client->setAuthConfig(get_template_directory() . '/credentials.json');

$client->setAccessType('offline');

$service = new Google_Service_Sheets($client);



// Prints the names and majors of students in a sample spreadsheet:

// https://docs.google.com/spreadsheets/d/1BxiMVs0XRA5nFMdKvBdBZjgmUUqptlbs74OgvE2upms/edit

$spreadsheetId = '1Bn5gYVDGIVqelsCMaDWpHLHLoyeMHTtk5ByjvNVygzg';

$range = 'All Candidates';

$response = $service->spreadsheets_values->get($spreadsheetId, $range);

$values = $response->getValues();
function search($array, $key, $value)
{
    $results = array();
    if (is_array($array)) {
        if (isset($array[$key]) && $array[$key] == $value) {
            $results[] = $array;
        }

        foreach ($array as $subarray) {
            $results = array_merge($results, search($subarray, $key, $value));
        }
    }
    return $results;
}

$data = search($values, 26, 'active');
// echo '<pre>';
// print_r($data);
?>
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <!-- /.col -->
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <form action="" method="post">
                        <div class="input-group mb-3 data1">
                            <?php
                            if (!empty($_GET['cd'])) {
                                $cd_input = $_GET['cd'];
                            }
                            $cd = search($data, 19, $cd_input);
                            foreach ($cd as $val) {
                                $arrcd[] = $val[13];
                            }
                            //$arr = array_values(array_unique($arr));
                            if (!empty($_GET['sd'])) {
                                $sd_input = $_GET['sd'];
                            }
                            $sd = search($data, 20, $sd_input);
                            foreach ($sd as $val) {
                                $arrsd[] = $val[13];
                            }
                            if (!empty($_GET['hd'])) {
                                $hd_input = $_GET['hd'];
                            }
                            $hd = search($data, 21, $hd_input);
                            foreach ($hd as $val) {
                                $arrhd[] = $val[13];
                            }
                            if (!empty($_GET['cb'])) {
                                $cb_input = $_GET['cb'];
                            }
                            $cb = search($data, 22, $cb_input);
                            foreach ($cb as $val) {
                                $arrcb[] = $val[13];
                            }
                            $arr[] = array_merge((array)$arrcd, (array)$arrsd, (array)$arrhd, (array)$arrcb);
                            // echo'<pre>';
                            // print_r($arr);
                            ?>
                            <select name="offc_category" id="ofc_cat" class="form-control">
                                <option value="">Select Office Category</option>
                                <option value="show_hide">Show All</option>
                                <?php
                                foreach ($arr as $val) {
                                    for ($i = 0; $i < sizeof($val); $i++) {
                                        $sec_id = str_replace(' ', '_', $val[$i]);
                                ?>
                                        <option value="<?php echo $sec_id; ?>"><?php echo $val[$i]; ?></option>
                                <?php }
                                } ?>
                            </select>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


    <section class="content">
        <div class="container-fluid">

            <?php
            $uss_input = '0';
            $uss = search($data, 19, $uss_input);
            // echo '<pre>';
            // print_r($uss);
            foreach ($uss as $us_val) {
                $arr_uss[] = $us_val[13];
            }
            ?>
            <!-- US Senator starts -->
            <div class="row show_hide">
                <?php  echo '<h2 style="text-align:center;"> ' . $arr_uss[0] . ' </h2>';
                foreach ($uss as $fd) { ?>
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-header1 <?php echo $fd[16]; ?>"><?php echo $fd[16]; ?></div>
                            <div class="card-body">
                                <div class="circular--portrait">
                                    <img src="https://static.votesmart.org/canphoto/193495.jpg" />
                                </div>
                                <h3 class="card-title"><?php if ($fd[15]) {
                                                            echo $fd[15];
                                                        } ?></h3>
                                <?php
                                echo $pd_follow_sc = do_shortcode('[pd_follow content_id="' . $fd[23] . '" content_type="1" user_id="6"]'); ?>
                                <hr class="hrline">
                                <div class="row">
                                    <div class="col-sm">
                                        <p class="card-text">Ballot Order </p>
                                        <h4 class="card-title"><?php echo $fd[14]; ?></h4>
                                        <p class="card-text">Office</p>
                                        <!-- <h4 class="card-title">candidateId : <?php // echo $fd['0']; 
                                                                                    ?></h4> -->
                                        <p class="card-title1"> <?php echo $fd['4']; ?></p>
                                    </div>
                                    <div class="col-sm">
                                        <p class="card-text">Terms End</p>
                                        <h4 class="card-title">2022</h4>
                                        <p class="card-text">Last Elected</p>
                                        <h4 class="card-title">2022</h4>
                                    </div>
                                </div>
                                <a class=" btn btn-warning" href="/my-representative/candidate-summary/?can_id=<?php echo $fd['23']; ?>">Detail Bio</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <!-- US Senator ends -->
            <!-- Secretary of State starts -->

            <!-- Secretary of State ends -->
            <!-- US Representative starts -->
            <div class="row show_hide <?php print(str_replace(' ', '_', $arrcd[0])); ?>">
                <?php if (isset($_GET["cd"])) {
                    echo '<h2 style="text-align:center;"> ' . $arrcd[0] . ' </h2>';
                    foreach ($cd as $fd) { ?>
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-header1 <?php echo $fd[16]; ?>"><?php echo $fd[16]; ?></div>
                                <div class="card-body">
                                    <div class="circular--portrait">
                                        <img src="https://static.votesmart.org/canphoto/193495.jpg" />
                                    </div>
                                    <h3 class="card-title"><?php if ($fd[15]) {
                                                                echo $fd[15];
                                                            } ?></h3>
                                    <?php
                                    echo $pd_follow_sc = do_shortcode('[pd_follow content_id="' . $fd[23] . '" content_type="1" user_id="6"]'); ?>
                                    
                                    <hr class="hrline">
                                    <div class="row">
                                        <div class="col-sm">
                                            <p class="card-text">Ballot Order </p>
                                            <h4 class="card-title"><?php echo $fd[14]; ?></h4>
                                            <p class="card-text">Office</p>
                                            <!-- <h4 class="card-title">candidateId : <?php // echo $fd['0']; 
                                                                                        ?></h4> -->
                                            <p class="card-title1"> <?php echo $fd['4']; ?></p>
                                        </div>
                                        <div class="col-sm">
                                            <p class="card-text">Terms End</p>
                                            <h4 class="card-title">2022</h4>
                                            <p class="card-text">Last Elected</p>
                                            <h4 class="card-title">2022</h4>
                                        </div>
                                    </div>
                                    <a class=" btn btn-warning" href="/my-representative/candidate-summary/?can_id=<?php echo $fd['23']; ?>">Detail Bio</a>
                                </div>
                            </div>
                        </div>
                <?php }
                } ?>
            </div>
            <!-- US Representative ends -->
            <!-- State Senator starts -->
            <div class="row show_hide <?php print(str_replace(' ', '_', $arrsd[0])); ?>">
                <?php if (isset($_GET["sd"])) {
                    echo '<h2 style="text-align:center;"> ' . $arrsd[0] . '</h2>';
                    foreach ($sd as $fd) { ?>
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-header1 <?php echo $fd[16]; ?>"><?php echo $fd[16]; ?></div>
                                <div class="card-body">
                                    <div class="circular--portrait">
                                        <img src="https://static.votesmart.org/canphoto/193495.jpg" />
                                    </div>
                                    <h3 class="card-title"><?php if ($fd[15]) {
                                                                echo $fd[15];
                                                            } ?></h3>
                                    <?php
                                    echo $pd_follow_sc = do_shortcode('[pd_follow content_id="' . $fd[23] . '" content_type="1" user_id="6"]'); ?>
                                    <hr class="hrline">
                                    <div class="row">
                                        <div class="col-sm">
                                            <p class="card-text">Ballot Order </p>
                                            <h4 class="card-title"><?php echo $fd[14]; ?></h4>
                                            <p class="card-text">Office</p>
                                            <!-- <h4 class="card-title">candidateId : <?php // echo $fd['0']; 
                                                                                        ?></h4> -->
                                            <p class="card-title1"> <?php echo $fd['4']; ?></p>
                                        </div>
                                        <div class="col-sm">
                                            <p class="card-text">Terms End</p>
                                            <h4 class="card-title">2022</h4>
                                            <p class="card-text">Last Elected</p>
                                            <h4 class="card-title">2022</h4>
                                        </div>
                                    </div>
                                    <a class=" btn btn-warning" href="/my-representative/candidate-summary/?can_id=<?php echo $fd['23']; ?>">Detail Bio</a>
                                </div>
                            </div>
                        </div>
                <?php }
                } ?>
            </div>
            <!-- State Senator ends -->
            <!-- house district starts -->
            <div class="row show_hide <?php print(str_replace(' ', '_', $arrhd[0])); ?>">
                <?php if (isset($_GET["hd"])) {
                    echo '<h2 style="text-align:center;"> ' . $arrhd[0] . ' </h2>';
                    foreach ($hd as $fd) { ?>
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-header1 <?php echo $fd[16]; ?>"><?php echo $fd[16]; ?></div>
                                <div class="card-body">
                                    <div class="circular--portrait">
                                        <img src="https://static.votesmart.org/canphoto/193495.jpg" />
                                    </div>
                                    <h3 class="card-title"><?php if ($fd[15]) {
                                                                echo $fd[15];
                                                            } ?></h3>
                                    <?php
                                    echo $pd_follow_sc = do_shortcode('[pd_follow content_id="' . $fd[23] . '" content_type="1" user_id="6"]'); ?>
                                    <hr class="hrline">
                                    <div class="row">
                                        <div class="col-sm">
                                            <p class="card-text">Ballot Order </p>
                                            <h4 class="card-title"><?php echo $fd[14]; ?></h4>
                                            <p class="card-text">Office</p>
                                            <!-- <h4 class="card-title">candidateId : <?php // echo $fd['0']; 
                                                                                        ?></h4> -->
                                            <p class="card-title1"> <?php echo $fd['4']; ?></p>
                                        </div>
                                        <div class="col-sm">
                                            <p class="card-text">Terms End</p>
                                            <h4 class="card-title">2022</h4>
                                            <p class="card-text">Last Elected</p>
                                            <h4 class="card-title">2022</h4>
                                        </div>
                                    </div>
                                    <a class=" btn btn-warning" href="/my-representative/candidate-summary/?can_id=<?php echo $fd['23']; ?>">Detail Bio</a>
                                </div>
                            </div>
                        </div>
                <?php }
                } ?>
            </div>
            <!-- house district ends -->
            <!-- County Boundaries starts -->
            <div class="row show_hide <?php print(str_replace(' ', '_', $arrcb[0])); ?>">
                <?php if (isset($_GET["cb"])) {
                    echo '<h2 style="text-align:center;"> ' . $arrcb[0] . ' </h2>';
                    foreach ($cb as $fd) { ?>
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-header1 <?php echo $fd[16]; ?>"><?php echo $fd[16]; ?></div>
                                <div class="card-body">
                                    <div class="circular--portrait">
                                        <img src="https://static.votesmart.org/canphoto/193495.jpg" />
                                    </div>
                                    <h3 class="card-title"><?php if ($fd[15]) {
                                                                echo $fd[15];
                                                            } ?></h3>
                                    <?php
                                    echo $pd_follow_sc = do_shortcode('[pd_follow content_id="' . $fd[23] . '" content_type="1" user_id="6"]'); ?>
                                    <hr class="hrline">
                                    <div class="row">
                                        <div class="col-sm">
                                            <p class="card-text">Ballot Order </p>
                                            <h4 class="card-title"><?php echo $fd[14]; ?></h4>
                                            <p class="card-text">Office</p>
                                            <!-- <h4 class="card-title">candidateId : <?php // echo $fd['0']; 
                                                                                        ?></h4> -->
                                            <p class="card-title1"> <?php echo $fd['4']; ?></p>
                                        </div>
                                        <div class="col-sm">
                                            <p class="card-text">Terms End</p>
                                            <h4 class="card-title">2022</h4>
                                            <p class="card-text">Last Elected</p>
                                            <h4 class="card-title">2022</h4>
                                        </div>
                                    </div>
                                    <a class=" btn btn-warning" href="/my-representative/candidate-summary/?can_id=<?php echo $fd['23']; ?>">Detail Bio</a>
                                </div>
                            </div>
                        </div>
                <?php }
                } ?>
            </div>
            <!-- County Boundaries ends -->

        </div>
    </section>
</div>

<script>
    jQuery(document).ready(function($) {
        $('#ofc_cat').on('change', function() {
            if (this.value == "") {
                $('show_hide').show();
            } else {
                $('.show_hide').hide();
                $('.' + (this.value)).show();
            }
        });
    });
</script>
<?php include('footer-v2.php') ?>