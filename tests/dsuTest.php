<?php 
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

include_once "dsu.php";        

final class dsuTest extends TestCase
{

    public function testdsu(): void
    {
        
        $dsu = new DSU();
        for($i=1; $i<=6; $i++){
            $dsu->make($i);
        }

        $s = $dsu->getString();
        $this->assertEquals($s, 'count: 6: (1_1_1), (2_2_1), (3_3_1), (4_4_1), (5_5_1), (6_6_1)');

        $dsu->merge(1, 2);
        $dsu->merge(3, 4);
        $dsu->merge(5, 6);
        $s = $dsu->getString();
        $this->assertEquals($s, 'count: 3: (1_2_1), (2_2_2), (3_4_1), (4_4_2), (5_6_1), (6_6_2)');

        $dsu->merge(2, 3);
        $s = $dsu->getString();
        $this->assertEquals($s, 'count: 2: (1_2_1), (2_4_2), (3_4_1), (4_4_3), (5_6_1), (6_6_2)');

        $dsu->merge(1, 6);
        $s = $dsu->getString();
        $this->assertEquals($s, 'count: 1: (1_4_1), (2_4_2), (3_4_1), (4_4_3), (5_6_1), (6_4_2)');

    }
}