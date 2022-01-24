<?php

namespace EeObjects\Tests;

use Mithra62\UnitTests\TestCase;
use EeObjects\Config;

class ConfigTest extends TestCase
{
    public function testConfigPropertyExists()
    {
        $config = new Config();
        $this->assertObjectHasAttribute('_config', $config);
    }

    public function testLoadConfigReturnInstance()
    {
        $config = new Config();
        $config = $config->load('ee_objects');
        $this->assertInstanceOf('EeObjects\Config', $config);
    }

    public function testLoadConfigBadConfigFileException()
    {
        $this->expectException('EeObjects\Exceptions\Config\ConfigFileNotFoundException');
        $config = new Config();
        $config->load('bad_config');
    }

    public function testLoadConfigFromInstantiation()
    {
        $config = [
            'my-config' => 'hello',
            'my-other-config' => 'one more',
            'my-nested-element' => [
                'nested-one' => 'nested-value',
                'nested-two' => 'nested-two-value'
            ]
        ];

        $config = new Config($config);
        $this->assertTrue($config->has('my-config'));
        $this->assertTrue($config->has('my-other-config'));
        $this->assertFalse($config->has('this-wont-work'));

        $this->assertEquals('hello', $config->get('my-config'));
        $this->assertEquals('one more', $config->get('my-other-config'));
        $this->assertEquals('nested-value', $config->get('nested-one', 'my-nested-element'));
        $this->assertEquals('nested-two-value', $config->get('nested-two', 'my-nested-element'));
    }
}