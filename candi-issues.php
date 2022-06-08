<?php

ini_set('display_errors', 'on');
include_once("votesmart/VoteSmart.php");

?>

<?php
function get_candidate_issues()
{
    $getIssues = new VoteSmart('Npat.getNpat', array('candidateId' => $_GET['can_id'])); //$_GET['can_id']
    $response_getIssues = json_decode($getIssues->getXml(), true);
    $issues = $response_getIssues['npat']; ?>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 text-left candidate-text">
                                <h4 class="title">Key</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-left candidate-text">
                                <hr>
                                <span><i class="fa fa-circle text-info mr-4"></i><b>Official Position:</b> Candidate addressed this issue directly by taking the Political Courage Test.</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-left candidate-text">
                                <hr>
                                <span><i class="fa fa-adjust text-info mr-4"></i><b>Inferred Position</b>: Candidate refused to address this issue, but Vote Smart inferred this issue based on the candidate's public record, including statements, voting record, and
                                    special interest group endorsements.</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-left candidate-text">
                                <hr>
                                <span><i class="fa fa-circle text-info mr-4"></i><b>Unknown Position</b>: Candidate refused to address this issue, or we could not infer an answer for this candidate despite exhaustive research of their public record.</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-left candidate-text">
                                <hr>
                                <span><i class="fa fa-chevron-down text-info mr-4" style="color: #3C4858 !important"></i>
                                    <b>Additional Information</b>: Click on this icon to reveal more information about this candidate's position, from their answers or Vote Smart's research.
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-left candidate-text">
                                <hr>
                                <em>
                                    Other or Expanded Principles &amp; Legislative Priorities are entered exactly as candidates submit them. Vote Smart does not edit for misspelled words, punctuation or grammar.
                                </em>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="candidateMoreInfoRowDesktop">
                    <div class="col">
                        <a href="/candidate/key-votes/7636/" class="btn btn-outline btn-block btn-candidate-more-info"><i class="fa fa-check"></i> Is Trump voting like he said he would?</a>
                    </div>
                </div>
            </div>
            <!--
                     <div class="col-md-8" id="mainContent">
                       -->
            <div class="col" id="mainContent">
                <div class="card">
                    <div class="card-body">


                        <div class="row">
                            <div class="col-md-12 text-left candidate-text">
                                <div class="alert alert-warning title pct-alerts" id="message">
                                    <p><?php echo $issues["surveyMessage"]; ?></p>
                                </div>
                                <a href="/about/political-courage-test" target="_blank">What is the Political Courage Test?</a>
                            </div>
                        </div>
                        <!-- end of row -->
                        <?php if (var_export($issues["section"], true) != "NULL") { ?>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <div class="row" id="returnedPctParentRow">
                                        <div class="col-md-12 text-center">
                                            <p class="text-left candidate-text">This candidate has responded to a Political Courage Test in a previous election. As a continued effort to provide the American public with factual information on candidates running for public
                                                    office, these archived responses are made available here.
                                            </p>
                                            <h5 id="pctResponseHeader" class="text-left">
                                            <b>West Virginia State Legislative Election 2002 National Political Awareness Test</b>
                                            </h5>
                                            <p class="text-left candidate-text">
                                                The Political Courage Test asks candidates which items they will <b>support</b> if elected. It does not ask them to indicate which items they will <b>oppose</b>. Through extensive research of public polling data, we discovered
                                                that voters are more concerned with what candidates would support when elected to office, not what they oppose. If a candidate does not select a response to any part or all of any question, it does not necessarily indicate that
                                                the candidate is opposed to that particular item.
                                            </p>

                                            <div class="accordion" id="accordionExample">
                                                <?php $i = 1;
                                                foreach ($issues["section"] as $sec) { ?>
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="heading<?php echo $i;?>">
                                                            <button class="accordion-button <?php if ($i > 1) {
                                                                                                echo 'collapsed';
                                                                                            } ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse<?php echo $i; ?>">
                                                                <i class="fa fa-circle text-info mr-4"></i> <?php echo $sec["name"]; ?>
                                                            </button>
                                                        </h2>
                                                        <div id="collapse<?php echo $i; ?>" class="accordion-collapse collapse <?php if ($i == 1) {
                                                                                                                                    echo 'show';
                                                                                                                                } ?>" aria-labelledby="heading<?php echo $i;?>" data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">

                                                                <div class="card-body">
                                                                    <?php if ($sec["row"]["rowText"]) { ?>
                                                                        <p class="text-left"><?php echo $sec["row"]["rowText"]; ?></p>
                                                                        <div class="table-responsive" id="candidatePCTTable">
                                                                            <table class="table">
                                                                                <tbody>
                                                                                    <?php
                                                                                    if (var_export($sec["row"]["row"], true) != "NULL") {
                                                                                        foreach ($sec["row"]["row"] as $r) {  ?>
                                                                                            <tr id="issueTextTypesNpatoptionText">
                                                                                                <td><?php echo $r["rowText"] ?></td>
                                                                                                <td><i class="fa fa-circle text-info mr-4"></i></td>
                                                                                                <td colspan="2" class="text-left"><?php echo $r["optionText"] ?></td>
                                                                                            </tr><?php
                                                                                                }
                                                                                            }
                                                                                                    ?>

                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    <?php } else { ?>
                                                                        <p class="text-left"><?php echo 'No data available'; ?></p>
                                                                    <?php } ?>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php $i++;
                                                } ?>

                                            </div>



                                            <!-- end of accordion -->
                                        </div>
                                    </div>
                                    <!-- end of parent row -->
                                    <div class="row">
                                        <div class="col-md-12 text-left">
                                            <div class="alert alert-info title pct-alerts">
                                                <p>Vote Smart does not permit the use of its name or programs in any campaign activity, including advertising, debates, and speeches.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } else {
                            echo "Records Not Found!";
                        } ?>


                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } ?>



