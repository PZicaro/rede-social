<?php
require_once('./models/post.php');
require('./dao/UserRelationDaoMySql.php');

class PostDaoMysql implements PostDao{
    private $pdo;

    public function __construct(PDO $drive){
        $this->pdo = $drive;
    }

    public function insert(Post $p){
        $sql = $this->pdo->prepare('INSERT INTO posts (id_user, type, created_at, body) VALUES (:id_user, :type, :created_at, :body)');
        $sql->bindValue(':id_user', $p->id_user);
        $sql->bindValue(':type', $p->type);
        $sql->bindValue(':created_at', $p->created_at);
        $sql->bindValue(':body', $p->body);
        $sql->execute();
    }
    public function getHomeFeed($id_user)
    {
        $array =[];

        $urDao = new UserRelationDaoMySql($this->pdo);
        $userList = $urDao->getRelationsFrom($id_user);

        $sql = $this->pdo->query("SELECT * FROM posts WHERE id_user IN (".implode(",", $userList).") ORDER BY created_at DESC");
        if($sql->rowCount()>0){
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);

            $array= $this->_postListToObject($data, $id_user);

        }

        return $array;
    }

    private function _postListToObject($post_list, $id_user){
        $posts= [];
        $userDao = new UserDaoMysql($this->pdo);

        foreach($post_list as $post_item){
                $newPost = new Post();
                $newPost->id = $post_item['id'];
                $newPost->type = $post_item['type'];
                $newPost->created_at = $post_item['created_at'];
                $newPost->body = $post_item['body'];
                $newPost->mine = false;

                if($post_item['id'] == $id_user ){
                $newPost->mine = true;


                    }
                    //pegar informações do usuário
                    $newPost->user = $userDao->findById($post_item['id_user']);
                  

                    //informações sobre Like
                    $newPost->like_count = 0;
                    $newPost->liked = false;

                    //informações sobre comentários
                    $newPost->comments=[];

                    $posts[] =$newPost;

                   
        }

        return $posts;

    }
}