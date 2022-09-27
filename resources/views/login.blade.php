<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ingresar Usuario</title>
  </head>
  <body>
    @if (session()->has('error'))
        <div style="color:red;">
            <h4>{{session('error')}}</h4>
        </div>
    @endif
    <form method="POST" action="login">
        @csrf
        <label for="name">Ingrese el usuario:</label>
        <input type="text" name="name" id="name">
        <label for="password">Ingrese la contraseña:</label>
        <input type="password" name="password" id="password">
        <input type="submit" name="uploadBtn" value="Guardar">
    </form>
  </body>
</html>