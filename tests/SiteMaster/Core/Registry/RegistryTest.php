<?php
namespace SiteMaster\Core\Registry;

class RegistryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function getPossibleSiteURIs()
    {
        $registry = new Registry();
        
        $this->assertEquals(
            array('http%://www.domain.com/path1/path2/path3/',
                  'http%://www.domain.com/path1/path2/',
                  'http%://www.domain.com/path1/',
                  'http%://www.domain.com/'),
            $registry->getPossibleSiteURIs('http://www.domain.com/path1/path2/path3/index.php?test=false#1')
        );

        $this->assertEquals(
            array('http%://www.domain.com/path1/path2/path3/',
                'http%://www.domain.com/path1/path2/',
                'http%://www.domain.com/path1/',
                'http%://www.domain.com/'),
            $registry->getPossibleSiteURIs('http://www.domain.com/path1/path2/path3/index')
        );

        $this->assertEquals(
            array('http%://www.domain.com/'),
            $registry->getPossibleSiteURIs('http://www.domain.com/')
        );

        //Verify that https acts the same way as http
        $this->assertEquals(
            array('http%://www.domain.com/'),
            $registry->getPossibleSiteURIs('https://www.domain.com/')
        );

        //A domain with no path, should have a path auto-appended
        $this->assertEquals(
            array('http%://www.domain.com/'),
            $registry->getPossibleSiteURIs('https://www.domain.com')
        );
    }

    /**
     * @test
     */
    public function trimFileName()
    {
        $registry = new Registry();

        $this->assertEquals('', $registry->trimFileName(''));
        $this->assertEquals('/', $registry->trimFileName('/'));
        $this->assertEquals('/', $registry->trimFileName('/test'));
        $this->assertEquals('/test/test/', $registry->trimFileName('/test/test/'));
        $this->assertEquals('/test/', $registry->trimFileName('/test/test'));
        $this->assertEquals('/test/test/', $registry->trimFileName('/test/test/test.php'));
        $this->assertEquals('/test/test/', $registry->trimFileName('/test/test/test.php?url=test'));
        $this->assertEquals('/test/test/', $registry->trimFileName('/test/test/test.php#fragment'));
        $this->assertEquals('/test/test/', $registry->trimFileName('/test/test/test.php?url=test#fragment'));
    }

    /**
     * @test
     */
    public function getClosestSiteSQL()
    {
        $registry = new Registry();
        
        $this->assertEquals('SELECT id FROM sites
WHERE
 base_url LIKE ? OR 
 base_url LIKE ? OR 
 base_url LIKE ? OR 
 base_url LIKE ?
ORDER BY base_url DESC LIMIT 1', 
            $registry->getClosestSiteSQL($registry->getPossibleSiteURIs('http://www.domain.com/path1/path2/path3/index')));
    }
}
