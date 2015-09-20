<?php namespace Coreplex\Navigator\Store;

abstract class AbstractStore {

    /**
     * Retrieve all menu items, regardless of thier parent item.
     *
     * @return array
     */
    abstract public function all();

    /**
     * Retrieve all specified menu items.
     *
     * @param string|array $keys
     * @return array
     *
     * @throws MenuNotFoundException
     */
    abstract public function find($keys);

    /**
     * Build a new callback from a class for the filter.
     *
     * @param string $class
     * @return callable
     */
    protected function buildClassCallback($class)
    {
        list($class, $method) = $this->parseClassCallback($class);

        return function() use ($class, $method)
        {
            $callable = array(new $class, $method);
            return call_user_func_array($callable, func_get_args());
        };
    }
    /**
     * Parse the filter name to the class name and method.
     *
     * @param string $class
     * @return array
     */
    protected function parseClassCallback($class)
    {
        if (strpos($class, '@') !== false) {
            return explode('@', $class);
        }
        return array($class, 'design');
    }

}