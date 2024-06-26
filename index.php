<?php
require('./config.php');
require('./dao/PostDaoMysql.php');
require('./models/Auth.php');
$auth = new Auth($pdo, $base);
$userInfo = $auth->checkToken();
$activeMenu = 'home';


$postDao = new PostDaoMysql($pdo);

$firstName = current(explode(' ', $userInfo->name ));

$feed = $postDao->getHomeFeed($userInfo->id);




require('./partials/header.php');
require('./partials/menu.php');

?>
 
  
        <section class="feed mt-10">
        <div class="row">
                <div class="column pr-5">
            <?=
            require('./partials/feed-editor.php');
        
            ?>
             </div>

<?php     
   foreach($feed as $item){
   
    require('./partials/feed-item.php');     
}
?>



</div>
            
                <div class="column side pl-5">
                    <div class="box banners">
                        <div class="box-header">
                            <div class="box-header-text">Patrocinios</div>
                            <div class="box-header-buttons">
                                
                            </div>
                        </div>
                        <div class="box-body">
                            <a href=""><img src="<?=$base;?>/https://alunos.b7web.com.br/media/courses/php-nivel-1.jpg" /></a>
                            <a href=""><img src="<?=$base;?>/https://alunos.b7web.com.br/media/courses/laravel-nivel-1.jpg" /></a>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-body m-10">
                            Criado com ❤️ por B7Web
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </section>
   <?php 
   require('./partials/footer.php')?>