<?php namespace Coreplex\Navigator\Components;

use ArrayAccess;
use Coreplex\Navigator\Contracts\Item as ItemContract;

class Item implements ItemContract, ArrayAccess {

    /**
     * The current navigation item.
     *
     * @var array
     */
    protected $item;

    /**
     * @var bool
     */
    protected $active = false;

    public function __construct(array $item)
    {
        $this->item = $item;
        $this->setActiveIfMatchesCurrentRequest();
    }

    /**
     * Check if the current item is active.
     *
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * Check if the current item's url matches the current request. Make the item
     * active if it is.
     */
    protected function setActiveIfMatchesCurrentRequest()
    {
        if (isset($this->item['url'])) {
            $path = trim(str_replace($_SERVER['SERVER_NAME'], '', $this->item['url']), '/');

            if ($path == trim($_SERVER['REQUEST_URI'], '/')) {
                $this->active = true;
            }
        }
    }

    /**
     * Whether a offset exists
     *
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $key An offset to check for.
     * @return boolean true on success or false on failure.
     *
     * The return value will be casted to boolean if non-boolean was returned.
     */
    public function offsetExists($key)
    {
        return array_key_exists($key, $this->item);
    }

    /**
     * Offset to retrieve
     *
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $key The offset to retrieve.
     * @return mixed Can return all value types.
     */
    public function offsetGet($key)
    {
        return $this->item[$key];
    }

    /**
     * Offset to set
     *
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $key The offset to assign the value to.
     * @param mixed $value  The value to set.
     * @return void
     */
    public function offsetSet($key, $value)
    {
        if (is_null($key)) {
            $this->item[] = $value;
        } else {
            $this->item[$key] = $value;
        }
    }

    /**
     * Offset to unset
     *
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $key The offset to unset.
     * @return void
     */
    public function offsetUnset($key)
    {
        unset($this->item[$key]);
    }

    /**
     * Dynamically retrieve a value from the item.
     *
     * @param  string  $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->item[$key];
    }

    /**
     * Dynamically set a value for the item.
     *
     * @param  string  $key
     * @param  mixed   $value
     * @return void
     */
    public function __set($key, $value)
    {
        $this->item[$key] = $value;
    }

    /**
     * Dynamically check if key is set for the item.
     *
     * @param  string  $key
     * @return void
     */
    public function __isset($key)
    {
        return isset($this->item[$key]);
    }

    /**
     * Dynamically unset a value from the item.
     *
     * @param  string  $key
     * @return void
     */
    public function __unset($key)
    {
        unset($this->item[$key]);
    }

}