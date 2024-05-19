<?php

namespace articles;

use exceptions\NotFoundException;
use system\FileStorage;
use system\IController;
use system\IStorage;

class Controller implements IController
{
    protected string $title = '';
    protected string $content = '';
    protected array $env;
    protected IStorage $storage;

    public function __construct()
    {
        $this->storage = FileStorage::getInstance('db/articles.txt'); // yes-yes, without DI it is trash
    }

    public function setEnvironment(array $urlParams): void
    {
        $this->env = $urlParams;
    }

    public function index()
    {
        $this->title = 'Home page';
        $this->content = 'Articles list';
    }

    public function item()
    {
        $this->title = 'Article page';
        $id = (int)$this->env[1];
        $article = $this->storage->get($id);
        if ($article === null) {
            throw new NotFoundException("Article №$$id not found");
        }
        $this->content = "
			<h2>{$article['title']}</h2>
			<div>{$article['content']}</div>
		";
    }

    public function render(): string
    {
        return "<h1>{$this->title}</h1><div>{$this->content}</div>";
    }
}