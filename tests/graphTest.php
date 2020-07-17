<?php 
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

include_once "graph.php";        

final class graphTest extends TestCase
{

    public function testgraph(): void
    {
        
        $g = new AdjListGraph();
        $g->add_edge(0, 1);
        $g->add_edge(0, 3);
        $g->add_edge(1, 2);
        $g->add_edge(1, 4);
        $g->add_edge(2, 5);
        $g->add_edge(3, 6);
        $g->add_edge(4, 7);
        $g->add_edge(5, 8);
        $g->add_edge(6, 4);
        $g->add_edge(8, 4);


        $out0 = $g->out_edges(0);
        $res = implode(', ', $out0);
        $this->assertEquals($res, '1, 3');

        $out7 = $g->out_edges(7);
        $res = implode(', ', $out7);
        $this->assertEquals($res, '');

        $in4 = $g->in_edges(4);
        $res = implode(', ', $in4);
        $this->assertEquals($res, '1, 6, 8');

        $in5 = $g->in_edges(5);
        $res = implode(', ', $in5);
        $this->assertEquals($res, '2');

        $bfs = $g->bfs(0);
        $res = implode(', ', $bfs);
        $this->assertEquals($res, '0, 1, 3, 2, 4, 6, 5, 7, 8');

        $dfs = $g->dfs(0);
        $res = implode(', ', $dfs);
        $this->assertEquals($res, '0, 3, 6, 4, 7, 1, 2, 5, 8');

        $cyclic = $g->isCyclic(0);
        $this->assertEquals($cyclic, false);

        $g->add_edge(4, 0);
        $cyclic = $g->isCyclic(0);
        $res = implode(', ', $cyclic);
        $this->assertEquals($res, '0, 1, 2, 5, 8, 4, 0');
        $g->remove_edge(4, 0);

        $g->add_edge(6, 0);
        $cyclic = $g->isCyclic(0);
        $res = implode(', ', $cyclic);
        $this->assertEquals($res, '0, 3, 6, 0');
        $g->remove_edge(6, 0);

        $cyclic = $g->isCyclic(0);
        $this->assertEquals($cyclic, false);
        

        $cyclic = $g->isCyclic2(0);
        $this->assertEquals($cyclic, false);

        $g->add_edge(4, 0);
        $cyclic = $g->isCyclic2(0);
        $res = implode(', ', $cyclic);
        $this->assertEquals($res, '0, 3, 6, 4, 0');
        $g->remove_edge(4, 0);


        $g->add_edge(5, 0);
        $cyclic = $g->isCyclic2(0);
        $res = implode(', ', $cyclic);
        $this->assertEquals($res, '0, 1, 2, 5, 0');
        $g->remove_edge(5, 0);

        $g->add_edge(7, 0);
        $cyclic = $g->isCyclic2(0);
        $res = implode(', ', $cyclic);
        $this->assertEquals($res, '0, 3, 6, 4, 7, 0');
        $g->remove_edge(7, 0);




    }
}