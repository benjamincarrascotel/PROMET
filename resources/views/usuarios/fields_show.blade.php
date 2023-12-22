<div class="mb-3 row">
    <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
    <div class="col-sm-10">
        <input name="nombre" id='nombre' type="text" class="form-control" value="{{$usuario->nombre}}"  required>
    </div>
</div>

<div class="mb-3 row">
    <label for="apellido1" class="col-sm-2 col-form-label">Apellido Paterno</label>
    <div class="col-sm-10">
        <input name="apellido1" id='apellido1' type="text" class="form-control" value="{{$usuario->apellido1}}" required>
    </div>
</div>

<div class="mb-3 row">
    <label for="apellido2" class="col-sm-2 col-form-label">Apellido Materno</label>
    <div class="col-sm-10">
        <input name="apellido2" id='apellido2' type="text" class="form-control" value="{{$usuario->apellido2}}" required>
    </div>
</div>

<div class="mb-3 row">
    <label for="rut" class="col-sm-2 col-form-label">Ingrese su Rut<br>(sin puntos ni dígito verificador)</label>
    <div class="col-sm-10">
        <input name="rut" id='rut' type="text" class="form-control" value="{{$usuario->rut}}" required>
    </div>
</div>

<div class="mb-3 row">
    <label for="rut_dv" class="col-sm-2 col-form-label">Ingrese su Digito Verificador</label>
    <div class="col-sm-10">
        <input name="rut_dv" id='rut_dv' type="text" class="form-control" value="{{$usuario->rut_dv}}" required>
    </div>
</div>

<div class="mb-3 row">
    <label for="email" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
        <input name="email" id='email' type="email" class="form-control" value="{{$usuario->email}}" disabled readonly>
    </div>
</div>

<div class="mb-3 row">
    <label for="superadmin" class="col-sm-2 col-form-label">Cambiar contraseña</label>
    <div class="col-sm-10 mt-2">
        <input id="cambiarContraseña" name="cambiarContraseña" type="checkbox" value="1" onchange="activarCampos()">
    </div>
</div>

<div class="mb-3 row">
    <label for="password" class="col-sm-2 col-form-label">Contraseña</label>
    <div class="col-sm-10">
        <input name="password" id='password' type="password" class="form-control" disabled>
    </div>
</div>

<div class="mb-3 row">
    <label for="password2" class="col-sm-2 col-form-label">Reingrese su contraseña</label>
    <div class="col-sm-10">
        <input name="password_confirmation" id='password_confirmation' type="password" class="form-control" disabled>
    </div>
</div>


<script>
    function activarCampos() {
        var checkbox = document.getElementById('cambiarContraseña');
        var passwordInput = document.getElementById('password');
        var confirmPasswordInput = document.getElementById('password_confirmation');

        passwordInput.disabled = !checkbox.checked;
        confirmPasswordInput.disabled = !checkbox.checked;

        // Establecer o quitar el atributo required según el estado del checkbox
        passwordInput.required = checkbox.checked;
        confirmPasswordInput.required = checkbox.checked;

        if (!checkbox.checked) {
            // Si el checkbox no está marcado, también puedes limpiar los campos de contraseña
            passwordInput.value = '';
            confirmPasswordInput.value = '';
        }
    }
</script>

