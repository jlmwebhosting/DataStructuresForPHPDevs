<?php
class ReadingList extends SplStack
{
}

$myBooks = new ReadingList();

// add some items to the stack
$myBooks->push('A Dream of Spring');
$myBooks->push('The Winds of Winter');
$myBooks->push('A Dance with Dragons');
$myBooks->push('A Feast for Crows');
$myBooks->push('A Storm of Swords');
$myBooks->push('A Clash of Kings');
$myBooks->push('A Game of Thrones');

// removing items from the stack
echo $myBooks->pop() . "\n"; // outputs 'A Game of Thrones'
echo $myBooks->pop() . "\n"; // outputs 'A Clash of Kings'
echo $myBooks->pop() . "\n"; // outputs 'A Storm of Swords'

// what's at the top of the stack?
echo $myBooks->top() . "\n"; // outputs 'A Feast for Crows'

// remove it
echo $myBooks->pop() . "\n"; // outputs 'A Feast for Crows'

// add a new item
$myBooks->push('The Armageddon Rag');
echo $myBooks->pop() . "\n"; // outputs 'The Armageddon Rag'

echo $myBooks->pop() . "\n"; // outputs 'A Dance with Dragons'
echo $myBooks->pop() . "\n"; // outputs 'The Winds of Winter'
echo $myBooks->pop() . "\n"; // outputs 'A Dream of Spring'
