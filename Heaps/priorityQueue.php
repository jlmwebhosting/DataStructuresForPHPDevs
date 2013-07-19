<?php
class PQ extends SplPriorityQueue
{
    public function compare($p1, $p2) {
        if ($p1 === $p2) {
            return 0;
        }
        else {
            // in ascending order of priority, a lower value
            // means higher priority
            return ($p1 < $p2 ? 1 : -1);
        }
    }
}

$pq = new PQ();
$pq->insert('A', 4);
$pq->insert('B', 3);
$pq->insert('C', 5);
$pq->insert('D', 8);
$pq->insert('E', 2);
$pq->insert('F', 7);
$pq->insert('G', 1);
$pq->insert('H', 6);
$pq->insert('I', 0);

//$pq->setExtractFlags(SplPriorityQueue::EXTR_BOTH);
//$pq->setExtractFlags(SplPriorityQueue::EXTR_PRIORITY);
while ($pq->valid()) {
    print_r($pq->current());
    echo "\n";
    $pq->next();
}