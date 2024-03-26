<?php
    $idrs           = "23476";			      /** ID Rumah Sakit dari BPJS **/
    $Key            = "5eN97393F7";		      /** Secret Key BPJS dari BPJS **/

    $timestamp          = strtotime(date("Y-m-d H:i:s"));
    $data               = $idrs."&".strtotime(date("Y-m-d H:i:s"));
    $signature          = hash_hmac('sha256', $data, $Key, true);
    $encodedSignature   = base64_encode($signature);
    
    echo '[{"X_cons_id":"'.$idrs.'","X_timestamp":"'.$timestamp.'","X_signature":"'.$encodedSignature.'"}]"'; 
?>