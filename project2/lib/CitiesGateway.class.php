<?php
class CitiesGateway extends TableDataGateway {
 public function __construct($connect) {
 parent::__construct($connect);
 }

 protected function getSelectStatement()
 {
 return "SELECT Cities.CityCode, Cities.CountryCodeISO, AsciiName, Cities.Longitude, Cities.Latitude, Cities.Population, Cities.Elevation, Cities.TimeZone 
 FROM Cities";
 }
 protected function getSelectStatement2()
 {
 return "SELECT Cities.CityCode, ImageDetails.ImageID, ImageDetails.Path 
 FROM Cities Join ImageDetails on Cities.CityCode = ImageDetails.CityCode";
 }

 protected function getOrderFields() {
 return 'AsciiName';
 }
 protected function getPrimaryKeyName() {
 return "CityCode";
 }
 
 
 public function innerJoin()
 {
 $sql = $this->getSelectStatement()." INNER JOIN ImageDetails on Cities.".$this->getPrimaryKeyName()."= ImageDetails.CityCode 
 group by ".$this->getOrderFields()." ORDER BY ".$this->getOrderFields();
 $statement = DatabaseHelper::runQuery($this->connection, $sql,null);
 return $statement->fetchAll();
} 

public function getByCity($id) {
  $sql = $this->getSelectStatement2()." WHERE Cities.CityCode =:id ORDER BY ". $this->getOrderFields();
  $statement = DatabaseHelper::runQuery($this->connection, $sql, Array(':id' => $id));
  return $statement->fetchAll();
}
//for the single country map, used to pull long, and lat data from cities that have images
public function getbyCity2($id) {
 $sql = $this->getSelectStatement(). " INNER JOIN ImageDetails on Cities." .$this->getPrimaryKeyName(). "=ImageDetails.CityCode
 INNER JOIN Countries on ImageDetails.CountryCodeISO = Countries.ISO WHERE Countries.ISO =:id";
 $statement = DatabaseHelper::runQuery($this->connection, $sql,Array(':id' => $id));
 return $statement->fetchAll();
}
 }

?>