<h1 nombre-pagina>Login</h1>
<p class="descripcion-pagina">Inicia Sesión</p>

<?php 
    include_once __DIR__ .'/../templates/alertas.php';
?> 

<form class="formulario-login" method="POST" action="/">
    <div class="campo">
        <label for="email">Usuario</label>
        <input type="email" 
        id="email"
        placeholder="Id Personal/Correo"
        name="email"
        value="<?php echo s($auth->email) ?>"
        />
    </div>
    <div class="campo">
        <label for="password">Password</label>
        <input type="password"
        id="passowrd"
        placeholder="Contraseña"
        name="password"
        />
    </div>

<input type="submit" class="boton" value="Inicar Sesión">
    
</form>

<div class="acciones">
    <a href="/crear-cuenta">Crear Cuenta</a>
    <a href="/olvide">¿Olvisdaste la contraseña?</a>
</div>