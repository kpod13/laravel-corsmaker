<?php
/**
 * Created by PhpStorm.
 * User: kpod13
 * Date: 09/11/2017
 * Time: 12:05
 */

namespace units;

use Kpod13\CorsMaker\OriginMatcher;
use PHPUnit\Framework\TestCase;

class OriginMatcherTest extends TestCase {

  /**
   * @var OriginMatcher
   */
  protected $originMatcher;

  public function setUp() {
    parent::setUp();
    $this->originMatcher = new OriginMatcher();
  }

  /**
   * @test OriginMatcher instance
   */
  public function testIsOriginMatcher() {
    $this->assertInstanceOf(OriginMatcher::class, $this->originMatcher);
  }

  /**
   * @test origin checking works
   */
  public function testOriginMatcherCanMatch() {
    $checks = [
      [
        'origin' => 'www.domain.com',
        'patterns' => [
          '*' => 'True',
          '' => 'False',
          'domain.com' => 'False',
          'www.domain.com' => 'True',
          '/^.*\.domain\.com/i' => 'True',
        ]
      ],
      [
        'origin' => 'www.evil.com',
        'patterns' => [
          '*' => 'True',
          '' => 'False',
          'domain.com' => 'False',
          'www.domain.com' => 'False',
          '/^.*\.domain\.com/i' => 'False'
        ]
      ],
      [
        'origin' => '',
        'patterns' => [
          '*' => 'False',
          '' => 'False',
          'domain.com' => 'False',
          'www.domain.com' => 'False',
          '/^.*\.domain\.com/i' => 'False'
        ]
      ]
    ];
    foreach ($checks as $check) {
      foreach ($check['patterns'] as $pattern => $assertion) {
        $this->{'assert'.$assertion}($this->originMatcher::match($check['origin'], $pattern));
      }
    }
  }
}
