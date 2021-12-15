<?php

namespace App;

class RobotMovement
{
    private $robot;

    /**
     * RobotMovement constructor.
     * @param Robot|null $robot
     */
    public function __construct(Robot $robot = null)
    {
        $this->robot = $robot;
    }

    /**
     * @param Robot $robot
     */
    public function setRobot(Robot $robot): void
    {
        $this->robot = $robot;
    }

    /**
     * @param string $command
     */
    public function calculateFinalPosition(string $command): void
    {
        $commandArr = str_split(strtoupper($command));

        foreach ($commandArr as $singleCommand) {
            if ($this->isTurnCmd($singleCommand)) {
                $this->robot->turn($singleCommand);
            } elseif ($this->isForwardCmd($singleCommand)) {
                $this->robot->move();
            }
        }
    }

    /**
     * @return array
     */
    public function getFinalPosition(): array
    {
        return ['position' => $this->robot->getPosition(), 'orientation' => $this->robot->getOrientation()];
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