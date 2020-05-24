<?php

function getCharacters($api_key)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($ch, CURLOPT_URL, "https://www.potterapi.com/v1/characters?key=$api_key");
    
    $result = curl_exec($ch);
    
    curl_close($ch);
    
    return $result;
}
