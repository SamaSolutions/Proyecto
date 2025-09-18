   <div class="register-container">
   <div class="register-image">
    <img src="images/register.png">
   </div>
   
   <div class="register-form">
    <h2>Registro de Usuario</h2>
    
    <form method="POST" style="max-width: 400px;">
        <div>
            <label>CI:</label>
            <input type="text" name="rut" minlength="8" maxlength="8" required value="<?= $this->e($input['rut'] ?? '') ?>">
        </div>

        <div>
            <label>Nombre:</label>
            <input type="text" name="nombre" minlength="3" maxlength="50" required value="<?= $this->e($input['nombre'] ?? '') ?>">
        </div>
        
        <div>
            <label>Apellido:</label>
            <input type="text" name="apellido" minlength="3" maxlength="50" required value="<?= $this->e($input['apellido'] ?? '') ?>">
        </div>
       
        <div>
            <label>Email:</label>
            <input type="email" name="email" maxlength="100" required value="<?= $this->e($input['email'] ?? '') ?>">
        </div>

        <div>
            <label>Telefono:</label>
            <input type="tel" name="numeroTelefonico" pattern="(09\d{7}|2\d{7})" required value="<?= $this->e($input['numeroTelefonico'] ?? '') ?>">
        </div>

 
        <div>
            <label>Localidad:</label>
            <select name ="localidad" id="localidad" required value="<?= $this->e($input['localidad'] ?? '') ?>">
             <option value ="barreras">Barreras</option>
             <option value ="barrio 19 de abril">Barrio 19 De Abril</option>
             <option value ="barrio campistegui">Barrio Campistegui</option>
             <option value ="barrio centro">Barrio Centro</option>
             <option value ="barrio gallo">Barrio Gallo</option>
             <option value ="barrio herten">Barrio Herten</option>
             <option value ="barrio laures">Barrio Laures</option>
             <option value ="barrio lenzi">Barrio Lenzi</option>
             <option value ="barrio obelisco">Barrio Obelisco</option>
             <option value ="canelon chico">Canelon Chico</option>
             <option value ="el colorado">El Colorado</option>
             <option value ="el dorado">El Dorado</option>
             <option value ="el santo">El Santo</option>
             <option value ="hipodromo">Hipodromo</option>
             <option value ="las piedras">Las Piedras</option>
             <option value ="la pilarica">La Pilarica</option>
             <option value ="progreso">Progreso</option>
             <option value ="pueblo nuevo">Pueblo Nuevo</option>
             <option value ="razetti">Razetti</option>
             <option value ="san francisco">San Francisco</option>
             <option value ="san isidro">San Isidro</option>
             <option value ="santa isabel">Santa Isabel</option>
             <option value ="santa rita">Santa Rita</option>
             <option value ="talca">Talca</option>
             <option value ="villa alegria">Villa Alegria</option>
             <option value ="villa foresti">Villa Foresti</option>
             <option value ="villa juanita">Villa Juanita</option>
             <option value ="vista linda">Vista Linda</option>
            </select>
        </div>

        <div>
            <label>Calle:</label>
            <input type="text" name="calle" minlength="3" maxlength="50" required value="<?= $this->e($input['calle'] ?? '') ?>">
        </div>
    
        <div>
            <label>Numero De Puerta:</label>
            <input type="number" name="numero_puerta" maxlength="11" required value="<?= $this->e($input['numero_puerta'] ?? '') ?>">
        </div>
       
        <div>
            <label>Contraseña:</label>
            <input type="password" name="password" minlength="8" maxlength="64" required>
        </div>
        
        <div>
            <label>Confirmar Contraseña:</label>
            <input type="password" name="password_confirm" required>
        </div>
       <p>¿Eres un proveedor? <a href="/registerProveedor">Registrarse como proveedor</a></p>
      
        <button type="submit">Registrarse</button>
    </form>
    <p>¿Ya tienes una cuenta? <a href="/login">Inicia sesión</a></p>
    </div>
   </div>
   
