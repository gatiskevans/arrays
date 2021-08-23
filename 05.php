<?php

class TicTacToe
{

    public array $gameCoordinates = [
        [" ", " ", " "],
        [" ", " ", " "],
        [" ", " ", " "]
    ];

    public int $emptyStrings;

    function display_board()
    {
        echo " {$this->gameCoordinates[0][0]} | {$this->gameCoordinates[0][1]} | {$this->gameCoordinates[0][2]} \n";
        echo "---+---+---\n";
        echo " {$this->gameCoordinates[1][0]} | {$this->gameCoordinates[1][1]} | {$this->gameCoordinates[1][2]} \n";
        echo "---+---+---\n";
        echo " {$this->gameCoordinates[2][0]} | {$this->gameCoordinates[2][1]} | {$this->gameCoordinates[2][2]} \n";
        echo "\n";
    }

    function playersTurn(): string
    {
        $number = 0;

        for ($i = 0; $i < count($this->gameCoordinates); $i++) {
            for ($j = 0; $j < count($this->gameCoordinates[$i]); $j++) {
                if ($this->gameCoordinates[$i][$j] === " ") {
                    $number++;
                }
            }
        }

        $this->emptyStrings = $number;

        if ($number % 2 === 0) {
            return "O";
        }
        return "X";
    }

    function makeMove()
    {
        $currentPlayer = $this->playersTurn();

        $row = readline("Enter row value: ");
        $col = readline("Enter column value: ");

        $isPromptActive = true;
        while ($isPromptActive) {
            if (!is_numeric($row)) {
                echo "Column $col\n";
                $row = readline("The value must be a number. Try again (row): ");
            } else if (!is_numeric($col)) {
                echo "Row $row\n";
                $col = readline("The value must be a number. Try again (column): ");
            } else if ($row > 2 || $row < 0) {
                $row = readline("The value must be between 0-2. Try again (row): ");
            } else if ($col > 2 || $col < 0) {
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

    function findWinner(): string
    {
        $coo = $this->gameCoordinates;

        for ($i = 0; $i <= 2; $i++) {
            if ($coo[0][$i] === $coo[1][$i] && $coo[1][$i] === $coo[2][$i] && $coo[0][$i] !== " ") {
                return $coo[0][$i];
            }
            if ($coo[$i][0] === $coo[$i][1] && $coo[$i][1] === $coo[$i][2] && $coo[$i][0] !== " ") {
                return $coo[$i][0];
            }
        }

        if ($coo[0][0] === $coo[1][1] && $coo[1][1] === $coo[2][2] && $coo[0][0] !== " ") {
            return $coo[0][0];
        }
        if ($coo[0][2] === $coo[1][1] && $coo[1][1] === $coo[2][0] && $coo[0][2] !== " ") {
            return $coo[0][2];
        }
        return " ";
    }

    function isTie(): bool
    {
        return $this->emptyStrings === 0 && $this->findWinner() !== "X";
    }

}

    $newGame = new TicTacToe();

    function redrawBoard($newGame)
    {
        while (true) {
            $currentPlayer = $newGame->playersTurn();
            echo "\nIt's $currentPlayer's turn:\n\n";
            $newGame->display_board();
            if ($newGame->isTie()) {
                echo "It's a tie!\n\n";
                exit();
            }
            $newGame->makeMove();

            if ($newGame->findWinner() !== " ") {
                echo "\nCongratulations {$newGame->findWinner()} won!\n\n";
                $newGame->display_board();
                exit();
            }
        }
    }

    redrawBoard($newGame);