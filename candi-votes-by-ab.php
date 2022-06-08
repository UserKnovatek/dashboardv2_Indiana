<style>
  .accordion-header p{
    margin-bottom: 0;
    font-size: 20px;
    font-weight: 600;
    padding: 1rem 1.25rem;
  }
  .accordion-header .accordion-button{
    background-color: #fff;
  }
</style>


<?php

// include_once( "votesmart/VoteSmart.php");



function get_candidate_votes_by_ab()
{

    $getVotes = new VoteSmart('Votes.getByOfficial', Array('candidateId' => $_GET['can_id'])); //$_GET['can_id']
    $response_getVotes = json_decode($getVotes->getXml(), true);
    $bills = $response_getVotes['bills']['bill'];
    // echo '<pre>';
    // print_r($response_getVotes);
    // echo '</pre>';
  ?>
   <style type="text/css">
       table
       {
           width:100%;
       }
       th
       {
           /* background-color:#ccc; */
           /* color:#000; */
       }
       td,th
       {
           padding:5px;
       }
        /* table, th, td {
            border: 0px solid black;
            border-collapse:collapse;
        } */
        .table th, .table td {
            white-space: normal;
            border-width: 0;
        }
        #loading 
        {
            margin: 0px;
            display: none;
            padding: 0px;
            position: fixed;
            right: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            background-color: rgb(255, 255, 255);
            z-index: 9999991;
            opacity: 0.8;
        }

        #ploading 
        {
            position: absolute;
            color: White;
            top: 50%;
            left: 45%;
        }
    </style>

	<table class="table table-bordered fontfamily">

    <thead>
      <tr style="background-color:#f9ae12; color:#fff; border:solid #fff 2px;">
        <th scope="col" class="bilno">Bill</th>
        <th scope="col" class="tdwidt">Information</th>
        <th scope="col" class="yn">Yes/No</th>
        <!-- <th scope="col" class="action">Action</th>
        <th scope="col" class="date">Date</th>
        <th scope="col" class="outcome">Outcome</th> -->
      </tr>
    </thead>
    <tbody>
    <?php
    if(var_export($bills, true)!="NULL")
    {
        foreach($bills as $bill)
        {
            $vote = ($bill['vote'] == 'Y') ? 'Yes' : 'No';
    
            ?>
                <tr class="actnhov" style="cursor: pointer; border-top:solid 2px #fff;border-left:solid 2px #fff;border-right:solid 2px #fff;" onclick="getOutcome('<?php echo $bill['billId']; ?>','<?php echo $bill['actionId']; ?>')">
                    <td><?php echo $bill['billNumber']; ?></td>
                    <td><?php echo $bill['title']; ?></td>
                    <td><?php echo $vote; ?></td>
                    <!-- <td><button onclick="getOutcome('<?php echo $bill['billId']; ?>','<?php echo $bill['actionId']; ?>')">Click To Get Outcome</button></td>
                    <td id="date<?php echo $bill['actionId']; ?>"></td>
                    <td id="outcome<?php echo $bill['actionId']; ?>"></td> -->
                </tr>
                <tr style="background-color:grey; color:#fff; border-bottom:solid 2px #fff;border-left:solid 2px #fff;border-right:solid 2px #fff;">
                    <td id="date<?php echo $bill['actionId']; ?>">
    
                    </td>
                    <td id="outcome<?php echo $bill['actionId']; ?>" colspan="2">
    
                    </td>
                </tr>
          <?php
    
        }
    }
    else
    {
        echo "<tr style='border:solid 2px #fff;'><td colspan='3'>No Records Found.</td></tr>";

    }    

    ?>
  </tbody>
  </table>
  <div id="loading">
        <p id="ploading">
            <img src="https://dev.indianacitizen.org/wp-content/uploads/2022/04/spinning-loading.gif" width="160px" height="110px" />
        </p>
    </div>

  <?php
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    function getOutcome(billid,actionId)
    {
        var myKeyVals = { "billid":billid, "actionId":actionId};
        $.ajax({
        type: 'POST',
        url: "https://dev.indianacitizen.org/bill_details",
        data: myKeyVals,
        dataType: "text",
        beforeSend: function() {
          $("#loading").show();
        },
        success: function(resultData) 
            {
                var res = $.parseJSON(resultData);
                $('#outcome'+actionId).html(res.outcome);
                $('#date'+actionId).html(res.status_date);
                $("#loading").hide();
            }
        });    
    }
</script>
