<?php

    $numbers = [
        1789, 2035, 1899, 1456, 2013,
        1458, 2458, 1254, 1472, 2365,
        1456, 2265, 1457, 2456
    ];

    echo "Enter the value to search for: \n";

    //todo check if an array contains a value user entered

    $search = readline("> ");

    $isPromptActive = true;
    while($isPromptActive){
        if(!is_numeric($search)){
            $search = readline("The value must be a number. Try again: ");
        } else {
            $isPromptActive = false;
        }
    }

    function searchForANumber(int $search, array $numbers): string {
        foreach($numbers as $number){
            if($number === $search) {
                return "The array contains number {$search}";
            }
        }
        return "The array doesn't have a number you were looking for";
    }

    echo searchForANumber($search, $numbers);