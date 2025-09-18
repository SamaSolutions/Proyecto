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
    <a href="/logout" class="<?= ($currentUrl === '/logout') ? 'active' : '' ?>">
      <span class="icon-user">👤</span>Salir
    </a>
   <?php else: ?>
    <a href="/login" class="<?= ($currentUrl === '/login') ? 'active' : '' ?>">
      <span class="icon-user">👤</span> Acceder
    </a>
    <?php endif; ?>
  </div>
</nav>
