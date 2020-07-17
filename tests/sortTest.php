<?php 
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

include_once "sort.php";        

final class sortTest extends TestCase
{

    public function testMergeSort(): void
    {
        
        $a=[9, 7, 13, 9, 5, 6, 11, 2, 4, 8];
        mergeSort($a, 0, count($a)-1);
        $s = implode(', ', $a);
        $this->assertEquals($s, "2, 4, 5, 6, 7, 8, 9, 9, 11, 13");


        $a=[7, 0, 3, 1, 5, 4, 9, 2, 2, 1, 13, 8, 6, 4, 12, 6, 1, 10];
        mergeSort($a, 0, count($a)-1);
        $s = implode(', ', $a);
        $this->assertEquals($s, "0, 1, 1, 1, 2, 2, 3, 4, 4, 5, 6, 6, 7, 8, 9, 10, 12, 13");

        
       



    }


    public function testQuickSort(): void
    {

        $a=[3, 1, 2];
        quickSort($a, 0, count($a)-1);
        $s = implode(', ', $a);
        $this->assertEquals($s, "1, 2, 3");

        $a=[9, 7, 13, 9, 5, 6, 11, 2, 4, 8];
        quickSort($a, 0, count($a)-1);
        $s = implode(', ', $a);
        $this->assertEquals($s, "2, 4, 5, 6, 7, 8, 9, 9, 11, 13");


        $a=[7, 0, 3, 1, 5, 4, 9, 2, 2, 1, 13, 8, 6, 4, 12, 6, 1, 10];
        quickSort($a, 0, count($a)-1);
        $s = implode(', ', $a);
        $this->assertEquals($s, "0, 1, 1, 1, 2, 2, 3, 4, 4, 5, 6, 6, 7, 8, 9, 10, 12, 13");


        $a=[7, 6, 9, 9, 6, 7, 9, 7, 6, 6, 7, 9, 6, 9, 7];
        quickSort($a, 0, count($a)-1);
        $s = implode(', ', $a);
        $this->assertEquals($s, "6, 6, 6, 6, 6, 7, 7, 7, 7, 7, 9, 9, 9, 9, 9");

    }


    public function testHeapSort(): void
    {

        $a=[3, 1, 2];
        heapSort($a);
        $s = implode(', ', $a);
        $this->assertEquals($s, "1, 2, 3");

        
        $a=[9, 7, 13, 9, 5, 6, 11, 2, 4, 8];
        heapSort($a);
        $s = implode(', ', $a);
        $this->assertEquals($s, "2, 4, 5, 6, 7, 8, 9, 9, 11, 13");


        $a=[7, 0, 3, 1, 5, 4, 9, 2, 2, 1, 13, 8, 6, 4, 12, 6, 1, 10];
        heapSort($a);
        $s = implode(', ', $a);
        $this->assertEquals($s, "0, 1, 1, 1, 2, 2, 3, 4, 4, 5, 6, 6, 7, 8, 9, 10, 12, 13");


        $a=[7, 6, 9, 9, 6, 7, 9, 7, 6, 6, 7, 9, 6, 9, 7];
        heapSort($a);
        $s = implode(', ', $a);
        $this->assertEquals($s, "6, 6, 6, 6, 6, 7, 7, 7, 7, 7, 9, 9, 9, 9, 9");
     

    }

    public function testCountingSort(): void
    {   

        $v = 1032;
        $a = get_number_at_postion($v, 0);
        $this->assertEquals($a, 2);
        $a = get_number_at_postion($v, 1);
        $this->assertEquals($a, 3);
        $a = get_number_at_postion($v, 2);
        $this->assertEquals($a, 0);
        $a = get_number_at_postion($v, 3);
        $this->assertEquals($a, 1);

        $a=[3, 1, 2, 2, 1, 3];
        $f = function($v){return $v;};
        $res = countingSort($a, 10, 'return_self');
        $s = implode(', ', $res);
        $this->assertEquals($s, "1, 1, 2, 2, 3, 3");

        $a=[7, 0, 3, 1, 5, 4, 9, 2, 2, 1, 13, 8, 6, 4, 12, 6, 1, 10];
        $res = countingSort($a, 20, 'return_self');
        $s = implode(', ', $res);
        $this->assertEquals($s, "0, 1, 1, 1, 2, 2, 3, 4, 4, 5, 6, 6, 7, 8, 9, 10, 12, 13");
        return;

        $a = [1302, 9841, 7731, 2015, 1134, 7011, 7952,  2000, 7122, 7733, 6554, 3227, 2212];
        base10radixSort($a, 4);
        $s = implode(', ', $a);
        $this->assertEquals($s, '1134, 1302, 2000, 2015, 2212, 3227, 6554, 7011, 7122, 7731, 7733, 7952, 9841');



    }
    


}