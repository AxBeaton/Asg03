<?php
class ContinentsGateway extends TableDataGateway {
 public function __construct($connect) {
 parent::__construct($connect);
 }

 protected function getSelectStatement()
 {
 return "SELECT ContinentCode, ContinentName FROM Continents ";
 }

 protected function getOrderFields() {
 return 'ContinentName';
 }
 protected function getPrimaryKeyName() {
 return "ContinentCode";
 }
}
?>