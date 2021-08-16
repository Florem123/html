<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="css/popup.css" rel="stylesheet">
<style>

body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

</style>
</head>
<body>

<button class="open-button" onclick="openForm()">Te gustó?</button>

<div class="form-popup" id="myForm">
  <form action="/action_page.php" class="form-container">
    <h3>Encuesta</h3>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>

    <label for="coment"><b>Comentario</b></label></br>
    <textarea  id="coment" rows="5" style="resize: none; width: 100%;"></textarea>

    <button type="submit" class="btn">Enviar</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Cerrar</button>
  </form>
</div>

<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>

</body>
</html>
