<?php

class Article
{
    protected int $id;
    public string $title;
    public string $content;
    protected IStorage $storage;

    public function __construct(IStorage $storage)
    {
        $this->storage = $storage;
    }

    public function create(array $fields)
    {

        $this->title = $fields['title'];
        $this->content = $fields['content'];
        if ($this->isValid()) {
            $this->id = $this->storage->create($fields);
        } else {
            throw new Exception("invalid article data");
        }
    }

    public function load(int $id)
    {
        $data = $this->storage->get($id);

        if ($data === null) {
            throw new Exception("article with id=$id not found");
        }

        $this->id = $id;
        $this->title = $data['title'];
        $this->content = $data['content'];
    }

    public function save()
    {
        if ($this->isValid()) {
            $this->storage->update($this->id, [
                'title' => $this->title,
                'content' => $this->content
            ]);
        } else {
            throw new Exception("invalid article data");
        }
    }

    private function isValid()
    {
        return trim($this->content) && trim($this->title);
    }
}
