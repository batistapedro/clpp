<?php
session_start();
if(isset($_SESSION['tipo'])&& !empty($_SESSION['tipo']))
{
	if($_SESSION["tipo"]=="administrador" || ($_SESSION['tipo']=="operador"))
	{
		$tipo=null;
		$sql=null;
		$base=null;
		$mensaje=null;
		if(isset($_POST['nombre']) && !empty($_POST['nombre']) && isset($_POST['apellido']) && !empty($_POST['apellido']) && isset($_POST['cedula']) && !empty($_POST['cedula']) && isset($_POST['clave']) && !empty($_POST['clave']))
		{

			$nombre = ucwords(trim(htmlspecialchars($_POST['nombre'])));
			$apellido = ucwords(trim(htmlspecialchars($_POST['apellido'])));
			$cedula = trim(htmlspecialchars($_POST['cedula']));
			$clave = hash('ripemd160',$_POST['clave']);
			$direccion = ucwords(trim(htmlspecialchars($_POST['direccion'])));
			$telefono = trim(htmlspecialchars($_POST['telefono']));
			$tipo="concejal";

			if($telefono==Null && ($telefono==""))
			{
				$telefono="00000000000";
			}
			$a=str_split($cedula);
			if($a[0]!="V" && ($a[0]!="E"))
			{
				echo "<h3>Error en la nacionalidad de la cedula</h3>";
				exit();
			}

			if(!preg_match("/^[a-zA-Z]+$/",$nombre))
			{
				$mensaje =  "<h3>error nombre solo debe poseer letras</h3>";
			}
			else if(strlen($nombre)<3)
			{
				$mensaje = "<h3>error nombre debe ser mayor a dos caracteres</h3>";
			}
			else
			{
				if(!preg_match("/^[Ñ-ña-zA-Z\s]+$/",$apellido))
				{
					$mensaje= "<h3>error apellido solo debe poseer letras</h3>";
				}
				else if(strlen($apellido)<3)
				{
					$mensaje =  "<h3>error apellido debe ser mayor a 2 caracteres</h3>";
				}
				else
				{
					if(!preg_match("/^[e-vE-V]{1}[\-]{1}[0-9]+$/",$cedula))
					{
						$mensaje= "<h3>error cedula invalida</h3>";
					}
					else if(strlen($cedula)>10 || strlen($cedula)<9)
					{
						$mensaje= "<h3>error cedula debe ser mayor a 8 digitos o igual a 10 digito ejemplo V-19871554</h3>";
					}
					else
					{
						if(strlen($clave)<6)
						{
							$mensaje = "<h3>error clave debe ser mayor o igual a 6 caracteres</h3>";
						}
						else
						{
							if($telefono=="")
							{

							}
							else
							{
								if(!preg_match("/^[0-9]+$/",$telefono))
								{
									$mensaje= "<h3>error telefono solo debe poseer numeros</h3>";
								}
								else if(strlen($telefono)!=11)
								{
									$mensaje = "<h3>error telefono debe ser igual a 11 caracteres</h3>";
								}
								else
								{
									require("../php/conexion.php");
									$sq="select cedula from usuarios where cedula='$cedula'";
									$sql="insert into usuarios(idusuario,nombre,apellido,cedula,clave,telefono,tipo) value('','$nombre','$apellido','$cedula','$clave','$telefono','$tipo')";
									$base= new Conexion();
									$base->conectar();
									$ver = $base->consultar($sq);
									if($ver==1)
									{
										$mensaje = "<h3>Error consejal ya existe en el sistema</h3>";
										$base->cerrar();
									}
									else
									{
										$base->agregar($sql);
										$base->cerrar();
									}
								}
							}
						}
					}
				}
			}
		}
		else
		{
			$mensaje = "<h3>error hay datos obligatorios que no le ha dado valor</h3>";
		}
		echo $mensaje;

	}
	else
	{
?>
<script>
window.location="../index.php";
</script>
<?php
	}
}
else
{
?>
<script>
window.location="../index.php";
</script>
<?php
}
?>
