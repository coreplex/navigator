<?php namespace Coreplex\Navigator\Store;

use Coreplex\Navigator\Contracts\Store;
use Coreplex\Navigator\Exceptions\MenuNotFoundException;

class ArrayStore implements Store {

    /**
     * The store items.
     *
     * @var array
     */
    protected $items = [];

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * Retrieve all menu items, regardless of thier parent item.
     *
     * @return array
     */
    public function all()
    {
        $items = [];

        foreach ($this->items as $menu) {
            $items = array_merge($items, $menu['items']);
        }

        return $items;
    }

    /**
     * Retrieve all specified menu items.
     *
     * @param string|array $keys
     * @return array
     *
     * @throws MenuNotFoundException
     */
    public function find($keys)
    {
        $items = [];

        foreach ($keys as $key) {
            if ( ! array_key_exists($key, $this->items)) {
                throw new MenuNotFoundException("No menu found with the name '$key'");
            }

            $items = array_merge($items, $this->items[$key]['items']);
        }

        return $items;
    }

}