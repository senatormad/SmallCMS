<?php
require_once 'src/tools/DB_cni.php';
require_once 'templates/header.php';
require_once 'templates/homepage.php';


$action = new DB_cni();
if($_SERVER['QUERY_STRING']){
    $case = $_SERVER['QUERY_STRING'][0];
} else { $case = null; }

session_start();
if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    echo '<h3>' . $_SESSION['username'] . '</h3>';
    echo '<a href="/?o">Logout</a>';
    echo '<br><br>';
    echo '<a href="/?e=">Add new post</a>';
    echo '<br><br>';


} else {
    echo '<a href="/?l">Login</a>';

}


switch ($case) {
    case 'p':
        $action->show_one($_GET['p']);
        break;

    case 'e':
        $action->edit($_GET['e']);
        break;

    case 'l':
        $action->login();
        break;

    case 'o':
        $action->logout();
        break;

    default:
        $action->show_all();
        break;

}

require_once 'templates/footer.php';