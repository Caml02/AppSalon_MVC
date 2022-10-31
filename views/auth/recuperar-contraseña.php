<h1 class="nombre-pagina">Recupera Tu Contraseña</h1>
<p class="descripcion-pagina">Ingresa Tu Nueva Contraseña.</p>

<?php 
    include_once __DIR__ .'/../templates/alertas.php';
?> 

<?php if($error) return; ?> 

<form class="formulario" method="POST">
    <div class="campo">
        <label for="password">Contraseña</label>
        <input type="password"
        id="password"
        name="password"
        placeholder="Tu nueva contraseña"
        />
    </div>
    <input type="submit" class="boton" value="Cambiar Contraseña">
</form>

<div class="acciones">
    <a href="/crear-cuenta">¿Aún no tienes cuenta? Crea una Cuenta</a>
    <a href="/olvide">¿Ya tienes cuenta? Inicia Sesión</a>
</div>