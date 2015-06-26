<?
if (!empty($_POST['idClient']) && !empty($_POST['commentText'])){
    $idClient = $_POST['idClient'];
    $commentText = $_POST['commentText'];
    require_once 'classes/crud.php';
    $dbObject = new crud('clients');
    $dbObject->setCommentClient($idClient, $commentText);
}
