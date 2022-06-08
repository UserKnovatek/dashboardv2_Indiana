<?php

function array_sort($array, $on, $order=SORT_ASC){

    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
                break;
            case SORT_DESC:
                arsort($sortable_array);
                break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}

function is_in_array($array, $key, $key_value){
    $within_array = 'no';
    foreach( $array as $k=>$v ){
      if( is_array($v) ){
          $within_array = is_in_array($v, $key, $key_value);
          if( $within_array == 'yes' ){
              break;
          }
      } else {
              if( $v == $key_value && $k == $key ){
                      $within_array = 'yes';
                      break;
              }
      }
    }
    return $within_array;
}

include_once( "votesmart/VoteSmart.php");
function get_candidate_ratings(){

    $getRatings = new VoteSmart('Rating.getCandidateRating', Array('candidateId' => $_GET['can_id'])); //$_GET['can_id']
    $response_getRatings = json_decode($getRatings->getXml(), true);

    $ratings = $response_getRatings['candidateRating']['rating'];
    $uniqueC=[];
    if(var_export($ratings, true)!="NULL")
    {
        if(!empty($ratings["sigId"]))
        {

            $ratings['categories']['category']["sigId"]=$ratings["sigId"];
            array_push($uniqueC,$ratings['categories']['category']);
        }
        else
        {
            foreach($ratings as $rating){
                foreach($rating['categories']['category'] as $t)
                {
                    if(is_array($t))
                    {
                        $t["sigId"] = $rating["sigId"];
                        array_push($uniqueC,$t);
                    }
                    else
                    {
                        $rating['categories']['category']["sigId"]=$rating["sigId"];
                        array_push($uniqueC,$rating['categories']['category']);
                    }
                }
            }        
        }
    }
    else
    {
        echo "Records Not Found!";
    }

    $uniqueC=array_sort($uniqueC,"name",SORT_ASC);
    function super_unique($array)
    {
      $result = array_map("unserialize", array_unique(array_map("serialize", $array)));
    
      foreach ($result as $key => $value)
      {
        if ( is_array($value) )
        {
          $result[$key] = super_unique($value);
        }
      }
    
      return $result;
    }
    $uniqueC = super_unique($uniqueC);

    $uniqueCategories = array_unique(array_map(function ($i) { return $i['name']; }, $uniqueC));
    $uniqueCategoryIds = array_unique(array_map(function ($i) { return $i['categoryId']; }, $uniqueC));
    $uniqueCate = array_map(null,$uniqueCategories,$uniqueCategoryIds);

   $uniqueCate=array_sort($uniqueCate,"name",SORT_ASC);
   ?>
   <style type="text/css">
       table
       {
           width:100%;
       }
       th
       {
           background-color:#ffc107;
           color:#000;
       }
       td,th
       {
           padding:5px;
       }
        table, th, td {
            border: 1px solid black;
            border-collapse:collapse;
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
            top: 45%;
            left: 45%;
        }
    </style>
   <?php
    echo '<table class="fontfamily">';

    foreach($uniqueCate as $cat){
        if(!empty($cat[0]))
        {
            $d = json_encode($uniqueC);
        ?>
                <tr class="hovefct">
                    <th colspan="5" onclick='getInnerData("<?php echo $cat[1]; ?>","<?php echo addslashes($d); ?>","<?php echo $_GET["can_id"]; ?>")'>  <?php echo $cat[0]; ?> </th>
                </tr>
                <tr>
                    <td>
                        <table id="parent_tr<?php echo $cat[1]; ?>">

                        </table>
                    </td>
                </tr>
        <?php
        }
    }
    echo '</table>';
    ?>
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
        function getInnerData(catid,uniqueC,can_id)
        {
            var myKeyVals = { "can_id":can_id,"catid":catid,'uniqueC':uniqueC };
            $.ajax({
            type: 'POST',
            url: "https://dev.indianacitizen.org/ratings_abhishek",
            data: myKeyVals,
            dataType: "text",
            beforeSend: function() {
              $("#loading").show();
            },
            success: function(resultData) 
                { 
                   $('#parent_tr'+catid).html(resultData);
                   $("#loading").hide();
                }
            });    
        }
    </script>
