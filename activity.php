<?require ('additional/header.php');
$idworker = $_SESSION['workerId'];
$nameworker = $_SESSION['workerName'];
require_once 'core/classes/crud.php';
$dbObject = new crud('clients');
$clients = $dbObject->activityRead();$clients = $clients[0];
?>
<body>
<div id="wrapper">
<?require_once 'additional/fixed-menu.php';?>
<!--/. NAV TOP  -->
<?require_once 'additional/fixed-sidebar.php'?>
<!-- /. NAV SIDE  -->
<div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">
                    Активные клиенты
                </h1>
            </div>
        </div>
        <!-- /. ROW  -->

        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Таблица клиентов
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>Организация</th>
                                    <th>Контактное лицо</th>
                                    <th>Телефон</th>
                                    <th>Email</th>
                                    <th>Коментарий</th>
                                    <th>Ответственный</th>
                                </tr>
                                </thead>
                                <tbody>
                                <? for ($i=0;$i<count($clients);$i++){ ?>
                                    <tr class="odd gradeX">
                                        <td> <a href="client.php?id=<?echo $clients[$i]['id']?>"> <?echo $clients[$i]['firmname']?></a></td>
                                        <td><?echo $clients[$i]['facename']?></td>
                                        <td><?echo $clients[$i]['phone']?></td>
                                        <td><?echo $clients[$i]['email']?></td>
                                        <td><?echo $clients[$i]['comment']?></td>
                                        <td><?echo $clients[$i]['worker']?></td>
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
