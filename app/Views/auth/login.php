   <div class="login-container">
    <div class="login-image"> 
     <img src="images/login.png">
    </div>
   <div class="login-form">
    <h2>Iniciar sesión</h2>

    <form method="POST" style="max-width: 300px;">
        <div>
            <label>Email:</label>
            <input type="email" name="email" maxlength="150" required value="<?= $this->e($input['email'] ?? '') ?>">
        </div>
        
        <div>
            <label>Contraseña:</label>
            <input type="password" name="password" maxlength="64" required value="<?= $this->e($input['password'] ?? '') ?>">
        </div>
       
       <p>¿No tienes una cuenta? <a href="/register">Crear Cuenta</a></p>
        
        <button type="submit">Ingresar</button>
    </form>
   </div>
  </div>
