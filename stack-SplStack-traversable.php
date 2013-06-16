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

// normal top-down traversal (last item shown first)
// default traversal mode for a stack
$myBooks->setIteratorMode(
    SplDoublyLinkedList::IT_MODE_LIFO | SplDoublyLinkedList::IT_MODE_KEEP
);
echo "Traversing Top-Down...\n";
foreach ($myBooks as $book) {
    echo $book . "\n";
}

// bottom-up traversal (first item inserted shown first)
$myBooks->setIteratorMode(
    SplDoublyLinkedList::IT_MODE_FIFO | SplDoublyLinkedList::IT_MODE_KEEP
);
echo "\nTraversing Bottom-Up...\n";
foreach ($myBooks as $book) {
    echo $book . "\n";
}
