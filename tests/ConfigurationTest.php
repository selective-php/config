<?php

namespace Selective\Config\Test;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Selective\Config\Configuration;

/**
 * Test.
 */
class ConfigurationTest extends TestCase
{
    /**
     * Test.
     *
     * @dataProvider providerGetString
     *
     * @param mixed $data The data
     * @param string $key The lookup key
     * @param mixed $default The default value
     * @param mixed $expected The expected value
     *
     * @return void
     */
    public function testGetString($data, string $key, $default, $expected)
    {
        $reader = new Configuration($data);
        static::assertSame($expected, $reader->findString($key, $default));
        static::assertSame($expected, $reader->getString($key, $default));
    }

    /**
     * Provider.
     *
     * @return array[] The test data
     */
    public function providerGetString(): array
    {
        return [
            [['key' => 'value'], 'key', null, 'value'],
            [['key' => null], 'key', 'value', 'value'],
            [['key' => 'value'], 'nope', 'default', 'default'],
            [['key' => ['key2' => 'value']], 'key.key2', null, 'value'],
            [['key' => ['key2' => 'value']], 'key.nope', 'default', 'default'],
        ];
    }

    /**
     * Test.
     *
     * @dataProvider providerGetStringError
     *
     * @param mixed $data The data
     * @param string $key The lookup key
     *
     * @return void
     */
    public function testGetStringError($data, string $key)
    {
        $this->expectException(InvalidArgumentException::class);

        $reader = new Configuration($data);
        $reader->getString($key);

        static::assertTrue(true);
    }

    /**
     * Provider.
     *
     * @return array[] The test data
     */
    public function providerGetStringError(): array
    {
        return [
            [['key' => 'value'], 'nope'],
            [['key' => null], 'nope'],
            [['key' => ['key2' => 'value']], 'key.nope'],
            [['key' => ['key2' => null]], 'key.key2'],
        ];
    }

    /**
     * Test.
     *
     * @dataProvider providerFindString
     *
     * @param mixed $data The data
     * @param string $key The lookup key
     * @param mixed $default The default value
     * @param mixed $expected The expected value
     *
     * @return void
     */
    public function testFindString($data, string $key, $default, $expected)
    {
        $reader = new Configuration($data);
        static::assertSame($expected, $reader->findString($key, $default));
    }

    /**
     * Provider.
     *
     * @return array[] The test data
     */
    public function providerFindString(): array
    {
        return [
            [['key' => 'value'], 'key', null, 'value'],
            [['key' => null], 'key', 'value', 'value'],
            [['key' => null], 'key', null, null],
            [['key' => 'value'], 'nope', 'default', 'default'],
            [['key' => ['key2' => 'value']], 'key.key2', null, 'value'],
            [['key' => ['key2' => 'value']], 'key.nope', 'default', 'default'],
        ];
    }

    /**
     * Test.
     *
     * @dataProvider providerGetInt
     *
     * @param mixed $data The data
     * @param string $key The lookup key
     * @param mixed $default The default value
     * @param mixed $expected The expected value
     *
     * @return void
     */
    public function testGetInt($data, string $key, $default, $expected)
    {
        $reader = new Configuration($data);
        static::assertSame($expected, $reader->findInt($key, $default));
        static::assertSame($expected, $reader->getInt($key, $default));
    }

    /**
     * Provider.
     *
     * @return array[] The test data
     */
    public function providerGetInt(): array
    {
        return [
            [['key' => 123456], 'key', null, 123456],
            [['key' => null], 'key', 12345, 12345],
            [['key' => 123456], 'nope', 12345, 12345],
            [['key' => ['key2' => 123456]], 'key.key2', null, 123456],
            [['key' => ['key2' => 123456]], 'key.nope', 12345, 12345],
        ];
    }

