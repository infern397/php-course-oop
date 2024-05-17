<?php

interface IStorage
{
    public function add(string $key, mixed $data): void;

    public function remove(string $key): void;

    public function contains(string $key): bool;

    public function get(string $key): mixed;
}

class Storage implements IStorage, JsonSerializable
{
    protected array $storage = [];

    public function add(string $key, mixed $data): void
    {
        $this->storage[$key] = $data;
    }

    public function remove(string $key): void
    {
        unset($this->storage[$key]);
    }

    public function contains(string $key): bool
    {
        return isset($this->storage[$key]);
    }

    public function get(string $key): mixed
    {
        return $this->storage[$key];
    }

    public function jsonSerialize(): mixed
    {
        return get_class($this) . ': [' . implode(', ', array_map(function ($key, $value) {
            return "$key: $value";
        }, array_keys($this->storage), array_values($this->storage))) . ']';
    }
}

class Animal implements JsonSerializable
{
    public $name;
    public $health;
    public $alive;
    protected $power;

    public function __construct(string $name, int $health, int $power)
    {
        $this->name = $name;
        $this->health = $health;
        $this->power = $power;
        $this->alive = true;
    }

    public function calcDamage()
    {
        return $this->power * (mt_rand(100, 300) / 200);
    }

    public function applyDamage(int $damage)
    {
        $this->health -= $damage;

        if ($this->health <= 0) {
            $this->health = 0;
            $this->alive = false;
        }
    }

    public function jsonSerialize(): mixed
    {
        return "Name: $this->name, health: $this->health, alive: $this->alive, power: $this->power";
    }
}

class JSONLogger
{
    protected array $objects = [];

    public function addObject($obj): void
    {
        $this->objects[] = $obj;
    }

    public function log(string $betweenLogs = ','): string
    {
        $logs = array_map(function ($obj) {
            return $obj->jsonSerialize();
        }, $this->objects);

        return implode($betweenLogs, $logs);
    }
}

function testStorage()
{
    $storage = new Storage();
    $storage->add('test', 123);
    $storage->add('another', 456);
    print_r('test = ' . $storage->get('test'));
    echo '<br>';
    print_r('test isset ' . (int)$storage->contains('test'));
    $storage->remove('test');
    print_r('test = ' . $storage->get('test'));
    print_r('test isset ' . (int)$storage->contains('test'));
}

function testSerialize()
{
    $a1 = new Animal('Murzik', 20, 5);
    $a2 = new Animal('Bobik', 30, 3);
    $gameStorage = new Storage();
    $gameStorage->add('test', mt_rand(1, 10));
    $gameStorage->add('other', mt_rand(1, 10));

    $logger = new JSONLogger();
    $logger->addObject($a1);
    $logger->addObject($a2);
    $logger->addObject($gameStorage);

    echo $logger->log('<br>') . '<hr>';

}

//testStorage();
testSerialize();