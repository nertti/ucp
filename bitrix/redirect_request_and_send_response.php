<?php

try {
    $link = isset($_REQUEST["link"]) ? $_REQUEST["link"] : "";
    if (!$link) {
        exit("");
    }

    $curl = curl_init($link);    
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

    $result = curl_exec($curl);
    echo($result); $link;
} catch (\Throwable $th) {
    //throw $th;
}