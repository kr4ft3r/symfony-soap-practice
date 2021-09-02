<?php


namespace App\Tests\Service;

use PHPUnit\Framework\TestCase;
use App\Service;

class PhpInfoParserTest extends TestCase
{

    /**
     * Assert that the value of the "System" field returned by the parser contains the system name
     */
    public function testParserSystemField()
    {
        $parser = new Service\PhpInfoParser();
        $system = $parser->getFieldValue('System');
        $this->assertStringContainsString(php_uname('s'), $system); // ie "Linux" is found in system field
    }

    /**
     * Just playing around with PHPInfo library's parsing abilities before using it
     */
    /*
    public function testParserLibrary()
    {
        ob_start();
        phpinfo();
        $phpinfoAsString = ob_get_contents();
        ob_get_clean();
        $phpInfo = new \OutCompute\PHPInfo\PHPInfo();
        $phpInfo->setText($phpinfoAsString);
        var_dump($phpInfo->get()['System']);
    }
    */
}