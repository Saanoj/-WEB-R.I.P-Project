<?php
require_once __DIR__ . '/../utils/DatabaseManager.php';
require_once __DIR__ . '/../models/User.php';

class UserService {

  private static $instance;

  private function __construct() {

  }

  public static function getInstance(): UserService {
    if(!isset(UserService::$instance)){
      UserService::$instance = new UserService();
    }
    return UserService::$instance;
  }

  /*
  public function insert(User $attraction): ?User {
    $db = DatabaseManager::getDatabase();
    $affectedRows = $db->exec('INSERT INTO user (name, capacity, min_height, duration) VALUES (?, ?, ?, ?) ', [$attraction->getName(),$attraction->getCapacity(),$attraction->getMinHeight(),$attraction->getDuration()]);
    if ($affectedRows > 0) {
      $attraction->setId(intval($db->lastInsertId()));
      return $attraction;
    }
    return NULL;
  }
  */

  public function allUsers(): array{
    $db = DatabaseManager::getDatabase();
    $list = $db->getALL('SELECT * FROM users');
    $users = [];
    foreach ($list as $data) {
      $users[] = User::UserFromArray($data);
    }
    return $users;
  }

  public function UserCollab(int $id): array{
    $db = DatabaseManager::getDatabase();
    $collab = $db->findOne('SELECT * FROM collaborateurs WHERE idCollaborateurs = ? AND isOff = 0',[$id]);
    //print_r($collab);
    return $collab;
  }

  public function switchOnline(int $id, int $isOnline): int{
    $db = DatabaseManager::getDatabase();
    $collab = $db->exec('UPDATE collaborateurs SET isOnline = ? WHERE idCollaborateurs = ? AND isOff = 0',[$isOnline,$id]);
    return $collab;
  }
}
?>
