<div class="login-box">
<?php
 $error="";
if($_SERVER['REQUEST_METHOD'] =="POST")
{
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    $password = sha1($password);
    $query ="select count(*) from usuarios where usuario  ='$usuario' and clave  = '$password'";
    $valida = rquery($query);
    if($valida > 0)
    {
        $_SESSION['loginfacturas']= "1";
        $_SESSION['usuario'] = rquery("select usuario from usuarios where usuario  ='$usuario' and clave  = '$password'");;
        $_SESSION['idusuarios'] = rquery("select idusuarios from usuarios where usuario  ='$usuario' and clave  = '$password'");;
        $_SESSION['admin'] = rquery("select admin from usuarios where usuario  ='$usuario' and clave  = '$password'");;
        $_SESSION['superadmin'] = rquery("select superadmin from usuarios where usuario  ='$usuario' and clave  = '$password'");;
if($usuario == "admin")
  {
      $_SESSION['admin']  ="1";
      $_SESSION['superadmin']  = "1";
  }
        $_SESSION['empresa'] = rquery("select nombrecomercial from datos_emisor");
?>
      <div class="callout callout-info lead">
    <h4>Datos correctos</h4>
    <p>Redirigiendo  ...</p>
  </div>
<script>
setTimeout(function() { window.location.href ="index.php"},1500);
</script>
</div>
<!--</div>-->
<!-- /.login-box -->

<?php
exit;
    }
    else
    {
        $error =  1;
    }
    #print_r($result->fetchArray());

}
?>
  <div class="login-logo">
    <img src="img/logo.png"/    >
    <a href="index.php"><b>Facturas</b>2.0</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">

    <p class="login-box-msg">
      <strong>
      <?php
    $nombre =  rquery("select nombrecomercial from datos_emisor");
    if($nombre =="") $nombre =rquery("select nombre from datos_emisor");

    echo  $nombre;
    ?></strong>
      <br>Ingreso de credenciales</p>

    <form method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Usuario" name="usuario" id="usuario" required="required" autocomplete="off"/>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" id="password" name="password" required="required" autocomplete="off" />
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">

        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
<?php

if($error =="1")
{
    ?>
    <br />
      <div class="callout callout-danger lead">
    <h4>Error de validacion!</h4>
    <p>Datos incorrectos</p>
  </div>

    <?php
}
?>



  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<?php
html2();
?>
