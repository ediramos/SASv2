<?php
session_start();
if (!array_key_exists("la_logusr",$_SESSION))
   {
	 print "<script language=JavaScript>";
	 print "location.href='../sigesp_inicio_sesion.php'";
	 print "</script>";		
   }
//////////////////////////////////////////////         SEGURIDAD               /////////////////////////////////////////////
	require_once("../shared/class_folder/sigesp_c_seguridad.php");
	$io_seguridad= new sigesp_c_seguridad();
    
	$dat=$_SESSION["la_empresa"];
	$ls_empresa=$dat["codemp"];
	$ls_logusr=$_SESSION["la_logusr"];
	$ls_sistema="SPG";
	$ls_ventanas="sigesp_spg_r_unidades_ejecutoras.php";

	$la_seguridad["empresa"]=$ls_empresa;
	$la_seguridad["logusr"]=$ls_logusr;
	$la_seguridad["sistema"]=$ls_sistema;
	$la_seguridad["ventanas"]=$ls_ventanas;
	
	if (array_key_exists("permisos",$_POST)||($ls_logusr=="PSEGIS"))
	{	
		if($ls_logusr=="PSEGIS")
		{
			$ls_permisos="";
			$la_accesos=$io_seguridad->uf_sss_load_permisossigesp();
		}
		else
		{
			$ls_permisos           = $_POST["permisos"];
			$la_accesos["leer"]    = $_POST["leer"];
			$la_accesos["incluir"] = $_POST["incluir"];
			$la_accesos["cambiar"] = $_POST["cambiar"];
			$la_accesos["eliminar"]= $_POST["eliminar"];
			$la_accesos["imprimir"]= $_POST["imprimir"];
			$la_accesos["anular"]  = $_POST["anular"];
			$la_accesos["ejecutar"]= $_POST["ejecutar"];
		}
	}
	else
	{
		$la_accesos["leer"]="";
		$la_accesos["incluir"]="";
		$la_accesos["cambiar"]="";
		$la_accesos["eliminar"]="";
		$la_accesos["imprimir"]="";
		$la_accesos["anular"]="";
		$la_accesos["ejecutar"]="";
		$ls_permisos=$io_seguridad->uf_sss_load_permisos($ls_empresa,$ls_logusr,$ls_sistema,$ls_ventanas,$la_accesos);
	}
	//////////////////////////////////////////////         SEGURIDAD               /////////////////////////////////////////////
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<script type="text/javascript" language="JavaScript1.2" src="../shared/js/disabled_keys.js"></script>
<script language="javascript">
	if(document.all)
	{ //ie 
		document.onkeydown = function(){ 
		if(window.event && (window.event.keyCode == 122 || window.event.keyCode == 116 || window.event.ctrlKey)){
		window.event.keyCode = 505; 
		}
		if(window.event.keyCode == 505){ 
		return false; 
		} 
		} 
	}
