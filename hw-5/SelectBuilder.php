<?php

class SelectBuilder{
	public string $table;
    public string $fields = '';
    public string $where = '';
    public string $order = '';
    public string $group = '';
    public string $limit = '';
    public string $join = '';

	public function __construct(string $table){
		$this->table = $table;
	}

    public function select(string|array $fields)
    {
        $this->fields = is_array($fields) ? implode(', ', $fields) : $fields;
        return $this;
    }

    public function join(string $table, string $condition)
    {
        $this->join = "JOIN $table AS $condition";
        return $this;
    }

    public function where(string $comparative, string $operation, string $comparison)
    {
        $this->where = "WHERE $comparative $operation $comparison";
        return $this;
    }

    public function groupBy(string $expression)
    {
        $this->group = "GROUP BY $expression";
        return $this;
    }

    public function limit(string $expression)
    {
        $this->limit = "LIMIT $expression";
        return $this;
    }

    public function orderBy(string $expression, string $order = 'ASC')
    {
        $this->order = "ORDER BY {$expression} {$order}";
        return $this;
    }

	public function __toString(){
		return "SELECT {$this->fields} FROM {$this->table} {$this->join} {$this->where} {$this->group} {$this->order} {$this->limit}";
	}
}