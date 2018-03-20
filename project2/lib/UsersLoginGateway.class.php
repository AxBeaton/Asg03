<?php
class UsersLoginGateway extends TableDataGateway {
 public function __construct($connect) {
 parent::__construct($connect);
 }

 protected function getSelectStatement()
 {
 return "SELECT	Salt, UserID, UserName, Password	FROM	UsersLogin";
 }
 
 protected function getSelectStatement2()
 {
return "SELECT	Users.FirstName, Users.LastName, Users.Address, Users.City,
Users.Region, Users.Country, Users.Postal, Users.Phone, Users.Email	FROM	UsersLogin	JOIN Users on UsersLogin.UserID = Users.UserID"; 
}


 protected function getOrderFields() {
 return 'LastName';
 }
 protected function getPrimaryKeyName() {
 return "UserName";
 }
 
 public function findByUser($user){
 $sql = $this->getSelectStatement2(). " WHERE	Users.UserID = $user ";
 $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
 return $statement->fetchAll();
 
 }
}
?>