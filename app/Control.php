<?php


namespace App;


class Control
{
    private $input;
    private $roomSize;
    private $position;
    private $orientation;
    private $command;
    private $finalPosition;

    /**
     * Control constructor.
     */
    public function __construct()
    {
        $validation = new Validation;
        $this->input = new Input($validation);
    }

    public function operateRobot()
    {
        $this->enterAllInput();
        $this->fetchAllInput();
        $this->robotMovementOperation();
        $this->showRobotFinalPosition();
    }

    private function enterAllInput()
    {
        $this->input->enterAllInput();
    }

    private function fetchAllInput()
    {
        [
            'roomSize' => $this->roomSize,
            'position' => $this->position,
            'orientation' => $this->orientation,
            'command' => $this->command
        ] = $this->input->getAllInputParameters();
    }

    private function robotMovementOperation()
    {
        $room = new Room($this->roomSize);
        $robot = new Robot($this->position, $this->orientation, $room);
        $robotMovement = new RobotMovement($robot);
        $robotMovement->calculateFinalPosition($this->command);
        $this->finalPosition = $robotMovement->getFinalPosition();
    }

    private function showRobotFinalPosition()
    {
        echo sprintf(
            'Final position: (%d, %d), orientation: %s',
            $this->finalPosition['position']['x'],
            $this->finalPosition['position']['y'],
            $this->finalPosition['orientation']
        );
    }
}
