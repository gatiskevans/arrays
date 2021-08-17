<?php

    $numbers = [
        1789, 2035, 1899, 1456, 2013,
        1458, 2458, 1254, 1472, 2365,
        1456, 2165, 1457, 2456
    ];

    //todo
    $originalNumbers = implode(", ", $numbers);
    echo "Original numeric array: $originalNumbers\n";

    //todo
    sort($numbers);
    $sorted = '';
    for($i = 0; $i < count($numbers); $i++){
        if($i === count($numbers)-1){
            $sorted .= "$numbers[$i]";
        } else {
            $sorted .= "$numbers[$i], ";
        }
    }
    echo "Sorted numeric array: $sorted\n";

    $words = [
        "Java",
        "Python",
        "PHP",
        "C#",
        "C Programming",
        "C++"
    ];

    //todo
    $originalWords = implode(", ", $words);
    echo "Original string array: $originalWords\n";

    //todo
    sort($words);
    $sortedWords = '';
    for($i = 0; $i < count($words); $i++){
        if($i === count($words)-1){
            $sortedWords .= "$words[$i]";
        } else {
            $sortedWords .= "$words[$i], ";
        }
    }
    echo "Sorted string array: $sortedWords";