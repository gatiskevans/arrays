<?php

    class TicTacToe {

        public array $gameCoordinates = [
            [" ", " ", " "],
            [" ", " ", " "],
            [" ", " ", " "]
        ];

        public int $emptyStrings = 0;

        function display_board()
        {
            echo " {$this->gameCoordinates[0][0]} | {$this->gameCoordinates[1][0]} | {$this->gameCoordinates[2][0]} \n";
            echo "---+---+---\n";
            echo " {$this->gameCoordinates[0][1]} | {$this->gameCoordinates[1][1]} | {$this->gameCoordinates[2][1]} \n";
            echo "---+---+---\n";
            echo " {$this->gameCoordinates[0][2]} | {$this->gameCoordinates[1][2]} | {$this->gameCoordinates[2][2]} \n";
            echo "\n";
        }

        function decideWhichPlayersTurn(): string {
            $number = 0;

            for($i = 0; $i < count($this->gameCoordinates); $i++){
                for($j = 0; $j < count($this->gameCoordinates[$i]); $j++){
                    if($this->gameCoordinates[$i][$j] === " "){
                        $number++;
                        $this->emptyStrings = $number;
                    } else {
                        $this->emptyStrings = $number;
                    }
                }
            }
            if($number % 2 === 0){
                return "O";
            }
            return "X";
        }

        function makeAMove () {
            $currentPlayer = $this->decideWhichPlayersTurn();

            $row = readline("Enter row value: ");
            $col = readline("Enter column value: ");

            $isPromptActive = true;
            while($isPromptActive) {
                if(!is_numeric($row)){
                    echo "Column $col\n";
                    $row = readline("The value must be a number. Try again (row): ");
                } else if(!is_numeric($col)){
                    echo "Row $row\n";
                    $col = readline("The value must be a number. Try again (column): ");
                } else if($row > 2 || $row < 0){
                    $row = readline("The value must be between 0-2. Try again (row): ");
                } else if($col > 2 || $col < 0){
                    $col = readline("The value must be between 0-2. Try again (column): ");
                } else
                if ($this->gameCoordinates[$row][$col] !== " ") {
                    $row = readline("This area is already used. Try again (row value): ");
                    $col = readline("Enter column value:  ");
                } else {
                    $isPromptActive = false;
                    $this->gameCoordinates[$row][$col] = $currentPlayer;
                }
            }

        }

        function findWinner(): string {
            $coo = $this->gameCoordinates;
            if($coo[0][0] === $coo[1][0] && $coo[1][0] === $coo[2][0] && $coo[0][0] !== " "){
                return $coo[0][0];
            }
            if($coo[0][1] === $coo[1][1] && $coo[1][1] === $coo[2][1] && $coo[0][1] !== " "){
                return $coo[0][1];
            }
            if($coo[0][2] === $coo[1][2] && $coo[1][2] === $coo[2][2] && $coo[0][2] !== " "){
                return $coo[0][2];
            }
            if($coo[0][0] === $coo[0][1] && $coo[0][1] === $coo[0][2] && $coo[0][0] !== " "){
                return $coo[0][0];
            }
            if($coo[1][0] === $coo[1][1] && $coo[1][1] === $coo[1][2] && $coo[1][0] !== " "){
                return $coo[1][0];
            }
            if($coo[2][0] === $coo[2][1] && $coo[2][1] === $coo[2][2] && $coo[2][0] !== " "){
                return $coo[2][0];
            }
            if($coo[0][0] === $coo[1][1] && $coo[1][1] === $coo[2][2] && $coo[0][0] !== " "){
                return $coo[0][0];
            }
            if($coo[0][2] === $coo[1][1] && $coo[1][1] === $coo[2][0] && $coo[0][2] !== " "){
                return $coo[0][2];
            }
            return " ";
        }

        function isTie(): bool {
            return $this->emptyStrings === 0 && $this->findWinner() !== "X";
        }

    }

    $newGame = new TicTacToe();

    function redrawBoard($newGame) {
        $isInProgress = true;
        while($isInProgress){
            $currentPlayer = $newGame->decideWhichPlayersTurn();
            echo "\nIt's $currentPlayer's turn:\n\n";
            $newGame->display_board();

            if($newGame->isTie()){
                echo "It's a tie!\n\n";
                exit();
            }

            $newGame->makeAMove();

            if($newGame->findWinner() !== " "){
                echo "\nCongratulations $currentPlayer won!\n\n";
                $newGame->display_board();
                $isInProgress = false;
            }
        }
    }

    redrawBoard($newGame);