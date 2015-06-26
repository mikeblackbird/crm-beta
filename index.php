<?require ('additional/header.php');
if (empty($_SESSION['workerName'])){
    require_once('login.php');
}else{
    require_once('core/classes/crud.php');
$workerId = $_SESSION['workerId'];
    $dbObject = new crud('tasks');
    $myTasks = $dbObject->getTasks($workerId);$myTasks = $myTasks[0];
    ?>
<body>
    <div id="wrapper">
       <?require_once 'additional/fixed-menu.php'?>
        <!--/. NAV TOP  -->
       <?require_once 'additional/fixed-sidebar.php'?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Рабочая панель <small></small>
                        </h1>
                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Мои задачи
                            </div>
                            <div class="col-md-2 col-lg-offset-10" style="font-size: 14px;color: #39C6F0;cursor: pointer">
                            </div>
                            <div class="panel-body">
                                <?if (count($myTasks) < 1){echo "<i> Обратитесь к менеджеру за новым задачами </i>";}?>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                        <tr>
                                            <th>Имя задачи</th>
                                            <th>Дедлайн</th>
                                            <th>Приоритет</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?for ($i=0;$i<count($myTasks);$i++){?>
                                            <tr class="odd gradeX">
                                             <td><a href="task.php?idTask=<?echo $myTasks[$i]['id']?>"><?echo $myTasks[$i]['name']?></a></td>
                                             <td><?echo $myTasks[$i]['finishdate']?></td>
                                             <td>
                                                 <?if    ($myTasks[$i]['priority'] == 0){
                                                    echo '<div style="color: black">'.$myTasks[$i]['status'].'</div>';
                                                 }elseif ($myTasks[$i]['priority'] == 1){
                                                    echo '<div style="color: green">'.$myTasks[$i]['status'].'</div>';
                                                 }else{
                                                     echo '<div style="color: red">'.$myTasks[$i]['status'].'</div>';
                                                 }

                                                 ?>
                                             </td>
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
            </div>

                <!-- /. ROW  -->
				<footer><p>All right reserved. Template by: <a href="http://webthemez.com">WebThemez</a></p></footer>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
	 
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- Morris Chart Js -->
    <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
	
	
	<script src="assets/js/easypiechart.js"></script>
	<script src="assets/js/easypiechart-data.js"></script>
	
	
    <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>

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

</body>

</html>
<?}?>