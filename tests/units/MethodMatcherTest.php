<?php

namespace units;

use Kpod13\CorsMaker\MethodMatcher;
use PHPUnit\Framework\TestCase;

class MethodMatcherTest extends TestCase {

  protected $methodMatcher;

  public function setUp() {
    parent::setUp();
    $this->methodMatcher =  new MethodMatcher();
  }

  /**
   * @test is MethodMatcher
   */
  public function testIsMethodMatcher() {
    $this->assertInstanceOf(MethodMatcher::class, $this->methodMatcher);
  }

  /**
   * @test match method works
   */
  public function testMethodMatcherCanMatch() {
    $checks = [
      [
        'inputMethods' => [
          'GET' => 'True',
          'POST' => 'False'
        ],
        'allowedMethods' => [
          'GET',
          'PATH'
        ]
      ],
      [
        'inputMethods' => [
          'GET' => 'True',
          'POST' => 'True'
        ],
        'allowedMethods' => [
          '*'
        ]
      ],
      [
        'inputMethods' => [
          'GET' => 'False',
          'POST' => 'False'
        ],
        'allowedMethods' => [
          'PUT',
          'DELETE'
        ]
      ]
    ];
    foreach ($checks as $check) {
      foreach ($check['inputMethods'] as $method => $assertion) {
        $this->{'assert'.$assertion}($this->methodMatcher::match($method, $check['allowedMethods']));
      }
    }
  }
}
