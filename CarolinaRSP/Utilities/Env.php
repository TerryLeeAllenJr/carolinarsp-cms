<?php
/**
 * CarolinaRSP\Utilities\Env.php
 */
namespace CarolinaRSP\Utilities;

/**
 * Class Env
 * Provides convient syntax for dealing with the environment.
 *
 * @package CarolinaRSP\Utilities
 */
class Env
{
    /**
     * Env::get()
     * Provides a wrapper around getenv() to allow for default values.
     *
     * @param string $key
     * @param null $default
     * @return null
     */
    public static function get(string $key, $default = null)
    {
        return getenv($key) ?: $default;
    }

    /**
     * Env::put()
     * Adds a value to the environment.
     *
     * @param array $data
     * @return bool
     */
    public static function put(array $data) : bool
    {
        return putenv(implode('=',$data));
    }
}
