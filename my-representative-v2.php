<?php
/*
Template Name: My Represntive page v2
 */
ini_set('display_errors', 'on');

include_once('header-v2.php');

include_once("votesmart/VoteSmart.php"); //get_template_directory_uri()."/dashboard
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8Oaptp9RRD6vRW7FFC9uFunniiYiQUIg&libraries=places"></script>
<script>
    $(document).ready(function() {
        google.maps.event.addDomListener(window, 'load', initialize);
    });

    function viewSelectedDistrictsData() {
        $('.cd').hide();
        $('.sd').hide();
        $('.hd').hide();
        $('.cb').hide();
        var districts = $('#districts').val();
        if (districts == "cd") {
            $('.cd').show();
        }
        if (districts == "sd") {
            $('.sd').show();
        }
        if (districts == "hd") {
            $('.hd').show();
        }
        if (districts == "cb") {
            $('.cb').show();
        }
        if (districts == "") {
            $('.cd').show();
            $('.sd').show();
            $('.hd').show();
            $('.cb').show();
        }
    }

    function getDistricts() {
        var zipcode = document.getElementById("zipcode").value;
        var myKeyVals = {
            "zipcode": zipcode
        };
        $.ajax({
            type: 'POST',
            url: "https://dev.indianacitizen.org/districts_list",
            data: myKeyVals,
            dataType: "text",
            success: function(resultData) {
                $('#districts_list').html(resultData);
            }
        });
    }

    function initialize() {
        var input = document.getElementById('address');
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.addListener('place_changed', function(event) {

            var place = autocomplete.getPlace();
            var street_address = '';
            //console.log(place.formatted_address);

            var url = 'https://www.googleapis.com/civicinfo/v2/voterinfo?key=AIzaSyCFkV_Wa9sr_2jxkvBsgzxHdBk3g_3QSi8&address=' + place.formatted_address + '&electionId=2000';
            $.getJSON(url, function(data) {
                obj = data["contests"]["0"]["district"]["id"];
                $('#district').val(obj.substr(obj.length - 1));
                console.log(obj.substr(obj.length - 1));
            });
            $("#address").val = "";
            $("#zipcode").val("");
            for (var comp in place.address_components) {

                var type = place.address_components[comp].types;

                if (type[0] == "street_number") {
                    street_address += place.address_components[comp].long_name;
                } else if (type[0] == "neighborhood") {
                    street_address += street_address != '' ? ', ' + place.address_components[comp].long_name : place.address_components[comp].long_name;
                } else if (type[0] == "route") {
                    street_address += street_address != '' ? ', ' + place.address_components[comp].long_name : place.address_components[comp].long_name;
                } else if (type[0] == "sublocality") {
                    street_address += street_address != '' ? ', ' + place.address_components[comp].long_name : place.address_components[comp].long_name;
                } else if (type[0] == "locality") {

                    $("#signup-form input[name='city']").val(place.address_components[comp].long_name);

                } else if (type[0] == "administrative_area_level_1") {

                    $("#signup-form input[name='state']").val(place.address_components[comp].long_name);

                } else if (type[0] == "country") {

                    $("#signup-form input[name='country']").val(place.address_components[comp].long_name);
                    $("#signup-form input[name='country_code']").val(place.address_components[comp].short_name);

                } else if (type[0] == "postal_code") {
                    if (place.address_components[comp].long_name == "") {
                        $("#zipcode").val("");
                    } else {
                        $("#zipcode").val(place.address_components[comp].long_name);
                        var myKeyVals = {
                            "zipcode": place.address_components[comp].long_name
                        };
                        $.ajax({
                            type: 'POST',
                            url: "https://dev.indianacitizen.org/districts_list",
                            data: myKeyVals,
                            dataType: "text",
                            success: function(resultData) {
                                $('#districts_list').html(resultData);
                            }
                        });
                    }

                }
            }

            $("#signup-form input[name='latitude']").val(place.geometry.location.lat());
            $("#signup-form input[name='longitude']").val(place.geometry.location.lng());
            $("#address").val(place.formatted_address);
        });
    }
