<?php
use \PHPUnit\Framework\TestCase;
use App\Robot;
use App\Room;

class RobotTest extends TestCase
{
    private $robot;

    public function setUp(): void
    {
        $position = ['34', '0'];
        $orientation = 'e';
        $roomSize = ['37','38'];
        $room = new Room($roomSize);
        $this->robot = new Robot($position, $orientation, $room);
    }

    public function tearDown(): void
    {
        $this->robot = null;
    }

    /**
     * @dataProvider turnCommandProvider
     * @param $turnCommand
     * @param $orientation
     * @param $expect
     */
    public function testTurn($turnCommand, $orientation, $expect): void
    {
        $this->robot->turn($turnCommand);
        $this->assertSame($expect, $this->robot->getOrientation() === $orientation);
    }

    public function testTurnInSerial(): void
    {
        $this->robot->turn('R');
        $this->assertSame($this->robot->getOrientation(), 'S');
        $this->robot->turn('R');
        $this->assertSame($this->robot->getOrientation(), 'W');
        $this->robot->turn('L');
        $this->assertSame($this->robot->getOrientation(), 'S');
        $this->robot->turn('L');
        $this->assertSame($this->robot->getOrientation(), 'E');
        $this->robot->turn('R');
        $this->assertSame($this->robot->getOrientation(), 'S');
    }


    public function testMove(): void
    {
        $this->robot->move();
        $this->assertSame(['x' => 35, 'y' => 0], $this->robot->getPosition());
        $this->robot->move();
        $this->assertSame(['x' => 36, 'y' => 0], $this->robot->getPosition());
        $this->robot->move();
        $this->assertSame(['x' => 36, 'y' => 0], $this->robot->getPosition());
        $this->assertNotSame(['x' => 37, 'y' => 0], $this->robot->getPosition());
        $this->robot->move();
        $this->assertSame(['x' => 36, 'y' => 0], $this->robot->getPosition());
    }

    public function turnCommandProvider(): array
    {
        return [
          ['L', 'N', true],
          ['R', 'S', true],
          ['L', 'W', false],
        ];
    }
}
