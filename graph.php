<?php
Class AdjListGraph{
    public $adjList = [];                      


    public function add_edge($i, $j){
        if(!isset($this->adjList[$i])){
           $this->adjList[$i] = [];
        }
        $this->adjList[$i][$j] = $j;
    }


    public function remove_edge($i, $j){
        unset($this->adjList[$i][$j]);
    }


    public function has_edge($i, $j){
        return isset($this->adjList[$i][$j]);
    }


    public function out_edges($i){
        if(isset($this->adjList[$i])){
            return $this->adjList[$i];
        }
        return [];
    }


    public function in_edges($i){
        $res =[];

        foreach($this->adjList as $j=>$targets){
            if(isset($targets[$i])){
                $res[$j] = $j;
            }

        }
        return $res;
    }


    public function bfs($i){
        $visited = [];
        $history = [];
        $history[] = $i;

        while(count($history)>0){
            $current = array_shift($history);
    
            $visited[$current] = $current;
            foreach($this->out_edges($current) as $out){
                if(!isset($visited[$out])){
                    $visited[$out] = $out;
                    $history[] = $out;
                }
            }

        }
        return $visited;
    }


    public function dfs($i){
        $visited = [];
        $history = [];
        $history[] = $i;
        while(count($history)>0){
            $current = array_pop($history);
            if(!isset($visited[$current])){
                $visited[$current] = $current;
                foreach($this->out_edges($current) as $out){
                    $history[] = $out;
                }
            }      
        }
        return $visited;
    }


    // recursive cyclic
    public function isCyclic($i){
        return $this->_cyclic($i, []);

    }


    public function _cyclic($i, $path){
        //echo "\nadding $i into path " .implode(', ', $path);
        if(in_array($i, $path)){
            $path[] = $i;
            return  $path;
        }
        else{
            $path[] = $i;
            foreach($this->out_edges($i) as $out){
                $cyclic = $this->_cyclic($out, $path);
                if($cyclic){
                    return $cyclic;
                }                                
            }
            return false;
        }
    }

    
    // cyclic using status array
    // array mimics the calling stack
    public function isCyclic2($i){       
        // at each level
        // history contain nodes with status which are children of current visiting node form the upper level      
        // status:    0: not visited,  1:  visiting
        $history = [];
        $history[] = [['value'=>$i, 'status'=>0]];      

        while(count($history)>0){
            /*
            echo "\n-------";
            foreach ($history as $x){
                $strs = [];
                foreach($x as $y){
                    $strs[] = "(v:".$y['value'].",s".$y['status'].")";
                }
                echo "\n".implode(', ', $strs);
            }
            */

            $levels = count($history);
            $current_level = $levels - 1;
            $nodes = $history[$current_level];
            if(count($history[$current_level])>0){

                // when node being popup is not visited before, just visit it.
                // otherwise means its children has all been visited
                // then this node has been fully visited. just remvoe it
                $node = array_pop($history[$current_level]);

                if($node['status']==0){
                    $node['status'] = 1;
                    array_push($history[$current_level], $node);

                    //find current path
                    $current_path = [];
                    foreach($history as $l){
                        $current_path[] = $l[count($l)-1]['value'];
                        
                    }

                    foreach($this->out_edges($node['value']) as $out){
                        if(in_array($out, $current_path)){
                            $current_path[] = $out;
                            return $current_path;
                        }
                        else{
                            $new_node = ['value'=>$out, 'status'=>0];
                            if(isset($history[$current_level+1])){
                                $history[$current_level+1][] = $new_node;
                            }
                            else{
                                $history[$current_level+1] = [$new_node]; 
                            }
                        }                                
                    }
                }
                else if($node['status']==1){
                    //array_pop($history[$current_level]);
                    //echo "\n poping";
                }
                else{
                    die('wrong status');
                }
            }
            else{
                unset($history[$current_level]);
                //echo "\n unsetting";
            }
        }
        return false;
    }



}
