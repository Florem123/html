<?php
include_once 'conexion.php';
$html = '';
// Recepción de los datos enviados mediante POST desde el JS   
$categ = (isset($_POST['categ'])) ? $_POST['categ'] : '';
$subcateg = (isset($_POST['subcateg'])) ? $_POST['subcateg'] : '';
$idrec = (isset($_POST['idrec'])) ? $_POST['idrec'] : '';


if ($subcateg == 0) {
	$rela= mysqli_query($con, "SELECT DISTINCT id_ova FROM relacion WHERE id_cat='$categ'");
	if(mysqli_num_rows($rela) == 0){
				$html .= "<span class='glyphicon glyphicon-search' aria-hidden='true'></span> No se encontraron OVAS asociados a esta categoría</br></br>";
			}else{
				while ($row1 = mysqli_fetch_assoc($rela)){

				$idova=$row1['id_ova'];
				//var_dump($idova);

				//CONSULTA EN LA TABLA DE OVAS PARA RESCATAR ESE OBJETO	
				$sql = mysqli_query($con, "SELECT * FROM objeto_ova WHERE id_objeto='$idova' AND id_tipo='$idrec' AND ova_activo=1");
			
				if(mysqli_num_rows($sql) != 0){
						$row = mysqli_fetch_assoc($sql);   
						//var_dump($row['id']);                      
	                        $html .=  '
								
								  <div>
								    <div class="thumbnail">
								      <img src="'.$row['miniatura'].'" width="100" height="100">
								      <div class="caption">
								        <h3>'.$row['nombre'].'</h3>
								        <p>Modelización: ';
								        $tipomodel=$row['tipo_model'];
								        $sql2 = mysqli_query($con, "SELECT descripcion FROM tipo_modelizacion WHERE id='$tipomodel'");

								    	while($row2 = mysqli_fetch_assoc($sql2))
								        	$html .= $row2['descripcion'].'</p>';

							$html .=  '
								        <p>Tipo de recurso: ';
								        $tiporecu=$row['id_tipo'];
								        $sql3 = mysqli_query($con, "SELECT nombre_tipo FROM tipo_ova WHERE id='$tiporecu'");

								    	while($row3 = mysqli_fetch_assoc($sql3))
								        	$html .= $row3['nombre_tipo'].'</p>';


							$html .=  '
								        <p>
								          <a href="profile.php?nik='.$row['id'].'"> <button type="button" class="btn btn-primary">Ver más</button></a>	
								        </p>
								      </div>
								    </div>
								  </div>
								
						';
						}

						
				}
			}
}else{
	$rela= mysqli_query($con, "SELECT DISTINCT id_ova FROM relacion WHERE id_subcat IS NOT NULL AND id_subcat='$subcateg'");
			
			if(mysqli_num_rows($rela) == 0){
				$html .=  "<span class='glyphicon glyphicon-search' aria-hidden='true'></span> No se encontraron OVAS asociados a esta subcategoría</br></br>";
			}else{
				while ($row1 = mysqli_fetch_assoc($rela)){

				$idova=$row1['id_ova'];
				//var_dump($idova);

				//CONSULTA EN LA TABLA DE OVAS PARA RESCATAR ESE OBJETO	
				$sql = mysqli_query($con, "SELECT * FROM objeto_ova WHERE id_objeto='$idova' AND id_tipo='$idrec' AND ova_activo=1");
			
				if(mysqli_num_rows($sql) != 0){
						$row = mysqli_fetch_assoc($sql);   
						//var_dump($row['id']);                      	
	                        $html .=  '
								
								  <div>
								    <div class="thumbnail">
								      <img src="'.$row['miniatura'].'" width="100" height="100">
								      <div class="caption">
								        <h3>'.$row['nombre'].'</h3>
								        <p>Modelización: ';
								        $tipomodel=$row['tipo_model'];
								        $sql2 = mysqli_query($con, "SELECT descripcion FROM tipo_modelizacion WHERE id='$tipomodel'");

								    	while($row2 = mysqli_fetch_assoc($sql2))
								        	$html .=  $row2['descripcion'].'</p>';

							$html .=  '
								        <p>Tipo de recurso: ';
								        $tiporecu=$row['id_tipo'];
								        $sql3 = mysqli_query($con, "SELECT nombre_tipo FROM tipo_ova WHERE id='$tiporecu'");

								    	while($row3 = mysqli_fetch_assoc($sql3))
								        	$html .=  $row3['nombre_tipo'].'</p>';


							$html .= '
								        <p>
								          <a href="profile.php?nik='.$row['id'].'"> <button type="button" class="btn btn-primary">Ver más</button></a>
								        </p>
								      </div>
								    </div>
								  </div>
								
						';
						}
				}
			}
}
if ($html == '') {
	$html .= "<span class='glyphicon glyphicon-search' aria-hidden='true'></span> No se encontraron OVAS asociados a esta categoría</br></br>";
}

echo $html;
?>

