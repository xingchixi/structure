<?php
include_once "BinaryTreeNode.php";  


class Heap{
    public $elements = [];

    public function left($i){
        return 2*$i + 1;
    }

    
    public function right($i){
        return 2*$i + 2;
    }


    public function parent($i){
        return floor(($i-1)/2);
    }


    public function count(){
        return count($this->elements);
    }


    public function getStr(){
        return implode(', ', $this->elements);
    }


    public function add($x){
        $this->elements[] = $x;
        $this->bubbleUp($this->count()-1);

    }


    public function bubbleUp($i){
        $p = $this->parent($i);

        while($i>0 && $this->elements[$p]>$this->elements[$i]){
            $t = $this->elements[$p];
            $this->elements[$p] = $this->elements[$i];
            $this->elements[$i] = $t;
            $i = $p;
            $p = $this->parent($i);
        }
    }


    public function getRoot(){
        if($this->count()){
            return $this->elements[0];
        }
        return null;
    }


    public function remove(){
        if(!$this->count()){
            return null;
        }

        $x = array_shift($this->elements);
        $z = array_pop($this->elements);
        array_unshift($this->elements, $z);

        $this->bubbleDown(0);
        return $x;
    }


    public function bubbleDown($i){
        $c = 0;
        while ($i>=0){

            $toSwitch = -1;

            $r=$this->right($i);
            $n = $this->count();
            if($r<$n && $this->elements[$r]<$this->elements[$i]){
                $l = $this->left($i);
                if($this->elements[$l] < $this->elements[$r]){
                    $toSwitch = $l;

                }
                else{
                    $toSwitch = $r;

                }
            }
            else{
                $l = $this->left($i);
                if($l<$n && $this->elements[$l]<$this->elements[$i]){
                    $toSwitch = $l;

                }
            }

            if($toSwitch>=0){
                $t = $this->elements[$i];
                $this->elements[$i] = $this->elements[$toSwitch];
                $this->elements[$toSwitch]=$t;

            }
            $i = $toSwitch;

            $c++;
            if($c>10){
                die('cccc');
            }
        }        
    }
}



class MeldableHeap{

    public $root = null;

    public function merge($a, $b){
        if($a==null){
            return $b;
        }
        if($b==null){
            return $a;
        }

        // make $a the one with smaller rootsamller value one
        if($b->value<$a->value){
            $t = $a;
            $a = $b;
            $b = $t;
        }

        if(rand(0, 1)){
            $a->left = $this->merge($a->left, $b);
        }
        else{
            $a->right = $this->merge($a->right, $b);

        }
        return $a;
    }

    // $x is a value
    public function add($x){
        $node = new BinaryTreeNode($x);
        $this->root = $this->merge($this->root, $node);
    }


    public function remove(){
        if($this->root==null){
            return;
        }
        $return = $this->root;
        $this->root = $this->merge($this->root->left, $this->root->right);
        return $return;
    }


    public function getRoot(){
        return $this->root;
    }


    public function getRootValue(){
        if($this->root==null){
            return null;
        }
        return $this->root->value;
    }

    
}