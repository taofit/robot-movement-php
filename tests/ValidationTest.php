<?php
use \PHPUnit\Framework\TestCase;
use App\Validation;

class ValidationTest extends TestCase
{
    private $validation;

    public function setUp(): void
    {
        $this->validation = new Validation();
    }

    public function tearDown(): void
    {
        $this->validation = null;
    }

    /**
     * @dataProvider commandProvider
     * @param string $command
     * @param bool $expect
     */
    public function testCommand(string $command, bool $expect): void
    {
        $this->assertSame($expect, $this->validation->isCommand($command));
    }

    /**
     * @dataProvider roomSizeProvider
     * @param array $roomSize
     * @param bool $expect
     */
    public function testSize(array $roomSize, bool $expect): void
    {
        $this->assertSame($expect, $this->validation->isSize($roomSize));
    }

    /**
     * @dataProvider orientationProvider
     * @param $orientation
     * @param bool $expect
     */
    public function testOrientation($orientation, bool $expect):void
    {
        $this->assertSame($expect, $this->validation->isOrientation($orientation));
    }

    /**
     * @dataProvider inRoomProvider
     * @param $roomSize
     * @param $initPosition
     * @param bool $expect
     */
    public function testIsInRoom($roomSize, $initPosition, bool $expect): void
    {
        $this->assertSame($expect, $this->validation->isInRoom($roomSize, $initPosition));
    }

    /**
     * @dataProvider validAllInputProvider
     * @param $roomSize
     * @param $position
     * @param $orientation
     * @param $command
     * @param bool $expect
     */
    public function testAllInputValid($roomSize, $position, $orientation, $command, bool $expect): void
    {
        $this->assertSame($expect, $this->validation->isAllInputValid($roomSize, $position, $orientation, $command));
    }

    public function commandProvider(): array
    {
        return [
            ['rflrfrlfrllRFLRLflrflrFLRLlrllrfff', true],
            ['lllrflrfrllfrlrflrflrllrllrllf', true],
            ['frrflrflrfrflrflrllrllrrr', true],
            ['frrflrflrfrflr4flrllrllrr4r', false],
            ['3874y3n4t8374yt324thi2rgh439gy49', false],
        ];
    }

    public function roomSizeProvider(): array
    {
        return [
            [['34', '5'], true],
            [['45345', '45345'], true],
            [['845', '0'], false],
            [['fsdf', 34], false],
            [[345, 454], true],
            [[345, -54], false],
            [['$%^df', 54], false]
        ];
    }

    public function orientationProvider(): array
    {
        return [
            ['e', true],
            ['w', true],
            ['s', true],
            ['N', true],
            ['ww', false],
            ['45', false],
            [945, false],
            ['osdf', false],
            ['o', false],
        ];
    }

    public function inRoomProvider(): array
    {
        return [
          [[24,34], [3,6], true],
          [['24',34], ['23','6'], true],
          [['2k','34'], ['23','6'], false],
          [['24',34], ['23','6'], true],
          [[24,3], ['23','0'], true],
          [[24,3], ['23',-45], false],
          [[24,3], ['23','58'], false],
          [['sdf','73'], ['23','58'], false],
        ];
    }

    public function validAllInputProvider(): array
    {
        return [
          [['34', '35'], ['23','6'], 'W', 'lrlfrlrflrfrlfrfl', true],
          [['364', '35'], [0,'26'], 'e', 'lrlfrLRFLRfrlfrfl', true],
          [['74', '45'], [0,36], 'N', 'LFRLLRFLRfrlfRFL', true],
          [['74', '45'], [14,26], 's', 'lflrflrfLRfrlfRrfrl', true],
          [['34', 35], [0,'26'], 'ue', 'lrlfrLRFLRfrlf9rfl', false],
          [['34', 35], [0,'26'], 'ue', 'lrlfrLRFLRfrlf9rfl', false],
          [['34', 365], [10,'26'], 's', '$#%RGLejg', false],
          [['74', '45'], [0,76], 'N', 'LFRLlflrflfrfrrrrfffrlfRFL', false]
        ];
    }
}