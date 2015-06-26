<?require ('additional/header.php');
if (!empty($_GET['id'])){
require_once 'core/classes/crud.php';
    $dbObject = new crud('workers');
    $infoWorker = $dbObject->getWorker($_GET['id']);$infoWorker = $infoWorker[0];
    $tasksWorker = $dbObject->getTasksWorker( $_GET['id'] );$tasksWorker=$tasksWorker[0];
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
                    Профиль сотрудника<small><?echo $infoWorker['name']?></small>
                </h1>
            </div>
        </div>

        <!-- /. ROW  -->

        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Таблица задач сотрудника
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>Номер задачи</th>
                                    <th>Название задачи</th>
                                    <th>Приоритет</th>
                                </tr>
                                </thead>
                                <tbody>
                                <? for ($i=0;$i<count($tasksWorker);$i++){ ?>

                                        <tr class="odd gradeX">
                                        <td><?echo $tasksWorker[$i]['id']?></td>
                                        <td><a href="task.php?idTask=<?echo $tasksWorker[$i]['id']?>"><?echo $tasksWorker[$i]['name']?></a></td>
                                        <td><?echo $tasksWorker[$i]['priority']?></td>
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
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Изменение ревкизитов клиента </h4>
                </div>
                <div class="modal-body">
                    <form class="form-group" id="updateClient">
                        <input type="hidden" value="<?echo $infoClient['id']?>" name="idUpdate"/>
                        <label for="facename">Лицо: </label>
                        <input type="text"  class="form-control" name="facename" id="facename"/>
                        <label for="facename">ИНН: </label>
                        <input type="text"  class="form-control" name="INN" id="INN"/>
                        <label for="facename">Адрес: </label>
                        <input type="text"  class="form-control" name="address" id="address"/>
                        <label for="facename">КПП: </label>
                        <input type="text"  class="form-control" name="KPP" id="KPP"/>
                        <label for="facename">Наименование банка: </label>
                        <input type="text"  class="form-control" name="BankName" id="BankName"/>
                        <label for="facename">ОГРН: </label>
                        <input type="text"  class="form-control" name="OGRN" id="OGRN"/>
                        <label for="facename">БИК: </label>
                        <input type="text"  class="form-control" name="BIK" id="BIK"/>
                        <label for="facename">Р/С: </label>
                        <input type="text"  class="form-control" name="RS" id="RS"/>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" id="SaveAndClose">Сохранить</button>
                </div>
            </div>
        </div>
    </div>
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
<script>
    $('#SaveAndClose').click(function(){
        $.ajax({
            method:'post',
            url:'core/updateClient.php',
            data: $('#updateClient').serialize(),
            success: function(msg){
                alert('Информация обновлена');
                console.log(msg);
                window.location = 'my-clients.php';
            },
            error: function (msg){
                alert('Возникла ошибка при изменении информации');
                console.log(msg);
            }
        });
    });
</script>

</body>
</html>
<?}?>