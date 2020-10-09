<?php
// disjoint set unit

Class DSU_node {
    public $value = null;
    public $parent = null;
    public $rank = null;


}



Class DSU_SIMPLE {



}


// if parent point to itself,  it is root
// number of root is number of disjoint set
// when create, the node is a root
// after merge, node in the same set has the same root.
// try to let node directly point to root (path compression)
// when merge,  smaller branch add as child of larger branch  (union by rank)
Class DSU{

    public $count = 0;
    public $nodes = [];
    
    // create a set for $i
    public  function make($i){
        if(array_key_exists($i, $this->nodes)){
            return $this->nodes[$i];
        }
        else{
            $node = new DSU_node();
            $node->value = $i;
            $node->parent = $node;
            $node->rank = 1;
            

            $this->nodes[$i] = $node;
            $this->count++;
        }
    }


    // find the set of element $i.
    public  function find($i){
        if(array_key_exists($i, $this->nodes)){
            $node = $this->nodes[$i];

            if ($node->parent != $node){
                $node->parent = $this->find($node->parent->value);     // with path compression. all nodes in the path will directly point to root
            }
            return $node->parent;

        }
        return null;    
    }


    // merge $i, $j into 1 set.
    // put root with smaller rank   as child of root of larger rank
    // if rank equal, use any one as child.  update rank for the merged root.
    public function merge($i, $j){
        if(array_key_exists($i, $this->nodes) && array_key_exists($j, $this->nodes)){
            $root1 = $this->find($i);
            $root2 = $this->find($j);

            if($root1->rank < $root2->rank){
                $root1->parent = $root2;
            }
            else if($root2->rank < $root1->rank){
                $root2->parent = $root1;
            }
            else{
                // $root1->rank == $root2->rank;
                $root1->parent = $root2;
                $root2->rank = $root1->rank + 1;

            }

            $this->count--;

        }   


    }

    public function getString(){
        $str =[];
        foreach($this->nodes as $node){
            $str[] =  "(" .$node->value. "_" .$node->parent->value. "_" . $node->rank. ")";
        }
        return "count: " . $this->count . ": " . implode(", ", $str);
    }


}
