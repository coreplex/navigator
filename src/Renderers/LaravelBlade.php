<?php namespace Coreplex\Navigator\Renderers;

use Illuminate\Contracts\View\Factory;
use Coreplex\Navigator\Contracts\Menu;
use Coreplex\Navigator\Contracts\TemplatableRenderer;
use Coreplex\Navigator\Exceptions\TemplateNotSetException;

class LaravelBlade implements TemplatableRenderer {

    /**
     * The template to be rendered.
     *
     * @var string
     */
    protected $template;

    /**
     * An instance of the laravel view class.
     *
     * @var Factory
     */
    protected $view;

    public function __construct(Factory $view)
    {
        $this->view = $view;
    }

    /**
     * Render the view.
     *
     * @param Menu $menu
     * @return mixed
     * @throws TemplateNotSetException
     */
    public function render(Menu $menu)
    {
        if ( ! isset($this->template)) {
            throw new TemplateNotSetException("You must set a template to use to render the navigation.");
        }

        return $this->view->make($this->template)->with('menu', $menu)->render();
    }

    /**
     * Set the template.
     *
     * @param $template
     * @return $this
     */
    public function template($template)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Set the template.
     *
     * @param $template
     * @return $this
     */
    public function setTemplate($template)
    {
        $this->template($template);
    }

}