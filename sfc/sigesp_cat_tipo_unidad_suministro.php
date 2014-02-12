<?php
session_start();
if((!array_key_exists("ls_database",$_SESSION))||(!array_key_exists("ls_hostname",$_SESSION))||(!array_key_exists("ls_gestor",$_SESSION))||(!array_key_exists("ls_login",$_SESSION)))
{
	print "<script language=JavaScript>";
	print "opener.location.href='../sigesp_conexion.php';";
	print "close();";
	print "</script>";
}

$la_datemp=$_SESSION["la_empresa"];
if(!array_key_exists("campo",$_POST))
{
	$ls_campo="cod_pro";
	$ls_orden="ASC";
}
else
{
	$ls_campo=$_POST["campo"];
	$ls_orden=$_POST["orden"];
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Cat&aacute;logo de unidad operativa de suministro</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" language="JavaScript1.2" src="js/number_format.js"></script>
<link href="../shared/css/cabecera.css" rel="stylesheet" type="text/css">
<link href="../shared/css/tablas.css" rel="stylesheet" type="text/css">
<link href="../shared/css/general.css" rel="stylesheet" type="text/css">
<link href="../shared/css/ventanas.css" rel="stylesheet" type="text/css">
<script type="text/javascript" language="JavaScript1.2" src="js/validaciones.js"></script>
<style type="text/css">
<!--
a:link {
	color: #006699;
}
a:visited {
	color: #006699;
}
a:hover {
	color: #006699;
}
a:active {
	color: #006699#006699;
}
.style6 {color: #000000}
-->
</style></head>

<body>
<form name="form1" method="post" action="">
<input type="hidden" name="campo" id="campo" value="<? print $ls_campo;?>" >
<input type="hidden" name="orden" id="orden" value="<? print $ls_orden;?>">
<?php

require_once("../shared/class_folder/sigesp_include.php");
require_once("../shared/class_folder/class_mensajes.php");
require_once("../shared/class_folder/class_sql.php");
require_once("../shared/class_folder/class_funciones.php");
require_once("class_folder/sigesp_sfc_class_utilidades.php");
$io_utilidad = new sigesp_sfc_class_utilidades();
$io_include=new sigesp_include();
$io_connect=$io_include->uf_conectar();
$io_msg=new class_mensajes();
$io_sql=new class_sql($io_connect);
$io_funcion=new class_funciones();
$ls_codemp=$la_datemp["codemp"];

if(array_key_exists("operacion",$_POST))
{
	$ls_operacion=$_POST["operacion"];
	$ls_denominacion=$_POST["denominacion"];

}
else
{
	$ls_operacion="";
	$ls_denominacion="";

}

?>
  <p align="center">
    <input name="operacion" type="hidden" id="operacion"  value="<? print $ls_operacion?>">

</p>
  	 <table width="500" border="0" align="center" cellpadding="1" cellspacing="1">
    	<tr>
     	 	<td width="496" colspan="2" class="titulo-celda">Cat&aacute;logo de unidad operativa de suministro</td>
    	</tr>
	 </table>
	 <br>
	 <table width="500" border="0" cellpadding="0" cellspacing="0" class="formato-blanco" align="center">
      <tr>
        <td>&nbsp;</td>
      </tr>

	  <tr>
        <td><div align="right">Denominaci&oacute;n</div></td>
        <td><div align="left">
          <input name="denominacion" type="text" id="denominacion"  size="60" maxlength="225">
        </div></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><div align="right"><a href="javascript: ue_search();"><img src="../shared/imagebank/tools20/buscar.gif" alt="Buscar" width="20" height="20" border="0"> Buscar</a></div></td>
      </tr>
    </table>
	<br>
    <?php


if($ls_operacion=="BUSCAR")
{
 $ls_cadena=" SELECT codtipundopesum ,dentipundopesum
                FROM sfc_tipo_unidadoperativasuministro
			   WHERE dentipundopesum like '%".$ls_denominacion."%'
               ORDER BY codtipundopesum ASC";
			$rs_datauni=$io_sql->select($ls_cadena);
			if($rs_datauni==false&&($io_sql->message!=""))
			{
				$io_msg->message("No hay registros");
				print $io_sql->message;
				//print_r($_SESSION);
			}
			else
			{
				print "<table width=500 border=0 cellpadding=1 cellspacing=1 class=fondo-tabla align=center>";
				print "<tr class=titulo-celda>";
				print "<td><font color=#FFFFFF>C�digo</font></a></td>";
				print "<td><font color=#FFFFFF>Denominaci�n</font></a></td></tr>";
				$li_rows=0;
				while($row=$io_sql->fetch_row($rs_datauni))
				{
						$li_rows++;
						print "<tr class=celdas-blancas>";
						$ls_codtipundopesum = $row["codtipundopesum"];
						$ls_dentipundopesum = $row["dentipundopesum"];		                
				        print "<td><a href=\"javascript: aceptar('$ls_codtipundopesum','$ls_dentipundopesum');\">".$ls_codtipundopesum."</a></td>";
						print "<td align=left>".$ls_dentipundopesum."</td>";
						print "</tr>";
						
				}
				if($li_rows==0)
				{
					$io_msg->message("No se han registrado tipos de unidades operativas de suministro");
				}
		}
}
print "</table>";
?>
</div>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
<script language="JavaScript">
  function aceptar(ls_codtipundopesum,ls_dentipundopesum)
  {
	  opener.document.form1.codunisum.value=ls_codtipundopesum;
	  opener.document.form1.denunisum.value=ls_dentipundopesum;
	  close();
  }

  function ue_search()
  {
	  f=document.form1;
	  f.operacion.value="BUSCAR";
	  f.action="sigesp_cat_tipo_unidad_suministro.php";
	  f.submit();
  }

</script>
</html>
