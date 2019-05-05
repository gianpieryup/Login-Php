<?php
include "funciones.php";
$errores = [];

$nombreOk='';
$emailOk='';
$usernameOk='';//hay que validar que no haya otro con el mismo username
//$passwordOk='';

if ($_POST) {
  $errores = validarRegistro($_POST);

  $nombreOk = trim($_POST["nombre"]);
  $emailOk = trim($_POST["email"]);
  $usernameOk = trim($_POST["username"]);
  //$passwordOk = $_POST["password"];
  if(empty($errores)){//NO EXISTE O  ES VACIO
      $usuario = armarUsuario();
      guardarUsuario($usuario);
      header('Location: felicitaciones.php');
      //subir imagen;
      //$ext= pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
      //move_uploaded_file($_FILES["avatar"]["tmp_name"], "img/". $_POST["email"]. "." .$ext);
  }
  else {
    var_dump($errores);
  }
}
//($_POST);

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1"><!--Deberia redirigir  al apagina de felicitacion solo si esta bien para eso lo dejamos por defecto y arriba en el if( si no hay algun problema){crear usuario y redireccionar a la pagina} -->
    <meta charset="utf-8">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/styleRegistro.css">

    <title>REGISTRO</title>
  </head>
  <body>
  <?php include("partes/header.php"); ?>

  <div class="container">
  <h2 class="text-center text-lg-left">Completá tus datos</h2>

  <form action="registro.php" method="post"><!--A donde va ir cuando presione ENviar-->
      <div class="form-group form-row">
          <div class="form-group col-xs-12 col-sm-6">
            <label for="nombre">Nombre Completo</label><!--Falta el value que es el valor que viajara y el name con la posicion que tendra-->
            <input type="text" class="form-control" id="inputNombre" name="nombre" value='<?= $nombreOk ?>' placeholder="Nombre" required>
          </div>
          <div class="form-group col-xs-12 col-sm-6">
            <label for="nombre">Email</label>
            <input type="email" class="form-control" id="inputApellido" name="email" value='<?= $emailOk ?>' placeholder="Email" required>
          </div>
      </div>

      <div class="form-group form-row">
          <div class="form-group col-xs-12 col-sm-6">
            <label for="inputEmail4">Username</label>
            <input type="text" class="form-control" id="inputEmail4" name="username" value='<?= $usernameOk ?>' placeholder="Username" required>
          </div>
          <div class="form-group col-xs-12 col-sm-6">
            <label for="inputPassword4">Password</label>
            <input type="password" class="form-control" id="inputPassword4" name="password" placeholder="Password" required>
          </div>
      </div>
      <div class="form-group form-row">
        <h6 class="mt-3">Hobbies</h6> <?php // TODO: Persistir ?>
        <div class="form-check form-check-inline">
          <input class="form-check-input" name="hobbies[sports]" type="checkbox" id="inlineCheckbox1" value="sports">
          <label class="form-check-label" for="inlineCheckbox1">Deportes</label>
        </div>

        <div class="form-check form-check-inline">
          <input class="form-check-input" name="hobbies[viaje]" type="checkbox" id="inlineCheckbox2" value="viaje">
          <label class="form-check-label" for="inlineCheckbox2">Viajar</label>
        </div>

        <div class="form-check form-check-inline">
          <input class="form-check-input" name="hobbies[programming]" type="checkbox" id="inlineCheckbox3" value="programming">
          <label class="form-check-label" for="inlineCheckbox3">Programación</label>
        </div>

      </div>
      <div class="form-group form-row">
          <div class="form-group col-xs-12 col-sm-6">
                <label for="pais">Pais</label>
                <select class="form-control" id="exampleFormControlSelect1" name="pais">
                <option value="argentina">Argentina</option>
                <option value="urugai">Urugays</option>
                <option value="brasil">Brasil</option>
                <option value="chile">Chile</option>
              </select>
          </div>
          <div class="form-group col-xs-12 col-sm-6">
              <label for="ciudad">Ciudad</label>
              <select id="inputState" class="form-control" name="ciudad">
                <option value="Buenos Aires">Buenos Aires</option>
                <option value="La Rioja">La Rioja</option>
                <option value="Acassuso">Acassuso</option>
              </select>
          </div>
      </div>
  <!--El checkbox de acepto los datos enviados-->
        <div class="form-group">
          <div class="form-check">
              <input class="form-check-input is-invalid" type="checkbox" id="gridCheck" required>
              <label class="form-check-label" for="gridCheck">
                De acuerdo a los términos y condiciones
              </label>
              <div class="invalid-feedback">
                  Usted debe estar de acuerdo antes de enviar.
              </div>
          </div>
        </div>

        <button type="submit" class="btn btn-primary btn-formulario">Enviar</button>
  </form>
</div>

<?php include("partes/footer.php"); ?>
    <!-- Js -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
