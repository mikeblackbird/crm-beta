<?require ('additional/header.php');
$workerId = $_SESSION['workerId'];

    require_once 'core/classes/crud.php';
    
    $dbObject = new crud('workers');

    $managers  = $dbObject->managersRead();$managers = $managers[0];

    //$dbObject->create();

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
                            Добавление нового клиента
                        </h1>
                    </div>
                </div> 
                 <!-- /. ROW  -->
              <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Информация нового клиента
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form" method="post" id="addClient">
                                        <div class="form-group">
                                            <label>Название компании</label>
                                            <input class="form-control" name="firmname"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Контактное лицо</label>
                                            <input class="form-control" name="facename" />
                                        </div>
                                        <div class="form-group">
                                            <label>Телефон</label>
                                            <input class="form-control" name="phone" />
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control" name="email" />
                                        </div>
                                        <div class="form-group">
                                            <label>Комментарий</label>
                                            <input class="form-control" name="comment" />
                                        </div>
                                        <div style="margin-top: 20px;"></div>

                                        <div id="toggleDetails" style="cursor: pointer;text-decoration: underline;color:#000;font-size:22px">Реквизиты</div>
                                        <div id="details" style="display:none">
                                        <div style="margin-top: 20px;"></div>
                                            <div class="form-group">
                                                <label>ИНН</label>
                                                <input class="form-control" name="INN" />
                                            </div>
                                            <div class="form-group">
                                                <label>Адрес</label>
                                                <input class="form-control" name="address" />
                                            </div>
                                            <div class="form-group">
                                                <label>КПП</label>
                                                <input class="form-control" name="KPP" />
                                            </div>
                                            <div class="form-group">
                                                <label>Имя банка</label>
                                                <input class="form-control" name="BankName" />
                                            </div>
                                            <div class="form-group">
                                                <label>ОГРН</label>
                                                <input class="form-control" name="OGRN" />
                                            </div>
                                            <div class="form-group">
                                                <label>БИК</label>
                                                <input class="form-control" name="BIK" />
                                            </div>
                                            <div class="form-group">
                                                <label>Р/С</label>
                                                <input class="form-control" name="RS" />
                                            </div>
                                        </div>
                                        <div id="btnAddClient" class="btn btn-success pull-right">Добавить</div>
                                    </form>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
			<footer><p>Все права защищены. Компания "М в кубе"</p></footer>
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
      <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>

    <!-- Datepicker Js -->
    <script type="text/javascript" src="assets/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/js/bootstrap-datepicker.ru.min.js" charset="UTF-8"></script>
        <script>
                $('#toggleDetails').click(function(){
                $('#details').toggle('fast');
            });

            $('#btnAddClient').click(function(){
                $.ajax({
                    method:'post',
                    url:'core/addClient.php',
                    data: $('#addClient').serialize(),
                    success: function(msg){
                        alert('Клиент успешно создана');
                        console.log(msg);
                        window.location = 'my-clients.php';
                    },
                    error: function (msg){
                        alert('Возникла ошибка при добавлении клиента');
                        console.log(msg);
                    }
                });
            });
            </script>
   
</body>
</html>
