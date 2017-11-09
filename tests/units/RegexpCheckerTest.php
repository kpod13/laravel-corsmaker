<?php

namespace units;

use Kpod13\CorsMaker\RegexpChecker;
use PHPUnit\Framework\TestCase;

class RegexpCheckerTest extends TestCase {

    /**
     * @var RegexpChecker
     */
    protected $regexpChecker;

    public function setUp() {
        parent::setUp();
        $this->regexpChecker = new RegexpChecker();
    }

    /**
     * @test instance
     */
    public function testIsRegexpChecker() {
        $this->assertInstanceOf(RegexpChecker::class, $this->regexpChecker);
    }

    /**
     * @test regexp checking
     */
    public function testRegexpCheckerCanCheck() {
        $regexpStrings = ['/.*/i'];
        $nonRegexpStrings = ['Test', ''];

        foreach ($regexpStrings as $regexpString) {
            $this->assertTrue($this->regexpChecker::check($regexpString));
        }

        foreach ($nonRegexpStrings as $nonRegexpString) {
            $this->assertFalse($this->regexpChecker::check($nonRegexpString));
        }
    }
}
