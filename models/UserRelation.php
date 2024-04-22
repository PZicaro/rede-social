<?php 
Class UserRelation{
    public $id;
    public $user_from;
    public $user_to;
    

}
Interface UserRelationDao {
    public function insert(UserRelation $r);
    public function getRelationsfrom($id);
    
};