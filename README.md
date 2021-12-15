# run the programm
1. git clone the `url`
2. php index.php
3. follow the command line instruction

This application is to calculate robot's final location and it orientation in a room after a sequence of movement that are defined by instructions/commands. The instructions are either move(left, right) or move forward.
Robot's movement is confined in a room size of width * depth, and robot's initial state consists of its initial location in the room, and orientation(north, east, west, and south). 
Obviously when robot is on the edge of room and tries to move against the wall, it will fail to move. The program will make sure the robot would not
go outside of the room. All user's input are entered in the command line. Program can detect user's invalid input such as robot's location is not in the room, or room size contains wrong value like negative number, and it will remind user of entering the correct input.     
It is written in vanilla PHP and in OOP way, including php unit testing.
# test the program
under project folder: run `./vendor/bin/phpunit`
