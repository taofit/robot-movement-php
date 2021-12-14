<?php
require __DIR__.'/vendor/autoload.php';
use App\RobotMovement;
use App\Validation;

$robotMovement = new RobotMovement;
$validation = new Validation();

while (true) {
    $line = readline('Please enter room size with two integer(width, depth)'.PHP_EOL);
    $roomSize = preg_split('/\s+/', $line);
    if (!$validation->isSize($roomSize)) {
        echo 'invalid room size'.PHP_EOL;
    } else {
        break;
    }
}

while (true) {
    $line = readline('Please enter the starting position'.PHP_EOL);
    $initLocation = preg_split('/\s+/', $line);
    if (!$validation->isInRoom($roomSize, $initLocation)) {
        echo 'invalid starting position'.PHP_EOL;
    } else {
        break;
    }
}
while (true) {
    $orientation = readline('Please enter the intial orientation'.PHP_EOL);
    if (!$validation->isOrientation($orientation)) {
        echo 'invalid orientation'.PHP_EOL;
    } else {
        break;
    }
}

while (true) {
    $command = readline('Please enter the command'.PHP_EOL);
    if (!$validation->isCommand($command)) {
        echo 'invalid command'.PHP_EOL;
    } else {
        break;
    }
}

$processInitLocation = static function ($value) {
    return is_numeric($value) ? (int) $value : $value;
};

list($validRoomSize['width'], $validRoomSize['depth']) = array_map('intval', $roomSize);
list($validInitLocation['x'], $validInitLocation['y']) = array_map($processInitLocation, $initLocation);
$validInitLocation['orientation'] = $orientation;

var_dump($validInitLocation, $validRoomSize);
$finalLocation = $robotMovement->getFinalPosition($validRoomSize, $validInitLocation, $command);
var_dump($finalLocation);


