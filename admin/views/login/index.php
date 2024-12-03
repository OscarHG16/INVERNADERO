<?php require('views/header.php'); ?>

<div class="login-container">
  <form class="login-form" method="post" action="login.php?accion=login">
    <div data-mdb-input-init class="form-outline mb-4">
      <input type="email" id="form2Example1" class="form-control" name="data[correo]"/>
      <label class="form-label" for="form2Example1">Correo electronico</label>
    </div>

    <div data-mdb-input-init class="form-outline mb-4">
      <input type="password" id="form2Example2" class="form-control" name="data[contrasena]" />
      <label class="form-label" for="form2Example2">Contraseña</label>
    </div>

    <div class="row mb-4">
      <div class="col d-flex justify-content-center">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
          <label class="form-check-label" for="form2Example31"> Recuerda me </label>
        </div>
      </div>

      <div class="col">
        <a href="login.php?accion=forgot">Olvidaste la contraseña?</a>
      </div>
    </div>

    <input class="btn btn-lg btn-primary" value="Entrar al sistema" name="Enviar" 
    data-mdb-button-init data-mdb-ripple-init type="submit"/>

    <div class="text-center">
      <p>No tienes cuenta? <a href="#!">Registrarte</a></p>
      <p>or sign up with:</p>
      <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
        <i class="fab fa-facebook-f"></i>
      </button>

      <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
        <i class="fab fa-google"></i>
      </button>

      <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
        <i class="fab fa-twitter"></i>
      </button>

      <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
        <i class="fab fa-github"></i>
      </button>
    </div>
  </form>
</div>

<style>
  .login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f5f5f5; /* Opcional: cambiar color de fondo */
  }

  .login-form {
    width: 100%;
    max-width: 400px; /* Define el tamaño máximo del formulario */
    padding: 20px;
    background-color: white;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    border-radius: 8px;
  }
</style>