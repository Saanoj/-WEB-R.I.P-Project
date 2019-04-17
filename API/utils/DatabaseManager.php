<?php

require_once __DIR__ . '/.conf.php';

class DatabaseManager {

  private $pdo;
  private static $instance;

  private function __construct()
  {
    
    $conn = DB_DRIVER . ':host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=UTF8';
    $this->pdo = new PDO($conn, DB_USER, DB_PASSWORD);
    
    

  }

  public static function getDatabase(): DatabaseManager {
    if(!isset(DatabaseManager::$instance)){
      DatabaseManager::$instance = new DatabaseManager();
    }
    return DatabaseManager::$instance;
  }

  private function internalExec(string $sql, array $params = []):?PDOStatement {
    $stmt = $this->pdo->prepare($sql);
    if ($stmt !== false) {
      $res = $stmt->execute($params);
      if ($res !== false) {
        return $stmt;
      }
      if (DB_LOG === true) {
        print_r($stmt->errorInfo());
      }
    }
    return NULL;
  }

  public function exec(string $sql, array $params = []): int {
    $stmt = $this->internalExec($sql,$params);
    if ($stmt !== NULL) {
      return $stmt->rowCount();
    }
    return 0;
  }

  public function getAll(string $sql, array $params = []): array {
    $stmt = $this->internalExec($sql,$params);
    if ($stmt !== NULL) {
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return [];
  }

  public function findOne(string $sql, array $params = []): ?array {
    $stmt = $this->internalExec($sql,$params);
    if ($stmt !== NULL) {
      $res = $stmt->fetch(PDO::FETCH_ASSOC);
      $stmt->closeCursor();
      return $res;
    }
    return NULL;
  }

  public function lastInsertId(): string{
    return $this->pdo->lastInsertId();
  }
}

?>
