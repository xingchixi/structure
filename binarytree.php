<?php

include_once "BinaryTreeNode.php";  


function getTreeNodesValues($nodes){
    $values = [];
    foreach($nodes as $node){
        $values[] = $node->value;
    }
    return $values;
}

function getTreeNodesString($nodes){
    return implode(', ', getTreeNodesValues($nodes));
}

/****************** dfs and bfs with recursion, by reference out parameter **************** */
function dfs($node, &$seq){
	$seq[] = $node;
	if($node->left){
		dfs($node->left, $seq);
	}
	if($node->right){
		dfs($node->right, $seq);
	}	
}


function bfs($nodes, &$seq){
    if(!is_array($nodes)){
        $nodes = [$nodes];
    }
    $seq = array_merge($seq, $nodes);
    //foreach($nodes as $node){
    //    $seq[] = $node;
    //}

	$children = [];
	foreach($nodes as $node){
		if($node->left){
			$children[] = $node->left;
		}
		if($node->right){
			$children[] = $node->right;
		}
		
    }

    if(count($children)>0){
        bfs($children, $seq);
    }
    
}

/****************** dfs and bfs with recurrsion, return value **************** */
function dfs2($node){
    $res = [];
    $res[] = $node;
	if($node->left){
		$res = array_merge($res, dfs2($node->left));	
	}
	if($node->right){
		$res = array_merge($res, dfs2($node->right));	
	}
	return $res;
}



function bfs2($nodes){
    if(!is_array($nodes)){
        $nodes = [$nodes];
    }
    $res = $nodes;

    $children = [];
	foreach($nodes as $node){
		if($node->left){
			$children[] = $node->left;
		}
		if($node->right){
			$children[] = $node->right;
		}
		
    }

    if(count($children)>0){
        $res = array_merge($res, bfs2($children));
    }

    return $res;

}

/****************** dfs and bfs with data structure **************** */
function dfs3($node){

    $lefts=[];
    $rights =[];
    $lefts[] = $node;

    $visited = [];

    while(count($lefts) || count($rights)){
        if(count($lefts)){
            $current = array_shift($lefts);
        }
        else if(count($rights)){
            $current = array_pop($rights);
        }

        $visited[] = $current;

        if($current->left){
            $lefts[] = $current->left;
        }
        if($current->right){
            $rights[] = $current->right;
        }
    }

    return $visited;

}



function dfs4($node){
    $node->status = 0;                      // 0 not visited before.   1: visited before
    $stack = [$node];
    $visited = [];

    while(count($stack)>0){
        $current  = array_pop($stack);
        if($current->status ==0){
            $current->status = 1;
            $stack[] = $current;                        //change the postion of push back to form any order of output
            if($current->left!=null){
                $current->left->status = 0;
                $stack[] = $current->left;
            }
            if($current->right!=null){
                $current->right->status = 0;
                $stack[] = $current->right;
            }
            

        }
        else{
            $visited[] = $current;
        }

    }

    return $visited; 

}



function bfs3($node){

    $history = [];
    $history[] = $node;
    $visited = [];

    while(count($history)>0){
        $current = array_shift($history);

        $visited[] = $current;
        if($current->left){
            $history[] = $current->left;
        }
        if($current->right){
            $history[] = $current->right;
        }
    }
    return $visited;

}


function size($node){
    $left_size = 0;
    $right_size = 0;
    if($node->left){
        $left_size = size($node->left);
    }
    if($node->right){
        $right_size = size($node->right);
    }
    return 1 + $left_size + $right_size;
    
}


function size2($node){
    if($node==null){
        return 0;
    }
    else{
        return 1+size2($node->left) + size2($node->right);
    }
}

function height($node){
    $left_height = 0;
    $right_height = 0;
    if($node->left){
        $left_height = height($node->left);
    }
    if($node->right){
        $right_height = height($node->right);
    }
    return 1 + max($left_height, $right_height);
    
}


function height2($node){
    if($node==null){
        return 0;
    }
    else{
        return 1+ max(height2($node->left), height2($node->right));
    }
}




//*********************binary serach tree******************* */

function binary_find($node, $value){
    while($node!=null){
        if($value == $node->value){
            return $node;
        }
        else if($value < $node->value){
            $node = $node->left;
        }
        else{
            $node = $node->right;
        }
    }
    return null;

}

function binary_find_last($node, $value){
    $last = null;           // last node we seen during search. 
                            // either largest node samller than search, or samllest node larger than search
    while($node!=null){
        if($value == $node->value){
            return $node;
        }
        else if($value < $node->value){
            $last = $node;
            $node = $node->left;
        }
        else{
            $last = $node;
            $node = $node->right;
        }
    }
    return $last;

}

function binary_add($node, $value){
    $new = new BinaryTreeNode($value);

    if($node==null){
        return $new;
    }

    $last = binary_find_last($node, $value);
    if($last==null){
        die('binary find lasy is null');
    }

    if($last->value == $value){
        // do nothing
    }
    else if($value < $last->value){
        $last->left = $new;
    }
    else{
        $last->right = $new;
    }

    return $node;

}


function binary_list($node){
    
    if($node==null){
        return [];
    }

    // inorder
    return array_merge(binary_list($node->left), [$node], binary_list($node->right));
}


function binary_list_preorder($node){
    if($node==null){
        return [];
    }
    // pre order
    return array_merge([$node],  binary_list_preorder($node->left),  binary_list_preorder($node->right));
}

// dfs4() is simpler and better!
function binary_list2($node){

    $node->status = 0;          // 0: children not visited,  1: left visited,  2:right visitied
    $path = [$node];
    $visited = [];

    $i =0;
    while(count($path)>0){

        $s= [];
        foreach($path as $p){
            $s[] = $p->value . ":" .$p->status;
        }
        //echo "\n path: " . implode(', ', $s);

        $current =  $path[count($path) - 1];
        if($current->status==0){
            if($current->left!=null){
                $current->left->status = 0;                 // we can set status to 1 here instead of change it later by find parent.
                $path[] = $current->left;
            }
            else{
                $current->status=1;
            }
        }
        else if($current->status==1){
            $visited[] = $current;
            if($current->right!=null){
                $current->right->status = 0;
                $path[] = $current->right;
            }
            else{
                $current->status=2;
            }
        }
        else if($current->status==2){
            if(count($path)>1){
                $parent = $path[count($path) - 2];
                if($parent->left == $current){
                    $parent->status = 1;
                }
                else if($parent->right == $current){
                    $parent->status = 2;
                }
                array_pop($path);
            }
            else{
                break;                
            }
        }

        $i++;
        if($i>50){
            die('binary_list2 loop limit exceeded');
        }
    }
    return $visited;
}









