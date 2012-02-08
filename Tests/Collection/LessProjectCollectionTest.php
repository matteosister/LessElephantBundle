<?php
/**
 * User: matteo
 * Date: 31/01/12
 * Time: 14.37
 *
 * Just for fun...
 */

namespace Cypress\LessElephantBundle\Tests\Collection;

use Cypress\LessElephantBundle\Collection\LessProjectCollection,
    LessElephant\LessBinary;

class CompassProjectCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $binary = new LessBinary();
        $tmpFolder1 = $this->getTempPathName();
        $tmpFolder2 = $this->getTempPathName();
        mkdir($tmpFolder1);
        mkdir($tmpFolder2);
        mkdir($tmpFolder1.DIRECTORY_SEPARATOR.'less');
        mkdir($tmpFolder1.DIRECTORY_SEPARATOR.'css');
        mkdir($tmpFolder2.DIRECTORY_SEPARATOR.'less');
        mkdir($tmpFolder2.DIRECTORY_SEPARATOR.'css');
        $projects = array(
            'test' => array(
                'source_folder' => $tmpFolder1.DIRECTORY_SEPARATOR.'less',
                'source_file' => 'screen.less',
                'destination_css' => $tmpFolder1.DIRECTORY_SEPARATOR.'css/screen.css',
            ),
            'test' => array(
                'source_folder' => $tmpFolder2.DIRECTORY_SEPARATOR.'less',
                'source_file' => 'screen.less',
                'destination_css' => $tmpFolder2.DIRECTORY_SEPARATOR.'css/screen.css',
            ),
        );
        $coll = new LessProjectCollection($binary, $projects);

        $this->assertCount(2, $coll);
        $this->assertInstanceOf('ArrayAccess', $coll);
        $this->assertInstanceOf('Iterator', $coll);
        $this->assertInstanceOf('Countable', $coll);
    }

    private function getTempPathName()
    {
        $tempDir = realpath(sys_get_temp_dir()).'compass_elephant_'.md5(uniqid(rand(),1));
        $tempName = tempnam($tempDir, 'compass_elephant');
        unlink($tempName);
        mkdir($tempName);
        return $tempName;
    }
}
