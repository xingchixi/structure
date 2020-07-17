<?php 
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

include_once "binarytree.php";        

final class binarytreeTest extends TestCase
{

    public function testbinarytree(): void
    {

        /**************************
 
                1
              /   \
             2     3
           /  \     \
          4    5     9
         / \   /
        6   7  8
        **********************/

        $nodes = [];
        for($i=1; $i<10; $i++){
            $nodes[$i] = new BinaryTreeNode($i);
        }
        $nodes[1]->left  = $nodes[2];
        $nodes[1]->right = $nodes[3];
        $nodes[2]->left  = $nodes[4];
        $nodes[2]->right = $nodes[5];
        $nodes[3]->right = $nodes[9];
        $nodes[4]->left  = $nodes[6];
        $nodes[4]->right = $nodes[7];
        $nodes[5]->left  = $nodes[8];


        $seq = [];
        dfs($nodes[1], $seq);;
        $s = (getTreeNodesString($seq));
        $this->assertEquals($s, "1, 2, 4, 6, 7, 5, 8, 3, 9");

        $seq = [];
        bfs($nodes[1], $seq);
        $s = (getTreeNodesString($seq));
        $this->assertEquals($s, "1, 2, 3, 4, 5, 9, 6, 7, 8");

        $seq = dfs2($nodes[1]);;
        $s = (getTreeNodesString($seq));
        $this->assertEquals($s, "1, 2, 4, 6, 7, 5, 8, 3, 9");

        $seq = bfs2($nodes[1]);
        $s = (getTreeNodesString($seq));
        $this->assertEquals($s, "1, 2, 3, 4, 5, 9, 6, 7, 8");

        $seq = dfs3($nodes[1]);;
        $s = (getTreeNodesString($seq));
        $this->assertEquals($s, "1, 2, 4, 6, 7, 5, 8, 3, 9");

        $seq = bfs3($nodes[1]);
        $s = (getTreeNodesString($seq));
        $this->assertEquals($s, "1, 2, 3, 4, 5, 9, 6, 7, 8");

        $size = size($nodes[1]);
        $this->assertEquals($size, 9);


        $height = height($nodes[1]);
        $this->assertEquals($height, 4);

        $size = size2($nodes[1]);
        $this->assertEquals($size, 9);



    }


    public function testBinarySearchTree(): void
    {
       $node = new BinaryTreeNode(7); 
       binary_add($node, 3);
       binary_add($node, 11);
       binary_add($node, 1);
       binary_add($node, 5);
       binary_add($node, 9);
       binary_add($node, 13);
       binary_add($node, 4);
       binary_add($node, 6);
       binary_add($node, 8);
       binary_add($node, 12);
       binary_add($node, 14);

       $seq = bfs3($node);
       $s = (getTreeNodesString($seq));
       $this->assertEquals($s, "7, 3, 11, 1, 5, 9, 13, 4, 6, 8, 12, 14");

       $seq = dfs3($node);
       $s = (getTreeNodesString($seq));
       $this->assertEquals($s, "7, 3, 1, 5, 4, 6, 11, 9, 8, 13, 12, 14");

       $seq = binary_list($node);
       $s = (getTreeNodesString($seq));
       $this->assertEquals($s, "1, 3, 4, 5, 6, 7, 8, 9, 11, 12, 13, 14");

       $seq = binary_list2($node);
       $s = (getTreeNodesString($seq));
       $this->assertEquals($s, "1, 3, 4, 5, 6, 7, 8, 9, 11, 12, 13, 14");



    }


}