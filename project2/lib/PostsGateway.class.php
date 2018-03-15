<?php
class PostsGateway extends TableDataGateway {
 public function __construct($connect) {
 parent::__construct($connect);
 }

 protected function getSelectStatement()
 {
 return "SELECT Posts.PostID, Posts.UserID, Posts.MainPostImage,
 Posts.Title, Posts.Message, ImageDetails.Path, Users.FirstName, Users.LastName FROM Posts 
 Join ImageDetails on Posts.MainPostImage = ImageDetails.ImageID
 JOIN Users on ImageDetails.UserID = Users.UserID";
 }
 
 protected function getSelectStatementPost($var)
 {
 return "select PostImages.ImageID, Path from PostImages JOIN ImageDetails on PostImages.ImageID = ImageDetails.ImageID where PostID =".$var;
 }

 protected function getOrderFields() {
 return 'Title';
 }
 protected function getPrimaryKeyName() {
 return "PostID";
 }
 public function postsGet($var)
 {
 $sql = $this->getSelectStatementPost($var);
 $statement = DatabaseHelper::runQuery($this->connection, $sql,null);
 return $statement->fetchAll();
 } 
}
?>