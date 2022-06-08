<?php
/*
  Template Name:  track-legistation V2
 */
ini_set('display_errors', 'Off');
include_once('header-v2.php');

?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" type="text/css">

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
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
                ?>
                <div class="table-responsive">
                    <h1> <?php echo $bill['session_name']; ?></h1>
                    <table id="legislation-tab" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                
                                <th class="th-lg">
                                    Bill
                                </th>
                                <th class="th-lg">
                                    Summary
                                </th>
                                <th class="th-lg">
                                    Date
                                    <p style="white-space: nowrap;margin-bottom: 0;font-size: 10px;font-weight: 600;">(Last Action)</p>
                                </th>
                                <th class="th-lg">
                                    Last Action
                                </th>
                                <th class="th-lg">
                                    Follow
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach ($response['masterlist'] as $key => $bill) {
                                if ($key != 'session') {

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
                                    }

                                    echo '<tr>';
                                   
                                    echo '<td>
                                    <a href="/dashboard/legislation-details?bill-id=' . $bill['bill_id'] . '" target="_blank" class="bill-link" data-bill-id="' . $bill['bill_id'] . '">' . $bill['number'] . '</a>
                                    </td>';
                                    echo '<td>' . $bill['title'] . '</td>';
                                    if (!empty($bill['last_action_date']) || !empty($bill['last_action'])) {
                                        echo '<td data-sort="' . $diff->days . '"><span class="last_action_date" >' . $days . '</span></td>'; //date("Y-m-d", strtotime($bill['last_action_date']))
                                        echo '<td>' . $bill['last_action'] . '</td>';
                                    } else {
                                        echo '<td><span class="last_action_date">-</span></td>';
                                        echo '<td><span class="no_action_history">No Action History Available</span></td>';
                                    }
                                    // echo '<td style="text-align: center;">
                                    //       <i class="knova-follow fa fa-heart-o" aria-hidden="true" 
                                    //       data-content-type="3"
                                    //       data-user-id="1"
                                    //       data-content-id="'. $bill['bill_id'] .'"></i>
                                    //       </td></tr>';
                                    $pd_follow_sc = do_shortcode('[pd_follow content_id="' . $bill['bill_id'] . '" content_type="2" user_id="1"]');
                                    echo '<td style="text-align: center;">
                                ' . $pd_follow_sc . '
                                </td></tr>';
                                }
                            } ?>
                            </tbody>
                    </table>
                </div>  


            </div>
        </div>
    </section>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
    // jQuery(document).ready(function($) {
    //             // $.fn.dataTable.moment( 'DD-MM-YYYY' );
    //             //$.fn.dataTable.moment( 'YYYY-DD-MM' );
    //             $('#legislation-table').DataTable();
    $(document).ready(function () {
        //$.fn.dataTable.moment( 'YYYY-DD-MM' );
        $('#legislation-tab').DataTable({ 
        "pageLength": 50,
       "order": [[ 2, "asc" ]] 
      });
    });
</script>
<?php
include_once('footer-v2.php');
?>