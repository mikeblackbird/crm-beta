<?require ('additional/header.php');
if (empty($_SESSION['workerName'])){
    require_once('login.php');
}else{$workerID = $_SESSION['workerId'];
require_once 'core/classes/crud.php';
$dbObject = new crud('project');
$projects = $dbObject->getMyProjects($workerID);$projects = $projects[0];
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
                            Мои проекты
                        </h1>
                    </div>
                </div> 
                 <!-- /. ROW  -->
               
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Таблица проектов. <?echo $_SESSION['workerName']?>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Номер проекта</th>
                                            <th>Имя проекта</th>
                                            <th>Клиент</th>
                                            <th>Активность проекта</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <? for ($i=0;$i<count($projects);$i++){ ?>
                                            <tr class="odd gradeX">
                                                <td><?echo $projects[$i]['id']?></td>
                                                <td><a href="project.php?id=<?echo $projects[$i]['id']?>"><?echo $projects[$i]['name']?></a></td>
                                                <td><?echo $projects[$i]['firmname']?></td>
                                                <td><?echo $projects[$i]['activity']?></td>
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
<?}?>