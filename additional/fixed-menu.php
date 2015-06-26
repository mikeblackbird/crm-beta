<?$nameworker = $_SESSION['workerName'];
$idworker = $_SESSION['workerId'];
?>
<nav class="navbar navbar-default top-navbar" role="navigation">
<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="../index.php">CRM MV3</a>
</div>

<ul class="nav navbar-top-links navbar-right">
<li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
        <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
    </a>
    <ul class="dropdown-menu dropdown-messages">
        <li class="divider"></li>
        <li>
           <a href="#"><?echo "Новые задачи: ". $countUnreadTasks ?></a>
        </li>
        <li class="divider"></li>
    </ul>
    <!-- /.dropdown-messages -->
</li>
<!-- /.dropdown -->
<li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
        <i class="fa fa-tasks fa-fw"></i> <i class="fa fa-caret-down"></i>
    </a>
    <ul class="dropdown-menu dropdown-tasks">
        <li class="divider"></li>
        <li>
           <a href="new-task.php">Создание задачи</a>
        </li>
        <li class="divider"></li>


    </ul>
    <!-- /.dropdown-tasks -->
</li>
<!-- /.dropdown -->

<!-- /.dropdown -->
<li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
    </a>
    <ul class="dropdown-menu dropdown-user">
        <li><a href="#"><i class="fa fa-user fa-fw"></i> <?echo $nameworker;?></a>
        <li class="divider"></li>
        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Выйти</a>
        </li>
    </ul>
    <!-- /.dropdown-user -->
</li>
<!-- /.dropdown -->
</ul>
</nav>