<?php
    include_once 'config.php';
    $arr = array(3, 1, -5, 3, 3, -5, 0, 10, 1, 1);
    $min= $arr[0];
    $max = $arr[0];
    
    foreach($arr as $key=>$value){
        if($min > $value){
            $min = $value;
        }
    }
    foreach($arr as $key=>$value){
        if($max < $value){
            $max = $value;
        }
    }
    echo $min.'---'.$max;
    
//   $lo = $arr[0];
//    $hi = $arr[9];
//if ( $arr[$hi] - $arr[$lo] == $hi - $lo )
//  echo $arr[$hi]+1; // no gaps so return highest + 1
//do
//  {
//  $mid = ($lo + $hi) / 2;
//  if ( $arr[$mid] - $arr[$lo] > $mid - $lo )   // there is a gap in the bottom half somewhere
//    $hi = $mid; // search the bottom half
//  else
//    $lo = $mid; // search the top half
//  } while ( $hi > $lo + 1 ); // search until 2 left
//echo $arr[$lo]+1;
    
   echo '<br/>';
   $count = array();
    for($i=$min; $i<=$max; $i++)
    {
       if(!in_array($i, $arr)){
           $count[] = $i;
       }
    }
    print_r($count);
    
    
    $strings = array('1C', '100', '111');
foreach ($strings as $testcase) {
    if (ctype_xdigit($testcase)) {
        echo "The string $testcase consists of all hexadecimal digits.\n";
        echo bindec($testcase);
        echo '<br/>';
    } else {
        echo "The string $testcase does not consist of all hexadecimal digits.\n";
    }
}
         
?>
<html>
    <head>
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <script src="js/js.js" type="text/javascript"></script>
        <script type="text/javascript">
            ajax_call();
            function ajax_call(filename,data,loaddiv){
                $('#'+loaddiv).html('<option selected="selected">-- Loading Data --</option>');
                if(loaddiv == 'state'){
                    $('#state').html('');
                    $('#city').html('');
                }
                if(loaddiv == 'city'){
                    $('#city').html('');
                }
                $.ajax({
                   type:"POST",
                   url:"stateajax.php",
                   data:data,
                   success:function(data){
                        $('#'+loaddiv).html(data);
                   }
                });
            }
        </script>
    </head>
    <body>
        <?php
            $selectQuery = $db->prepare('select * from location where location_type = ?');
            $selectQuery->bindValue(1,0,PDO::PARAM_INT);
            $selectQuery->execute();
            $stateData= $selectQuery->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <select name="country" id="country" onchange="ajax_call('ajaxcall',{location_id:this.value,location_type:1},'state')">
            <option value="">-- Select Country --</option>
            <?php foreach($stateData as $value): ?>
            <option value="<?php echo $value['location_id'] ?>"><?php echo $value['name']; ?></option>
            <?php endforeach; ?>
        </select>
        <br/><br/>
        <select name="state" id="state" onchange="ajax_call('ajaxcall',{location_id:this.value,location_type:2},'city')"></select>
        <br/><br/>
        <select name="city" id="city"></select>
        <br/><br/>
    </body>
</html>