<?php

namespace Services;

class Db
{
    private $pdo;
    private static $instance;

    private function __construct()
    {
//        self::$instancesCount++;

        $options = include __DIR__ . '/../settings.php';

        $this->pdo = new \PDO(
            'mysql:host=' . $options['host'] . ';dbname=' . $options['dbname'],
            $options['user'],
            $options['password']
        );
        $this->pdo->exec('SET NAMES UTF8');
    }

    public function query(string $sql, $params = [], string $className = 'stdClass'): ?array
    {
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute($params);

        if (!$result) return null;
        return $sth->fetchAll(\PDO::FETCH_CLASS, $className);
    }

    public static function getInstance(): self

    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;

    }
}
