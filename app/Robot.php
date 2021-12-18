<?php

namespace App;

class Robot
{
    private $position = [];
    private $orientation;
    private $room;
    private const ORIENTATION_MAP = [
        'N' => ['L' => 'W', 'R' => 'E'],
        'E' => ['L' => 'N', 'R' => 'S'],
        'S' => ['L' => 'E', 'R' => 'W'],
        'W' => ['L' => 'S', 'R' => 'N']
    ];

    /**
     * Robot constructor.
     * @param $position
     * @param $orientation
     * @param $room
     */
    public function __construct(array $position, string $orientation, Room $room)
    {
        list($this->position['x'], $this->position['y']) = array_map('intval', $position);
        $this->orientation = strtoupper($orientation);
        $this->room = $room->getRoom();
    }

    /**
     * @param string $turnCommand
     */
    public function turn(string $turnCommand): void
    {
        $orientation = self::ORIENTATION_MAP[$this->orientation][$turnCommand];
        $this->setOrientation($orientation);
    }

    public function move(): void
    {
        $curPosition = $this->getPosition();

        switch ($this->getOrientation()) {
            case 'N':
                if ($curPosition['y'] < $this->room['depth'] - 1) {
                    $curPosition['y']++;
                }
                break;
            case 'E':
                if ($curPosition['x'] < $this->room['width'] - 1) {
                    $curPosition['x']++;
                }
                break;
            case 'S':
                if ($curPosition['y'] > 0) {
                    $curPosition['y']--;
                }
                break;
            case 'W':
                if ($curPosition['x'] > 0) {
                    $curPosition['x']--;
                }
                break;
        }
        $this->setPosition($curPosition);
    }

    /**
     * @return string
     */
    public function getOrientation(): string
    {
        return $this->orientation;
    }

    /**
     * @param string $orientation
     */
    private function setOrientation(string $orientation)
    {
        $this->orientation = $orientation;
    }

    /**
     * @param array $position
     */
    private function setPosition(array $position)
    {
        $this->position = $position;
    }

    /**
     * @return array
     */
    public function getPosition(): array
    {
        return $this->position;
    }

}