</script>


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
    <?php
    function does_url_exists($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($code == 200) {
            $status = true;
        } else {
            $status = false;
        }
        curl_close($ch);
        return $status;
    }

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

    // if (isset($_POST['submit']) || isset($_POST["districts_list"]) || isset($_POST["cd"])) {

    // echo "Districts : ".$_GET["cd"]." ".$_GET["sd"];
    if (isset($_POST['submit']) || isset($_POST["districts_list"]) || isset($_GET['cd']) || isset($_GET['sd']) || isset($_GET['hd']) || isset($_GET['cb'])) {
    ?>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- <div class="col-md-12 border p-0">
                        <div class="p-1 border text-center w-100">
                        <h3>Incumbent</h3>
                    </div> -->
                </div>
                <hr />
                <?php if (isset($_GET["cd"]) || isset($_POST["cd"])) { ?>
                    <h2 style="text-align:center;"> US Representative </h2>
                    <div class="row p-2 cd">

                        <?php
                        // $url = "https://docs.google.com/spreadsheets/d/e/2PACX-1vQMd5RcEKEHuNkoXXZ4-MwzRwP1tWm1QZTwxCyhE0tlFBtI3dcIo7uETSVMrwpV8dTbXSz_SFkehmpm/pub?output=csv";
                        $url = "https://docs.google.com/spreadsheets/d/e/2PACX-1vQMd5RcEKEHuNkoXXZ4-MwzRwP1tWm1QZTwxCyhE0tlFBtI3dcIo7uETSVMrwpV8dTbXSz_SFkehmpm/pub?gid=458816781&single=true&output=csv";
                        $row = 0;
                        if (($handle = fopen($url, "r")) !== FALSE) {
                            $data = fgetcsv($handle, 1000, ",");
                            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                                if ($row !== 0) {
                                    //$find_data = search($data, 13, 5);
                                    // $find_data = search($data, 13, $_POST['district']);
                                    $cd_input = (!empty($_GET['cd'])) ? $_GET['cd'] : $_POST['cd'];
                                    $cd = search($data, 19, $cd_input);
                                    if (count($cd) == 1) {
                                        foreach ($cd as $fd) { ?>
                                            <div class="col-md-4">
                                                <div class="card mb-3">
                                                    <div class="card-header1 <?php echo $fd[16]; ?>" >Incumbent</div>
                                                    <div class="card-body">
                                                        <div class="circular--portrait">
                                                            <img src="https://static.votesmart.org/canphoto/193495.jpg" />
                                                        </div>
                                                        <h3 class="card-title"><?php if ($fd[15]) {
                                                                                    echo $fd[15];
                                                                                } ?></h3>
                                                        <?php
                                                        echo $pd_follow_sc = do_shortcode('[pd_follow content_id="' . $fd[23] . '" content_type="1" user_id="6"]'); ?>
                                                        <?php if ($fd[16]) { ?>
                                                            <button type="button" class="<?php echo $fd[16]; ?> btn btn-sm cntr"><?php echo $fd[16]; ?> </button>
                                                        <?php } ?>
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
                        <?php
                                        }
                                    }
                                }
                                $row++;
                            }
                            fclose($handle);
                        }
                        ?>
                    </div>
                <?php } ?>
                <!-- sd starts -->
                <?php if (isset($_GET["sd"]) || isset($_POST["sd"])) { ?>
                    <h2 style="text-align:center;"> State Senator </h2>
                    <div class="row p-2 sd">
                        
                        <?php
                        // $url = "https://docs.google.com/spreadsheets/d/e/2PACX-1vQMd5RcEKEHuNkoXXZ4-MwzRwP1tWm1QZTwxCyhE0tlFBtI3dcIo7uETSVMrwpV8dTbXSz_SFkehmpm/pub?output=csv";
                        $url = "https://docs.google.com/spreadsheets/d/e/2PACX-1vQMd5RcEKEHuNkoXXZ4-MwzRwP1tWm1QZTwxCyhE0tlFBtI3dcIo7uETSVMrwpV8dTbXSz_SFkehmpm/pub?gid=458816781&single=true&output=csv";
                        $row = 0;
                        if (($handle = fopen($url, "r")) !== FALSE) {
                            $data = fgetcsv($handle, 1000, ",");
                            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                                if ($row !== 0) {
                                    $sd_input = (!empty($_GET['sd'])) ? $_GET['sd'] : $_POST['sd'];
                                    $sd = search($data, 20, $sd_input);
                                    if (count($sd) == 1) {
                                        foreach ($sd as $fd) { ?>
                                            <div class="col-md-4">
                                                <div class="card mb-3">
                                                    <div class="card-header1 <?php echo $fd[16]; ?>">Incumbent</div>
                                                    <div class="card-body">
                                                        <h3 class="card-title"><?php if ($fd[15]) {
                                                                                    echo $fd[15];
                                                                                } ?></h3>
                                                        <?php echo $pd_follow_sc = do_shortcode('[pd_follow content_id="' . $fd[23] . '" content_type="1" user_id="6"]'); ?>
                                                        <?php if ($fd[16]) { ?>
                                                            <button type="button" class="<?php echo $fd[16]; ?> btn btn-sm cntr"><?php echo $fd[16]; ?> </button>
                                                        <?php } ?>
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
                        <?php
                                        }
                                    }
                                }
                                $row++;
                            }
                            fclose($handle);
                        }
                        ?>
                    </div>
                <?php
                }
                ?>
                <!-- sd ends -->
                <!-- house district starts -->
                <?php if (isset($_GET["hd"]) || isset($_POST["hd"])) { ?>
                    <h2 style="text-align:center;"> State Representative </h2>
                    <div class="row p-2 hd">

                        <?php
                        // $url = "https://docs.google.com/spreadsheets/d/e/2PACX-1vQMd5RcEKEHuNkoXXZ4-MwzRwP1tWm1QZTwxCyhE0tlFBtI3dcIo7uETSVMrwpV8dTbXSz_SFkehmpm/pub?output=csv";
                        $url = "https://docs.google.com/spreadsheets/d/e/2PACX-1vQMd5RcEKEHuNkoXXZ4-MwzRwP1tWm1QZTwxCyhE0tlFBtI3dcIo7uETSVMrwpV8dTbXSz_SFkehmpm/pub?gid=458816781&single=true&output=csv";
                        $row = 0;
                        if (($handle = fopen($url, "r")) !== FALSE) {
                            $data = fgetcsv($handle, 1000, ",");
                            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                                if ($row !== 0) {
                                    $hd = search($data, 21, 97);
                                    if (count($hd) == 1) {
                                        foreach ($hd as $fd) { ?>
                                            <div class="col-md-4">
                                                <div class="card mb-3">
                                                    <div class="card-header1 <?php echo $fd[16]; ?>" >Incumbent</div>
                                                    <div class="card-body">
                                                        <h3 class="card-title"><?php if ($fd[15]) {
                                                                                    echo $fd[15];
                                                                                } ?></h3>
                                                        <?php echo $pd_follow_sc = do_shortcode('[pd_follow content_id="' . $fd[23] . '" content_type="1" user_id="6"]'); ?>
                                                        <?php if ($fd[16]) { ?>
                                                            <button type="button" class="<?php echo $fd[16]; ?> btn btn-sm cntr"><?php echo $fd[16]; ?> </button>
                                                        <?php } ?>
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
                        <?php
                                        }
                                    }
                                }
                                $row++;
                            }
                            fclose($handle);
                        }
                        ?>
                    </div>
                <?php } ?>
                <!-- house district ends -->
                <!-- Count Boundaries starts -->
                <?php if (isset($_GET["cb"]) || isset($_POST["cb"])) { ?>
                    <h2 style="text-align:center;"> Count Boundaries </h2>
                    <div class="row p-2 cb">
                        
                        <?php
                        // $url = "https://docs.google.com/spreadsheets/d/e/2PACX-1vQMd5RcEKEHuNkoXXZ4-MwzRwP1tWm1QZTwxCyhE0tlFBtI3dcIo7uETSVMrwpV8dTbXSz_SFkehmpm/pub?output=csv";
                        $url = "https://docs.google.com/spreadsheets/d/e/2PACX-1vQMd5RcEKEHuNkoXXZ4-MwzRwP1tWm1QZTwxCyhE0tlFBtI3dcIo7uETSVMrwpV8dTbXSz_SFkehmpm/pub?gid=458816781&single=true&output=csv";
                        $row = 0;
                        if (($handle = fopen($url, "r")) !== FALSE) {
                            $data = fgetcsv($handle, 1000, ",");
                            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                                if ($row !== 0) {
                                    $cb = search($data, 22, 97);
                                    if (count($cb) == 1) {
                                        foreach ($cb as $fd) { ?>
                                            <div class="col-md-4">
                                                <div class="card mb-3">
                                                    <div class="<?php echo $fd[16]; ?> card-header1">Incumbent</div>
                                                    <div class="card-body">
                                                        <h3 class="card-title"><?php if ($fd[15]) {
                                                                                    echo $fd[15];
                                                                                } ?></h3>
                                                        <?php if ($fd[16]) { ?>
                                                            <button type="button" class="<?php echo $fd[16]; ?> btn btn-sm cntr"><?php echo $fd[16]; ?> </button>
                                                        <?php } ?>
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
                        <?php
                                        }
                                    }
                                }
                                $row++;
                            }
                            fclose($handle);
                        }
                        ?>
                    </div>
                <?php } ?>
                <!-- house district ends -->
            </div>

            <!-- /.content -->
</div>

<!-- candidates cards section loop starts -->

<!-- candidates cards section loop starts -->
</section>
<?php
    } ?>
</div>

<?php include_once('footer-v2.php'); ?>