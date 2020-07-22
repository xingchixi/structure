<?php
class TrieNode{
    public $value = null;
    public $children = [];
    public $isEnd = false;

    function __construct($value=null) 
    { 
    	$this->value = $value; 
    }

}


class Trie{
    public $root = [];

    function __construct() 
    { 
    	$this->root = new TrieNode();
    }


    function add($word){
        $node = $this->root;
        for($i=0; $i<strlen($word); $i++){
            $letter = $word[$i];
            if(isset($node->children[$letter])){
                $node = $node->children[$letter];
            }
            else{
                $newNode = new TrieNode($letter);
                $node->children[$letter] = $newNode; 
                $node = $newNode;
            }
        }

        $node->isEnd = true;


    }


    function find($word){
        $node = $this->root;
        for($i=0; $i<strlen($word); $i++){
            $letter = $word[$i];
            if(isset($node->children[$letter])){
                $node = $node->children[$letter];
            }
            else{
                return false;
            }
        }

        return $node;
    }



    function remove($word){
        if($word==''){
            return;
        }

        $path = [$this->root];

        $node = $this->root;
        for($i=0; $i<strlen($word); $i++){
            $letter = $word[$i];
            
            if(isset($node->children[$letter])){                
                $node = $node->children[$letter];
                $path[] = $node;
            }
            else{
                break;
            }
        }
        
        if(count($path)-1 < strlen($word) ){
            //echo "\n do not have this word. no need to remove";
        }
        else if( count($path[count($path)-1]->children )>0){
            //echo "\n has longer word. just set isEnd";
        }
        else{
            //at this the word ends in a leaf of the trie
            // the leaf can be removed
            // and we should check all parents to see if parents can be remvoed too
            if(count($path)>1){
                $n = count($path);
                $value = $path[$n-1]->value;
                $path[$n-1]->isEnd = false;                 //mark it as not end of other words, so we can remove it
                $path[$n-1]->children = [] ;                 //should be [] at this case.
                unset($path[$n-2]->children[$value]);

                //echo "\n---- n:$n";
                for($j=$n-1; $j>0; $j--){
                    $current = $path[$j];
                    $parent = $path[$j-1];

                    // not the end of other word and not have other children, 
                    // remove from parent
                    if(!$current->isEnd && count($current->children)==0 ){
                        unset($parent->children[$current->value]);
                    }
                    

                }



            }


        }



    }


}