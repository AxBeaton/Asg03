<?php
class PostsGateway extends TableDataGateway {
 public function __construct($connect) {
 parent::__construct($connect);
 }

 protected function getSelectStatement()
 {
 return "SELECT PostID, UserID, MainPostImage,
 Title, Image FROM Posts ";
 }

 protected function getOrderFields() {
 return 'Title';
 }
 protected function getPrimaryKeyName() {
 return "PostID";
 }
}
?>