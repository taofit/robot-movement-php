<?php


namespace App;

class Validation
{
    public function isSize(array $roomSize): bool
    {
        if (count($roomSize) !== 2 || !is_numeric($roomSize[0]) || !is_numeric($roomSize[1])) {
            return false;
        }
        return (int)$roomSize[0] > 0 && (int)$roomSize[1] > 0;
    }

    public function isInRoom($roomSize, $initLocation): bool
    {
        if (!is_numeric($initLocation[0]) || !is_numeric($initLocation[1]) || !$this->isSize($roomSize)) {
            return false;
        }

        return (int)$initLocation[0] >= 0 &&
            (int)$initLocation[1] >= 0 &&
            (int)$initLocation[0] < (int)$roomSize[0] &&
            (int)$initLocation[1] < (int)$roomSize[1];
    }

    public function isOrientation($orientation): bool
    {
        return preg_match('/^[NESW]$/i', $orientation);
    }

    public function isCommand($command): bool
    {
        return preg_match('/^[LRF]+$/i', $command);
    }

    public function getErrorMessage($roomSize, $initLocation, $command): string
    {
        $errorMessage = '';
        if (!$this->isSize($roomSize)) {
            $errorMessage = 'Room size is wrong'.PHP_EOL;
        }
        if (!$this->isInRoom($roomSize, $initLocation)) {
            $errorMessage .= 'robot\'s location is wrong and is not in room'.PHP_EOL;
        }
        if (!$this->isOrientation($initLocation['orientation'])) {
            $errorMessage .= 'robot\'s orientation is wrong'.PHP_EOL;
        }
        if (!$this->isCommand($command)) {
            $errorMessage .= 'command instruction is wrong'.PHP_EOL;
        }

        return $errorMessage;
    }
}