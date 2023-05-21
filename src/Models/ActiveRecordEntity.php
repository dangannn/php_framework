<?php
namespace Models;

use Services\Db;

abstract class ActiveRecordEntity
{
    //всех наших сущностей будет id,
    // и нет необходимости писать это каждый раз в каждой сущности –
    // можно просто унаследовать
    protected $id;

    public function __set($name, $value)
    {
        // метод позволяет динамически устанавливать значения свойств объекта,
        // даже если эти свойства не определены явно в классе.
        $nameCamelCase = $this->underscoreToCamelcase($name);
        $this->$nameCamelCase = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public static function getById(int $id): ?self
    {
        $db = Db::getInstance();
        $entities = $db->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE `id`=:id',
            [':id' => $id],
            static::class);
        return $entities ? $entities[0] : null;
    }
    public static function findAllByOption(string $option, $value): array
    {
        $db = Db::getInstance();
        return $db->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE '.'`'.$option.'`'.'=:value',
            [':value' => $value],
            static::class);
    }

    public static function findAll(): array
    {
        $db = Db::getInstance();
        return $db->query('SELECT * FROM `' . static::getTableName() . '`', [], static::class);
    }

    private function underscoreToCamelcase(string $source)
    {
        return lcfirst(str_replace('_', '', ucwords($source, '_')));
    }

    private function camelCaseToUnderscore(string $source): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $source));
    }

    private function mapPropertiesToDbFormat(): array
    {
        $reflector = new \ReflectionObject($this);
        $properties = $reflector->getProperties();
        $mappedProperties = [];
        foreach ($properties as $property) {
            $propertyName = $property->getName();
            $propertyNameAsUnderscore = $this->camelCaseToUnderscore($propertyName);
            $mappedProperties[$propertyNameAsUnderscore] = $this->$propertyName;
        }
        return $mappedProperties;
    }

    public function save(): void
    {
        $mappedProperties = $this->mapPropertiesToDbFormat();
        if ($this->id !== null) {
            $this->update($mappedProperties);
        } else {
            $this->insert($mappedProperties);
        }
    }
    private function update(array $mappedProperties): void

    {
        $columns2params = [];
        $params2values = [];
        $index = 1;
        foreach ($mappedProperties as $column => $value) {
            $param = ':param' . $index; // :param1
            $columns2params[] = $column . ' = ' . $param; // column1 = :param1
            $params2values[$param] = $value; // [:param1 => value1]
            $index++;
        }
        $sql = 'UPDATE ' . static::getTableName() . ' SET ' . implode(', ', $columns2params) . ' WHERE id = ' . $this->id;
        $db = Db::getInstance();
        $db->query($sql, $params2values, static::class);
    }
    private function insert(array $mappedProperties): void

    {
        $filteredProperties = array_filter($mappedProperties);
        $columns = [];
        $paramsNames = [];
        $params2values = [];
        foreach ($filteredProperties as $columnName => $value) {
            $columns[] = '`' . $columnName. '`';
            $paramName = ':' . $columnName;
            $paramsNames[] = $paramName;
            $params2values[$paramName] = $value;
        }
        $columnsViaSemicolon = implode(', ', $columns);
        $paramsNamesViaSemicolon = implode(', ', $paramsNames);
        $sql = 'INSERT INTO ' . static::getTableName() . ' (' . $columnsViaSemicolon . ') VALUES (' . $paramsNamesViaSemicolon . ');';
        $db = Db::getInstance();
        $db->query($sql, $params2values, static::class);
    }
    public function delete(): void
    {
        $db = Db::getInstance();
        $db->query(
            'DELETE FROM `' . static::getTableName() . '` WHERE id = :id',
            [':id' => $this->id]
        );
        $this->id = null;
    }

    abstract protected static function getTableName(): string;
}

?>
