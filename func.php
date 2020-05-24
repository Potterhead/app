<?php

function houseColor($house)
{
    switch ($house) {
        case "gryffindor":
            $color = "#991d3c";
            break;
        case "ravenclaw":
            $color = "#025ab3";
            break;
        case "hufflepuff":
            $color = "#e8af26";
            break;
        case "slytherin":
            $color = "#164235";
            break;
        default:
            $color = "#000";
    }
    return $color;
}

function getTitle()
{
    return 'Anasayfa';
}

function houses()
{
    return [
        '5a05e2b252f721a3cf2ea33f' => 'gryffindor',
        '5a05da69d45bd0a11bd5e06f' => 'ravenclaw',
        '5a05dc8cd45bd0a11bd5e071' => 'slytherin',
        '5a05dc58d45bd0a11bd5e070' => 'hufflepuff',
    ];
}
