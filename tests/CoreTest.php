<?php

namespace RasTeixeira;

use PHPUnit\Framework\TestCase;
use RasTeixeira\Core;

class CoreTest extends TestCase
{
    public function testGetVersion()
    {
        $core = new Core();
        $version = $core->version();

        $this->expectOutputString($version);
        print $version;
    }

    public function testImageText()
    {
        $core = new Core();
        $text = $core->imageText(__DIR__.'/Mocks/Images/text.png');
        
        $this->expectOutputString($text);
        print "The quick brown fox\njumps over\nthe lazy dog.";
    }
}
