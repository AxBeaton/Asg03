<?php
class ImageDetailsGateway extends TableDataGateway {
 public function __construct($connect) {
 parent::__construct($connect);
 }

 protected function getSelectStatement()
 {
 return "SELECT ImageID, UserID, Title, Description, CountryCodeISO, 
 ContinentCode, Path FROM ImageDetails ";
 }

 protected function getOrderFields() {
 return 'Title';
 }
 protected function getPrimaryKeyName() {
 return "ImageID";
 }
 public function whereClause(){
  return  $this->getSelectStatement." WHERE ".$this->getOrderFields()." LIKE '%$varTitle%'";
 }
 
public function getByCountryISO($id) {
  $sql = $this->getSelectStatement()." WHERE CountryCodeISO =:id ORDER BY ". $this->getOrderFields();
  $statement = DatabaseHelper::runQuery($this->connection, $sql, Array(':id' => $id));
  return $statement->fetchAll();
}
 
}
?>