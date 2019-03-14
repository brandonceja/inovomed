<div id="modalshadow" class="modal-shadow">
  <div id="myModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <span class="close">&times;</span>
        <div class="logo-modal">
          <img src="logo.png" alt="">
          <h1>inicia sesión</h1>
        </div>
      </div>
      <div class="modal-body"><form id="login" action="./includes/login.php" method="POST">
          <input type="text" name="username" placeholder="usuario/e-mail">
          <br>
          <input type="password" name="pwd" placeholder="contraseña">
          <br>
          <button type="submit" name="submit" class="lgn">Login</button>
          <a href="signup-view.php" class="rgt" id="rgt">Regístrate</a>
          <br>
         <!-- <a href="/reset-pass">¿Olvidaste tu contraseña?</a> -->
          </form>
      </div>
    </div>
  </div>
</div>