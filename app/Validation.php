<?php


namespace App;

class Validation
{
    /**
     * @param array $roomSize
     * @return bool
     */
    public function isSize(array $roomSize): bool
    {
        if (count($roomSize) < 2 || !is_numeric($roomSize[0]) || !is_numeric($roomSize[1])) {
            return false;
        }
        return (int)$roomSize[0] > 0 && (int)$roomSize[1] > 0;
    }

    /**
     * @param array $roomSize
     * @param array $initPosition
     * @return bool
     */
    public function isInRoom(array $roomSize, array $initPosition): bool
    {
        if (!is_numeric($initPosition[0]) || !is_numeric($initPosition[1]) || !$this->isSize($roomSize)) {
            return false;
        }

        return (int)$initPosition[0] >= 0 &&
            (int)$initPosition[1] >= 0 &&
            (int)$initPosition[0] < (int)$roomSize[0] &&
            (int)$initPosition[1] < (int)$roomSize[1];
    }

    /**
     * @param string $orientation
     * @return bool
     */
    public function isOrientation(string $orientation): bool
    {
        return preg_match('/^[NESW]$/i', $orientation);
    }

    /**
     * @param string $command
     * @return bool
     */
    public function isCommand(string $command): bool
    {
        return preg_match('/^[LRF]+$/i', $command);
    }

    /**
     * @param array $roomSize
     * @param array $initPosition
     * @param string $orientation
     * @param string $command
     * @return bool
     */
    public function isAllInputValid(array $roomSize, array $initPosition, string $orientation, string $command): bool
    {
        $result = false;
        if ($this->isSize($roomSize) &&
            $this->isInRoom($roomSize, $initPosition) &&
            $this->isOrientation($orientation) &&
            $this->isCommand($command)
        ) {
            $result = true;
        }

        return $result;
    }
}