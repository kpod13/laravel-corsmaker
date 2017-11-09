<?php

namespace units;

use Kpod13\CorsMaker\CorsMakerHandler;
use PHPUnit\Framework\TestCase;

class CorsMakerHandlerTest extends TestCase {

  /**
   * @var CorsMakerHandler
   */
  protected $corsMakerHandler;

  public function setUp() {
    parent::setUp();
    $this->corsMakerHandler = new CorsMakerHandler();
  }

  /**
   * @test is CorsMakerHandler
   */
  public function testIsCorsMakerHandler() {
    $this->assertInstanceOf(CorsMakerHandler::class, $this->corsMakerHandler);
  }

}
