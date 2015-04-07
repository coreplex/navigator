<?php namespace Coreplex\Navigator\Contracts;

interface Store {

    /**
     * Retrieve all menu items, regardless of thier parent item.
     *
     * @return array
     */
    public function all();

    /**
     * Retrieve all specified menu items.
     *
     * @param string|array $menu
     * @return array
     */
    public function find($menu);

}