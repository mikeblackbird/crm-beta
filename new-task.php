<?require ('additional/header.php');
$workerId = $_SESSION['workerId'];

    require_once 'core/classes/crud.php';
    
    $dbObject = new crud('workers');
    $projects = $dbObject->getAllProjects();$projects = $projects[0];
    $workers  = $dbObject->getAllWorkers();$workers = $workers[0];

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
                            Создание новой задачи
                        </h1>
                    </div>
                </div> 
                 <!-- /. ROW  -->
              <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Детали новой задачи
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form" method="post" id="creatTaskForm">
                                        <div class="form-group">
                                            <label>Название задачи</label>
                                            <input class="form-control" name="name"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Сроки задачи</label>
                                            <div class="input-daterange input-group" id="datepicker">
                                                <input type="text" class="input-sm form-control" name="startdate" />
                                                <span class="input-group-addon">-</span>
                                                <input type="text" class="input-sm form-control" name="finishdate" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Ответственный</label>
                                            <select class="form-control" name="idworker">
                                                <?for ($i=0;$i<count($workers);$i++){ ?>
                                                <option value="<?echo $workers[$i]['id']?>"><?echo $workers[$i]['name']?></option>
                                                <?}?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Приоритет задачи</label>
                                            <select class="form-control" name="status">
                                                    <option value="0">Низкий</option>
                                                    <option value="1">Средний</option>
                                                    <option value="2">Высокий</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Описание задачи</label>
                                            <textarea class="form-control" name="description" rows="10"></textarea>
                                        </div>
                                        <input type="hidden" value="create" name="create" />
                                        <div class="form-group">
                                            <button class="btn btn-success" id="createTaskBtn">Создать задачу</button>
                                        </div>
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
        $('.input-daterange').datepicker({
            format: "yyyy-mm-dd",
            weekStart: 1,
            todayBtn: "linked",
            clearBtn: true,
            language: "ru",
            orientation: "bottom right"
        });
    </script>
        <script>
            $('#createTaskBtn').click(function(e){
                e.preventDefault();
                $.ajax({
                   method:'post',
                   url:'core/createTask.php',
                   data: $('#creatTaskForm').serialize(),
                    success: function(msg){
                        alert('Задача успешно создана');
                        console.log(msg);
                        window.location = 'new-task.php';
                    },
                    error: function (msg){
                        alert('Возникла ошибка при создании задачи');
                        console.log(msg);
                    }
                });
            });
            </script>
   
</body>
</html>
