<?session_start();
	 if (!empty ($_POST)){
        print_r($_POST);
    }

if (!empty($_GET['idclient'])){
    require_once 'classes/crud.php';
    $idclient = $_GET['idclient'];
    $dbObject = new crud('workers');
    $projects = $dbObject->getAllProjects();$projects = $projects[0];
    $countProjects = $dbObject->getCountRows('projects');
    $workers  = $dbObject->getAllWorkers();$workers = $workers[0];
    $infoOfClient = $dbObject->getClient( $idclient );$infoOfClient = $infoOfClient[0];
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CRM - Создание проекта</title>
	<!-- Bootstrap Styles-->
    <link href="../assets/css/steps.css" rel="stylesheet" />

    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FontAwesome Styles-->
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
        <!-- Custom Styles-->
    <link href="../assets/css/custom-styles.css" rel="stylesheet" />
     <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <!-- Datepicker-->
    <link href="../assets/css/bootstrap-datepicker3.min.css" rel="stylesheet" />
    <style>
        .separator{
            height: 2px;
            background-color: #39C6F0;
        }
    </style>


</head>
<body>
    <div id="wrapper">
        <?require_once '../additional/fixed-menu.php' ?>
        <!--/. NAV TOP  -->
        <?require_once '../additional/fixed-sidebar.php' ?>
        <div id="page-wrapper" >
            <div id="page-inner">
			 <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                           Создание проекта<br /><small> Компания:<a href="../client.php?idclient=<?echo $idclient?>"><?echo $infoOfClient['firmname']?></a></small>
                        </h1>
                    </div>
                </div> 
                 <!-- /. ROW  -->
              <div class="row">
                <div class="col-lg-12">
                 <div class="panel panel-default">
                     <div class="panel-heading">
                         Детали нового проекта
                     </div>
                     <form role="form" method="post" id="project">
                     <div id="example-vertical" style="padding-top: 30px;padding-left: 10px;padding-bottom: 20px;">
                             <h3>Название проекта</h3>
                             <section data-step="0">
                                 <div class="panel-body">
                                     <div class="row">
                                         <div class="col-lg-10 col-md-offset-1">
                                             <div id="step1">
                                                 <div class="form-group">
                                                     <p style="padding-bottom: 30px;">Введите название проекта и нажмите "Открыть проект"</p>
                                                     <label>Название проекта</label>
                                                     <input class="form-control required" name="project_name" id="project_name"/>
                                                     <input type="hidden" value="<?echo $_GET['idclient']?>" name="idclient" />
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                             </section>
                             <h3>Задачи проекта</h3>

                         <section data-step="1">
                             <div class="panel-tasks">
                             <div class="col-lg-4">
                                 <div class="form-group">
                                         <label>Название задачи</label>
                                         <input class="form-control" name="name[]" id="task-name"/>
                                     </div>
                                 <div class="form-group">
                                     <label>Ответственный</label>
                                     <select class="form-control" name="worker[]" id="task-worker" >
                                     <?for ($i=0;$i<count($workers);$i++){?>
                                         <option value="<?echo $workers[$i]['id']?>"><?echo $workers[$i]['name']?></option>
                                     <?}?>
                                     </select>
                                 </div>
                                 <div class="form-group">
                                     <label for="task-summary">Стоимость задачи</label>
                                     <input class="form-control" name="summary[]" id="task-summary" />
                                 </div>
                                 <div class="form-group">
                                     <label>Сроки задачи</label>
                                     <div class="input-daterange input-group" id="datepicker">
                                         <input type="text" class="input-sm form-control" name="startdate[]"   />
                                         <span class="input-group-addon">-</span>
                                         <input type="text" class="input-sm form-control" name="finishdate[]" />
                                     </div>
                                 </div>
                                     <div class="form-group">
                                         <label>Описание задачи</label>
                                         <textarea class="form-control" name="description[]"> </textarea>
                                     </div>
                            </div>
                             <div class="col-lg-4">
                                 <div class="form-group">
                                     <label>Название задачи</label>
                                     <input class="form-control" name="name[]" id="task-name"/>
                                 </div>
                                 <div class="form-group">
                                     <label>Ответственный</label>
                                     <select class="form-control" name="worker[]" id="task-worker" >
                                         <?for ($i=0;$i<count($workers);$i++){?>
                                             <option value="<?echo $workers[$i]['id']?>"><?echo $workers[$i]['name']?></option>
                                         <?}?>
                                     </select>
                                 </div>
                                 <div class="form-group">
                                     <label for="task-summary">Стоимость задачи</label>
                                     <input class="form-control" name="summary[]" id="task-summary" />
                                 </div>
                                 <div class="form-group">
                                     <label>Сроки задачи</label>
                                     <div class="input-daterange input-group" id="datepicker">
                                         <input type="text" class="input-sm form-control" name="startdate[]"  />
                                         <span class="input-group-addon">-</span>
                                         <input type="text" class="input-sm form-control" name="finishdate[]" />
                                     </div>
                                 </div>
                                 <div class="form-group">
                                     <label>Описание задачи</label>
                                     <textarea class="form-control" name="description[]"> </textarea>
                                 </div>
                             </div>
                             <div class="col-lg-4">
                                 <div class="form-group">
                                     <label>Название задачи</label>
                                     <input class="form-control" name="name[]" id="task-name"/>
                                 </div>
                                 <div class="form-group">
                                     <label>Ответственный</label>
                                     <select class="form-control" name="worker[]" id="task-worker" >
                                         <?for ($i=0;$i<count($workers);$i++){?>
                                             <option value="<?echo $workers[$i]['id']?>"><?echo $workers[$i]['name']?></option>
                                         <?}?>
                                     </select>
                                 </div>
                                 <div class="form-group">
                                     <label for="task-summary">Стоимость задачи</label>
                                     <input class="form-control" name="summary[]" id="task-summary" />
                                 </div>
                                 <div class="form-group">
                                     <label>Сроки задачи</label>
                                     <div class="input-daterange input-group" id="datepicker">
                                         <input type="text" class="input-sm form-control" name="startdate[]"   />
                                         <span class="input-group-addon">-</span>
                                         <input type="text" class="input-sm form-control" name="finishdate[]" />
                                     </div>
                                 </div>
                                 <div class="form-group">
                                     <label>Описание задачи</label>
                                     <textarea class="form-control" name="description[]"> </textarea>
                                 </div>
                             </div>
                             </div>

                             </section>
                     </div>
                     </form>
                    </div>
                </div>
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
    <script src="../assets/js/jquery-1.10.2.js"></script>
      <!-- Bootstrap Js -->
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/jquery.steps.js"></script>
    <script src="../assets/js/jquery.validate.min.js"></script>
    <script src="../assets/js/messages_ru.js"></script>
        <script>
            var form = $('#project');
            form.validate({
                lang: 'ru'
            });
            form.find('#example-vertical').steps({
                headerTag: "h3",
                bodyTag: "section",
                transitionEffect: "slideLeft",
                onStepChanging: function (event, currentIndex, newIndex)
                {

                    form.validate().settings.ignore = ":disabled,:hidden";
                    return form.valid();

                },
                onFinishing: function (event, currentIndex)
                {
                    form.validate().settings.ignore = ":disabled";
                    return form.valid();
                },
                onFinished: function (event, currentIndex)
                {
                    var project_name = $('#project_name').val();
                    $.ajax({
                       method: 'post',
                        url: 'add_projectAjax.php',
                        data: $('#project').serialize(),
                        success: function(msg){
                            console.log(msg);
                            alert("Проект успешно создан!");
                            window.location = '../my-projects.php';
                        },
                        error: function(msg){
                            console.log(msg);
                        }
                    });


                },
                labels: {
                    cancel: "Отмена",
                    current: "current step:",
                    pagination: "Pagination",
                    finish: "Готово",
                    next: "Далее",
                    previous: "Назад",
                    loading: "Загрузка ..."
                }
            });


        </script>
    <!-- Metis Menu Js -->
    <script src="../assets/js/jquery.metisMenu.js"></script>
      <!-- Custom Js -->
    <script src="../assets/js/custom-scripts.js"></script>

    <!-- Datepicker Js -->
    <script type="text/javascript" src="../assets/js/bootstrap-datepicker.min.js"></script>
    <script src="../assets/js/bootstrap-datepicker.ru.min.js" charset="UTF-8"></script>
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
        $('#btn_projectOpen').click(function(e){
            e.preventDefault();
            project_name =  $('#project_name').val();
            idclient = <?echo $idclient ?>;
            idworker = <?echo $_SESSION['workerId'] ?>;
            $.ajax({
               method: 'post',
                url: 'add_projectAjax.php',
                data: {name: project_name, idworker: idworker, activity: 1, idclient: idclient},
                success: function(data){
                    $('#step1').html("<p>Проект успешно создан. Нажмите 'Далее'</p>");
                    $('#step1').append("<input type='hidden' value= <?echo $countProjects++?> />")
                },
                error: function(msg){
                    alert ("Возникла ошибка. Попробуйте снова или свяжитесь с администратором");
                   console.log(msg);
                }
            });
        });
    </script>
    <script>
    	$('.add-task').click(function(e){
            e.preventDefault();
            $('.content').height( $('.content').height() + 600);
            clonePanel = $('.panel-tasks:last').clone();
                $('.panel-tasks').after(clonePanel);
    	});
    </script>

</body>
</html>
