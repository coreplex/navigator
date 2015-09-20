<?php

namespace Coreplex\Navigator\Contracts;

interface Navigator
{
    /**
     * Create a new menu and return it with all of the menu items.
     *
     * @return Menu
     */
    public function all();

    /**
     * Create a new menu and return it with the selected menus.
     *
     * @param string|array $keys
     * @return Menu
     */
    public function get($keys);
}