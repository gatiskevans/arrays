<?php

    class Hangman {
        public array $words = ['hangman', 'purgatory', 'magnetar', 'troposphere', 'programming'];
        public array $wordIntoArray = [];
        public array $hiddenWord = [];
        public array $misses = [];
        public int $lives = 5;

        function chooseWord() {
            $this->wordIntoArray = str_split($this->words[rand(0, count($this->words)-1)]);
        }

        function createHiddenField() {
            $emptyFields = [];
            for($i = 0; $i < count($this->wordIntoArray); $i++){
                array_push($emptyFields, "_");
            }
            $this->hiddenWord = $emptyFields;
        }

        function checkChosenLetter(string $input){
            foreach($this->wordIntoArray as $index => $letter){
                if($letter === strtolower($input) && $this->hiddenWord[$index] === "_"){
                    $this->hiddenWord[$index] = $letter;
                }
            }
            if(!in_array(strtolower($input), $this->wordIntoArray)){
                if(!in_array(strtolower($input), $this->misses)){
                    array_push($this->misses, strtolower($input));
                    $this->lives--;
                }
            }
        }

        function win(): bool {
            return $this->hiddenWord == $this->wordIntoArray;
        }

        function lose(): bool {
            return $this->lives === 0;
        }

        function restartGame(){
            $isPromptActive = true;
            while($isPromptActive){
                $option = readline("Play \"again\"? (Y/N) ");

                while(strlen($option) > 1){
                    $option = readline("Play \"again\"? (Y/N) ");
                }

                if(strtoupper($option) === "N"){
                    die("Bye");
                } else if(strtoupper($option) === "Y") {
                    $this->wordIntoArray = [];
                    $this->hiddenWord = [];
                    $this->misses = [];
                    $this->lives = 5;
                    $this->chooseWord();
                    $this->createHiddenField();
                    $isPromptActive = false;
                }
            }
        }

    }

    $newGame = new Hangman();

    $newGame->chooseWord();
    $newGame->createHiddenField();

    while(true){
        echo "-=-=-=-=-=-=-=-=-=-=-=-=-=-";
        echo "\nYou have $newGame->lives lives left\n";
        echo "\nWord: " . implode(" ", $newGame->hiddenWord) . "\n\n";
        echo "Misses: " . implode("", $newGame->misses) . "\n\n";

        $input = readline("Guess: ");
        while(strlen($input) > 1 || is_numeric($input)){
            $input = readline("Invalid input. Try again: ");
        }

        $newGame->checkChosenLetter($input);
        if($newGame->win()){
            echo "Congratulations! You have won\n";
            $newGame->restartGame();
        }
        if($newGame->lose()){
            echo "Game Over\n";
            $newGame->restartGame();
        }
    }


