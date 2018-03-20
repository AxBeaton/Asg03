<?php
class UsersGateway extends TableDataGateway {
 public function __construct($connect) {
 parent::__construct($connect);
 }

 protected function getSelectStatement()
 {
 return "SELECT UserID, FirstName, LastName, Address, City,
 Country, Phone, Email, Postal FROM Users ";
 }
 protected function getSelectStatement2()
 {
 return "SELECT LastName, ImageID, Path FROM ImageDetails JOIN Users on ImageDetails.UserID = Users.UserID";
 }
 
 protected function getSelectStatement3()
 {
 return "SELECT Users.UserID, FirstName, LastName, Address, City, ImageDetails.CityCode, Country, Phone, Email, Postal, Path, CountryName,Description, AsciiName,Title,ImageDetails.CountryCodeISO FROM Users 
 JOIN ImageDetails on Users.UserID = ImageDetails.UserID 
 JOIN Countries on Countries.ISO=ImageDetails.CountryCodeISO
 JOIN Cities on Cities.CityCode=ImageDetails.CityCode";
 }

 protected function getOrderFields() {
 return 'LastName';
 }
 protected function getPrimaryKeyName() {
 return "UserID";
 }
 
 public function getImages($id) {
  $sql = $this->getSelectStatement2()." WHERE ImageDetails.UserID =:id ORDER BY ". $this->getOrderFields();
  $statement = DatabaseHelper::runQuery($this->connection, $sql, Array(':id' => $id));
  return $statement->fetchAll();
}

public function join($id){
 $sql= $this -> getSelectStatement3()." WHERE ImageID =:id ";
 $statement = DatabaseHelper::runQuery($this->connection, $sql, Array(':id' => $id));
 return $statement->fetchAll();
}
}
?>