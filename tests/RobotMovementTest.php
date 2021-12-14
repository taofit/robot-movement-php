<?php
use \PHPUnit\Framework\TestCase;
use App\RobotMovement;
use App\Validation;

class RobotMovementTest extends TestCase
{
    private $robotMovement;
    private $validation;

    public function setUp(): void
    {
        $this->robotMovement = new RobotMovement;
        $this->validation = new Validation;
    }

    public function testAdd()
    {
        $this->robotMovement->setOperands([5,20]);
        $this->assertEquals(25, $this->robotMovement->add());
    }

    public function testCommand()
    {
        $command = 'lflrflrfrlfrllrflrlflrflrflrllrllrllf';
        $this->assertTrue($this->validation->isCommand($command));
    }

    public function testOrientation()
    {
        $orientation = 'd';
        $this->assertFalse($this->validation->isOrientation($orientation));
    }

    public function testSize()
    {
        $roomSize = ['width' => 343, 'depth' => 33];
        $this->assertTrue($this->validation->isSize($roomSize));
    }
    public function testInRoom()
    {
        $roomSize = ['width' => 343, 'depth' => 33];
        $initLocation = ['x' => 5000, 'y' => 3];
        $this->assertFalse($this->validation->isInRoom($roomSize, $initLocation));
    }
}