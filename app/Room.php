<?php


namespace App;


class Room
{
    private $width;
    private $depth;

    /**
     * Room constructor.
     * @param array $roomSize
     */
    public function __construct(array $roomSize)
    {
        $this->width = (int)$roomSize[0];
        $this->depth = (int)$roomSize[1];
    }

    /**
     * @return array
     */
    public function getRoom(): array
    {
        return ['width' => $this->width, 'depth' => $this->depth];
    }
}