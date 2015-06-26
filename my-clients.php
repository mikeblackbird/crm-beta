<?require ('additional/header.php');
$idworker = $_SESSION['workerId'];
require_once 'core/classes/crud.php';
$dbObject = new crud('clients');
$clients = $dbObject->MyActivityRead($idworker);$clients = $clients[0];
//echo "<pre>"; var_dump($clients);echo "</pre>";
?>
<body>
<div id="wrapper">
    <?require_once 'additional/fixed-menu.php'?><!--/. NAV TOP  -->
    <?require_once 'additional/fixed-sidebar.php'?>
<!--  NAV SIDE  -->
<div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">
                    Мои клиенты
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
                                    <!--<th>Открыть проект</th>-->
                                </tr>
                                </thead>
                                <tbody>
                                <? for ($i=0;$i<count($clients);$i++){ ?>
                                    <tr class="odd gradeX" id="<?echo $clients[$i]['id']?>">
                                        <td><a href="client.php?id=<?echo $clients[$i]['id']?>"><?echo $clients[$i]['firmname']?></a></td>
                                        <td><?echo $clients[$i]['facename']?></td>
                                        <td><?echo $clients[$i]['phone']?></td>
                                        <td><?echo $clients[$i]['email']?></td>
                                        <td data-toggle="modal" data-target="#myModal" class="addcomment"><?echo $clients[$i]['comment']?></td>
                                        <!--<td style="text-align: center; cursor: pointer;" class="addproject"><a href="core/add_project.php?idclient=<?echo $clients[$i]['id']?> "><i class="fa fa-plus-circle"></i></a></td>-->
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
                    <h4 class="modal-title" id="myModalLabel">Изменение статуса клиента </h4>
                </div>
                <div class="modal-body">
                    <form class="form-group">
                        <input type="text"  class="form-control" name="comment" id="formCommentValue"/>
                        <input type="hidden" value="" id="hiddenIdClient"/>
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
    $('.activity').click(function(){
        idclient = $(this).next('.idclient').val();
        idworker = <?echo $_SESSION['workerId']?>;
        if (confirm("Перевести этого клиента на себя ?")){
            $.ajax({
                method: "POST",
                url: "core/relation_mc.php",
                data: {idclient: idclient, idworker: idworker},
                success: function(msg){
                    alert( msg );
                }
            });
        }
    });
</script>
<script>
    $('#myModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget).parent('tr').attr('id'); // ID Client's
        var modal = $(this);
        var oldText = $(event.relatedTarget).text();
        console.log(oldText);
        modal.find('#hiddenIdClient').val(button);
        modal.find('#formCommentValue').val(oldText);

    });
    $('#SaveAndClose').click(function(){
        idClient = $('#hiddenIdClient').val();
        commentText = $('#formCommentValue');
            $.ajax({
                method: 'post',
                url: "core/changeStatusClient.php",
                data: {idClient: idClient, commentText: commentText.val() },
                success: function (msg){
                    commentText.val('');
                    location.href = 'my-clients.php';
                }
            });

        $('#myModal').modal('hide');

    });
</script>
</body>
</html>
