<?php namespace Coreplex\Navigator\Components;

use ArrayIterator;
use IteratorAggregate;
use Coreplex\Navigator\Contracts\Renderer;
use Coreplex\Navigator\Contracts\Menu as MenuContract;
use Coreplex\Navigator\Contracts\Item as ItemContract;

class Menu implements IteratorAggregate, MenuContract
{

    /**
     * An array of menu items.
     *
     * @var array
     */
    protected $items = [];

    public function __construct(Renderer $renderer, array $filters)
    {
        $this->renderer = $renderer;
        $this->filters = $filters;
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
        $this->items = $this->parseItems($items);

        return $this;
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
     * Loop through the menu items and turn them into Item objects and then
     * run any item filters to see if the current user can view the item.
     *
     * @param array $items
     * @return array
     * @throws FilterNotDefinedException
     */
    protected function parseItems(array $items)
    {
        foreach ($items as $key => $item) {
            $item = new Item($this->renderer, $this->filters, $item);

            if (isset($item['filter'])) {
                $valid = true;
                $callbacks = $this->getFilterCallbacks($item['filter'], $item);

                foreach ($callbacks as $callback) {
                    if ( ! $callback()) {
                        $valid = false;
                        break;
                    }
                }

                if ( ! $valid) {
                    unset($items[$key]);
                    continue;
                }
            }

            $items[$key] = $item;
        }

        return $items;
    }

    /**
     * Return the filter callbacks for a menu item.
     *
     * @param array $filters
     * @param ItemContract $item
     * @return callable
     * @throws FilterNotDefinedException
     */
    protected function getFilterCallbacks($filters, ItemContract $item)
    {
        $callbacks = [];

        if (is_string($filters)) {
            $filters = [$filters];
        }

        foreach ($filters as $key => $filter) {
            list($filter, $args) = $this->parseFilter($item, $key, $filter);

            if ( ! isset($this->filters[$filter])) {
                throw new FilterNotDefinedException("No filter has been defined with the name '$filter'");
            }

            $callbacks[] = $this->buildClassCallback($this->filters[$filter], $args);
        }

        return $callbacks;
    }

    /**
     * @param ItemContract $item
     * @param $filter
     * @return array
     */
    protected function parseFilter(ItemContract $item, $key, $filter)
    {
        if (is_string($key)) {
            $args = array_merge([$item], $filter);
            $filter = $key;
        } else {
            $args = [$item];
        }

        return array($filter, $args);
    }

    /**
     * Build a new callback from a class for the filter.
     *
     * @param string $class
     * @param array $args
     * @return callable
     */
    protected function buildClassCallback($class, $args)
    {
        list($class, $method) = $this->parseClassCallback($class);

        return function() use ($class, $method, $args)
        {
            $callable = array(new $class, $method);
            return call_user_func_array($callable, $args);
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
    public function setTemplate($template)
    {
        return $this->template($template);
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