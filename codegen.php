<?php
//php ./codegen.php abc 

//var_dump($argv);

if(count($argv)<2 || trim($argv[1])=='' ){
    die("run like this: php ./codegen.php fileName\n");
}

$name = $argv[1];
if(file_exists($name.'.php')){
    die("file already exists!\n");
}

$file1 ='<?php
function ' .$name. '($s){
    
    return $s;
}
';
file_put_contents($name.'.php', $file1);


$file2='<?php 
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

include_once "' .$name. '.php";        

final class ' .$name. 'Test extends TestCase
{

    public function test' .$name. '(): void
    {
        $res = ' .$name.'(1);
        $this->assertEquals($res, 1);

    }
}';
file_put_contents( 'tests/'.$name.'Test.php', $file2);


