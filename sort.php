<?php

include_once "heap.php"; 

function mergeSort(&$a, $start, $end){
    $n = $end - $start + 1;
    if($n<=1){
        return;
    }
    else if($n==2){
        if($a[$start]>$a[$end]){
            $t = $a[$start];
            $a[$start] = $a[$end];
            $a[$end] = $t;
        }
        
    }
    else{
        $mid = floor(($start + $end)/2);

        $l = [];
        for($i=$start; $i<$mid; $i++){
            $l[] = $a[$i];
        }
        $r = [];
        for($i=$mid; $i<=$end;  $i++){
            $r[] = $a[$i];
        }

        mergeSort($l, 0, count($l)-1);
        mergeSort($r, 0, count($r)-1);        
     

        $pl = 0;
        $pr = 0;
        $pa = $start;

        for($i=0; $i<$n; $i++){
            if($pl>(count($l)-1) || $pr>(count($r)-1) ){
                break;
            }

            if($l[$pl]<$r[$pr]){                
                $a[$pa] = $l[$pl];
                $pl++;
            }
            else{                
                $a[$pa] = $r[$pr];
                $pr++;
            }
            $pa++;
        }

        if($pl<=(count($l)-1)){
            for($i=$pl; $i<=(count($l)-1); $i++){
                $a[$pa] = $l[$i];
                $pa++;
            }
        }
        if($pr<=(count($r)-1)){
            for($i=$pr; $i<=(count($r)-1); $i++){
                $a[$pa] = $r[$i];
                $pa++;
            }
        }

    }


}



function quickSort(&$a, $start, $end){
    $n = $end - $start + 1;
    if($n<=1){
        return;
    }
    /*
    //optional
    else if($n==2){
        if($a[$start]>$a[$end]){
            $t = $a[$start];
            $a[$start] = $a[$end];
            $a[$end] = $t;
        }
        
    }
    */
    else{

        $r = rand($start+1, $end-1);            // a random pivot
        $x = $a[$r];

        //put the pivot to the end
        $a[$r] = $a[$end];
        $a[$end] = $x;

        
        $p_known = $start;                    //pointer for elements known to be < pivot (the element before it is tested to be samller)
        for($i=$start; $i<=$end-1; $i++ ){
            if($a[$i]<$x){                     //if we do not do $p_known/$end switch after the for loog, 
                                                //then it has to be <=, so that the partition will shrink.
                                                //otherwise say the pivot is the samllest number, then the partion won't shrink
                $t = $a[$i];
                $a[$i] = $a[$p_known];
                $a[$p_known] = $t;
                $p_known++;
            }
            
        }

        $t = $a[$p_known];
        $a[$p_known] = $a[$end];
        $a[$end] = $t;

        quickSort($a, $start, $p_known-1);
        quickSort($a, $p_known+1, $end);



    }



    



}


function heapSort(&$a){
    $h = new Heap();
    $h->elements = $a;
    $m = $h->parent(count($h->elements)-1);

    for($i=9; $i>=0; $i--){
        $h->bubbleDown($i);
    }

    $n = count($a);
    $res = [];
    for($i=0; $i<$n; $i++){
        $res[] = $h->elements[0];        
        $h->elements[0] = $h->elements[count($h->elements)-1];
        unset($h->elements[count($h->elements)-1]);
        $h->bubbleDown(0);
    }

    for($i=0; $i<$n; $i++){
        $a[$i] = $res[$i];
    }

}


function return_self($v){
    return $v;
}

function countingSort($a, $bucketrange, $bucket_function){
    $buckets = [];
    for($i=0; $i<=$bucketrange; $i++){
        $buckets[$i] = [];
    }
    foreach ($a as $v){
        $bucket = $bucket_function($v);
        $buckets[$bucket][] = $v;
    }

    $res = [];
    foreach($buckets as $bucket){
        if(count($bucket)>0){
            foreach($bucket as $v){
                $res[] = $v;
            }
        }
    }
    return $res;

}


function get_number_at_postion($v, $p){
    $divide_by = pow(10, $p);
    $multiple = floor($v / $divide_by);
    return $multiple % 10; 

}

function base10radixSort(&$a, $numberOfDigits ){
    for($i=0; $i<numberOfDigits; $i++){
        
        $f = function($v)use($i){return get_number_at_postion($v, $i); };
        $a = countingSort($a, 10, $f);
        echo "\n a " .implode(', ', $a);
    }
}