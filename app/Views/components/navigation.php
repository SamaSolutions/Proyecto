<nav>
    <a href="/" class="<?= ($currentUrl === '/' || $currentUrl === '') ? 'active' : '' ?>">Inicio</a>
    
    <?php if ($auth['check']): ?>
        <a href="/dashboard" class="<?= (strpos($currentUrl, '/dashboard') === 0) ? 'active' : '' ?>">Dashboard</a>
        <a href="/logout">Cerrar sesión</a>
    <?php else: ?>
     <a href="/login" class="<?= ($currentUrl === '/login') ? 'active' : '' ?>">Login</a>
	  <?php endif; ?>

	   <a href="/usuarios" class="<?= ($currentUrl === '/usuarios') ? 'active' : '' ?>">Usuarios</a>
		<a href="/post" class="<?=($currentUrl === '/post')?'active': ''?>">Posts</a>
		<a href="/apicategorias" class="<?=($currentUrl === '/apicategorias')?'active': ''?>">Api Categorias</a>
  

</nav>
