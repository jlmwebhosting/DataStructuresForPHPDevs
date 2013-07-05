<?php
class BinaryNode
{
    public $value;  // node item
    public $left;   // left subtree
    public $right;  // right subtree

    public function __construct($item) {
        $this->value = $item;
        $this->left = null;
        $this->right = null;
    }

    public function isLeaf() {
        return ($this->right === null && $this->left === null);
    }

    public function getKey() {
        return $this->value->id();
    }

    public function getValue() {
        return $this->value->get();
    }

    // perform an in-order traversal of the current node
    public function dump() {
        if ($this->left !== null) {
            $this->left->dump();
        }
        echo $this->getKey() . '=' . $this->getValue() . "\n";
        if ($this->right !== null) {
            $this->right->dump();
        }
    }
}

class BinaryTree
{
    public $root;
    public $found;

    public function __construct() {
        $this->root = null;
    }

    public function isEmpty() {
        return $this->root === null;
    }

    public function insert($item) {
        $node = new BinaryNode($item);
        if ($this->isEmpty()) {
            $this->root = $node;
        }
        else {
            // insert the node somewhere in the tree starting at the root
            $this->insertNode($node, $this->root);
        }
    }

    protected function insertNode($node, &$subtree) {
        if ($subtree === null) {
            // insert node here if subtree is empty
            $subtree = $node;
        }
        else if ($node->value > $subtree->value) {
            // keep trying to insert right
            $this->insertNode($node, $subtree->right);
        }
        else if ($node->value < $subtree->value) {
            // keep trying to insert left
            $this->insertNode($node, $subtree->left);
        }
        else {
            // reject duplicates
        }
    }

    public function locate($key, $method = 'bfs') {
        $this->found = null;
        // PHP 5.4 allows $this to be used in anonymous functions.
        // To support 5.3, pass instance as closure
        $me = $this;
        $op = function($subtree) use($me, $key) {
            if ($subtree->getKey() == $key) {
                $me->found = $subtree->getValue();
            }
        };

        $this->traverse($this->root, $method, $op);

        if ($this->found !== null) {
            echo $key . " FOUND!\n";
        }
        else {
            echo $key . " NOT FOUND :(\n";
        }
        return $this->found;
    }

    public function preorder($subtree, $op) {
        if ($subtree !== null) {
            call_user_func_array($op, array($subtree));
            if ($subtree->left !== null) {
                $this->preorder($subtree->left, $op);
            }
            if ($subtree->right !== null) {
                $this->preorder($subtree->right, $op);
            }
        }
    }

    public function inorder($subtree, $op) {
        if ($subtree !== null) {
            if ($subtree->left !== null) {
                $this->inorder($subtree->left, $op);
            }
            call_user_func_array($op, array($subtree));
            if ($subtree->right !== null) {
                $this->inorder($subtree->right, $op);
            }
        }
    }

    public function postorder($subtree, $op) {
        if ($subtree !== null) {
            if ($subtree->left !== null) {
                $this->postorder($subtree->left, $op);
            }
            if ($subtree->right !== null) {
                $this->postorder($subtree->right, $op);
            }
            call_user_func_array($op, array($subtree));
        }
    }

    public function bfs($subtree, $op) {
        $iterations = 0;
        // mark all nodes as "unvisited"
        $v = array();
        // use an inorder traversal to get all nodes
        $this->traverse($subtree, 'inorder', function($tree) use(&$v) {
            $v[$tree->getKey()] = false;
        });

        $q = new SplQueue();
        // enqueue root node and mark as "visited"
        $q->enqueue($subtree);
        $v[$subtree->getKey()] = true;

        $this->found = null;
        while (!$q->isEmpty() && !$this->found) {
            // dequeue node from front of queue
            $t = $q->dequeue();
            echo $t->getKey();

            call_user_func_array($op, array($t));

            // enqueue each "unvisited" adjacent node
            if ($t->left !== null && $v[$t->left->getKey()] == false) {
                $q->enqueue($t->left);
                $v[$t->left->getKey()] = true;
            }
            if ($t->right !== null && $v[$t->right->getKey()] == false) {
                $q->enqueue($t->right);
                $v[$t->right->getKey()] = true;
            }

            echo " > ";

            $iterations++;
        }
        echo "\n";

        if ($this->found) {
            echo 'Found in ' . $iterations . " hops\n";
        }
    }

    public function traverse($subtree, $order = 'inorder', $op) {
        switch($order) {
            case 'postorder':
                $this->postorder($subtree, $op);
                break;

            case 'preorder':
                $this->preorder($subtree, $op);
                break;

            case 'bfs':
                $this->bfs($subtree, $op);
                break;

            case 'inorder':
                default:
                $this->inorder($subtree, $op);
                break;
        }
    }
}

interface NodeItem
{
    public function id();
    public function get();
}

class Contact implements NodeItem
{
    public $name;
    public $phone;

    public function __construct($name, $phone) {
        $this->name = $name;
        $this->phone = $phone;
    }

    public function id() {
        return $this->name;
    }

    public function get() {
        return $this->phone;
    }
}

class ContactList extends BinaryTree
{
}

$list = new ContactList();

$list->insert(new Contact('Sue', '555-1234'));
$list->insert(new Contact('John', '555-5678'));
$list->insert(new Contact('Mary', '555-9012'));
$list->insert(new Contact('Sally', '555-9876'));
$list->insert(new Contact('Mark', '555-3456'));
$list->insert(new Contact('Tom', '555-7890'));
$list->insert(new Contact('Dick', '555-4567'));
$list->insert(new Contact('Sally', '555-7654'));
$list->insert(new Contact('Harry', '555-6789'));
$list->insert(new Contact('Julie', '555-5432'));
$list->insert(new Contact('Paul', '555-3210'));

echo $list->locate('John', 'inorder') . "\n";   // 555-5678
echo $list->locate('Tom', 'preorder') . "\n";   // 555-7890
echo $list->locate('Mary', 'postorder') . "\n"; // 555-9012
echo $list->locate('Sally') . "\n"; // 555-7654
echo $list->locate('Peter') . "\n"; // not found
