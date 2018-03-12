<?php
class CountriesGateway extends TableDataGateway {
 public function __construct($connect) {
 parent::__construct($connect);
 }

 protected function getSelectStatement()
 {
 return "SELECT ISO, CountryName, Capital, Area, Population, 
 Continent, CurrencyName, CountryDescription FROM Countries ";
 }


 protected function getOrderFields() {
 return 'CountryName';
 }
 protected function getPrimaryKeyName() {
 return "ISO";
 }
 
 
 public function innerJoin()
 {
 $sql = $this->getSelectStatement()." INNER JOIN ImageDetails on Countries.".$this->getPrimaryKeyName()."= ImageDetails.CountryCodeISO 
 group by ".$this->getOrderFields()." ORDER BY ".$this->getOrderFields();
 $statement = DatabaseHelper::runQuery($this->connection, $sql,null);
 return $statement->fetchAll();
} 
 
 }

?>