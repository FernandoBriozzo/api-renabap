<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulario de Prueba</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <form method="POST" action="./store">
        @csrf
        <label for="api-url">Ingrese la url:</label>
        <input type="text" name="api-url" id="api-url">
        <input type="submit" name="uploadBtn" value="Guardar">
    </form>
	<script src="index.js"></script>
  </body>
</html>