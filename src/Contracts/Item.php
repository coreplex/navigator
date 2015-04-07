<?php namespace Coreplex\Navigator\Contracts;

interface Item {

    /**
     * Check if the current item is active.
     *
     * @return bool
     */
    public function isActive();

}