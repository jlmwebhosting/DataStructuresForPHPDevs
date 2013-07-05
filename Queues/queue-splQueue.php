<?php
class ReadingList extends SplQueue
{
}

$myBooks = new ReadingList();

// add some items to the queue
$myBooks->enqueue('A Game of Thrones');
$myBooks->enqueue('A Clash of Kings');
$myBooks->enqueue('A Storm of Swords');
$myBooks->enqueue('A Feast for Crows');
$myBooks->enqueue('A Dance with Dragons');
$myBooks->enqueue('The Winds of Winter');
$myBooks->enqueue('A Dream of Spring');

// removing items from the front of the queue
echo $myBooks->dequeue() . "\n"; // outputs 'A Game of Thrones'
echo $myBooks->dequeue() . "\n"; // outputs 'A Clash of Kings'
echo $myBooks->dequeue() . "\n"; // outputs 'A Storm of Swords'

// what's at the front of the queue?
echo $myBooks->bottom() . "\n"; // outputs 'A Feast for Crows'

// remove it
echo $myBooks->dequeue() . "\n"; // outputs 'A Feast for Crows'

// add a new item
$myBooks->enqueue('The Armageddon Rag');

echo $myBooks->dequeue() . "\n"; // outputs 'A Dance with Dragons'
echo $myBooks->dequeue() . "\n"; // outputs 'The Winds of Winter'
echo $myBooks->dequeue() . "\n"; // outputs 'A Dream of Spring'
echo $myBooks->dequeue() . "\n"; // outputs 'The Armageddon Rag'
