<?php

class Tag
{
    protected array $attrs = [];
    protected string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function attr(string $name, string $value)
    {
        $this->attrs[$name] = $value;
        return $this;
    }

    private function attrsToString(): string
    {
        $res = '';
        foreach ($this->attrs as $name => $value) {
            $res .= "$name=\"$value\" ";
        }
        return $res;
    }

    public function render()
    {
        return "<$this->name {$this->attrsToString()}>";
    }
}

class PairTag extends Tag
{
    private array $children = [];

    function appendChild(Tag $tag): Tag
    {
        $this->children[] = $tag;
        return $this;
    }

    private function renderChildren()
    {
        $res = '';
        foreach ($this->children as $child) {
            $res .= $child->render();
        }
        return $res;
    }

    function render()
    {
        return parent::render() . $this->renderChildren() . "</{$this->name}>";
    }
}

class SingleTag extends Tag
{

}

//$img = new SingleTag('img');
//$img->attr('src', './nz');
//$img->attr('alt', 'nz');
//
//$hr = new SingleTag('hr');
//
//$a = new PairTag('a');
//$a->attr('href', './nz');
//$a->appendChild($img);
//$a->appendChild($hr);
//
//echo $a->render();

$firstImg = new SingleTag('img');
$firstImg->attr('src', 'f1.jpg')->attr('alt', 'f1 not found')->render();

$firstInput = new SingleTag('input');
$firstInput->attr('type', 'text')->attr('name', 'f1');

$secondImg = new SingleTag('img');
$secondImg->attr('src', 'f2.jpg')->attr('alt', 'f2 not found');

$secondInput = new SingleTag('input');
$secondInput->attr('type', 'password')->attr('name', 'f2');

$firstLabel = new PairTag('label');
$firstLabel->appendChild($firstImg)->appendChild($firstInput);

$secondLabel = new PairTag('label');
$secondLabel->appendChild($secondImg)->appendChild($secondInput);

$thirdInput = new SingleTag('input');
$thirdInput->attr('type', 'submit')->attr('value', 'Send');

$form = new PairTag('form');
$form->appendChild($firstLabel)
    ->appendChild($secondLabel)
    ->appendChild($thirdInput);
echo htmlspecialchars($form->render());

