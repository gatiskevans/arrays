<?php

    class Hangman {
        private array $words = ['hangman', 'purgatory', 'magnetar', 'troposphere', 'programming'];
        private array $chosenWord = [];
        private array $hiddenWord = [];
        private array $misses = [];
        private int $lives = 5;

        public function chooseWord(): void {
            $this->chosenWord = str_split($this->words[array_rand($this->words)]);
        }

        public function getLives(): int {
            return $this->lives;
        }

        public function getHiddenWord(): array {
            return $this->hiddenWord;
        }

        public function getMisses(): array {
            return $this->misses;
        }

        public function createHiddenField(): void {
            for($i = 0; $i < count($this->chosenWord); $i++){
                array_push($this->hiddenWord, "_");
            }
        }

        public function checkChosenLetter(string $input): void {
            foreach($this->chosenWord as $index => $letter){
                if($letter === strtolower($input) && $this->hiddenWord[$index] === "_"){
                    $this->hiddenWord[$index] = $letter;
                }
            }
            if(!in_array(strtolower($input), $this->chosenWord)){
                if(!in_array(strtolower($input), $this->misses)){
                    array_push($this->misses, strtolower($input));
                    $this->lives--;
                }
            }
        }

        public function win(): bool {
            return $this->hiddenWord == $this->chosenWord;
        }

        public function lose(): bool {
            return $this->lives === 0;
        }

        public function restartGame(): void{
            $isPromptActive = true;
            while($isPromptActive){
                $option = readline("Play again? (Y/N) ");

                if(strtoupper($option) === "N"){
                    die("Bye");
                } else if(strtoupper($option) === "Y") {
                    $this->chosenWord = $this->hiddenWord = $this->misses = [];
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
        echo "\nYou have {$newGame->getLives()} lives left\n";
        echo "\nWord: " . implode(" ", $newGame->getHiddenWord()) . "\n\n";
        echo "Misses: " . implode("", $newGame->getMisses()) . "\n\n";

        if($newGame->win()){
            echo "Congratulations! You have won\n";
            $newGame->restartGame();
            continue;
        }
        if($newGame->lose()){
            echo "Game Over\n";
            $newGame->restartGame();
            continue;
        }

        $input = readline("Guess: ");
        while(strlen($input) > 1 || is_numeric($input)){
            $input = readline("Invalid input. Try again: ");
        }

        $newGame->checkChosenLetter($input);
    }


