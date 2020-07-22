<?php 
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

include_once "trie.php";        

final class trieTest extends TestCase
{

    public function testtrie(): void
    {
        $trie = new Trie();
        $trie->add('abcd');
        $trie->add('abce');

        $trie->remove('ab');
        $this->assertEquals($trie->find('abc')->value, 'c');

        $trie->remove('abk');
        $this->assertEquals($trie->find('abc')->value, 'c');


        $trie->add('abcefg');
        $this->assertEquals($trie->find('abcefg')->value, 'g');

        $trie->remove('abcefg');
        $this->assertEquals($trie->find('abcefg'),  false);
        $this->assertEquals($trie->find('abcef'),  false);
        $this->assertEquals($trie->find('abce')->value, 'e');


    }
}