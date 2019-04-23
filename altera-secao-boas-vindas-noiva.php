<?php 
require_once 'logica-usuario.php';
verificaUsuario(); verificaAdmin();
require_once 'conecta.php';
require_once 'banco-meusite.php';
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    
      <?php 

      $noiva_nome = $_POST["noiva_nome"];
      $noiva_desc = $_POST["noiva_desc"];

      if($_FILES['noiva_img']['name'] != "") {
        $extensao = strtolower(substr($_FILES['noiva_img']['name'], -4)); //pega a extensao do arquivo
        $noiva_img = md5('noiva_img') . $extensao; //define o nome do arquivo
        $diretorio = "upload/"; //define o diretorio para onde enviaremos o arquivo
        move_uploaded_file($_FILES['noiva_img']['tmp_name'], $diretorio.$noiva_img); //efetua o upload
      } else {
        $noiva_img = $_POST['noiva_img_anterior'];
      }

      if(alteraBoasVindasNoiva($conexao,
        $noiva_nome,
        $noiva_desc,
        $noiva_img
      ))
      {
        header ("Location: personalizar-secao-boas-vindas-noiva?alteracao=true");
        die();
      }else{ 
      ?>
        <h1>Algo deu errado:</h1>
        <?php
          printf("Connect failed: %s\n", mysqli_error($conexao));
        exit();
      }
      ?>

    </section>
    <!-- /.content -->
  </div>