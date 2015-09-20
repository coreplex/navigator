<?php namespace Coreplex\Navigator\Contracts;

interface Menu {

    /**
     * Retrieve all of the menu items.
     *
     * @return array
     */
    public function all();

    /**
     * Set the menu items.
     *
     * @param array $items
     * @return $this
     */
    public function items(array $items);

    /**
     * Set the menu items.
     *
     * @param $items
     * @return Menu
     */
    public function setItems($items);

    /**
     * Retrieve menu items.
     *
     * @return array
     */
    public function getItems();

    /**
     * Set the template for the menu.
     *
     * @param $template
     * @return $this
     */
    public function template($template);

    /**
     * Set the template for the menu.
     *
     * @param $template
     * @return $this
     */
    public function setTemplate($template);

    /**
     * Render the template.
     *
     * @return string
     */
    public function render();

}