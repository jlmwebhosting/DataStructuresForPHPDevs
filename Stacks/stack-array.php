<?php
class ReadingList
{
    protected $stack;
    protected $limit;
    
    public function __construct($limit = 10) {
        // initialize the stack
        $this->stack = array();
        // stack can only contain this many items
        $this->limit = $limit;
    }

    public function push($item) {
        // trap for stack overflow
        if (count($this->stack) < $this->limit) {
            // prepend item to the start of the array
            array_unshift($this->stack, $item);
        }
        else {
            throw new RunTimeException('Stack is full!'); 
        }
    }

    public function pop() {
        if ($this->isEmpty()) {
            // trap for stack underflow
          throw new RunTimeException('Stack is empty!');
        }
        else {
            // pop item from the start of the array
            return array_shift($this->stack);
        }
    }

    public function top() {
        return current($this->stack);
    }

    public function isEmpty() {
        return empty($this->stack);
    }
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
