<?php namespace Coreplex\Navigator\Contracts;

interface TemplatableRenderer extends Renderer {

    /**
     * Set the template.
     *
     * @param $template
     * @return $this
     */
    public function template($template);

    /**
     * Set the template.
     *
     * @param $template
     * @return $this
     */
    public function setTemplate($template);

}