<?php

require_once 'config.php';
require_once 'src/models/Article.php';
require_once 'src/tools/functions.php';


/**
 * Class DB_cni
 */
class DB_cni {

    function login()
    {
/*        if ( isset( $_POST['login'] ) ) {

            if ( $_POST['username'] == ADMIN_USERNAME && $_POST['password'] == ADMIN_PASSWORD ) {
                $_SESSION['username'] = ADMIN_USERNAME;
                header( "Location: http://" . $_SERVER['HTTP_HOST'] );

            } else {
                $login_error = "Incorrect username or password. Please try again.";
                login_page($login_error);

            }

        } else {

            // User has not posted the login form yet: display the form
            login_page(null);
        }*/

        if(isset($_POST['login'])){
            $username = $_POST["username"];
            $password = $_POST["password"];

            $sql = "SELECT id,username,password FROM users WHERE username =:username AND password =:password";
            $st = $this->db_info()->prepare( $sql );
            $st ->bindParam(':username',$username);
            $st ->bindParam(':password', $password);
            $st->execute();
            /*$results = $st->fetch();*/
            if($st->rowCount() == 1 ){
                $_SESSION['username'] = $username;
                header( "Location: http://" . $_SERVER['HTTP_HOST'] );


            }else{
                $login_error = "Incorrect username or password. Please try again.";
                login_page($login_error);

            }
        }else {

            // User has not posted the login form yet: display the form
            login_page(null);
        }

    }

    /**
     * @return PDO
     */
    protected function db_info()
    {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        return $conn;

    }

    function logout()
    {
        unset( $_SESSION['username'] );
        session_destroy();
        header( "Location: http://" . $_SERVER['HTTP_HOST'] );

    }

    /**
     * @param $id
     */
    function show_one($id)
    {
        $sql = "SELECT *, UNIX_TIMESTAMP(publicationDate) AS publicationDate FROM articles WHERE id = :id";
        $st = $this->db_info()->prepare( $sql );
        $st->bindValue( ":id", $id, PDO::PARAM_INT );
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        $article = new Article($row);
        single_post($article);

    }

    /**
     *
     */
    function show_all()
    {
        $sql = "SELECT * FROM articles";
        $i = 0;
        foreach ($this->db_info()->query($sql) as $row) {
            $articles[$i] = new Article($row);
            ++$i;
        }
        home_posts($articles);
    }

    /**
     * @param $id
     */
    function edit($id)
    {
        if(!$id){
            $this->new();
        }

        else {
            $sql = "SELECT *, UNIX_TIMESTAMP(publicationDate) AS publicationDate FROM articles WHERE id = :id";
            $st = $this->db_info()->prepare($sql);
            $st->bindValue(":id", $id, PDO::PARAM_INT);
            $st->execute();
            $row = $st->fetch();

            $article = new Article($row);
            edit_post($article);

            if (isset($_POST['saveChanges'])) {
                $this->save($article->getFileToUpload());
                header( "Location: " . $_SERVER['REQUEST_URI'] );

            }

            if (isset($_POST['delete'])) {
                $this->delete($article->getId());
            }
        }
    }

    /**
     *
     */
    protected function new()
    {
        edit_post(null);
        if ( isset( $_POST['saveChanges'] ) ) {

            $publicationDate = explode('-', $_POST['publicationDate']);
            list ($y, $m, $d) = $publicationDate;
            $publicationDate = mktime(0, 0, 0, $m, $d, $y);

            $sql = "INSERT INTO articles ( publicationDate, title, summary, content, fileToUpload ) VALUES ( FROM_UNIXTIME(:publicationDate), :title, :summary, :content, :fileToUpload )";
            $st = $this->db_info()->prepare($sql);
            $st->bindValue(":publicationDate", $publicationDate, PDO::PARAM_INT);
            $st->bindValue(":title", $_POST['title'], PDO::PARAM_STR);
            $st->bindValue(":summary", $_POST['summary'], PDO::PARAM_STR);
            $st->bindValue(":content", $_POST['content'], PDO::PARAM_STR);
            $st->bindValue(":fileToUpload", $_FILES['fileToUpload']['name'], PDO::PARAM_STR);
            $st->execute();

        }
    }

    /**
     * @param $img
     */
    protected function save($img)
    {
        $publicationDate = explode('-', $_POST['publicationDate']);
        list ($y, $m, $d) = $publicationDate;
        $publicationDate = mktime(0, 0, 0, $m, $d, $y);

        $sql = "UPDATE articles SET publicationDate=FROM_UNIXTIME(:publicationDate), title=:title, summary=:summary, content=:content, fileToUpload=:fileToUpload WHERE id =:id";
        $st = $this->db_info()->prepare($sql);
        $st->bindValue(":publicationDate", $publicationDate, PDO::PARAM_INT);
        $st->bindValue(":title", $_POST['title'], PDO::PARAM_STR);
        $st->bindValue(":summary", $_POST['summary'], PDO::PARAM_STR);
        $st->bindValue(":content", $_POST['content'], PDO::PARAM_STR);
        if($_FILES['fileToUpload']["name"]){
            $st->bindValue( ":fileToUpload", $_FILES['fileToUpload']['name'], PDO::PARAM_STR );
            $target_dir = "images/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        } else {
            $st->bindValue( ":fileToUpload", $img, PDO::PARAM_STR );
        }
        $st->bindValue(":id", $_POST['articleId'], PDO::PARAM_INT);
        $st->execute();
        $conn = null;
        edit_post($st);

    }

    /**
     * @param $id
     */
    protected function delete($id)
    {
        $st = $this->db_info()->prepare ( "DELETE FROM articles WHERE id = :id LIMIT 1" );
        $st->bindValue( ":id", $id, PDO::PARAM_INT );
        $st->execute();
        $conn = null;
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $sql = "SELECT * FROM articles";
        $i = 0;
        foreach ($conn->query($sql) as $row) {
            $articles[$i] = new Article($row);
            ++$i;
        }
        home_posts($articles);
    }

}
