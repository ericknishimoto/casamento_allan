<?php
require_once 'logica-usuario.php';
verificaUsuario(); verificaAdmin();
require_once 'header.php';
require_once 'conecta.php';
require_once 'banco.php';

$usuarios = listaUsuarios($conexao);

?>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Usuários
        <small>cadastro de usuários</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li>Cadastros</li>
        <li class="active">Usuários</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

<?php if(isset($_GET["cadastro"]) && $_GET["cadastro"]==true) {
?>
    <div class="row">
      <div class="col-xs-8">
      <div class="box box-success box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Cadastrado</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            O usuário foi cadastrada com sucesso!
            </div>
            <!-- /.box-body -->
          </div>
      </div>
    </div>
<?php
  }
?>

<?php if(isset($_GET["alteracao"]) && $_GET["alteracao"]==true) {
?>
    <div class="row">
      <div class="col-xs-8">
      <div class="box box-success box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Alterado</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            O usuário foi alterado com sucesso!
            </div>
            <!-- /.box-body -->
          </div>
      </div>
    </div>
<?php
  }
?>

<?php if(isset($_GET["exclusao"]) && $_GET["exclusao"]==true) {
?>
    <div class="row">
      <div class="col-xs-8">
      <div class="box box-success  box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Excluído</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            O usuário foi excluído com sucesso!
            </div>
            <!-- /.box-body -->
          </div>
      </div>
    </div>
<?php
  }
?>

<?php if(isset($_GET["senha"]) && $_GET["senha"]==true) {
  ?>
      <div class="row">
        <div class="col-xs-8">
        <div class="box box-danger  box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">ALERTA</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
                <!-- /.box-tools -->
              </div>
              <!-- /.box-header -->
              <div class="box-body">
              Senhas não conferem, tente novamente.
              </div>
              <!-- /.box-body -->
            </div>
        </div>
      </div>
  <?php
    }
  ?>

      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Todos usuários:</h3>
            </div>
            <!-- /.box-header -->
            <!-- TABLE -->
            <div class="box-body table-responsive">
              <table id="tabela" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                 <th>ID</th>
                  <th>Nome</th>
                  <th>Email</th>
                  <th>Permissão</th>
                  <th class="text-center">Ações</th>
                </tr>
                </thead>
                <tbody>

                <?php
                foreach ($usuarios as $usuario) {
                ?>
                      <td><?= $usuario['id'] ?></td>
                      <td><?= $usuario['nome'] ?></td>
                      <td><?= $usuario['email'] ?></td>
                      <td><?= $usuario['permissao'] ?></td>
                      <td class="text-center">
                        <a data-url="altera-usuario.php?id=" data-id="<?= $usuario['id'] ?>" class="btn btn-default mr-1" data-toggle="modal" data-target="#modal-altera"><i class="fa fa-lock"></i></a>                                                                                              
                      </td>
                  </tr>

                <?php
                }
                ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<!-- MODAL ALTERAR -->
<div class="modal fade" id="modal-altera" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header modal-success">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Alterar Usuário</h4>
        </div>
        <div class="modal-body">
          <form action="altera-usuario.php" id="form-altera" method="POST">
          <input type="hidden" name="id" value="<?= $usuario['id'] ?>"/>
            <div class="row">
              <div class="col-xs-12">
                <div class="row">
                  <div class="col-xs-12">
                  <div class="form-group mt-1">
                      <label>Nova senha:</label>
                      <input type="password" required name="password1" class="form-control">
                    </div>
                    <div class="form-group mt-1">
                      <label>Confirmar nova senha:</label>
                      <input type="password" required name="password2" class="form-control">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" form="form-altera" class="btn btn-success" value="Submit">Alterar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
</div>

<?php
require_once 'footer.php';
?>

<!-- Active Menu -->
<script>
var menu = document.querySelectorAll('#liUser');
var item = menu[0];
item.classList.add("active");
</script>
