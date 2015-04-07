<?php namespace Coreplex\Navigator\Components;

use ArrayIterator;
use IteratorAggregate;
use Coreplex\Navigator\Contracts\Menu as MenuContract;

class Menu implements IteratorAggregate, MenuContract {

    /**
     * An array of menu items.
     *
     * @var array
     */
    protected $items = [];

    public function __construct($renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * Retrieve all of the menu items.
     *
     * @return array
     */
    public function all()
    {
        return $this->items;
    }

    /**
     * Set the menu items.
     *
     * @param array $items
     * @return $this
     */
    public function items(array $items)
    {
        foreach ($items as $item) {
            if (isset($item['filter'])) {
                $callback = $this->buildClassCallback($item['filter']);

                if ( ! $callback()) {
                    continue;
                }
            }
            $this->items[] = new Item($item);
        }

        return $this;
    }

    /**
     * Set the menu items.
     *
     * @param $items
     * @return Menu
     */
    public function setItems($items)
    {
        return $this->items($items);
    }

    /**
     * Retrieve menu items.
     *
     * @return array
     */
    public function getItems()
    {
        return $this->all();
    }

    /**
     * Set the template for the menu.
     *
     * @param $template
     * @return $this
     */
    public function template($template)
    {
        $this->renderer->template($template);

        return $this;
    }

    /**
     * Set the template for the menu.
     *
     * @param $template
     * @return $this
     */
    public function setTemplate($template)
    {
        return $this->template($template);
    }

    /**
     * Render the template.
     *
     * @return mixed
     */
    public function render()
    {
        return $this->renderer->render($this);
    }

    /**
     * Build a new callback from a class for the filter.
     *
     * @param string $callback
     * @return callable
     */
    protected function buildClassCallback($callback)
    {
        list($class, $method) = $this->parseClassCallback($callback);
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
        if (str_contains($class, '@')) {
            return explode('@', $class);
        }
        return array($class, 'filter');
    }

    /**
     * Return the items for a foreach loop.
     *
     * @return ArrayIterator
     */
    public function getIterator() {
        return new ArrayIterator($this->items);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }

}