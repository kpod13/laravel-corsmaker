<?php

namespace units;

use Kpod13\CorsMaker\LocationMatcher;
use PHPUnit\Framework\TestCase;

class LocationMatcherTest extends TestCase {

  /**
   * @var LocationMatcher
   */
  protected $locationMatcher;

  public function setUp() {
    parent::setUp();
    $this->locationMatcher = new LocationMatcher();
  }

  /**
   * @test instance type
   */
  public function testIsLocationMatcher() {
    $this->assertInstanceOf(LocationMatcher::class, $this->locationMatcher);
  }

  /**
   * @test location matching
   */
  public function testCanMatchLocation() {
    $checks = [
      [
        'location' => '/api/v2',
        'patterns' => [
          '/^\/api\/.*/i' => 'True',
          '/api/' => 'True',
          '*' => 'True'
        ]
      ],
      [
        'location' => '/appi/v2',
        'patterns' => [
          '/^\/api\/.*/i' => 'False',
          '/api/' => 'False',
          '*' => 'True'
        ]
      ]
    ];
    foreach ($checks as $check) {
      foreach ($check['patterns'] as $pattern => $assertion) {
        $this->{'assert'.$assertion}($this->locationMatcher::match($check['location'], array($pattern)));
      }
    }
  }
}
