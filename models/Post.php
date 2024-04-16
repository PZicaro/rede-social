<?php 
Class Post{
    public $id;
    public $id_user;
    public $type;
    public $created_at ;
    public $body;
   

}
Interface PostDao {
    public function insert( Post $p);

    
};