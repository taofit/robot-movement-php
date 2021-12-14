<?php

namespace App;

class RobotMovement
{
    private $operands;
    const ORIENTATION_MAP = ['N' => ['L' => 'W', 'R' => 'E'],
        'E' => ['L' => 'N', 'R' => 'S'],
        'S' => ['L' => 'E', 'R' => 'W'],
        'W' => ['L' => 'S', 'R' => 'N']];

    public function setOperands(array $operands)
    {
        $this->operands = $operands;
    }
    public function add()
    {
        return array_sum($this->operands);
    }

    /**
     * @param array $roomSize
     * @param array $initLocation
     * @param string $command
     * @return array
     */
    public function getFinalPosition(array $roomSize, array $initLocation, string $command): array
    {
        $curOrientation = strtoupper($initLocation['orientation']);
        $command = strtoupper($command);
        $curLocation = ['x' => $initLocation['x'], 'y' => $initLocation['y']];

        $commandArr = str_split($command);

        foreach ($commandArr as $singleCommand) {
            if ($this->isTurnCmd($singleCommand)) {
                $curOrientation = self::ORIENTATION_MAP[$curOrientation][$singleCommand];
            } elseif ($this->isForwardCmd($singleCommand)) {
                switch ($curOrientation) {
                    case 'N':
                        if ($curLocation['y'] < $roomSize['depth'] - 1) {
                            $curLocation['y']++;
                        }
                        break;
                    case 'E':
                        if ($curLocation['x'] < $roomSize['width'] - 1) {
                            $curLocation['x']++;
                        }
                        break;
                    case 'S':
                        if ($curLocation['y'] > 0) {
                            $curLocation['y']--;
                        }
                        break;
                    case 'W':
                        if ($curLocation['x'] > 0) {
                            $curLocation['x']--;
                        }
                        break;
                }
            }
        }

        return ['x' => $curLocation['x'], 'y' => $curLocation['y'], 'orientation' => $curOrientation];
    }

    /**
     * @param $singleCommand
     * @return bool
     */
    private function isTurnCmd($singleCommand): bool
    {
        return in_array($singleCommand, ['L', 'R']);
    }

    /**
     * @param $command
     * @return bool
     */
    private function isForwardCmd($command): bool
    {
        return $command === 'F';
    }
}