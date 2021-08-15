<?php

    $numbers = [20, 30, 25, 35, -16, 60, -100];

    //todo calculate an average value of the numbers

    $totalValue = 0;
    foreach ($numbers as $number){
        $totalValue += $number;
    }

    echo "The average value of the numbers is: " . number_format($totalValue/count($numbers), 2);