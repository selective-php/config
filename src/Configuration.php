<?php

namespace Selective\Config;

use Cake\Chronos\Chronos;
use InvalidArgumentException;
use Selective\ArrayReader\ArrayReader;

/**
 * Configuration.
 */
final class Configuration
{
    /**
     * @var ArrayReader
     */
    private ArrayReader $arrayReader;

    /**
     * Constructor.
     *
     * @param array<mixed> $data Data
     */
    public function __construct(array $data = [])
    {
        $this->arrayReader = new ArrayReader($data);
    }

    /**
     * Get value as integer.
     *
     * @param string $key The key
     * @param int|null $default The default value
     *
     * @throws InvalidArgumentException
     *
     * @return int The value
     */
    public function getInt(string $key, ?int $default = null): int
    {
        return $this->arrayReader->getInt($key, $default);
    }

    /**
     * Get value as integer or null.
     *
     * @param string $key The key
     * @param int|null $default The default value
     *
     * @return int|null The value
     */
    public function findInt(string $key, ?int $default = null)
    {
        return $this->arrayReader->findInt($key, $default);
    }

    /**
     * Get value as string.
     *
     * @param string $key The key
     * @param string|null $default The default value
     *
     * @throws InvalidArgumentException
     *
     * @return string The value
     */
    public function getString(string $key, ?string $default = null): string
    {
        return $this->arrayReader->getString($key, $default);
    }

    /**
     * Get value as string or null.
     *
     * @param string $key The key
     * @param string $default The default value
     *
     * @return string|null The value
     */
    public function findString(string $key, ?string $default = null)
    {
        return $this->arrayReader->findString($key, $default);
    }

    /**
     * Get value as array.
     *
     * @param string $key The key
     * @param array<mixed>|null $default The default value
     *
     * @throws InvalidArgumentException
     *
     * @return array<mixed> The value
     */
    public function getArray(string $key, ?array $default = null): array
    {
        return $this->arrayReader->getArray($key, $default);
    }

    /**
     * Get value as array or null.
     *
     * @param string $key The key
     * @param array<mixed> $default The default value
     *
     * @return array<mixed>|null The value
     */
    public function findArray(string $key, ?array $default = null)
    {
        return $this->arrayReader->findArray($key, $default);
    }

    /**
     * Get value as float.
     *
     * @param string $key The key
     * @param float|null $default The default value
     *
     * @throws InvalidArgumentException
     *
     * @return float The value
     */
    public function getFloat(string $key, ?float $default = null): float
    {
        return $this->arrayReader->getFloat($key, $default);
    }

    /**
     * Get value as float or null.
     *
     * @param string $key The key
     * @param float $default The default value
     *
     * @return float|null The value
     */
    public function findFloat(string $key, ?float $default = null)
    {
        return $this->arrayReader->findFloat($key, $default);
    }

    /**
     * Get value as boolean.
     *
     * @param string $key The key
     * @param bool|null $default The default value
     *
     * @throws InvalidArgumentException
     *
     * @return bool The value
     */
    public function getBool(string $key, ?bool $default = null): bool
    {
        return $this->arrayReader->getBool($key, $default);
    }

    /**
     * Get value as boolean or null.
     *
     * @param string $key The key
     * @param bool $default The default value
     *
     * @return bool|null The value
     */
    public function findBool(string $key, ?bool $default = null)
    {
        return $this->arrayReader->findBool($key, $default);
    }

    /**
     * Get value as Chronos.
     *
     * @param string $key The key
     * @param Chronos|null $default The default value
     *
     * @throws InvalidArgumentException
     *
     * @return Chronos The value
     */
    public function getChronos(string $key, ?Chronos $default = null): Chronos
    {
        return $this->arrayReader->getChronos($key, $default);
    }

    /**
     * Get value as Chronos or null.
     *
     * @param string $key The key
     * @param Chronos|null $default The default value
     *
     * @return Chronos|null The value
     */
    public function findChronos(string $key, ?Chronos $default = null)
    {
        return $this->arrayReader->findChronos($key, $default);
    }

    /**
     * Return all settings as array.
     *
     * @return array<mixed> The data
     */
    public function all(): array
    {
        return $this->arrayReader->all();
    }
}
