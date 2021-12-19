<?php
use \PHPUnit\Framework\TestCase;
use App\RobotMovement;
use App\Robot;
use App\Room;
use App\Validation;

class RobotMovementTest extends TestCase
{
    private $robotMovement;
    private $validation;

    public function setUp(): void
    {
        $this->robotMovement = new RobotMovement();
        $this->validation = new Validation;
    }

    public function tearDown(): void
    {
        $this->robotMovement = null;
        $this->validation = null;
    }

    /**
     * @dataProvider AllValueProvider
     * @param $roomSize
     * @param $position
     * @param $orientation
     * @param $command
     * @param $expect
     */
    public function testFinalPosition($roomSize, $position, $orientation, $command, $expect): void
    {
        if($this->validation->isAllInputValid($roomSize, $position, $orientation, $command)) {
            $room = new Room($roomSize);
            $robot = new Robot($position, $orientation, $room);
            $this->robotMovement->setRobot($robot);
            $this->robotMovement->calculateFinalPosition($command);
            $this->assertSame($expect, $this->robotMovement->getFinalPosition());
        } else {
            $this->assertFalse($expect);
        }
    }

    public function AllValueProvider(): array
    {
        return [
          [['12', '9'], ['3', '0'], 'E', 'lfrlflrflrlrlfllfflflflrlflrlf', ['position' => ['x' => 4,'y' => 3], 'orientation' => 'E']],
          [['122', '29'], ['3', '10'], 'E', 'lfrlflrflrlrlfllfflflflrlflrlf', ['position' => ['x' => 4,'y' => 13], 'orientation' => 'E']],
          [['5', '6'], ['3', '4'], 'e', 'LFFLRLFLRLF', ['position' => ['x' => 2, 'y' => 4], 'orientation' => 'S']],
          [['12', '9'], ['3', '10'], 'E', 'lfrlflrflrlrlfllfflflflrlflrlf', false],
          [['152', '32'], [32, 1], 'E', 'rffrlflrflrflfrflrlflrlf', false],
          [['12', '9'], ['3', '-1'], 'W', 'lfrlflrflrlrugjglflflrlflrlf', false],
          [['102', '19'], ['-3', '10'], 'E', 'lfrlflrflrlrlfllfflflflrlflrlf', false],
          [['12', '9'], ['3', '10'], 'E', 'lfrlflrflrlrlfllfflflflrlflrlf', false],
          [['36', '-9'], ['3', '10'], 'E', 'lfrlflrflrlrlfllfflflflrlflrlf', false],
          [['122', 29], ['3', '10'], 'E', 'lfrlflrflrlrlfllfflflflrlflrlf', false],
        ];
    }
}
