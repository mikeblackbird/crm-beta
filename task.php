<?require ('additional/header.php');
if(!empty($_GET['idTask'])){
$workerID = $_SESSION['workerId'];
require_once 'core/classes/crud.php';
$dbObject = new crud('tasks');
$task = $dbObject->getTask($_GET['idTask']);$task = $task[0];
$workers = $dbObject->getAllWorkers();$workers = $workers[0];
$comments = $dbObject->getCommentsTask($_GET['idTask']);$comments = $comments[0];
$conditionTask = $task['cond'];
$idfrom = $task['idfrom'];
    $accessToTask = $dbObject->checkAccessTask($_GET['idTask'], $workerID);
?>
<body>
    <div id="wrapper">
        <?require_once 'additional/fixed-menu.php'?>
        <!--/. NAV TOP  -->
        <?require_once 'additional/fixed-sidebar.php'?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
			 <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                          Страница задачи
                        </h1>
                    </div>
                </div> 
                 <!-- /. ROW  -->
               
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?if ($task['opened'] == 1){
                                echo "Задача открыта";
                            }else{
                                echo "Задача закрыта";
                            }?>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <table class="table-responsive table-bordered table-hover table">
                                 <tr>
                                     <td>Задача:</td><td> <?echo $task['name']?></td>
                                 </tr>
                                <tr>
                                   <td>Присвоил:</td><td> <?echo $task['fromTask']?></td>
                                </tr>
                                <tr>
                                    <td>Дедлайн:</td><td><?echo $task['finishdate']?></td>
                                </tr>
                                <tr>
                                    <td>Приоритет:</td><td> <?echo $task['status']?></td>
                                </tr>
                                <tr>
                                    <td>Описание:</td><td> <?echo $task['description']?></td>
                                </tr>
                                <tr>
                                    <td>Исполнитель:</td><td><?echo $task['toTask']?></td>
                                </tr>
                                    <tr>
                                        <td>Статус:</td><td><?echo $task['conditionName']?></td>
                                    </tr>
                                </table>
                                <div class="row">
                                    <? if ($task['opened'] == 1 && $accessToTask){?>

                                     <?if ($conditionTask == 1 ){?>
                                            <div class="col-md-5">
                                        <button class="btn btn-success" id="successTaskBtn">Выполнено</button>
                                        <button class="btn btn-warning" id="noSuccessTaskBtn">Не может быть выполнено</button>
                                            </div>
                                    <?}elseif ($conditionTask == 2 || $conditionTask == 3) {?>
                                     <div class="col-md-2 col-md-offset-1">
                                        <button class="btn btn-info" id="closeTaskBtn">Закрыть задачу</button>
                                     </div>
                                    <?}?>

                                    <div class="col-md-7">
                                        <form class="form-inline">
                                        <label>Перевести задачу на: </label>
                                        <select class="form-control" id="idworkerSelect">
                                            <?for ($i=0;$i<count($workers);$i++){?>
                                               <option value="<?echo $workers[$i]['id']?>"><?echo $workers[$i]['name']?></option>
                                            <?}?>
                                        </select>
                                        <div class="btn btn-danger" id="changeTaskToBtn">Перевести</div>
                                        </form>
                                    </div>
                                    <?} ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
                <div class="detailBox">
                    <div class="titleBox">
                        <label>Комментарии </label>
                    </div>
                    <div class="commentBox">

                        <p class="taskDescription">Комментарии к задаче "<?echo $task['name']?>"</p>
                    </div>
                    <div class="actionBox">
                        <ul class="commentList">
                            <?for ($i=0;$i<count($comments);$i++){?>
                                <li>
                                    <div class="commenterImage">
                                        <?echo $comments[$i]['author']?>
                                    </div>
                                    <div class="commentText">
                                       <?echo $comments[$i]['text']?>

                                    </div>
                                </li>
                            <?}?>
                        </ul>
                        <form class="form-inline" role="form" id="formAddCommentToTask">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" style="width:100%">
                                        <textarea class="form-control" type="text" placeholder="Ваш комментарий" name="commentText" id="commentText" rows="5"></textarea>
                                        <input type="hidden" value="<?echo $_GET['idTask']?>" name="idTask" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="btn btn-info" id="addCommentToTaskBtn" style="margin-top:6px;"> Добавить</div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- /. ROW  -->
            
                <!-- /. ROW  -->
            
                <!-- /. ROW  -->
            
                <!-- /. ROW  -->
        </div>
               <footer><p>Все права защищены. Компания <a href="http://www.mvkybe.ru"> "М в кубе" </a></p></footer>
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
     <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script>
        $('#addCommentToTaskBtn').click(function(e){
            e.preventDefault();
            if ( $('#commentText').val() !== '' ){
                $.ajax({
                  method: 'post',
                    url: 'core/addCommentToTask.php',
                    data: $('#formAddCommentToTask').serialize(),
                    success: function(){
                            window.location = 'task.php?idTask=<?echo $_GET['idTask']?>';
                            $('#commentText').val('');
                    },
                    error: function(msg){
                        console.log(msg);
                    }
                });
            }else{
                alert ('Текст комментария не может быть пустым');
                $('#commentText').focus();
            }
        });
    </script>
    <script>
        $(document).ready(function(){
        $('#closeTaskBtn').click(function(){
            if (confirm('Уверены что хотите завершить эту задачу ?')){
                $.ajax({
                   method: 'post',
                    url: 'core/closeTask.php',
                    data: {idTask: <?echo $_GET['idTask']?>},
                    success: function(msg){
                        console.log(msg);
                        window.location = "task.php?idTask=<?echo $_GET['idTask']?>";
                    },
                    error: function(msg){
                        console.log(msg);
                    }
                });
            }
        });

        $('#successTaskBtn').click(function(){
            $.ajax({
              method: 'post',
                url: 'core/successTask.php',
                data: {idTask: <?echo $_GET['idTask']?>, idfrom: <?echo $idfrom?>},
                success: function(msg){
                    window.location = 'task.php?idTask='+<?echo $_GET['idTask']?>;
                    console.log(msg);
                },
                error: function(msg){
                    console.log(msg);
                }
            });
        });
         $('#noSuccessTaskBtn').click(function(){
             $.ajax({
                 method: 'post',
                 url: 'core/noSuccessTask.php',
                 data: {idTask: <?echo $_GET['idTask']?>, idfrom: <?echo $idfrom?>},
                 success: function(msg){
                     window.location = 'task.php?idTask='+<?echo $_GET['idTask']?>;
                     console.log(msg);
                 },
                 error: function(msg){
                     console.log(msg);
                 }
             });
         });

        $('#changeTaskToBtn').click(function(){
            idworker = $('#idworkerSelect').val();
            $.ajax({
               method: 'post',
                url: 'core/changeTaskTo.php',
                data: {idTask: <?echo $_GET['idTask']?>, idworker: idworker},
                success: function(msg){
                    window.location = 'task.php?idTask='+<?echo $_GET['idTask']?>;
                    console.log(msg);
                },
                error: function(msg){
                    console.log(msg);
                }
            });
        });
        });
    </script>

        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable({
                     "language": {
                        
                          "processing": "Подождите...",
                          "search": "Поиск:",
                          "lengthMenu": "Показать _MENU_ записей",
                          "info": "Записи с _START_ до _END_ из _TOTAL_",
                          "infoEmpty": "Записи с 0 до 0 из 0 записей",
                          "infoFiltered": "(отфильтровано из _MAX_ записей)",
                          "infoPostFix": "",
                          "loadingRecords": "Загрузка записей...",
                          "zeroRecords": "Записи отсутствуют.",
                          "emptyTable:": "В таблице отсутствуют данные",
                          "paginate": {
                            "first": "Первая",
                            "previous": "Предыдущая",
                            "next": "Следующая",
                            "last": "Последняя"
                          },
                          "aria": {
                            "sortAscending": ": активировать для сортировки столбца по возрастанию",
                            "sortDescending": ": активировать для сортировки столбца по убыванию"
                          }
                        
                    }
                });
            });
    </script>
         <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>
    
   
</body>
</html>
<?}?>