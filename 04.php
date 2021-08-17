<?php

    $arrayOne = [
        rand(1, 100),
        rand(1, 100),
        rand(1, 100),
        rand(1, 100),
        rand(1, 100),
        rand(1, 100),
        rand(1, 100),
        rand(1, 100),
        rand(1, 100),
        rand(1, 100)
    ];

    $arrayTwo = array_map(function ($element){
        return $element;
        }, $arrayOne);

    array_pop($arrayOne);
    array_push($arrayOne, -7);

    $arrayOneDisplay = "Array 1: ";
    $arrayTwoDisplay = "Array 2: ";

    foreach ($arrayOne as $value){
        $arrayOneDisplay .= "$value ";
    }

    foreach ($arrayTwo as $value){
        $arrayTwoDisplay .= "$value ";
    }

    echo "$arrayOneDisplay\n";
    echo $arrayTwoDisplay;