<?php namespace Coreplex\Navigator;

use Coreplex\Core\Contracts\Renderer;
use Coreplex\Navigator\Contracts\Store;
use Coreplex\Navigator\Components\Menu;
use Coreplex\Navigator\Contracts\Navigator as NavigatorContract;

class Navigator implements NavigatorContract {

    /**
     * An instance of the navigator renderer.
     *
     * @var Renderer
     */
    protected $renderer;

    /**
     * An instance of a navigator store.
     *
     * @var Store
     */
    protected $store;

    /**
     * The package config.
     *
     * @var array
     */
    protected $config;

    /**
     * An array of item filters.
     *
     * @var array
     */
    protected $filters = [];

    public function __construct(Renderer $renderer, Store $store, array $config)
    {
        $this->renderer = $renderer;
        $this->store = $store;
        $this->config = $config;

        if ( ! empty($this->config['filters'])) {
            foreach ($this->config['filters'] as $key => $class) {
                $this->filter($key, $class);
            }
        }
    }

    /**
     * Create a new menu and return it with all of the menu items.
     *
     * @return Menu
     */
    public function all()
    {
        $menu = $this->newMenu();
        $menu->items($this->store->all());
        $menu->template($this->config['defaultView']);

        return $menu;
    }

    /**
     * Create a new menu and return it with the selected menus.
     *
     * @param string|array $keys
     * @return Menu
     */
    public function get($keys)
    {
        $keys = $this->parseKeys($keys);

        $menu = $this->newMenu();
        $menu->items($this->store->find($keys));
        $menu->template($this->config['defaultView']);

        return $menu;
    }

    /**
     * Create a new menu instance.
     *
     * @return Menu
     */
    protected function newMenu()
    {
        return new Menu($this->renderer, $this->filters, $this->config);
    }

    /**
     * Parse the menu keys to an array if they are a string.
     *
     * @param string|array $keys
     * @return array
     */
    protected function parseKeys($keys)
    {
        if (is_string($keys)) {
            if (str_contains($keys, ',')) {
                return explode(',', str_replace(' ', '', $keys));
            } else {
                $keys = [$keys];
            }
        }

        return $keys;
    }

    /**
     * Register a new filter.
     *
     * @param $key
     * @param $class
     * @return $this
     */
    public function filter($key, $class)
    {
        $this->filters[$key] = $class;

        return $this;
    }

}