<?php 
Class Post{
    public $id;
    public $id_user;
    public $type;
    public $created_at ;
    public $body;
    public $mine;
    public $user;
    public $like_count;
    public $liked;
    public $comments;
   

}
Interface PostDao {
    public function insert( Post $p);
    public function getHomeFeed($id_user);

    
};