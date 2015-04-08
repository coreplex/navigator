<?php

return [

    /**
     * =======================================================================
     *  Base menu items
     * =======================================================================
     *
     * Set any class based menus here.
     */
    'menus' => [
        //
    ],

    /**
     * =======================================================================
     *  Default view
     * =======================================================================
     *
     * If you are using a templatable driver then you can set the base
     * template here. To override this at run time you can use the template
     * method.
     */
    'defaultView' => 'navigator::bootstrap.default',

    /**
     * =======================================================================
     *  Renderer
     * =======================================================================
     *
     * Set the navigator renderer. Can be:
     *
     * Coreplex\Navigator\Renderers\LaravelBlade
     */
    'renderer' => 'Coreplex\Navigator\Renderers\LaravelBlade',

    /**
     * =======================================================================
     *  Store
     * =======================================================================
     *
     * Set the data store you are using. Can be:
     *
     * Coreplex\Navigator\Store\ArrayStore
     */
    'store' => 'Coreplex\Navigator\Store\ArrayStore',

    /**
     * =======================================================================
     *  Item Filters
     * =======================================================================
     *
     * Item filters can be used to verify if a user can view a menu item. To
     * add a filter add them to the array below with the key as a unique name
     * used to access the item filter and the value being then name of the
     * class used for the filter.
     */
    'filters' => [
        //
    ],

];