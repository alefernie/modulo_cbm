<?php
require_once("java/Java.inc"); 
require_once('sentencias.php');
require_once('conn.php');
require_once('funciones.php');
ini_set("display_errors", "on");

$localidad=$_POST['municipio'];

$cat = catalogos();
if($cat)
{
	
	$sql_select = 'SELECT "cve_loc", "nom_loc" FROM localidades  WHERE "cve_mun" = '.$localidad.' ORDER BY "nom_loc" ASC';
	$res_select = pg_query($cat, $sql_select);
	if (!$res_select) { exit("Error en la consulta"); }

	if (pg_num_rows ($res_select))
	{
		echo "<option value=\"\">Seleccione una localidad</option>";
		while ($fila = pg_fetch_array($res_select))
		{
			$clave	= $fila [0];
			$nombre = $fila [1];
			echo  "<option value=\"$clave\">$nombre</option>";
		}
	}
	else
	{
		echo  "<option value=\"1\" selected >Sin Localidad</option>";
	}
}
?>
