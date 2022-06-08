<?php
/*
  Template Name:  Following--V2
 */
ini_set('display_errors', 'Off');
include_once('header-v2.php');

?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" type="text/css">
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
?>



<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <!-- Custom Tabs -->
            <div class="card">
                <div class="card-header ">
                    <ul class="nav nav-pills ml-auto p-2">
                        <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Candidates Following</a></li>
                        <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Bills Following</a></li>
                        <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Bills We’re Tracking</a></li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <section class="col-lg-12 connectedSortable">
                                <div class="row">
                                    <?php
                                    $param = [

                                        'content_type' => '1',
                                        'user_id' => '6'
                                    ];
                                    $followed_representative = array();
                                    $representative_ids = pd_follow_get_following($param);


                                    foreach ($representative_ids as $representative) {
                                        $followed_representative[] = $representative->content_id . '<br/>';
                                    }



                                    $vote_smart = array();
                                    foreach ($values as $row => $v) {
                                        if (in_array((int)$v[23], $followed_representative)) {
                                            //echo $v[23].'<br>';
                                            //echo  $v[15] ; 
                                    ?>
                                            <div class="col-md-4">
                                                <div class="card mb-3">

                                                    <div class="card-header1 <?php echo $v[16];  ?>">Incumbent</div>
                                                    <div class="card-body">
                                                        <div class="circular--portrait">

                                                            <img src="https://dev.indianacitizen.org/wp-content/uploads/2022/04/not_avail.png" />
                                                        </div>
                                                        <h5 class="card-title-page"><a href="#"><?php echo $v[15]; ?></a></h5>
                                                        <?php echo $pd_follow_sc = do_shortcode('[pd_follow content_id="' . $v[23] . '" content_type="1" user_id="6"]'); ?>


                                                        <p class="card-text"><?php echo $v[13];  ?></p>

                                                        
                                                            <button type="button" class="<?php echo $v[16];  ?> btn btn-primary btn-sm cntr"><?php echo $v[16];  ?> </button>
                                                        
                                                            <hr class="hrline">
                                                        <div class="row">
                                                            <div class="col-sm">
                                                                <p class="card-text">Tenure </p>
                                                                <h4 class="card-title">2018-Present</h4>
                                                                <p class="card-text">Predecessor</p>
                                                                <h4 class="card-title"></h4>
                                                                <p class="card-text">Candidate Id</p>
                                                                <h4 class="card-title"> <?php echo $v[23];  ?></h4>

                                                            </div>
                                                            <div class="col-sm">
                                                                <p class="card-text">Terms End</p>
                                                                <h4 class="card-title">2022</h4>
                                                                <p class="card-text">Last Elected</p>
                                                                <h4 class="card-title">2022</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </section>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            <section class="content">
                                <div class="container-fluid">
                                    <div class="row">
                                        <section class="col-lg-12 connectedSortable">

                                            <section class="content" data-category="2">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="table-responsive">
                                                            <?php

                                                            $details_url = 'https://dev.indianacitizen.org/dashboard/legislation-details.php';
                                                            $request_url = 'https://api.legiscan.com/?key=7dd5093929ca86db0b59bfc04253490e&op=getMasterList&id=1955';
                                                            // $query = array_merge(array('key'=>$this->api_key,'op'=>$op), $params);

                                                            // $query_string = http_build_query($query);

                                                            // $this->request_url = 'https://api.legiscan.com/?' . $query_string;

                                                            $ch = curl_init();
                                                            curl_setopt($ch, CURLOPT_URL, $request_url);
                                                            curl_setopt($ch, CURLOPT_FAILONERROR, true);
                                                            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
                                                            curl_setopt($ch, CURLOPT_BUFFERSIZE, 64000);
                                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                                            // curl_setopt($ch, CURLOPT_USERAGENT, "LegiScan API Client " . LegiScan::VERSION);

                                                            $response = curl_exec($ch);
                                                            $response = json_decode($response, true);

                                                            // echo '<pre>';
                                                            // print_r($response);
                                                            // echo '</pre>';
                                                            $param_bill = [
                                                                'content_type' => '2',
                                                                'user_id' => '1'
                                                            ];
                                                            $followed_bills = array();
                                                            $bill_ids = pd_follow_get_following($param_bill);
                                                            // print_r($bill_ids);
                                                            foreach ($bill_ids as $followed_bill) {
                                                                $followed_bills[] = $followed_bill->content_id . '<br/>';
                                                            }
                                                            ?>
                                                            <!--Table-->
                                                            <h1> <?php echo $bill['session_name']; ?></h1>
                                                            <table id="legislation-table" class=" table table-bordered table-striped">
                                                                <!--Table head-->
                                                                <thead>
                                                                    <tr>

                                                                        <th class="th-lg">
                                                                            Bill
                                                                        </th>
                                                                        <th class="th-lg">Summary</th>
                                                                        <th class="th-lg">Date</th>
                                                                        <th class="th-lg">Last Action</th>
                                                                        <th class="th-lg">Follow</th>
                                                                    </tr>
                                                                </thead>
                                                                <!--Table head-->
                                                                <!--Table body-->
                                                                <tbody>
                                                                    <?php
                                                                    foreach ($response['masterlist'] as $key => $bill) {
                                                                        if ($key != 'session') {
                                                                            if (in_array($bill['bill_id'], $followed_bills)) {

                                                                                $last_action_date = new DateTime($bill['last_action_date']);
                                                                                $today = new DateTime("now");
                                                                                $diff = $today->diff($last_action_date);

                                                                                // print_r($diff);
                                                                                // wp_die( 'Done' );
                                                                                switch ($diff->days) {
                                                                                    case 0:
                                                                                        $days = 'Today';
                                                                                        break;
                                                                                    case 1:
                                                                                        $days = '1 day ago';
                                                                                        break;
                                                                                    default:
                                                                                        $days = $diff->days . ' days ago';
                                                                                } ?>
                                                                                <tr>

                                                                                    <td><a href="/dashboard/legislation-details.php?bill-id=<?php echo $bill['bill_id']; ?>" target="_blank" class="bill-link" data-bill-id="<?php echo $bill['bill_id']; ?>"><?php echo $bill['number']; ?></a></td>
                                                                                    <td><?php echo $bill['title']; ?></td>
                                                                                    <?php if (!empty($bill['last_action_date']) || !empty($bill['last_action'])) {
                                                                                        echo '<td data-sort="' . $diff->days . '"><span class="last_action_date">' . $days . '</span></td>';
                                                                                        echo '<td><span class="">' . $bill['last_action'] . '</span></td>';
                                                                                    } else {
                                                                                        echo '<td><span class="last_action_date">-</span></td>';
                                                                                        echo '<td><span class="no_action_history">No Action History Available</span></td>';
                                                                                    }
                                                                                    $pd_follow_sc = do_shortcode('[pd_follow content_id="' . $bill['bill_id'] . '" content_type="2" user_id="1"]');
                                                                                    echo '<td style="text-align: center;">' . $pd_follow_sc . '</td>';
                                                                                    ?>
                                                                                </tr><?php
                                                                                    }
                                                                                }
                                                                            } ?>
                                                                </tbody>
                                                                <!--Table body-->
                                                            </table>
                                                            <!--Table-->

                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </section>
                                    </div>
                                    <!-- /.content -->
                                </div>
                                <!-- /.content-wrapper -->
                            </section>
                        </div>
                        <!-- /.tab-pane -->

                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
            <!-- ./card -->
        </div>
        <!-- /.col -->
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#legislation-table').DataTable();
    });
</script>


<?php
include_once('footer-v2.php');
?>