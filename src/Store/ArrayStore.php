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
            if ( ! is_array($menu)) {
                $callback = $this->buildClassCallback($menu);
                $items = array_merge($items, $callback());
            } else {
                $items = array_merge($items, $menu);
            }
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

            if ( ! is_array($this->menus[$key])) {
                $callback = $this->buildClassCallback($this->menus[$key]);
                $items = array_merge($items, $callback());
            } else {
                $items = array_merge($items, $this->menus[$key]);
            }
        }

        return $items;
    }

}