<?require ('additional/header.php');
$workerID = $_SESSION['workerId'];
require_once 'core/classes/crud.php';
$dbObject = new crud('tasks');
$tasks = $dbObject->getAllTasks();$tasks = $tasks[0];
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
                          Задачи
                        </h1>
                    </div>
                </div> 
                 <!-- /. ROW  -->
               
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                         <div class="row">
                            <div class="col-md-12">
                             <div class="col-md-10">Таблица задач</div><div class="col-md-2"><a href="new-task.php"><button class="btn btn-primary">Создать задачу</button></a></div>
                         </div>
                         </div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Имя задачи</th>
                                            <th>Дедлайн</th>
                                            <th>Статус</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <? for ($i=0;$i<count($tasks);$i++){ ?>
                                            <tr class="odd gradeX">
                                                <td><a href="task.php?idTask=<?echo $tasks[$i]['id']?>"><?echo $tasks[$i]['name']?></a></td>
                                                <td><?echo $tasks[$i]['startdate']?></td>
                                                <td><?echo $tasks[$i]['cond']?></td>
                                            </tr>
                                        <?}?>
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
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
