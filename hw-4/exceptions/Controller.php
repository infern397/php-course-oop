<?php

namespace exceptions;

use system\IController;

class Controller implements IController
{
    protected string $title = '';
    protected string $content = '';
    protected array $env;
    public function notFound()
    {
        $this->title = 'Error 404';
        $this->content = 'Page not found';
    }
    public function fatal()
    {
        $this->title = 'Error 500';
        $this->content = 'Fatal Error';
    }
    public function forbidden()
    {
        $this->title = 'Error 403';
        $this->content = 'Have no access Error';
    }
    public function render(): string
    {
        return "<h1>{$this->title}</h1><div>{$this->content}</div>";
    }

    public function setEnvironment(array $urlParams): void
    {
        $this->env = $urlParams;
    }
}