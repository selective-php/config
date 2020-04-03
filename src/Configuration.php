<?php

namespace Selective\Config;

use Cake\Chronos\Chronos;
use InvalidArgumentException;

/**
 * Configuration.
 */
final class Configuration
{
    /**
     * @var array<mixed> The data
     */
    private $data;

    /**
     * Constructor.
     *
     * @param array<mixed> $data Data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
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
    public function getInt(string $key, int $default = null): int
    {
        $value = $this->find($key, $default);

        if ($this->isNullOrBlank($value)) {
            throw new InvalidArgumentException(sprintf('No value found for key "%s"', $key));
        }

        return (int)$value;
    }

    /**
     * Get value as integer or null.
     *
     * @param string $key The key
     * @param int|null $default The default value
     *
     * @return int|null The value
     */
    public function findInt(string $key, int $default = null)
    {
        $value = $this->find($key, $default);

        if ($this->isNullOrBlank($value)) {
            return null;
        }

        return (int)$value;
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
    public function getString(string $key, string $default = null): string
    {
        $value = $this->find($key, $default);

        if ($value === null) {
            throw new InvalidArgumentException(sprintf('No value found for key "%s"', $key));
        }

        return (string)$value;
    }

    /**
     * Get value as string or null.
     *
     * @param string $key The key
     * @param string $default The default value
     *
     * @return string|null The value
     */
    public function findString(string $key, string $default = null)
    {
        $value = $this->find($key, $default);

        if ($value === null) {
            return null;
        }

        return (string)$value;
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
    public function getArray(string $key, array $default = null): array
    {
        $value = $this->find($key, $default);

        if ($this->isNullOrBlank($value)) {
            throw new InvalidArgumentException(sprintf('No value found for key "%s"', $key));
        }

        return (array)$value;
    }

    /**
     * Get value as array or null.
     *
     * @param string $key The key
     * @param array<mixed> $default The default value
     *
     * @return array<mixed>|null The value
     */
    public function findArray(string $key, array $default = null)
    {
        $value = $this->find($key, $default);

        if ($this->isNullOrBlank($value)) {
            return null;
        }

        return (array)$value;
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
    public function getFloat(string $key, float $default = null): float
    {
        $value = $this->find($key, $default);

        if ($this->isNullOrBlank($value)) {
            throw new InvalidArgumentException(sprintf('No value found for key "%s"', $key));
        }

        return (float)$value;
    }

    /**
     * Get value as float or null.
     *
     * @param string $key The key
     * @param float $default The default value
     *
     * @return float|null The value
     */
    public function findFloat(string $key, float $default = null)
    {
        $value = $this->find($key, $default);

        if ($this->isNullOrBlank($value)) {
            return null;
        }

        return (float)$value;
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
    public function getBool(string $key, bool $default = null): bool
    {
        $value = $this->find($key, $default);

        if ($this->isNullOrBlank($value)) {
            throw new InvalidArgumentException(sprintf('No value found for key "%s"', $key));
        }

        return (bool)$value;
    }

    /**
     * Get value as boolean or null.
     *
     * @param string $key The key
     * @param bool $default The default value
     *
     * @return bool|null The value
     */
    public function findBool(string $key, bool $default = null)
    {
        $value = $this->find($key, $default);

        if ($this->isNullOrBlank($value)) {
            return null;
        }

        return (bool)$value;
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
    public function getChronos(string $key, Chronos $default = null): Chronos
    {
        $value = $this->find($key, $default);

        if ($this->isNullOrBlank($value)) {
            throw new InvalidArgumentException(sprintf('No value found for key "%s"', $key));
        }

        if ($value instanceof Chronos) {
            return $value;
        }

        return new Chronos($value);
    }

    /**
     * Get value as Chronos or null.
     *
     * @param string $key The key
     * @param Chronos $default The default value
     *
     * @return Chronos|null The value
     */
    public function findChronos(string $key, Chronos $default = null)
    {
        $value = $this->find($key, $default);

        if ($this->isNullOrBlank($value)) {
            return null;
        }

        if ($value instanceof Chronos) {
            return $value;
        }

        return new Chronos($value);
    }

    /**
     * Find mixed value.
     *
     * @param string $path The path
     * @param mixed|null $default The default value
     *
     * @return mixed|null The value
     */
    public function find(string $path, $default = null)
    {
        if (array_key_exists($path, $this->data)) {
            return $this->data[$path] ?? $default;
        }

        if (strpos($path, '.') === false) {
            return $default;
        }

        $pathKeys = explode('.', $path);

        $arrayCopyOrValue = $this->data;

        foreach ($pathKeys as $pathKey) {
            if (!isset($arrayCopyOrValue[$pathKey])) {
                return $default;
            }
            $arrayCopyOrValue = $arrayCopyOrValue[$pathKey];
        }

        return $arrayCopyOrValue;
    }

    /**
     * Return all settings as array.
     *
     * @return array<mixed> The data
     */
    public function all(): array
    {
        return $this->data;
    }

    /**
     * Is null or blank.
     *
     * @param mixed $value The value
     *
     * @return bool The status
     */
    private function isNullOrBlank($value): bool
    {
        return $value === null || $value === '';
    }
}
