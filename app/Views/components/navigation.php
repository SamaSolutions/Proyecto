<nav class="navbar">
  <div class="logo">
    <img src="images/logo" alt="SAMA Solutions" />
    <span>SAMA <strong>Solutions</strong></span>
  </div>

  <ul class="menu">
    <li><a href="/" class="<?= ($currentUrl === '/') ? 'active' : '' ?>">Inicio</a></li>
    <li><a href="/explorar" class="<?= ($currentUrl === '/explorar') ? 'active' : '' ?>">Explorar</a></li>
    <li><a href="/contacto" class="<?= ($currentUrl === '/contacto') ? 'active' : '' ?>">Contacto</a></li>
  </ul>
    
  <div class="auth">
   <?php if ($auth['check']): ?>
   
    <?php $nombreUsuario = $nombre ?? 'Mi Cuenta'; ?>

<div class="dropdown-perfil">
    
 <button class="dropdown-toggle" onclick="toggleDropdown()">
        
        <span class="nombre-usuario"><?= htmlspecialchars($nombreUsuario) ?></span>
        <span class="icono-flecha">&#9662;</span> <!-- Flecha hacia abajo -->
    </button>

    <div id="perfilDropdownMenu" class="dropdown-menu">
        <a href="/perfil" class="dropdown-item">Mi Perfil</a>
        <a href="/logout" class="dropdown-item">Salir (Logout)</a>
    </div>
</div> 
   <script src="js/perfil.js"></script>   
   <?php else: ?>
    <a href="/login" class="<?= ($currentUrl === '/login') ? 'active' : '' ?>">
      <span class="icon-user">👤</span> Acceder
    </a>
    <?php endif; ?>
  </div>
</nav>
