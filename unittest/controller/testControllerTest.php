<?php
define("APP_BASE_DIR", realpath(__DIR__."/../"));
define("APP_PLUGIN_DIR", realpath(__DIR__."/../plugin/"));

define("ELIZABETHAE_BASE_DIR", realpath(__DIR__."/../../"));
require_once 'PHPUnit/Framework.php';

require_once APP_BASE_DIR.'/controller/testController.php';

/**
 * Test class for elizabethae.
 * Generated by PHPUnit on 2010-10-08 at 09:57:28.
 */
class testControllerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var    elizabethae
     * @access protected
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @access protected
     */
    protected function setUp()
    {
        $this->object = new testController("test");
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     *
     * @access protected
     */
    protected function tearDown()
    {
    }

    /**
     * @todo Implement testFind_plugin().
     */
    public function testFind_plugin()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @todo Implement testRead_plugin().
     */
    public function testRead_plugin()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

}