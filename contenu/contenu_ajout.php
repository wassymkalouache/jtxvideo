 <?php
 if (!isset($_SESSION['loggedIn'])) {
     header('Location:index.php?page=erreur&error=forbidden');
     exit();
 }
 ?>
<div class="container-fluid">
    <div id='arborescenceserveur' style="width: 200px;
				height: 400px;
				border-top: solid 1px #BBB;
				border-left: solid 1px #BBB;
				border-bottom: solid 1px #FFF;
				border-right: solid 1px #FFF;
				background: #FFF;
				overflow: scroll;
				padding: 5px;"></div>
</div>