<?php namespace Coreplex\Navigator\Contracts;

interface Renderer {

    /**
     * Render the view.
     *
     * @param Menu $menu
     * @return mixed
     * @throws TemplateNotSetException
     */
    public function render(Menu $menu);

}