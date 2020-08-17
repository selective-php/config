<?php

namespace Selective\Config\Test;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Cake\Chronos\Chronos;
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

    /**
     * Test.
     *
     * @dataProvider providerGetFloat
     *
     * @param mixed $data The data
     * @param string $key The lookup key
     * @param mixed $default The default value
     * @param mixed $expected The expected value
     *
     * @return void
     */
    public function testGetFloat($data, string $key, $default, $expected)
    {
        $reader = new Configuration($data);
        static::assertSame($expected, $reader->findFloat($key, $default));
        static::assertSame($expected, $reader->getFloat($key, $default));
    }

    /**
     * Provider.
     *
     * @return array[] The test data
     */
    public function providerGetFloat(): array
    {
        return [
            [['key' => 123.456], 'key', null, 123.456],
            [['key' => null], 'key', 123.45, 123.45],
            [['key' => 123.456], 'nope', 123.45, 123.45],
            [['key' => ['key2' => 123.456]], 'key.key2', null, 123.456],
            [['key' => ['key2' => 123.456]], 'key.nope', 123.45, 123.45],
        ];
    }

    /**
     * Test.
     *
     * @dataProvider providerGetFloatError
     *
     * @param mixed $data The data
     * @param string $key The lookup key
     *
     * @return void
     */
    public function testGetFloatError($data, string $key)
    {
        $this->expectException(InvalidArgumentException::class);

        $reader = new Configuration($data);
        $reader->getFloat($key);

        static::assertTrue(true);
    }

    /**
     * Provider.
     *
     * @return array[] The test data
     */
    public function providerGetFloatError(): array
    {
        return [
            [['key' => 123.456], 'nope'],
            [['key' => null], 'nope'],
            [['key' => ['key2' => 123.456]], 'key.nope'],
            [['key' => ['key2' => null]], 'key.key2'],
        ];
    }

    /**
     * Test.
     *
     * @dataProvider providerFindFloat
     *
     * @param mixed $data The data
     * @param string $key The lookup key
     * @param mixed $default The default value
     * @param mixed $expected The expected value
     *
     * @return void
     */
    public function testFindFloat($data, string $key, $default, $expected)
    {
        $reader = new Configuration($data);
        static::assertSame($expected, $reader->findFloat($key, $default));
    }

    /**
     * Provider.
     *
     * @return array[] The test data
     */
    public function providerFindFloat(): array
    {
        return [
            [['key' => 123.456], 'key', null, 123.456],
            [['key' => null], 'key', 123.45, 123.45],
            [['key' => null], 'key', null, null],
            [['key' => 123.456], 'nope', 123.45, 123.45],
            [['key' => ['key2' => 123.456]], 'key.key2', null, 123.456],
            [['key' => ['key2' => 123.456]], 'key.nope', 123.45, 123.45],
        ];
    }

    /**
     * Test.
     *
     * @dataProvider providerGetArray
     *
     * @param mixed $data The data
     * @param string $key The lookup key
     * @param mixed $default The default value
     * @param mixed $expected The expected value
     *
     * @return void
     */
    public function testGetArray($data, string $key, $default, $expected)
    {
        $reader = new Configuration($data);
        static::assertSame($expected, $reader->findArray($key, $default));
        static::assertSame($expected, $reader->getArray($key, $default));
    }

    /**
     * Provider.
     *
     * @return array[] The test data
     */
    public function providerGetArray(): array
    {
        return [
            [['key' => ['key' => 'value']], 'key', null, ['key' => 'value']],
            [['key' => null], 'key', ['key' => 'val'], ['key' => 'val']],
            [['key' => ['key' => 'value']], 'nope', ['key' => 'val'], ['key' => 'val']],
            [['key' => ['key2' => ['key' => 'value']]], 'key.key2', null, ['key' => 'value']],
            [['key' => ['key2' => ['key' => 'value']]], 'key.nope', ['key' => 'val'], ['key' => 'val']],
        ];
    }

    /**
     * Test.
     *
     * @dataProvider providerGetArrayError
     *
     * @param mixed $data The data
     * @param string $key The lookup key
     *
     * @return void
     */
    public function testGetArrayError($data, string $key)
    {
        $this->expectException(InvalidArgumentException::class);

        $reader = new Configuration($data);
        $reader->getArray($key);

        static::assertTrue(true);
    }

    /**
     * Provider.
     *
     * @return array[] The test data
     */
    public function providerGetArrayError(): array
    {
        return [
            [['key' => ['key' => 'value']], 'nope'],
            [['key' => null], 'nope'],
            [['key' => ['key2' => ['key' => 'value']]], 'key.nope'],
            [['key' => ['key2' => null]], 'key.key2'],
        ];
    }

    /**
     * Test.
     *
     * @dataProvider providerFindArray
     *
     * @param mixed $data The data
     * @param string $key The lookup key
     * @param mixed $default The default value
     * @param mixed $expected The expected value
     *
     * @return void
     */
    public function testFindArray($data, string $key, $default, $expected)
    {
        $reader = new Configuration($data);
        static::assertSame($expected, $reader->findArray($key, $default));
    }

    /**
     * Provider.
     *
     * @return array[] The test data
     */
    public function providerFindArray(): array
    {
        return [
            [['key' => ['key' => 'value']], 'key', null, ['key' => 'value']],
            [['key' => null], 'key', ['key' => 'val'], ['key' => 'val']],
            [['key' => null], 'key', null, null],
            [['key' => ['key' => 'value']], 'nope', ['key' => 'val'], ['key' => 'val']],
            [['key' => ['key2' => ['key' => 'value']]], 'key.key2', null, ['key' => 'value']],
            [['key' => ['key2' => ['key' => 'value']]], 'key.nope', ['key' => 'val'], ['key' => 'val']],
        ];
    }

    /**
     * Test.
     *
     * @dataProvider providerGetChronos
     *
     * @param mixed $data The data
     * @param string $key The lookup key
     * @param mixed $default The default value
     * @param mixed $expected The expected value
     *
     * @return void
     */
    public function testGetChronos($data, string $key, $default, $expected)
    {
        $reader = new Configuration($data);
        static::assertSame((string)$expected, (string)$reader->findChronos($key, $default));
        static::assertSame((string)$expected, (string)$reader->getChronos($key, $default));
    }

    /**
     * Provider.
     *
     * @return array[] The test data
     */
    public function providerGetChronos(): array
    {
        return [
            [['key' => Chronos::now()], 'key', null, Chronos::now()],
            [['key' => '2020-08-15'], 'key', null, '2020-08-15 00:00:00'],
            [['key' => null], 'key', Chronos::yesterday(), Chronos::yesterday()],
            [['key' => Chronos::now()], 'nope', Chronos::yesterday(), Chronos::yesterday()],
            [['key' => ['key2' => Chronos::now()]], 'key.key2', null, Chronos::now()],
            [['key' => ['key2' => Chronos::now()]], 'key.nope', Chronos::yesterday(), Chronos::yesterday()],
        ];
    }

    /**
     * Test.
     *
     * @dataProvider providerGetChronosError
     *
     * @param mixed $data The data
     * @param string $key The lookup key
     *
     * @return void
     */
    public function testGetChronosError($data, string $key)
    {
        $this->expectException(InvalidArgumentException::class);

        $reader = new Configuration($data);
        $reader->getChronos($key);

        static::assertTrue(true);
    }

    /**
     * Provider.
     *
     * @return array[] The test data
     */
    public function providerGetChronosError(): array
    {
        return [
            [['key' => Chronos::now()], 'nope'],
            [['key' => null], 'nope'],
            [['key' => ['key2' => Chronos::now()]], 'key.nope'],
            [['key' => ['key2' => null]], 'key.key2'],
        ];
    }

    /**
     * Test.
     *
     * @dataProvider providerFindChronos
     *
     * @param mixed $data The data
     * @param string $key The lookup key
     * @param mixed $default The default value
     * @param mixed $expected The expected value
     *
     * @return void
     */
    public function testFindChronos($data, string $key, $default, $expected)
    {
        $reader = new Configuration($data);
        static::assertSame((string)$expected, (string)$reader->findChronos($key, $default));
    }

    /**
     * Provider.
     *
     * @return array[] The test data
     */
    public function providerFindChronos(): array
    {
        return [
            [['key' => Chronos::now()], 'key', null, Chronos::now()],
            [['key' => '2020-08-15'], 'key', null, '2020-08-15 00:00:00'],
            [['key' => null], 'key', Chronos::yesterday(), Chronos::yesterday()],
            [['key' => null], 'key', null, null],
            [['key' => Chronos::now()], 'nope', Chronos::yesterday(), Chronos::yesterday()],
            [['key' => ['key2' => Chronos::now()]], 'key.key2', null, Chronos::now()],
            [['key' => ['key2' => Chronos::now()]], 'key.nope', Chronos::yesterday(), Chronos::yesterday()],
        ];
    }

    /**
     * Provider
     *
     * @return array[] The test data
     */
    public function providerAll(): array
    {
        return [
            [['key' => Chronos::now()]],
            [['key' => '2020-08-15']],
            [['key' => 123.456]],
            [['key' => 123]],
            [['key' => 'value']],
            [['key' => true]],
            [['key' => false]],
            [['key' => null]],
        ];
    }

    /**
     * Test
     *
     * @dataProvider providerAll
     *
     * @param mixed $data The data
     *
     * @return void
     */
    public function testAll($data): void
    {
        $reader = new Configuration($data);

        static::assertSame($data, $reader->all());
    }
}
