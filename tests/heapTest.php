<?php 
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

include_once "heap.php";        

final class heapTest extends TestCase
{

    public function testheap(): void
    {
        $h = new Heap();
        $values = [9, 7, 13, 9, 5, 6, 11, 2, 4, 8];
        foreach ($values as $v){
            $h->add($v);
        }

        //echo $h->getStr();
        $this->assertEquals($h->getRoot(), 2);
        $h->remove();
        $this->assertEquals($h->getRoot(), 4);
        $h->remove();
        $this->assertEquals($h->getRoot(), 5);
        $h->remove();
        $this->assertEquals($h->getRoot(), 6);
        $h->remove();
        $this->assertEquals($h->getRoot(), 7);
        $h->remove();
        $this->assertEquals($h->getRoot(), 8);

    }


    public function testMeldableheap(): void
    {
        $h = new MeldableHeap();
        $values = [9, 7, 13, 9, 5, 6, 11, 2, 4, 8];
        foreach ($values as $v){
            $h->add($v);
        }
        
        $this->assertEquals($h->getRootValue(), 2);
        $h->remove();
        $this->assertEquals($h->getRootValue(), 4);
        $h->remove();
        $this->assertEquals($h->getRootValue(), 5);
        $h->remove();
        $this->assertEquals($h->getRootValue(), 6);
        $h->remove();
        $this->assertEquals($h->getRootValue(), 7);
        $h->remove();
        $this->assertEquals($h->getRootValue(), 8);
        

    }


}