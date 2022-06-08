<?php
/*
  Template Name: candidate summary Template--V2
 */

include_once('header-v2.php');
include_once("votesmart/VoteSmart.php");
// include_once( "candi-votes-by-ab.php");
?>
<?php

$getDetailedBio = new VoteSmart('CandidateBio.getDetailedBio', array('candidateId' => $_GET['can_id']));
// $getDetailedBio = new VoteSmart('CandidateBio.getDetailedBio', Array('candidateId' => '148534'));
$response_getDetailedBio = json_decode($getDetailedBio->getXml(), true);


// $getBio = new VoteSmart('CandidateBio.getBio', Array('candidateId' => $_GET['can_id']));
// $response_getBio = json_decode($getBio->getXml(), true);


//  echo '<pre>';
//  print_r($response_getDetailedBio);
//  echo '</pre>';

// echo '<pre>';
// print_r($response_getBio);
// echo '</pre>';

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
            <h3>Summary</h3>
            <style type="text/css">
                table {
                    width: 100%;
                }

                th {
                    width: 20%;
                }

                td {
                    width: 80%;
                }

                th,
                td {
                    padding: 5px;
                }

                table,
                tr,
                td,
                th {
                    border: solid 2px;
                    border-collapse: collapse;
                }
            </style>
            <?php
            if (count($bio) > 0) {
            ?>
                <table>
                    <tr>
                        <th colspan="2">Personal</th>
                    </tr>
                    <?php
                    if (!empty($bio["firstName"])) {
                    ?>
                        <tr>
                            <th>Full Name : </th>
                            <td>
                                <?php
                                if (!empty($bio["middleName"])) {
                                    echo $bio["firstName"] . " " . $bio["middleName"] . " " . $bio["lastName"];
                                } else {
                                    echo $bio["firstName"] . " " . $bio["lastName"];
                                }
                                ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    <?php
                    if (!empty($bio["gender"])) {
                    ?>
                        <tr>
                            <th>Gender : </th>
                            <td>
                                <?php
                                echo $bio["gender"];
                                ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>

                    <?php
                    if (!empty($bio["family"])) {
                    ?>
                        <tr>
                            <th>Family : </th>
                            <td>
                                <?php
                                echo $bio["family"];
                                ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    <?php
                    if (!empty($bio["homeCity"])) {
                    ?>
                        <tr>
                            <th>Home City : </th>
                            <td>
                                <?php
                                echo $bio["homeCity"];
                                ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    <?php
                    if (!empty($bio["religion"])) {
                    ?>
                        <tr>
                            <th>Religion : </th>
                            <td>
                                <?php
                                echo $bio["religion"];
                                ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    <?php
                    if (isset($bio["education"]["institution"]["fullText"])) {
                    ?>
                        <tr>
                            <th>Education</th>
                            <td>
                                <?php
                                echo $bio["education"]["institution"]["fullText"];
                                ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <th colspan="2">&nbsp;</th>
                    </tr>
                    <?php
                    if (isset($bio["political"]["experience"])) {
                        if (!empty($bio["political"]["experience"]["fullText"])) {
                    ?>
                            <tr>
                                <th style="vertical-align:top;">Political Experience</th>
                                <td><?php echo $bio["political"]["experience"]["fullText"]; ?></td>
                            </tr>
                        <?php
                        } else {
                        ?>
                            <tr>
                                <th style="vertical-align:top;" rowspan=<?php echo count($bio["political"]["experience"]) + 1; ?>>Political Experience</th>
                            </tr>
                            <?php
                            if (var_export($bio["political"]["experience"], true) != "NULL") {
                                foreach ($bio["political"]["experience"] as $pol) {
                            ?>
                                    <tr>
                                        <td>
                                            <?php
                                            echo $pol["fullText"];
                                            ?>
                                        </td>
                                    </tr>
                        <?php
                                }
                            }
                        }
                        ?>
                        <tr>
                            <th colspan="2">&nbsp;</th>
                        </tr>
                    <?php
                    }
                    if (isset($response_getDetailedBio['bio']["office"]["committee"])) {
                    ?>
                        <tr>
                            <th style="vertical-align:top;" rowspan=<?php echo count($response_getDetailedBio['bio']["office"]["committee"]) + 1; ?>>Current Legislative Committees</th>
                        </tr>
                        <?php
                        if (var_export($response_getDetailedBio['bio']["office"]["committee"], true) != "NULL") {
                            foreach ($response_getDetailedBio['bio']["office"]["committee"] as $com) {
                        ?>
                                <tr>
                                    <td>
                                        <?php
                                        echo $com["committeeName"];
                                        ?>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                        <tr>
                            <th colspan="2">&nbsp;</th>
                        </tr>
                    <?php
                    }
                    if (isset($bio["orgMembership"]["experience"])) {
                    ?>
                        <tr>
                            <th style="vertical-align:top;" rowspan=<?php echo count($bio["orgMembership"]["experience"]) + 1; ?>>Org Membership</th>
                        </tr>
                        <?php
                        if (isset($bio["orgMembership"]["experience"])) {
                            foreach ($bio["orgMembership"]["experience"] as $orgmem) {
                        ?>
                                <tr>
                                    <td>
                                        <?php
                                        echo $orgmem["fullText"];
                                        ?>
                                    </td>
                                </tr>
                    <?php
                            }
                        }
                    }
                    ?>

                </table>
            <?php
            }
            ?>
        </div>

    </div>

</div>






<?php include_once('footer-v2.php'); ?>