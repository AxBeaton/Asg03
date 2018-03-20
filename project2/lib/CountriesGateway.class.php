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

 protected function getSelectStatementCities() //used in single country's map function. Pulls information from Cities without having to open a new DB connection 
 { // Used in getByCities for map function
 return "SELECT Cities.CityCode, Cities.CountryCodeISO, AsciiName, Cities.Longitude, Cities.Latitude, Cities.Population, Cities.Elevation, Cities.TimeZone 
 FROM Cities";
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

public function cities()
 {
 $sql = $this->getSelectStatement()." INNER JOIN ImageDetails on Cities.".$this->getPrimaryKeyName()."= ImageDetails.CityCode 
 group by ".$this->getOrderFields()." ORDER BY ".$this->getOrderFields();
 $statement = DatabaseHelper::runQuery($this->connection, $sql,null);
 return $statement->fetchAll();
} 
public function getByCities($id) {
 $sql = $this->getSelectStatementCities(). " INNER JOIN ImageDetails on Cities.CityCode =ImageDetails.CityCode
 INNER JOIN Countries on ImageDetails.CountryCodeISO = Countries.ISO WHERE Countries.ISO =:id";
 $statement = DatabaseHelper::runQuery($this->connection, $sql,Array(':id' => $id));
 return $statement->fetchAll();
 
}


 }

?>