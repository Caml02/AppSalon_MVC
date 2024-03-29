<h1 class="nombre-pagina">Crear Cuenta</h1>


<?php 
    include_once __DIR__ .'/../templates/alertas.php';
?>  

<form action="/crear-cuenta" class="formulario" method="POST">
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input type="text"
        id= "nombre"
        name="nombre"
        placeholder="Tu Nombre"
        value="<?php echo s($personal->nombre); ?>"
        />
    </div>
    <div class="campo">
        <label for="apellido">Apellido</label>
        <input type="text"
        id= "apellido"
        name="apellido"
        placeholder="Tu Apellido"
        value="<?php echo s($personal->apellido); ?>"
        />
    </div>
    <div class="campo">
        <label for="telefono">Teléfono</label>
        <input type="tel"
        id= "telefono"
        name="telefono"
        placeholder="Tu Teléfono"
        value="<?php echo s($personal->telefono); ?>"
        />
    </div>
    <div class="campo">
        <label for="email">E-mail</label>
        <input type="email"
        id= "email"
        name="email"
        placeholder="Tu E-mail"
        value="<?php echo s($personal->email); ?>"
        />
    </div>
    <div class="campo">
        <label for="password">Contraseña</label>
        <input type="password"
        id= "password"
        name="password"
        placeholder="Tu Contraseña"
        />
    </div>
    <input type="submit" value="Crear Cuenta" class="boton">
</form>
<div class="acciones">
    <a href="/">¿Ya tienes cuenta? Inicia Sesión</a>
</div>