    /**
     * Test.
     *
     * @dataProvider providerGetIntError
     *
     * @param mixed $data The data
     * @param string $key The lookup key
     *
     * @return void
     */
    public function testGetIntError($data, string $key)
    {
        $this->expectException(InvalidArgumentException::class);

        $reader = new Configuration($data);
        $reader->getInt($key);

        static::assertTrue(true);
    }

    /**
     * Provider.
     *
     * @return array[] The test data
     */
    public function providerGetIntError(): array
    {
        return [
            [['key' => 123456], 'nope'],
            [['key' => null], 'nope'],
            [['key' => ['key2' => 123456]], 'key.nope'],
            [['key' => ['key2' => null]], 'key.key2'],
        ];
    }

    /**
     * Test.
     *
     * @dataProvider providerFindInt
     *
     * @param mixed $data The data
     * @param string $key The lookup key
     * @param mixed $default The default value
     * @param mixed $expected The expected value
     *
     * @return void
     */
    public function testFindInt($data, string $key, $default, $expected)
    {
        $reader = new Configuration($data);
        static::assertSame($expected, $reader->findInt($key, $default));
    }

    /**
     * Provider.
     *
     * @return array[] The test data
     */
    public function providerFindInt(): array
    {
        return [
            [['key' => 123456], 'key', null, 123456],
            [['key' => null], 'key', 12345, 12345],
            [['key' => null], 'key', null, null],
            [['key' => 123456], 'nope', 12345, 12345],
            [['key' => ['key2' => 123456]], 'key.key2', null, 123456],
            [['key' => ['key2' => 123456]], 'key.nope', 12345, 12345],
        ];
    }

    /**
     * Test.
     *
     * @dataProvider providerGetBool
     *
     * @param mixed $data The data
     * @param string $key The lookup key
     * @param mixed $default The default value
     * @param mixed $expected The expected value
     *
     * @return void
     */
    public function testGetBool($data, string $key, $default, $expected)
    {
        $reader = new Configuration($data);
        static::assertSame($expected, $reader->findBool($key, $default));
        static::assertSame($expected, $reader->getBool($key, $default));
    }

    /**
     * Provider.
     *
     * @return array[] The test data
     */
    public function providerGetBool(): array
    {
        return [
            [['key' => true], 'key', null, true],
            [['key' => null], 'key', false, false],
            [['key' => true], 'nope', false, false],
            [['key' => ['key2' => true]], 'key.key2', null, true],
            [['key' => ['key2' => true]], 'key.nope', false, false],
        ];
    }

    /**
     * Test.
     *
     * @dataProvider providerGetBoolError
     *
     * @param mixed $data The data
     * @param string $key The lookup key
     *
     * @return void
     */
    public function testGetBoolError($data, string $key)
    {
        $this->expectException(InvalidArgumentException::class);

        $reader = new Configuration($data);
        $reader->getBool($key);

        static::assertTrue(true);
    }

    /**
     * Provider.
     *
     * @return array[] The test data
     */
    public function providerGetBoolError(): array
    {
        return [
            [['key' => true], 'nope'],
            [['key' => null], 'nope'],
            [['key' => ['key2' => true]], 'key.nope'],
            [['key' => ['key2' => null]], 'key.key2'],
        ];
    }

    /**
     * Test.
     *
     * @dataProvider providerFindBool
     *
     * @param mixed $data The data
     * @param string $key The lookup key
     * @param mixed $default The default value
     * @param mixed $expected The expected value
     *
     * @return void
     */
    public function testFindBool($data, string $key, $default, $expected)
    {
        $reader = new Configuration($data);
        static::assertSame($expected, $reader->findBool($key, $default));
    }

    /**
     * Provider.
     *
     * @return array[] The test data
     */
    public function providerFindBool(): array
    {
        return [
            [['key' => true], 'key', null, true],
            [['key' => null], 'key', false, false],
            [['key' => null], 'key', null, null],
            [['key' => true], 'nope', false, false],
            [['key' => ['key2' => true]], 'key.key2', null, true],
            [['key' => ['key2' => true]], 'key.nope', false, false],
        ];
    }
}
