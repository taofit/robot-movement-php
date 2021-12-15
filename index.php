<?php
require __DIR__.'/vendor/autoload.php';
use App\RobotMovement;
use App\Validation;
use App\Robot;
use App\Room;
use App\Input;

$validation = new Validation;
$input = new Input($validation);

$input->enterRoomSize();
$input->enterPosition();
$input->enterOrientation();
$input->enterCommand();

$roomSize = $input->getRoomSize();
$position = $input->getPosition();
$orientation = $input->getOrientation();
$command = $input->getCommand();

$room = new Room($roomSize);
$robot = new Robot($position, $orientation, $room);
$robotMovement = new RobotMovement($robot);
$robotMovement->calculateFinalPosition($command);
$finalPosition = $robotMovement->getFinalPosition();

echo sprintf(
    'Final position: (%d, %d), orientation: %s',
    $finalPosition['position']['x'],
    $finalPosition['position']['y'],
    $finalPosition['orientation']
);


