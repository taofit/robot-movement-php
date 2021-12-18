<?php


namespace App;


class Input
{
    private $roomSize = [];
    private $position = [];
    private $orientation;
    private $command;
    private $validation;

    /**
     * Input constructor.
     * @param $validation
     */
    public function __construct($validation)
    {
        $this->validation = $validation;
    }


    public function enterAllInput()
    {
        $this->enterRoomSize();
        $this->enterPosition();
        $this->enterOrientation();
        $this->enterCommand();
    }

    /**
     * @return array
     */
    public function getAllInputParameters(): array
    {
        return [
            'roomSize' => $this->getRoomSize(),
            'position' => $this->getPosition(),
            'orientation' => $this->getOrientation(),
            'command' => $this->getCommand()
        ];
    }

    private function enterRoomSize(): void
    {
        while (true) {
            $line = readline('Please enter room size with two integer(width, depth)'.PHP_EOL);
            $roomSize = preg_split('/\s+/', $line);
            if (!$this->validation->isSize($roomSize)) {
                echo 'invalid room size'.PHP_EOL;
            } else {
                $this->roomSize = $roomSize;
                break;
            }
        }
    }

    private function enterPosition(): void
    {
        while (true) {
            $line = readline('Please enter the starting position'.PHP_EOL);
            $position = preg_split('/\s+/', $line);
            if (!$this->validation->isInRoom($this->roomSize, $position)) {
                echo 'invalid starting position'.PHP_EOL;
            } else {
                $this->position = $position;
                break;
            }
        }
    }

    private function enterOrientation(): void
    {
        while (true) {
            $orientation = readline('Please enter the intial orientation'.PHP_EOL);
            if (!$this->validation->isOrientation($orientation)) {
                echo 'invalid orientation'.PHP_EOL;
            } else {
                $this->orientation = $orientation;
                break;
            }
        }
    }

    private function enterCommand(): void
    {
        while (true) {
            $command = readline('Please enter the command'.PHP_EOL);
            if (!$this->validation->isCommand($command)) {
                echo 'invalid command'.PHP_EOL;
            } else {
                $this->command = $command;
                break;
            }
        }
    }

    /**
     * @return array
     */
    public function getRoomSize(): array
    {
        return $this->roomSize;
    }

    /**
     * @return array
     */
    public function getPosition(): array
    {
        return $this->position;
    }

    /**
     * @return mixed
     */
    public function getOrientation()
    {
        return $this->orientation;
    }

    /**
     * @return mixed
     */
    public function getCommand()
    {
        return $this->command;
    }
}
