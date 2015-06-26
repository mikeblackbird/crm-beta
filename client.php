<?require ('additional/header.php');
if (!empty($_GET['id'])){
require_once 'core/classes/crud.php';
    $dbObject = new crud('clients');
    $infoClient = $dbObject->getClient($_GET['id']);$infoClient = $infoClient[0];
    $managers = $dbObject->managersRead();$managers = $managers[0];
?>
<body xmlns="http://www.w3.org/1999/html">
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
                    Страница клиента<small><?echo $infoClient['firmname']?></small>
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-4">
                    <div class="col-md-12">
                      Реквизиты
                        <div class="pull-right" data-toggle="modal" data-target="#myModal" title="Изменение данных клиента"  id="editInfoClient"><i style="font-size: 20px;cursor: pointer; color: #39C6F0" class="fa fa-cog"></i></div>
                        <div class="pull-right" data-toggle="modal" data-target="#myModal2" title="Перенаправление клиента" id="editManagerClient"><i style="font-size: 20px;cursor: pointer; color: #39C6F0;margin-right: 30px;" class="fa fa-arrows-h"></i></div>
                    </div>
                    <div class="panel-body">
                        <div class="pull-left">

                            <table class="table table-bordered table-responsive">
                            <tr>
                                <th>Компания</th>
                                <th>Телефон</th>
                                <th>Email</th>
                                <th>Коментарий</th>
                                <th>Активность</th>
                                <th>Менеджер</th>
                                <th>Лицо</th>
                            </tr>
                                <tr>
                                <td><?echo $infoClient['firmname']?> </td>
                                <td><?echo $infoClient['phone']?>    </td>
                                <td><?echo $infoClient['email']?>    </td>
                                <td><?echo $infoClient['comment']?>  </td>
                                <td><?echo $infoClient['activity']?> </td>
                                <td><?echo $infoClient['name']?>     </td>
                                <td><?echo $infoClient['facename']?> </td>
                            </tr>

                            <tr>
                                <th>ИНН</th>
                                <th>Адрес</th>
                                <th>КПП</th>
                                <th>Наименование Банка</th>
                                <th>ОГРН</th>
                                <th>БИК</th>
                                <th>Счет</th>
                            </tr>
                            <tr>
                                <td> <?echo $infoClient['INN']?>     </td>
                                <td> <?echo $infoClient['address']?> </td>
                                <td> <?echo $infoClient['KPP']?>     </td>
                                <td> <?echo $infoClient['BankName']?></td>
                                <td> <?echo $infoClient['OGRN']?>    </td>
                                <td> <?echo $infoClient['BIK']?>     </td>
                                <td> <?echo $infoClient['RS']?>      </td>
                            </tr>   
                            </table>
                          
                        </div>
                    </div>


            </div>

        </div>
        <!-- /. ROW  -->

        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Таблица заказов
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>Номер заказа</th>
                                    <th>Название заказа</th>
                                    <th>Активность</th>
                                </tr>
                                </thead>
                                <tbody>
                                <? for ($i=0;$i<count($projects);$i++){ ?>
                                    <tr class="odd gradeX">
                                        <td><?echo $projects[$i]['project']?></td>
                                        <td><?echo $projects[$i]['name']?></td>
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
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Изменение ревкизитов клиента </h4>
                </div>
                <div class="modal-body">
                    <form class="form-group" id="updateClient">
                        <div class="col-md-6">
                            <label for="firmname">Организация: </label>
                            <input type="text"  class="form-control" name="firmname" id="firmname" value="<?echo $infoClient['firmname']?>" />
                            <label for="phone">Телефон: </label>
                            <input type="text"  class="form-control" name="phone" id="phone" value="<?echo $infoClient['phone']?>" />
                            <label for="email">Email: </label>
                            <input type="text"  class="form-control" name="email" id="email" value="<?echo $infoClient['email']?>" />
                            <label for="comment">Комментарий: </label>
                            <input type="text"  class="form-control" name="comment" id="comment" value="<?echo $infoClient['comment']?>" />
                        </div>
                        <div class="col-md-6">
                            <input type="hidden" value="<?echo $infoClient['id']?>" name="idUpdate"/>
                            <label for="facename">Лицо: </label>
                            <input type="text"  class="form-control" name="facename" id="facename" value="<?echo $infoClient['facename']?>""/>
                            <label for="facename">ИНН: </label>
                            <input type="text"  class="form-control" name="INN" id="INN" value="<?echo $infoClient['INN']?>"/>
                            <label for="facename">Адрес: </label>
                            <input type="text"  class="form-control" name="address" id="address" value="<?echo $infoClient['address']?>"/>
                            <label for="facename">КПП: </label>
                            <input type="text"  class="form-control" name="KPP" id="KPP" value="<?echo $infoClient['KPP']?>"/>
                            <label for="facename">Наименование банка: </label>
                            <input type="text"  class="form-control" name="BankName" id="BankName" value="<?echo $infoClient['BankName']?>"/>
                            <label for="facename">ОГРН: </label>
                            <input type="text"  class="form-control" name="OGRN" id="OGRN" value="<?echo $infoClient['OGRN']?>"/>
                            <label for="facename">БИК: </label>
                            <input type="text"  class="form-control" name="BIK" id="BIK" value="<?echo $infoClient['BIK']?>"/>
                            <label for="facename">Р/С: </label>
                            <input type="text"  class="form-control" name="RS" id="RS" value="<?echo $infoClient['RS']?>"/>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" id="SaveAndClose">Сохранить</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Изменение сопровождающего</h4>
                </div>
                <div class="modal-body">
                    <form class="form-group" id="updateManagerClient">
                        <div class="col-md-12">
                               <select class="form-control" name="idmanager">
                                   <?for ($i=0;$i<count($managers);$i++){?>
                                        <option value="<?echo $managers[$i]['id']?>"><?echo $managers[$i]['name']?></option>
                                   <?}?>
                               </select>
                            <input type="hidden" value="<?echo $infoClient['id']?>" name="idUpdate"/>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" id="SaveAndClose2">Сохранить</button>
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

<script>
    $('#SaveAndClose2').click(function(){
        $.ajax({
            method:'post',
            url:'core/updateManagerClient.php',
            data: $('#updateManagerClient').serialize(),
            success: function(msg){
                alert('Сопровождающий изменен');
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