</script>
<title>UNIDADES EJECUTORAS </title>
<meta http-equiv="" content="text/html; charset=iso-8859-1">
<meta http-equiv="" content="text/html; charset=iso-8859-1">
<script type="text/javascript" language="JavaScript1.2" src="js/stm31.js"></script>
<meta http-equiv="" content="text/html; charset=iso-8859-1"><meta http-equiv="" content="text/html; charset=iso-8859-1">
<meta http-equiv="Content-Type" content="text/html; charset=">
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
	color: #006699;
}
-->
</style>
<link href="../shared/css/cabecera.css" rel="stylesheet" type="text/css">
<link href="../shared/css/general.css" rel="stylesheet" type="text/css">
<link href="../shared/css/tablas.css" rel="stylesheet" type="text/css">
<link href="../shared/css/ventanas.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.Estilo1 {font-weight: bold}
.Estilo2 {font-size: 14px}
.Estilo4 {color: #6699CC}
-->
</style></head>
<body>
<table width="780" border="0" align="center" cellpadding="0" cellspacing="0" class="contorno">
  <tr> 
    <td height="30" class="cd-logo"><img src="../shared/imagebank/header.jpg" width="778" height="40"></td>
  </tr>
  <tr>
    <td width="432" height="20" colspan="11" bgcolor="#E7E7E7">
		<table width="762" border="0" align="center" cellpadding="0" cellspacing="0">
			  <td width="432" height="20" bgcolor="#E7E7E7" class="descripcion_sistema Estilo4">Sistema de Presupuesto de Gasto</td>
			    <td width="346" bgcolor="#E7E7E7"><div align="right"><span class="letras-pequenas"><b><?PHP print date("j/n/Y")." - ".date("h:i a");?></b></span></div></td>
				<tr>
	  	      <td height="20" bgcolor="#E7E7E7" class="descripcion_sistema">&nbsp;</td>
	  	      <td bgcolor="#E7E7E7" class="letras-pequenas"><div align="right"><b><?PHP print $_SESSION["la_nomusu"]." ".$_SESSION["la_apeusu"];?></b></div></td> </tr>
	  	</table>
	 </td>
  </tr>
  <tr>
         <?php
	   if(array_key_exists("confinstr",$_SESSION["la_empresa"]))
	  {
      if($_SESSION["la_empresa"]["confinstr"]=='A')
	  {
   ?>
    <td height="20" colspan="11" bgcolor="#E7E7E7" class="cd-menu"><script type="text/javascript" language="JavaScript1.2" src="js/menu.js"></script></td>
  <?php
      }
      elseif($_SESSION["la_empresa"]["confinstr"]=='V')
	  {
   ?>
    <td height="20" colspan="11" bgcolor="#E7E7E7" class="cd-menu"><script type="text/javascript" language="JavaScript1.2" src="js/menu_2007.js"></script></td>
  <?php
      }
      elseif($_SESSION["la_empresa"]["confinstr"]=='N')
	  {
   ?>
       <td height="20" colspan="11" bgcolor="#E7E7E7" class="cd-menu"><script type="text/javascript" language="JavaScript1.2" src="js/menu_2008.js"></script></td>
  <?php
      }
	  	 }
	  else
	  {
   ?>
    <td height="20" colspan="11" bgcolor="#E7E7E7" class="cd-menu"><script type="text/javascript" language="JavaScript1.2" src="js/menu_2008.js"></script></td>
	<?php 
	}
	?>
  </tr>
  <tr>
    <td height="20" bgcolor="#FFFFFF" class="toolbar">&nbsp;</td>
  </tr>
  <tr> 
    <td height="20" bgcolor="#FFFFFF" class="toolbar"><a href="javascript: ue_showouput();"><img src="../shared/imagebank/tools20/imprimir.gif" width="20" height="20" border="0" title="Imprimir"></a><a href="sigespwindow_blank.php"><img src="../shared/imagebank/tools20/salir.gif" alt="Salir" width="20" height="20" border="0" title="Salir"></a><img src="../shared/imagebank/tools20/ayuda.gif" alt="Ayuda" width="20" height="20" title="Ayuda"></td>
  </tr>
</table>
  <?php
$la_emp=$_SESSION["la_empresa"];
$li_estmodest=$la_emp["estmodest"];
if(array_key_exists("operacion",$_POST))
{
	$ls_operacion=$_POST["operacion"];
}
else
{
	$ls_operacion="";	
}
if (array_key_exists("codestpro1",$_POST))
   {
     $ls_codestpro1=$_POST["codestpro1"];	   
   }
else
   {
     $ls_codestpro1="";
   }
if (array_key_exists("codestpro2",$_POST))
   {
    $ls_codestpro2=$_POST["codestpro2"];	   
   }
else
   {
     $ls_codestpro2="";
   }
if (array_key_exists("codestpro3",$_POST))
   {
     $ls_codestpro3=$_POST["codestpro3"];	   
   }
else
   {
     $ls_codestpro3="";
   }
if (array_key_exists("codestpro4",$_POST))
   {
     $ls_codestpro4=$_POST["codestpro4"];	   
   }
else
   {
     $ls_codestpro4="";
   }
if (array_key_exists("codestpro5",$_POST))
   {
     $ls_codestpro5=$_POST["codestpro5"];	   
   }
else
   {
     $ls_codestpro5="";
   }
if (array_key_exists("codestpro1h",$_POST))
   {
      $ls_codestpro1h=$_POST["codestpro1h"];	   
   }
else
   {
      $ls_codestpro1h="";
   }
if (array_key_exists("codestpro2h",$_POST))
   {
     $ls_codestpro2h=$_POST["codestpro2h"];	   
   }
else
   {
     $ls_codestpro2h="";
   }
if (array_key_exists("codestpro3h",$_POST))
   {
     $ls_codestpro3h=$_POST["codestpro3h"];	   
   }
else
   {
     $ls_codestpro3h="";
   }
if (array_key_exists("codestpro4h",$_POST))
   {
     $ls_codestpro4h=$_POST["codestpro4h"];	   
   }
else
   {
     $ls_codestpro4h="";
   }
if (array_key_exists("codestpro5h",$_POST))
   {
     $ls_codestpro5h=$_POST["codestpro5h"];	   
   }
else
   {
     $ls_codestpro5h="";
   }
if (array_key_exists("txtcoduniadmdes",$_POST))
   {
     $ls_coduniadmdes=$_POST["txtcoduniadmdes"];	   
   }
else
   {
      $ls_coduniadmdes="";
   }
   
if (array_key_exists("txtcoduniadmhas",$_POST))
   {
     $ls_coduniadmhas=$_POST["txtcoduniadmhas"];	   
   }
else
   {
     $ls_coduniadmhas="";
   }
if(array_key_exists("chkunidad",$_POST))
{
	if($_POST["chkunidad"]==1)
	{
		$chkunidad   = "checked" ;	
		$ls_chkunidad = 1;
	}
	else
	{
		$ls_chkunidad = 0;
		$chkunidad="";
	}
}
else
{
  $ls_chkunidad=0;
  $chkunidad="";
}	
if(array_key_exists("chkemireq",$_POST))
{
	if($_POST["chkemireq"]==1)
	{
		$chkemireq   = "checked" ;	
		$ls_chkemireq = 1;
	}
	else
	{
		$ls_chkemireq = 0;
		$chkemireq="";
	}
}
else
{
  $ls_chkemireq=0;
  $chkemireq="";
}
if  (array_key_exists("estclades",$_POST))
	{
	  $ls_estclades=$_POST["estclades"];
    }
else
	{
	  $ls_estclades="";
	}	
if  (array_key_exists("estclahas",$_POST))
	{
	  $ls_estclahas=$_POST["estclahas"];
    }
else
	{
	  $ls_estclahas="";
	}
if	(array_key_exists("txtcodfuefindes",$_POST))
	{
	  $ls_codfuefindes=$_POST["txtcodfuefindes"];
    }
else
	{
	  $ls_codfuefindes="";
	} 
	
if	(array_key_exists("txtcodfuefinhas",$_POST))
	{
	  $ls_codfuefinhas=$_POST["txtcodfuefinhas"];
    }
else
	{
	  $ls_codfuefinhas="";
	}   
?>
</div> 
<p>&nbsp;</p>
<form name="form1" method="post" action="">
<?php 
	//////////////////////////////////////////////         SEGURIDAD               /////////////////////////////////////////////
	if (($ls_permisos)||($ls_logusr=="PSEGIS"))
	{
		print("<input type=hidden name=permisos id=permisos value='$ls_permisos'>");
		print("<input type=hidden name=leer     id=leer     value='$la_accesos[leer]'>");
		print("<input type=hidden name=incluir  id=incluir  value='$la_accesos[incluir]'>");
		print("<input type=hidden name=cambiar  id=cambiar  value='$la_accesos[cambiar]'>");
		print("<input type=hidden name=eliminar id=eliminar value='$la_accesos[eliminar]'>");
		print("<input type=hidden name=imprimir id=imprimir value='$la_accesos[imprimir]'>");
		print("<input type=hidden name=anular   id=anular   value='$la_accesos[anular]'>");
		print("<input type=hidden name=ejecutar id=ejecutar value='$la_accesos[ejecutar]'>");
		
	}
	else
	{
		
		print("<script language=JavaScript>");
		print(" location.href='sigespwindow_blank.php'");
		print("</script>");
	}
	//////////////////////////////////////////////         SEGURIDAD               //////////////////////////////////////////////
?>
  <table width="608" height="18" border="0" align="center" cellpadding="1" cellspacing="1">
    <tr>
      <td width="604" colspan="2" class="titulo-ventana">UNIDADES EJECUTORAS </td>
    </tr>
  </table>
  <table width="605" border="0" align="center" cellpadding="0" cellspacing="1" class="formato-blanco">
    <tr>
      <td width="94"></td>
    </tr>
    <tr>
      <td height="17" colspan="4" align="center"><div align="left"><span class="Estilo2"></span></div></td>
    </tr>
    <tr style="display:none">
      <td align="center"><div align="right"><strong>Reporte en</strong></div></td>
      <td align="center"><div align="left">
          <select name="cmbbsf" id="cmbbsf">
            <option value="0" selected>Bs.</option>
            <option value="1">Bs.F.</option>
          </select>
      </div></td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
    </tr>
    <tr>
      <td height="13" colspan="4" align="center">&nbsp;</td>
    </tr>
    <tr>
      <td height="13" colspan="4" align="center"><?php 
		 $li_estmodest=$_SESSION["la_empresa"]["estmodest"];
		 $ls_loncodestpro1 = $_SESSION["la_empresa"]["loncodestpro1"]+10;
		 $ls_loncodestpro2 = $_SESSION["la_empresa"]["loncodestpro2"]+10;
		 $ls_loncodestpro3 = $_SESSION["la_empresa"]["loncodestpro3"]+10;
		 $ls_loncodestpro4 = $_SESSION["la_empresa"]["loncodestpro4"]+10;
		 $ls_loncodestpro5 = $_SESSION["la_empresa"]["loncodestpro5"]+10;
		 if($li_estmodest==1)
		 {
	   ?>
        <table width="550" height="77" border="0" align="center" cellpadding="0" cellspacing="0" class="formato-blanco"  va>
          <!--DWLayoutTable-->
          <tr class="titulo-celda">
            <td height="13" colspan="9" valign="top" class="titulo-celdanew"><strong class="titulo-celdanew">Rango Estructura Presupuestaria </strong></td>
          </tr>
          <tr class="formato-blanco">
            <td><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td height="20"><div align="left">
                <input name="codestpro1" type="text" id="codestpro1" value="<?php print $ls_codestpro1 ?>" size="<?php print $ls_loncodestpro1; ?>" maxlength="<?php print $ls_loncodestpro1; ?>" style="text-align:center">
            </div></td>
            <td height="20"><a href="javascript:catalogo_estpro1();"><img src="../shared/imagebank/tools15/buscar.gif" width="15" height="15" border="0" alt="Cat&aacute;logo de Estructura Programatica 1"></a></td>
            <td width="171" colspan="6"><a href="javascript:catalogo_estpro2();"></a><a href="javascript:catalogo_estpro3();"></a></td>
          </tr>
          <tr class="formato-blanco">
            <td><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td height="20"><div align="left">
                <input name="codestpro2" type="text" id="codestpro2" value="<?php print $ls_codestpro2 ?>" size="<?php print $ls_loncodestpro2; ?>" maxlength="<?php print $ls_loncodestpro2; ?>" style="text-align:center">
            </div></td>
            <td height="20"><a href="javascript:catalogo_estpro2();"><img src="../shared/imagebank/tools15/buscar.gif" width="15" height="15" border="0" alt="Cat&aacute;logo de Estructura Programatica 2"></a></td>
            <td width="171" colspan="6"><!--DWLayoutEmptyCell-->&nbsp;</td>
          </tr>
          <tr class="formato-blanco">
            <td width="170"><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td width="136" height="22">
              <div align="left">
                <input name="codestpro3" type="text" id="codestpro3" value="<?php print $ls_codestpro3 ?>" size="<?php print $ls_loncodestpro3; ?>" maxlength="<?php print $ls_loncodestpro3; ?>" style="text-align:center">
                  </div></td><td width="71" height="22"><a href="javascript:catalogo_estpro3();"><img src="../shared/imagebank/tools15/buscar.gif" width="15" height="15" border="0" alt="Cat&aacute;logo de Estructura Programatica 3"></a></td>
            <td width="171" colspan="6"><!--DWLayoutEmptyCell-->&nbsp;</td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td height="13" colspan="4" align="center"><?php 
		  }
		 if($li_estmodest==2)
		 {
		?>
        <table width="550" height="117" border="0" align="center" cellpadding="0" cellspacing="0" class="formato-blanco"  va>
          <!--DWLayoutTable-->
          <tr class="titulo-celda">
            <td height="13" colspan="4" valign="top" class="titulo-celdanew"><strong class="titulo-celdanew">Rango Codigo Programatico </strong></td>
          </tr>
          <tr class="formato-blanco">
            <td><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td height="20"><input name="codestpro1" type="text" id="codestpro12" value="<?php print $ls_codestpro1 ?>" size="<?php print $ls_loncodestpro1; ?>" maxlength="<?php print $ls_loncodestpro1; ?>" style="text-align:center">
              <a href="javascript:catalogo_estpro1();"></a></td>
            <td width="70" height="20"><a href="javascript:catalogo_estpro1();"><img src="../shared/imagebank/tools15/buscar.gif" width="15" height="15" border="0" alt="Cat&aacute;logo de Estructura Programatica 1"></a></td>
            <td></td>
          </tr>
          <tr class="formato-blanco">
            <td><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td height="20"><input name="codestpro2" type="text" id="codestpro22" value="<?php print $ls_codestpro2 ?>" size="<?php print $ls_loncodestpro2; ?>" maxlength="<?php print $ls_loncodestpro2; ?>" style="text-align:center">
              <a href="javascript:catalogo_estpro2();"></a></td>
            <td height="20"><a href="javascript:catalogo_estpro2();"><img src="../shared/imagebank/tools15/buscar.gif" width="15" height="15" border="0" alt="Cat&aacute;logo de Estructura Programatica 2"></a></td>
            <td></td>
          </tr>
          <tr class="formato-blanco">
            <td><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td height="20"><input name="codestpro3" type="text" id="codestpro32" value="<?php print $ls_codestpro3 ?>" size="<?php print $ls_loncodestpro3; ?>" maxlength="<?php print $ls_loncodestpro3; ?>" style="text-align:center">
              <a href="javascript:catalogo_estpro3();"></a></td>
            <td height="20"><a href="javascript:catalogo_estpro3();"><img src="../shared/imagebank/tools15/buscar.gif" width="15" height="15" border="0" alt="Cat&aacute;logo de Estructura Programatica 3"></a></td>
            <td></td>
          </tr>
          <tr class="formato-blanco">
            <td><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td height="20"><input name="codestpro4" type="text" id="codestpro4" value="<?php print $ls_codestpro4 ?>" size="<?php print $ls_loncodestpro4; ?>" maxlength="<?php print $ls_loncodestpro4; ?>" style="text-align:center">
              <a href="javascript:catalogo_estpro4();"></a></td>
            <td height="20"><a href="javascript:catalogo_estpro4();"><img src="../shared/imagebank/tools15/buscar.gif" width="15" height="15" border="0" alt="Cat&aacute;logo de Estructura Programatica 3"></a></td>
            <td></td>
          </tr>
          <tr class="formato-blanco">
            <td width="171"><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td width="136" height="18"><input name="codestpro5" type="text" id="codestpro5" value="<?php print $ls_codestpro5 ?>" size="<?php print $ls_loncodestpro5; ?>" maxlength="<?php print $ls_loncodestpro5; ?>" style="text-align:center">
              <a href="javascript:catalogo_estpro5();"></a></td>
            <td height="22"><a href="javascript:catalogo_estpro5();"></a><a href="javascript:catalogo_estpro5();"><img src="../shared/imagebank/tools15/buscar.gif" width="15" height="15" border="0" alt="Cat&aacute;logo de Estructura Programatica 3"></a><a href="javascript:catalogo_estpro1();"></a></td>
            <td width="171"></td>
          </tr>
        </table>
      <?php
		  }
		 ?></td>
    </tr>
    <tr>
      <td height="13" colspan="4" align="center">&nbsp;</td>
    </tr>
    <tr>
      <td height="13" colspan="4" align="center"><table width="550" height="39" border="0" align="center" cellpadding="0" cellspacing="0" class="formato-blanco">
        <tr class="titulo-celdanew">
          <td height="13" colspan="5"><strong>Intervalo de Fuente de Financiamiento </strong></td>
        </tr>
        <tr>
          <td width="96" height="22"><div align="right"><span class="style1 style14">Desde</span></div></td>
          <td width="167"><div align="left">
              <input name="txtcodfuefindes" type="text" id="txtcodfuefindes"  style="text-align:center" value="<?php print $ls_codfuefindes; ?>" size="10" readonly>
          <a href="javascript:catalogo_fuefindes();"><img src="../shared/imagebank/tools15/buscar.gif" width="15" height="15" border="0" alt="Cat&aacute;logo de Estructura Programatica 1"></a></div></td>
          <td width="94"><div align="right">Hasta</div></td>
          <td width="120"><input name="txtcodfuefinhas" type="text" id="txtcodfuefinhas" style="text-align:center" value="<?php print $ls_codfuefinhas; ?>" size="10" readonly>
            <a href="javascript:catalogo_fuefinhas();"><img src="../shared/imagebank/tools15/buscar.gif" width="15" height="15" border="0" alt="Cat&aacute;logo de Estructura Programatica 1"></a></td>
          <td width="80"><a href="javascript:catalogo_fuefinhas();"></a></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="13" colspan="4" align="center">&nbsp;</td>
    </tr>
    <tr>
      <td height="46" colspan="4" align="center"><table width="550" height="39" border="0" align="center" cellpadding="0" cellspacing="0" class="formato-blanco">
          <tr class="titulo-celdanew">
            <td height="13" colspan="6"><strong>Intervalo de Codigo </strong></td>
          </tr>
          <tr>
            <td width="72" height="22"><div align="right"><span class="style1 style14">Desde</span></div></td>
            <td width="131"><div align="left">
                <input name="txtcoduniadmdes" type="text" id="txtcoduniadmdes" value="<?php print $ls_coduniadmdes; ?>" style="text-align:center">
            </div></td>
            <td width="71"><div align="left"><a href="javascript:catalogo_coduniadmdes();"><img src="../shared/imagebank/tools15/buscar.gif" width="15" height="15" border="0" alt="Cat&aacute;logo de Definicion Administrativa"></a></div></td>
            <td width="69"><div align="right"></div>
                <div align="right">Hasta</div></td>
            <td width="132"><div align="left">
                <input name="txtcoduniadmhas" type="text" id="txtcoduniadmhas" value="<?php print $ls_coduniadmhas; ?>" style="text-align:center">
            </div></td>
            <td width="73"><a href="javascript:catalogo_coduniadmhas();"><img src="../shared/imagebank/tools15/buscar.gif" width="15" height="15" border="0" alt="Cat&aacute;logo de Definicion Administrativa"></a></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td colspan="4" align="center">&nbsp;</td>
    </tr>
    <tr>
      <td align="center"><div align="right">
          <label>
          <input name="chkunidad" type="checkbox" id="chkunidad" onChange="uf_cambio()" value="0" <?php print $chkunidad ?>>
          </label>
      </div></td>
      <td width="140" align="center"><div align="left">Imprimir  todas las  Unidades Administrativas</div></td>
      <td width="79" align="center"><div align="right">
          <input name="chkemireq" type="checkbox" id="chkemireq" value="0" <?php print $chkemireq ?>>
      </div></td>
      <td width="285" align="center"><div align="left">Imprimir solo los que emiten requisici&oacute;n </div></td>
    </tr>
    <tr>
      <td colspan="4" align="center">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" align="center"><div align="right"><span class="Estilo1">
          <input name="estclades" type="hidden" id="estclades" value="<?php print $ls_estclades;?>">
          <input name="estclahas" type="hidden" id="estclahas" value="<?php print $ls_estclahas;?>">
          <input name="estmodest" type="hidden" id="estmodest" value="<?php print  $li_estmodest; ?>">
          <input name="operacion"   type="hidden"   id="operacion"   value="<?php print $ls_operacion;?>">
      </span></div></td>
    </tr>
  </table>
  <div align="left"></div>
  <p align="center">
<input name="total" type="hidden" id="total" value="<?php print $totrow;?>">
</p>
</form>      
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
<script language="JavaScript">
function uf_cambio()
{
    f=document.form1;
   	if(f.chkunidad.checked==true)
	{
	  f.codestpro1.readOnly=true;
      f.codestpro2.readOnly=true;
      f.codestpro3.readOnly=true;
      f.imagen.style.visibility='hidden'
	}
	else
	{
	  f.codestpro1.readOnly=false;
      f.codestpro2.readOnly=false;
      f.codestpro3.readOnly=false;
	}
}
function ue_showouput()
{
	f=document.form1;
	li_imprimir=f.imprimir.value;
	if(li_imprimir==1)
	{
		codestpro1  = f.codestpro1.value;
		codestpro2  = f.codestpro2.value;
		codestpro3  = f.codestpro3.value;
		codestpro1h = "";
		codestpro2h = "";
		codestpro3h = "";
		txtcoduniadmdes=f.txtcoduniadmdes.value;
		txtcoduniadmhas=f.txtcoduniadmhas.value;
		txtcodfuefindes = f.txtcodfuefindes.value;
		txtcodfuefinhas = f.txtcodfuefinhas.value;
	    estclades=f.estclades.value;
	    estclahas=f.estclades.value;
	    tipoformato=f.cmbbsf.value;
		if(f.chkunidad.checked==true)
		{
		  chkunidad=1;
		}
		else
		{
		 chkunidad=0;
		}
		if(f.chkemireq.checked==true)
		{
		  chkemireq=1;
		}
		else
		{
		 chkemireq=0;
		}
		estmodest   = f.estmodest.value;
		if(estmodest==1)
		{
			pagina="reportes/sigesp_spg_rpp_unidad_ejecutora.php?codestpro1="+codestpro1+"&codestpro2="+codestpro2
					+"&codestpro3="+codestpro3+"&codestpro1h="+codestpro1h+"&codestpro2h="+codestpro2h+"&codestpro3h="+codestpro3h
					+"&chkemireq="+chkemireq+"&chkunidad="+chkunidad+"&txtcoduniadmdes="+txtcoduniadmdes
					+"&txtcoduniadmhas="+txtcoduniadmhas+"&txtcodfuefindes="+txtcodfuefindes+"&txtcodfuefinhas="+txtcodfuefinhas
					+"&estclades="+estclades+"&estclahas="+estclahas+"&tipoformato="+tipoformato;
			window.open(pagina,"catalogo","menubar=no,toolbar=no,scrollbars=yes,width=800,height=600,resizable=yes,location=no");
		}
		else
		{
			codestpro4  = f.codestpro4.value;
			codestpro5  = f.codestpro5.value;
			codestpro4h = "";
			codestpro5h = "";
			pagina="reportes/sigesp_spg_rpp_unidad_ejecutora.php?codestpro1="+codestpro1+"&codestpro2="+codestpro2
					+"&codestpro3="+codestpro3+"&codestpro4="+codestpro4+"&codestpro5="+codestpro5+"&codestpro1h="+codestpro1h
					+"&codestpro2h="+codestpro2h+"&codestpro3h="+codestpro3h+"&codestpro4h="+codestpro4h+"&codestpro5h="+codestpro5h
					+"&chkemireq="+chkemireq+"&chkunidad="+chkunidad+"&txtcoduniadmdes="+txtcoduniadmdes
					+"&txtcoduniadmhas="+txtcoduniadmhas+"&txtcodfuefindes="+txtcodfuefindes+"&txtcodfuefinhas="+txtcodfuefinhas
					+"&estclades="+estclades+"&estclahas="+estclahas+"&tipoformato="+tipoformato;
			window.open(pagina,"catalogo","menubar=no,toolbar=no,scrollbars=yes,width=800,height=600,resizable=yes,location=no");
		}
	}
	else
	{
       alert("No tiene permiso para realizar esta operacion");	
	}	
}


function catalogo_estpro1()
{
	   pagina="sigesp_cat_public_estpro1.php?tipo=reporte";
	   window.open(pagina,"_blank","menubar=no,toolbar=no,scrollbars=yes,width=568,height=400,resizable=yes,location=no");
}
function catalogo_estpro2()
{
	f=document.form1;
	codestpro1=f.codestpro1.value;	
	estmodest=f.estmodest.value;
	estcla=f.estclades.value;
	if(estmodest==1)
	{
		if(codestpro1!="")
		{
			pagina="sigesp_cat_public_estpro2.php?codestpro1="+codestpro1+"&tipo=reporte"+"&estcla="+estcla;
			window.open(pagina,"_blank","menubar=no,toolbar=no,scrollbars=yes,width=568,height=400,resizable=yes,location=no");
		}
		else
		{
			alert("Seleccione nivel anterior");
		}
	}
	else
	{
		if(codestpro1=='**')
		{
			pagina="sigesp_cat_estpro2.php?tipo=reporte"+"&estcla="+estcla;
			window.open(pagina,"_blank","menubar=no,toolbar=no,scrollbars=yes,width=568,height=400,resizable=yes,location=no");
		}
		else
		{
			if(codestpro1!="")
			{
				pagina="sigesp_cat_public_estpro2.php?codestpro1="+codestpro1+"&tipo=reporte"+"&estcla="+estcla;
				window.open(pagina,"_blank","menubar=no,toolbar=no,scrollbars=yes,width=568,height=400,resizable=yes,location=no");
			}
			else
			{
				alert("Seleccione  nivel anterior");
			}
		}
	}	
}
function catalogo_estpro3()
{
	f=document.form1;
	codestpro1=f.codestpro1.value;
	codestpro2=f.codestpro2.value;
	codestpro3=f.codestpro3.value;
	estmodest=f.estmodest.value;
	estcla=f.estclades.value;
	if(estmodest==1)
	{
		if((codestpro1!="")&&(codestpro2!="")&&(codestpro3==""))
		{
			pagina="sigesp_cat_public_estpro3.php?codestpro1="+codestpro1+"&codestpro2="+codestpro2+"&tipo=reporte"+"&estcla="+estcla;
			window.open(pagina,"_blank","menubar=no,toolbar=no,scrollbars=yes,width=568,height=400,resizable=yes,location=no");
		}
		else
		{
			pagina="sigesp_cat_public_estpro.php?tipo=reporte"+"&estcla="+estcla;
			window.open(pagina,"_blank","menubar=no,toolbar=no,scrollbars=yes,width=568,height=400,resizable=yes,location=no");
		}
	}
	else
	{
		if((codestpro2=='**')||(codestpro1=='**'))
		{
			if((codestpro2!="")&&(codestpro1!=""))
			{
				pagina="sigesp_cat_estpro3.php?tipo=reporte&codestpro1="+codestpro1+"&codestpro2="+codestpro2+"&estcla="+estcla;
				window.open(pagina,"_blank","menubar=no,toolbar=no,scrollbars=yes,width=568,height=400,resizable=yes,location=no");
			}
			else
			{
				alert("Seleccione niveles anteriores");
			}
		}
		else
		{
			if((codestpro2!="")&&(codestpro1!=""))
			{
				pagina="sigesp_cat_public_estpro3.php?codestpro1="+codestpro1+"&codestpro2="+codestpro2+"&tipo=reporte"+"&estcla="+estcla;
				window.open(pagina,"_blank","menubar=no,toolbar=no,scrollbars=yes,width=568,height=400,resizable=yes,location=no");	
			}
			else
			{
				alert("Seleccione niveles anteriores");
			}
		}	
	}	
}
function catalogo_estpro4()
{
	f=document.form1;
	codestpro1=f.codestpro1.value;
	codestpro2=f.codestpro2.value;
	codestpro3=f.codestpro3.value;
	estcla=f.estclades.value;
	if((codestpro2=='**')||(codestpro1=='**')||(codestpro3=='**'))
	{
		if((codestpro2!="")&&(codestpro1!="")&&(codestpro3!=""))
		{
			pagina="sigesp_cat_estpro4.php?tipo=reporte&codestpro1="+codestpro1+"&codestpro2="+codestpro2
			+"&codestpro3="+codestpro3+"&estcla="+estcla;
			window.open(pagina,"_blank","menubar=no,toolbar=no,scrollbars=yes,width=568,height=400,resizable=yes,location=no");
		}
		else
		{
			alert("Seleccione niveles anteriores");
		}
	}
	else
	{
		if((codestpro2!="")&&(codestpro1!="")&&(codestpro3!=""))
		{
			pagina="sigesp_cat_public_estpro4.php?codestpro1="+codestpro1+"&codestpro2="+codestpro2
			+"&codestpro3="+codestpro3+"&tipo=reporte"+"&estcla="+estcla;
			window.open(pagina,"_blank","menubar=no,toolbar=no,scrollbars=yes,width=568,height=400,resizable=yes,location=no");	
		}
		else
		{
			alert("Seleccione niveles anteriores");
		}
	}	
}
function catalogo_estpro5()
{
	f=document.form1;
	codestpro1=f.codestpro1.value;
	codestpro2=f.codestpro2.value;
	codestpro3=f.codestpro3.value;
	codestpro4=f.codestpro4.value;
	codestpro5=f.codestpro5.value;
	estcla=f.estclades.value;
	if((codestpro2=='**')||(codestpro1=='**')||(codestpro3=='**')||(codestpro4=='**'))
	{
		if((codestpro2!="")&&(codestpro1!="")&&(codestpro3!="")&&(codestpro4!=""))
		{
			pagina="sigesp_cat_estpro5.php?tipo=reporte&codestpro1="+codestpro1+"&codestpro2="+codestpro2
			+"&codestpro3="+codestpro3+"&codestpro4="+codestpro4+"&estcla="+estcla;
			window.open(pagina,"_blank","menubar=no,toolbar=no,scrollbars=yes,width=568,height=400,resizable=yes,location=no");
		}
		else
		{
			alert("Seleccione niveles anteriores");
		}
	}
	else
	{
		if((codestpro2!="")&&(codestpro1!="")&&(codestpro3!="")&&(codestpro4!=""))
		{
			pagina="sigesp_cat_public_estpro5.php?codestpro1="+codestpro1+"&codestpro2="+codestpro2
													 +"&codestpro3="+codestpro3+"&codestpro4="+codestpro4
													 +"&tipo=reporte"+"&estcla="+estcla;
			window.open(pagina,"_blank","menubar=no,toolbar=no,scrollbars=yes,width=568,height=400,resizable=yes,location=no");
		}
		else
		{
			alert("Seleccione niveles anteriores");
		}
	}
}

function catalogo_coduniadmdes()
{
	f=document.form1;
	codestpro1  = f.codestpro1.value;
	codestpro2  = f.codestpro2.value;
	codestpro3  = f.codestpro3.value;
	estmodest   = f.estmodest.value;
    if(estmodest==1)
	{
		pagina="sigesp_spg_cat_unidad_ejecutora.php?codestpro1="+codestpro1+"&codestpro2="+codestpro2+"&codestpro3="+codestpro3
		        +"&tipo=coduniad_desde";
		window.open(pagina,"_blank","menubar=no,toolbar=no,scrollbars=yes,width=568,height=400,resizable=yes,location=no");
	}
	else
	{
		codestpro4  = f.codestpro4.value;
		codestpro5  = f.codestpro5.value;
		pagina="sigesp_spg_cat_unidad_ejecutora.php?codestpro1="+codestpro1+"&codestpro2="+codestpro2+"&codestpro3="+codestpro3
		        +"&codestpro4="+codestpro4+"&codestpro5="+codestpro5+"&tipo=coduniad_desde";
		window.open(pagina,"_blank","menubar=no,toolbar=no,scrollbars=yes,width=568,height=400,resizable=yes,location=no");
	}
}

function catalogo_coduniadmhas()
{
	f=document.form1;
	codestpro1  = f.codestpro1.value;
	codestpro2  = f.codestpro2.value;
	codestpro3  = f.codestpro3.value;
	estmodest   = f.estmodest.value;
    if(estmodest==1)
	{
		pagina="sigesp_spg_cat_unidad_ejecutora.php?codestpro1="+codestpro1+"&codestpro2="+codestpro2+"&codestpro3="+codestpro3
		        +"&tipo=coduniad_hasta";
		window.open(pagina,"_blank","menubar=no,toolbar=no,scrollbars=yes,width=568,height=400,resizable=yes,location=no");
	}
	else
	{
		codestpro4  = f.codestpro4.value;
		codestpro5  = f.codestpro5.value;
		pagina="sigesp_spg_cat_unidad_ejecutora.php?codestpro1="+codestpro1+"&codestpro2="+codestpro2+"&codestpro3="+codestpro3
		        +"&codestpro4="+codestpro4+"&codestpro5="+codestpro5+"&tipo=coduniad_hasta";
		window.open(pagina,"_blank","menubar=no,toolbar=no,scrollbars=yes,width=568,height=400,resizable=yes,location=no");
	}
}
function catalogo_fuefindes()
{
    f=document.form1;
    pagina="sigesp_spg_cat_fuente.php?tipo=REPORTE_DESDE";
    window.open(pagina,"catalogo","menubar=no,toolbar=no,scrollbars=yes,width=520,height=400,resizable=yes,location=no");
}

function catalogo_fuefinhas()
{
    f=document.form1;
    pagina="sigesp_spg_cat_fuente.php?tipo=REPORTE_HASTA";
    window.open(pagina,"catalogo","menubar=no,toolbar=no,scrollbars=yes,width=520,height=400,resizable=yes,location=no");
}
</script>
</html>