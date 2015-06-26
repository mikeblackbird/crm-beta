<?session_start();
if ( !empty($_POST['password']) ){
    require_once 'core/classes/crud.php';

    $password = $_POST['password'];
    $login    = $_POST['login'];
    $dbObject = new crud( 'workers' );
    if ($userdata  = $dbObject->auth( $login, $password ) ){
        $_SESSION['workerName'] = $userdata['0']['name'];
        $_SESSION['workerId'] =   $userdata['0']['id'];
        header('Location: index.php');
    }
}else{?>
<link rel="stylesheet" href="assets/css/styles.css" />
<link rel="stylesheet" href="assets/css/animate.css" />
<div id="container">
    <form method="post">
        <label for="name">Логин:</label>

        <input type="name" name="login">

        <label for="username">Пароль:</label>



        <input type="password" name="password">

        <div id="lower">



            <input type="submit" value="Войти">

        </div>
    </form>
</div>
<?}?>