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
 
 public function getSelectStatement2()
 {
 return "SELECT ImageID, UserID, Title, Description, CountryCodeISO, 
 ContinentCode, Path FROM ImageDetails ";
 }
 
}
?>