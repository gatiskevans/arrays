<?php

    $arrayOne = [];
    for($i = 0; $i < 10; $i++){
        $arrayOne[] = rand(1, 10);
    }

    $arrayTwo = $arrayOne;

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