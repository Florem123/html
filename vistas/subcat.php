<?php
include_once 'conexion.php';
$html = '';
// Recepción de los datos enviados mediante POST desde el JS   
$cate = (isset($_POST['cate'])) ? $_POST['cate'] : '';

/*$res= "SELECT count(*) FROM objeto_ova WHERE id_objeto LIKE '%"$ident"%'"; */

$result = mysqli_query($con,"SELECT * FROM subcat WHERE cat_padre='$cate'");


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $html .= '<option value="'.$row['id'].'">'.$row['descripcion'].'</option>';
    }
     $html .= '<option value="0">Ver todas</option>';
}else{
	$html .= '<option value="0">Ver todas</option>';
	}
echo $html;
?>