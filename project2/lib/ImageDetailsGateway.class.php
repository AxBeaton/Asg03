<?php
class ImageDetailsGateway extends TableDataGateway {
 public function __construct($connect) {
 parent::__construct($connect);
 }

 protected function getSelectStatement()
 {
 return "SELECT ImageID, UserID, Title, Description, CityCode, CountryCodeISO, 
 ContinentCode, Latitude, Longitude,Path FROM ImageDetails ";
 }

 protected function getRatings(){
  return "SELECT ROUND(avg(ImageRating.Rating)) as RatingSum, ImageRating.ImageID FROM ImageRating";
 }
 //"SELECT ImageRating.Rating, ImageRating.ImageID, ImageRating.ImageRatingID FROM ImageRating";

 protected function getOrderFields() {
 return 'Title';
 }
 protected function getPrimaryKeyName() {
 return "ImageID";
 }
 
 
 public function getPosition($id) {
  $sql = $this->getSelectStatement()." WHERE ImageDetails.ImageID =:id";
  $statement = DatabaseHelper::runQuery($this->connection, $sql, Array(':id' => $id));
  return $statement->fetchAll();
}

 public function whereClause(){
  $sql = $this->getSelectStatement()." WHERE ".$this->getOrderFields()." LIKE '%".$_GET['title']."%'";
  $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
  return $statement->fetchAll();
 }
 
public function getByCountryISO($id) {
  $sql = $this->getSelectStatement()." WHERE CountryCodeISO =:id ORDER BY ". $this->getOrderFields();
  $statement = DatabaseHelper::runQuery($this->connection, $sql, Array(':id' => $id));
  return $statement->fetchAll();
}
 
 public function getByRatings($id) {
  $sql = $this->getRatings(). " INNER JOIN ImageDetails ON ImageRating.ImageID = ImageDetails." .$this->getPrimaryKeyName(). " WHERE ImageRating.ImageID =:id";
  $statement = DatabaseHelper::runQuery($this->connection,$sql, Array(':id' => $id));
  return $statement->fetchAll();
 }
 
}
?>