<?php namespace Coreplex\Navigator\Store;

use Coreplex\Navigator\Contracts\Store;
use Coreplex\Navigator\Exceptions\MenuNotFoundException;

class ArrayStore extends AbstractStore implements Store {

    /**
     * An array of menus.
     *
     * @var array
     */
    protected $menus = [];

    public function __construct(array $menus)
    {
        $this->menus = $menus;
    }

    /**
     * Retrieve all menu items, regardless of thier parent item.
     *
     * @return array
     */
    public function all()
    {
        $items = [];

        foreach ($this->menus as $key => $menu) {
            $callback = $this->buildClassCallback($this->menus[$key]);
            $items = array_merge($items, $callback());
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
            if ( ! array_key_exists($key, $this->menus)) {
                throw new MenuNotFoundException("No menu found with the name '$key'");
            }

            $callback = $this->buildClassCallback($this->menus[$key]);
            $items = array_merge($items, $callback());
        }

        return $items;
    }

}