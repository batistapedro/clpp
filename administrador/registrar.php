<?php
session_start();
if(isset($_SESSION['nombre']) && isset($_SESSION['tipo'])&& isset($_SESSION['id'])){
?>
<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../css/registrar.css">
	</head>
	<body>
	<?php
	 if($_SESSION['tipo']=="administrador"){
	?>
	<!---formulario de registro del administrador -->
	<form class="form" id="formregistrardatos" role="form">
		<h2> Registrar Datos</h2>
		<div class="form-group">
			<select name="tipo" id="tipo" class="form-control" required>
				<option value=""></option>
				<option value="consejos">Registrar Consejos Comunales</option>
				<option value="registrosintegrantesconsejos">Registrar Integrantes de Consejos Comunales</option>
				<option value="comunas">Registrar Comunas</option>
				<option value="registrosintegrantescomunas">Registrar Integrantes de Comunas</option>
				<option value="registrarconsejoscomunas">Registrar Consejos Comunales en Comunas</option>
				<option value="movimientos">Registrar Movimientos Sociales</option>
				<option value="registrosintegrantesmovimientos">Registrar Integrantes de movimientos Sociales</option>
				<option value="voceroporparroquia">Registrar Voceros Electos Por Parroquia</option>
				<option value="consejales">Registrar Concejales</option>
				<option value="registrooperador">Registrar Operador</option>
			</select>
		</div>
		<button type="submit" class="btn btn-success" title="Elegir"><span class="glyphicon glyphicon-ok-sign"></span> Elegir</button>
		<button type="reset" class="btn btn-danger" title="Limpiar"><span class="glyphicon glyphicon-remove-sign"></span> Limpiar</button>
		</form>
		<!--- fin formulario de registro del administrador -->
	<div id="mensajestodos"></div>

		<!---formulario de registro del administrador del los consejos comunales-->
	<form class="form" id="rconsejocomunales" role="form">
		<h2>Consejos comunales</h2>
		<h3>* Datos Obligatorios</h3>
		<div class="form-group input-group">
			<span class="input-group-addon glyphicon glyphicon-asterisk"></span>
		  	<select id="consejoparroquia" name="parroquia" class="form-control" required>
				  <option value="">Elige Parroquia</option>
				  <option value="marhuanta">Marhuanta</option>
				  <option value="agua salada">Agua Salada</option>
				  <option value="sabanita">Sabanita</option>
				  <option value="catedral">Catedral</option>
				  <option value="vista hermosa">Vista Hermosa</option>
				  <option value="jose antonio paez">Jose Antonio Paez</option>
				  <option value="zea">Zea</option>
				  <option value="orinoco">Orinoco</option>
				  <option value="panapana">Panapana</option>
		    </select>
		</div>
		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<div class="form-group">
	       			<label for="sector" role="label">* Sector</label>
		        	<input type="text" class="form-control" name="sector" id="consejosector" placeholder="Sector" required>
				</div>
				<div class="form-group">
		    		<label for="sede" role="label">* Sede</label>
		        	<input type="text" class="form-control" name="sede" id="consejosede"placeholder="Sede" required>
		    	</div>
		    	<div class="form-group">
		    		<label for="rif" role="label">* Rif</label>
		        	<input type="text" class="form-control" name="rif" id="consejorif" placeholder="Rif" required>

		    	</div>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<div class="form-group">
		    		<label for="nombre" role="label">* Nombre</label>
		        	<input type="text" class="form-control" name="nombre" id="consejonombre" placeholder="Nombre" required>
		        </div>
		        <div class="form-group">

		        	<label for="consejosdia" role="label">* Fecha de Adecuacion</label>

		        	<div class="row">
		        		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

		    				<select id="consejosdia" class="form-control" required>
				      			<option value="">DIA </option>
								<option value="01" > 1 </option>
								<option value="02" > 2 </option>
								<option value= "03" > 3 </option>
								<option value= "04" > 4 </option>
								<option value= "05" > 5 </option>
								<option value= "06" > 6 </option>
								<option value= "07" > 7 </option>
								<option value= "08" > 8 </option>
								<option value= "09" > 9 </option>
								<option value= "10" > 10 </option>
								<option value= "11" > 11 </option>
								<option value= "12" > 12 </option>
								<option value= "13" > 13 </option>
								<option value= "14" > 14 </option>
								<option value= "15" > 15 </option>
								<option value= "16" > 16 </option>
								<option value= "17" > 17 </option>
								<option value= "18" > 18 </option>
								<option value= "19" > 19 </option>
								<option value= "20" > 20 </option>
								<option value= "21" > 21 </option>
								<option value= "22" > 22 </option>
								<option value= "23" > 23 </option>
								<option value= "24" > 24 </option>
								<option value= "25" > 25 </option>
								<option value= "26" > 26 </option>
								<option value= "27" > 27 </option>
								<option value= "28" > 28 </option>
								<option value= "29" > 29 </option>
								<option value= "30" > 30 </option>
								<option value= "31" > 31 </option>
		      				</select>
		      			</div>
		      			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
		      				<select id="consejosmes" class="form-control" required>
					      		<option value="">MES</option>
					      		<option value= "01" > 1 </option>
								<option value= "02" > 2 </option>
								<option value= "03" > 3 </option>
								<option value= "04" > 4 </option>
								<option value= "05" > 5 </option>
								<option value= "06" > 6 </option>
								<option value= "07" > 7 </option>
								<option value= "08" > 8 </option>
								<option value= "09" > 9 </option>
								<option value= "10" > 10 </option>
								<option value= "11" > 11 </option>
								<option value= "12" > 12 </option>
		      				</select>
		      			</div>
		      			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
		      				<select id="consejosanios" class="form-control" required>
								<option value="">AÑO</option>
								<?php

									for($i=Date("Y"); $i>=1998; $i--)
									{
										echo "<option value='{$i}'>{$i}</option>";
									}
								 ?>
		      				</select>
		      			</div>
		      		</div>
		    	</div>
		    	<div class="form-group">
		    		<label for="clave" role="label">* Clave</label>
		    		<input type="text" class="form-control" name="clave" id="consejoclave" placeholder="clave" required>
		    	</div>
			</div>
		</div>
		<h2>Anexos</h2>
		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<div class="form-group">
					<label for="consejosacta" role="label">Acta Constitutiva</label>
					<input type="checkbox" class="form-control"  id="consejosacta" value="si">
				</div>

				<div class="form-group">
					<label for="consejoscertificado" role="label">Certificado de Registro</label>
					<input type="checkbox" class="form-control"  id="consejoscertificado" value="si">
				</div>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<div class="form-group">
					<label for="consejosmiembro" role="label">Nomina de Miembros</label>
					<input type="checkbox" class="form-control"   id="consejosmiembro" value="si">
				</div>
				<div class="form-group">
					<label for="consejoscedulas" role="label">Cedula de Miembros</label>
					<input type="checkbox" class="form-control"  id="consejoscedulas" value="si">
				</div>
			</div>
		</div>
		      <button type="submit" class="btn btn-success" title="Guardar"><span class="glyphicon glyphicon-ok-sign"></span> Guardar</button>
		      <button type="reset" class="btn btn-danger" title="Limpiar"><span class="glyphicon glyphicon-remove-sign"></span> Limpiar</button>
	</form>

		<!--- fin formulario de registro del administrador del los consejos comunales-->

		<!---formulario de registro del administrador del los integrantes de los consejos comunales-->
	<form class="form" id="integrantesconsejos" role="form">
		<h2>Integrantes consejos comunales </h2>
		<h3>* Datos Obligatorios</h3>
		<div class="form-group input-group">
		<span class="input-group-addon glyphicon glyphicon-asterisk"></span>
			<select  id="tipointconsejos" class="form-control" required>
				<option value="">Elija tipo de vocero</option>
				<option value="principal">Principal</option>
				<option value="suplente">Suplente</option>
			</select>
		</div>
		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<div class="form-group">
					<label for="unidad" role="label">* Elija Unidad</label>
					<select id="unidad" class="form-control" required>
						<option value=''>Elija Unidad</option>
						<option value="ejecutiva">Unidad Ejecutiva</option>
						<option value="administrativa">Administrativa y Financiera</option>
						<option value="contraloria">Contraloria Social</option>
					</select>
				</div>
				<label for="tiporifcodigoconsejos" role="label">* Elija Relacion</label>
				<div class="form-group input-group">
					<span id="ayudaintconsejosselectrelacion" title="Ayuda" class="input-group-addon"><img margin="0px" padding="0px" width="22px" height="22px" src='../imagenes/ayuda.png'></span>
						<select id="tiporifcodigoconsejos" class="form-control" required>
							<option value="">Elija Relacion</option>
							<option value="rif">Rif</option>
							<option value="codigo_gestion">Codigo</option>
						</select>

				</div>
				<label for="relacion" role="label">* Relacion</label>
				<div class="form-group input-group">
					<span id="ayudaintconsejosrelacion" title="Ayuda" class="input-group-addon "><img margin="0px" padding="0px" width="22px" height="22px" src='../imagenes/ayuda.png'></span>
					<input type="text" class="form-control" name="relacion" id="intconsejosrelacion" required>
				</div>
				<div class="form-group">
					<label for="nombre" role="label">* Nombre</label>
					<input type="text" class="form-control" name="nombre" id="intconsejosnombre" placeholder="Nombre" maxlength="15" required>
				</div>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<div class="form-group">
					<label for="apellido" role="label">* Apellido</label>
					<input type="text" class="form-control" name="apellido" id="intconsejosapellido" placeholder="Apellido" maxlength="15" required>
				</div>
				<div class="form-group">
					<label for="consejosnacionalidad" role="label">* Cedula</label>
					<div class="row">
						<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="padding-right:2px;">
							<select id="consejosnacionalidad" class="form-control" required>
								<option value="V-">V</option>
								<option value="E-">E</option>
							</select>
						</div>
						<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9" style="padding-left:2px;">
							<input type="text" class="form-control" name="cedula" id="intconsejoscedula" placeholder="Cedula" maxlength="8" required>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="consejocodigotelefono" role="label"> Telefono</label>
					<div class="row">
						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding-right:2px;">
							<select id="consejocodigotelefono" class="form-control">
								<option value="">Codigo</option>
								<option value="0412">0412</option>
								<option value="0416">0416</option>
								<option value="0426">0426</option>
								<option value="0414">0414</option>
								<option value="0424">0424</option>
								<option value="0285">0285</option>
							</select>
						</div>
						<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" style="padding-left:2px;">
							<input type="text" class="form-control" name= "telefono" id="intconsejostelefono" placeholder="Telefono" maxlength="7">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="cargo" role="label">* Comite</label>
					<input type="text" class="form-control" name="cargo" id="intconsejoscargo" placeholder="Comite" required>
				</div>
			</div>
		</div>

		<button type="submit" class="btn btn-success" title="Guardar"><span class="glyphicon glyphicon-ok-sign"></span> Guardar</button>
		<button type="reset" class="btn btn-danger" title="Limpiar"><span class="glyphicon glyphicon-remove-sign"></span> Limpiar</button>
	</form>
		<!--- fin formulario de registro del administrador del los integrantes
		 de los consejos comunales-->

		 <!---formulario de registro del administrador del las comunas socialistas-->
	<form class="form" id="rcomunas" role="form">
		<h2>Comunas</h2>
		<h3>* Datos Obligatorios</h3>
		<div class="form-group input-group">
			<span class="input-group-addon glyphicon glyphicon-asterisk"></span>
			<select id="comunaparroquia" class="form-control" required>
				  <option value="">Elija Parroquia</option>
				  <option value="marhuanta">Marhuanta</option>
				  <option value="agua salada">Agua Salada</option>
				  <option value="sabanita">Sabanita</option>
				  <option value="catedral">Catedral</option>
				  <option value="vista hermosa">Vista Hermosa</option>
				  <option value="jose antonio paez">Jose Antonio Paez</option>
				  <option value="zea">Zea</option>
				  <option value="orinoco">Orinoco</option>
				  <option value="panapana">Panapana</option>
		      </select>
		</div>
		<div class="row">
			<div class="col-sm-6 col-md-6 col-lg-6">
				<div class="form-group">
					<label for="sector" role="label">* Sector</label>
		    		<input type="text" class="form-control" name="sector" id="comunasector"placeholder="Sector" required>
		    	</div>
		    	<div class="form-group">
		    		<label for="sede" role="label">* Sede</label>
		      		<input type="text" class="form-control" name="sede" id="comunasede"placeholder="Sede" required>
		   		</div>
		    	<div class="form-group">
		    		<label for="rif" role="label">* Rif</label>
		      		<input type="text" class="form-control" name="rif" id="comunarif" placeholder="Rif" required>
		    	</div>
		    </div>
		    <div class="col-sm-6 col-md-6 col-lg-6">
		    	<div class="form-group">
		    		<label for="nombre" role="label">* Nombre</label>
		      		<input type="text" class="form-control" name="nombre" id="comunanombre" placeholder="Nombre" required>
		    	</div>
		    	<div class="form-group">
		    		<label for="comunasdia" role="label">* Fecha de Adecuacion</label>
	      			<div class="row">
	      				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
		      				<select id="comunasdia" class="form-control" required>
				      			<option value="">DIA </option>
								<option value="01" > 1 </option>
								<option value="02" > 2 </option>
								<option value= "03" > 3 </option>
								<option value= "04" > 4 </option>
								<option value= "05" > 5 </option>
								<option value= "06" > 6 </option>
								<option value= "07" > 7 </option>
								<option value= "08" > 8 </option>
								<option value= "09" > 9 </option>
								<option value= "10" > 10 </option>
								<option value= "11" > 11 </option>
								<option value= "12" > 12 </option>
								<option value= "13" > 13 </option>
								<option value= "14" > 14 </option>
								<option value= "15" > 15 </option>
								<option value= "16" > 16 </option>
								<option value= "17" > 17 </option>
								<option value= "18" > 18 </option>
								<option value= "19" > 19 </option>
								<option value= "20" > 20 </option>
								<option value= "21" > 21 </option>
								<option value= "22" > 22 </option>
								<option value= "23" > 23 </option>
								<option value= "24" > 24 </option>
								<option value= "25" > 25 </option>
								<option value= "26" > 26 </option>
								<option value= "27" > 27 </option>
								<option value= "28" > 28 </option>
								<option value= "29" > 29 </option>
								<option value= "30" > 30 </option>
								<option value= "31" > 31 </option>
		      				</select>
		      			</div>
		      			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				      		<select id="comunasmes" class="form-control" required>
					      		<option value="">MES</option>
					      		<option value= "01" > 1 </option>
								<option value= "02" > 2 </option>
								<option value= "03" > 3 </option>
								<option value= "04" > 4 </option>
								<option value= "05" > 5 </option>
								<option value= "06" > 6 </option>
								<option value= "07" > 7 </option>
								<option value= "08" > 8 </option>
								<option value= "09" > 9 </option>
								<option value= "10" > 10 </option>
								<option value= "11" > 11 </option>
								<option value= "12" > 12 </option>
				      		</select>
				      	</div>
				      	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
					      	<select id="comunasanios" class="form-control" required>
								<option value="">AÑO</option>
								<?php
									for($i=Date("Y");$i>=1998;$i--)
									{
										echo "<option value='{$i}'>{$i}</option>";
									}
								 ?>
					      	</select>
					    </div>
	      			</div>
		    	</div>
		    	<div class="form-group">
		    		<label for="clave" role="label">* Clave</label>
		      		<input type="text" class="form-control" name="clave"  id="comunaclave" placeholder="clave" required>
		    	</div>
		    </div>
		</div>
		<h2>Anexos</h2>

		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<div>
					<div class="form-group">
						<label for="" role="label">Constancia de Elección</label>
						<input type="checkbox" class="form-control" value="si" id="comunaanexoconstancia">
					</div>
					<div class="form-group">
						<label for="" role="label">Acta de Constitutiva</label>
						<input type="checkbox" class="form-control" value="si" id="comunaanexoacta">
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<div class="form-group">
						<label for="" role="label">Certificado de registro</label>
						<input type="checkbox" class="form-control" value="si" id="comunaanexoregistro">
					</div>
					<div class="form-group">
						<label for="" role="label">Cedulas de miembros</label>
						<input type="checkbox" class="form-control" value="si" id="comunaanexocedula">
					</div>

			</div>
		</div>
		<button type="submit" class="btn btn-success" title="Guardar"><span class="glyphicon glyphicon-ok-sign"></span> Guardar</button>
		<button type="reset" class="btn btn-danger" title="Limpiar"><span class="glyphicon glyphicon-remove-sign"></span> Limpiar</button>
	</form>
   <!--- fin formulario de registro del administrador del las comunas socialistas-->

    <!---formulario de registro del administrador del los movimientos sociales-->
	<form class="form" role="form" id="rmovimientossociales">
		<h2>Movimientos Sociales</h2>
		<h3>* Datos Obligatorios</h3>

	 	<div id="hijomovimientos">
	 		<div class="row">
	 			<div class="col-sm-6 col-md-6 col-lg-6">
		 			<div class="form-group">
		 				<label for="parroquia" role="label">* Parroquia</label>
			 			<select id="moviparroquia" name="parroquia" class="form-control" required>
							<option value="">Elije Parroquia</option>
					  		<option value="marhuanta">Marhuanta</option>
					  		<option value="agua salada">Agua Salada</option>
					  		<option value="sabanita">Sabanita</option>
					  		<option value="catedral">Catedral</option>
					  		<option value="vista hermosa">Vista Hermosa</option>
					  		<option value="jose antonio paez">Jose Antonio Paez</option>
					  		<option value="zea">Zea</option>
					  		<option value="orinoco">Orinoco</option>
					  		<option value="panapana">Panapana</option>
						</select>
		  			</div>
					<div class="form-group">
						<label for="tipo" role="label">* Tipo De Movimiento</label>
						<select name="tipo" id="movitipo" class="form-control" required>
							<option value="">Elija tipo</option>
							<option value="campesino">Campesino</option>
							<option value="trabajadores">Trabajadores</option>
							<option value="intelectuales">Intelectuales</option>
							<option value="pescadores">Pescadores</option>
							<option value="deportista">Deportista</option>
							<option value="mujeres">Mujeres</option>
							<option value="culturales">Culturales</option>
							<option value="juventud">Juventud</option>
							<option value="asociacion civil">Asociacion Civil</option>
							<option value="cooperativa">Cooperativa</option>
						</select>
					</div>
					<div class="form-group">
						<label for="sector" role="label">* Sector</label>
						<input type="text" class="form-control" name="sector" id="movisector" placeholder="Sector" required>
					</div>
					<div class="form-group">
						<label for="sede" role="label">* Sede</label>
						<input type="text" class="form-control" name="sede"  id="movisede" placeholder="Sede" required>
					</div>
				</div>
				<div class="col-sm-6 col-md-6 col-lg-6">
					<div class="form-group">
						<label for="rif" role="label">* Rif</label>
						<input type="text" class="form-control" name="rif" id="movirif"placeholder="Rif" required>
					</div>
					<div class="form-group">
						<label for="nombre" role="label">* Nombre</label>
						<input type="text" class="form-control" name="nombre" id="movinombre" placeholder="Nombre" required>
					</div>
				      	<div class="form-group" id="adecuacion">
				      		<label for="movimientosdia" role="label">* Fecha de Adecuacion</label>
				      		<div class="row">
				      			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
					      			<select id="movimientosdia" class="form-control" required>
						      			<option value="">DIA </option>
										<option value="01" > 1 </option>
										<option value="02" > 2 </option>
										<option value= "03" > 3 </option>
										<option value= "04" > 4 </option>
										<option value= "05" > 5 </option>
										<option value= "06" > 6 </option>
										<option value= "07" > 7 </option>
										<option value= "08" > 8 </option>
										<option value= "09" > 9 </option>
										<option value= "10" > 10 </option>
										<option value= "11" > 11 </option>
										<option value= "12" > 12 </option>
										<option value= "13" > 13 </option>
										<option value= "14" > 14 </option>
										<option value= "15" > 15 </option>
										<option value= "16" > 16 </option>
										<option value= "17" > 17 </option>
										<option value= "18" > 18 </option>
										<option value= "19" > 19 </option>
										<option value= "20" > 20 </option>
										<option value= "21" > 21 </option>
										<option value= "22" > 22 </option>
										<option value= "23" > 23 </option>
										<option value= "24" > 24 </option>
										<option value= "25" > 25 </option>
										<option value= "26" > 26 </option>
										<option value= "27" > 27 </option>
										<option value= "28" > 28 </option>
										<option value= "29" > 29 </option>
										<option value= "30" > 30 </option>
										<option value= "31" > 31 </option>
							      	</select>
							    </div>
							    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
							      	<select id="movimientosmes" class="form-control" required>
							      		<option value="">MES</option>
							      		<option value= "01" > 1 </option>
										<option value= "02" > 2 </option>
										<option value= "03" > 3 </option>
										<option value= "04" > 4 </option>
										<option value= "05" > 5 </option>
										<option value= "06" > 6 </option>
										<option value= "07" > 7 </option>
										<option value= "08" > 8 </option>
										<option value= "09" > 9 </option>
										<option value= "10" > 10 </option>
										<option value= "11" > 11 </option>
										<option value= "12" > 12 </option>
							      	</select>
							    </div>
							    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
					      			<select id="movimientosanios" class="form-control" required>
										<option value="">AÑO</option>

										<?php
										for($i=Date("Y");$i>=1945;$i--)
										{
											echo "<option value='{$i}'>{$i}</option>";
										}
										 ?>
					      			</select>
					      		</div>
				      		</div>
				      	</div>
				  		<div class="form-group">
				  			<label for="clave" role="label">* Clave</label>
				      		<input type="text" class="form-control" name="clave" id="moviclave" placeholder="clave" required>
				  		</div>
				</div>
		  	</div>
		</div>
		<h2>Anexos</h2>
		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<div id="movirecaudos">
					<div class="form-group">
						<label for="acta" role="label">Acta Constitutiva</label>
						<input type="checkbox" value="si" id="acta" class="form-control">
					</div>
					<div class="form-group">
						<label for="constancia" role="label">Constancia de Elecciones</label>
						<input type="checkbox" value="si" id="constancia" class="form-control">
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<div class="form-group">
					<label for="" role="label">Nomina de Miembros</label>
					<input type="checkbox" value="si" id="miembro" class="form-control">
				</div>
				<div class="form-group">
					<label for="" role="label">Cedula de Miembros</label>
					<input type="checkbox" value="si" id="cedulas" class="form-control">
				</div>
			</div>
		</div>
		<button type="submit" class="btn btn-success"  title="Guardar"><span class="glyphicon glyphicon-ok-sign"></span> Guardar</button>
		<button type="reset" class="btn btn-danger" title="Limpiar"><span class="glyphicon glyphicon-remove-sign"></span> Limpiar</button>
	</form>
		<!--- fin formulario de registro del administrador del los movimientos sociales-->

		<!---formulario de registro del administrador del los concejales-->

	<form class="form" id="rconsejales" role="form">
		<h2>Concejales</h2>
		<h3>* Datos Obligatorios</h3>
		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">

			  	<div class="form-group">
			  		<label for="nombre" role="label">* Nombre</label>
					<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" maxlength="20" required>
			  	</div>
			  	<div class="form-group">
			  		<label for="apellido" role="label">* Apellido</label>
					<input type="text" class="form-control" name="apellido" id="apellido" placeholder="Apellido" maxlength="20" required>
			  	</div>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<div>
					<div class="form-group">
						<label for="consejalescodigocedula" role="label">* Cedula</label>
						<div class="row">
							<div class="col-xs-4 col-sm-3 col-md-3 col-lg-3" style="padding-right:2px;">
								<select id="consejalescodigocedula" class="form-control" required>
									<option value="V-">V</option>
									<option value="E-">E</option>
								</select>
							</div>
							<div class="col-xs-8 col-sm-9 col-md-9 col-lg-9" style="padding-left:2px;">
								<input type="text" class="form-control" name="cedula" id="cedula" placeholder="Cedula" maxlength="8" required>
							</div>
						</div>
					</div>
				</div>
				<div>
					<div class="form-group">
						<label for="consejalescodigotelefono" role="label">Teléfono</label>
						<div class="row">
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding-right:2px;">
								<select id="consejalescodigotelefono" class="form-control">
									<option value="">Codigo</option>
									<option value="0412">0412</option>
									<option value="0416">0416</option>
									<option value="0426">0426</option>
									<option value="0414">0414</option>
									<option value="0424">0424</option>
									<option value="0285">0285</option>
								</select>
							</div>
							<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" style="padding-left:2px;">
								<input type="text" class="form-control" name="telefono" id="telefono" placeholder="Telefono" maxlength="7">
							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="col-md-12">
			<div class="form-group">
					<label for="clave" role="label">* Clave</label>
					<input type="text" class="form-control" name="clave" id="clave" placeholder="Clave" maxlength="12" required>
				</div>
			</div>
			<button type="submit" class="btn btn-success" title="Guardar"><span class="glyphicon glyphicon-ok-sign"></span> Guardar</button>
			<button type="reset" class="btn btn-danger" title="Limpiar"><span class="glyphicon glyphicon-remove-sign"></span> Limpiar</button>
		</div>
	</form>
		<!--- fin formulario de registro del administrador del los concejales-->

		<!---formulario de registro del administrador del los integrantes de los movimientos sociales-->
	<form class="form" role="form" id="integrantesmovimientos">
		<h2>Integrantes de Movimientos </h2>
		<h3>* Datos Obligatorios</h3>
		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<div class="form-group">
					<label for="tipointmovi" role="label">* Tipo Vocero</label>
					<select  id="tipointmovi" class="form-control" required>
						<option value="">Elija Tipo de  Vocero</option>
						<option value="principal">Principal</option>
						<option value="suplente">Suplente</option>
					</select>
				</div>
				<div>
					<label for="tiporifcodigo" role="label">* Elija Relacion</label>
					<div class="form-group input-group">
						<span class="input-group-addon" id="ayudaintmovimientosselectrelacion"  title="Ayuda"><img margin="0px" padding="0px" width="22px" height="22px" src='../imagenes/ayuda.png'></span>
						<select id="tiporifcodigo" class="form-control" required>
							<option value="">Elija Relacion</option>
							<option value="rif">Rif</option>
							<option value="codigo_gestion">Codigo</option>
						</select>
					</div>
				</div>
					<label for="relacion" role="label">* Realcion</label>
					<div class="form-group input-group">
						<span class="input-group-addon" id="ayudaintmovimientosrelacion" title="Ayuda"><img margin="0px" padding="0px" width="22px" height="22px" src='../imagenes/ayuda.png'></span>
						<input type="text" class="form-control" name="relacion" id="intmovirelacion" placeholder="Digite relacion" required>
					</div>
				<div class="form-group">
					<label for="nombre" role="label">* Nombre</label>
					<input type="text" class="form-control" name="nombre" id="intmovinombre" placeholder="Nombre" maxlength="15" required>
				</div>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<div class="form-group">
					<label for="apellido" role="label">* Apellido</label>
					<input type="text" class="form-control" name="apellido" id="intmoviapellido" placeholder="Apellido" maxlength="15" required>
				</div>
				<div>
					<div class="form-group">
						<label for="movimientosnacionalidad" role="label">* Cedula</label>
						<div class="row">
							<div class="col-xs-4 col-sm-3 col-md-3 col-lg-3" style="padding-right:2px;">
								<select id="movimientosnacionalidad" class="form-control" required>
									<option value="V-">V</option>
									<option value="E-">E</option>
								</select>
							</div>
							<div class="col-xs-8 col-sm-9 col-md-9 col-lg-9" style="padding-left:2px;">
								<input type="text" class="form-control" name="cedula" id="intmovicedula" placeholder="Cedula" maxlength="8" required>
							</div>
						</div>
					</div>
				</div>
				<div>
					<div class="form-group">
						<label for="movimientoscodigotelefono" role="label">Telefono</label>
						<div class="row">
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding-right:2px;">
								<select id="movimientoscodigotelefono" class="form-control">
									<option value="">Codigo</option>
									<option value="0412">0412</option>
									<option value="0416">0416</option>
									<option value="0426">0426</option>
									<option value="0414">0414</option>
									<option value="0424">0424</option>
									<option value="0285">0285</option>
								</select>
							</div>
							<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" style="padding-left:2px;">
								<input type="text" class="form-control" name= "telefono" id="intmovitelefono" placeholder="Telefono" maxlength="7">
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="cargo" role="label">* Cargo</label>
					<input type="text" class="form-control" name="cargo" id="intmovicargo" placeholder="Cargo" required>
				</div>
			</div>
		</div>
		<button type="submit" class="btn btn-success" title="Guardar"><span class="glyphicon glyphicon-ok-sign"></span> Guardar</button>
		<button type="reset" class="btn btn-danger" title="Limpiar"><span class="glyphicon glyphicon-remove-sign"></span> Limpiar</button>
	</form>
<!-- fin formulario de registro del administrador del los integrantes de los movimientos sociales-->

<!---formulario de registro del administrador del los integrantes de las comunas-->
	<form class="form" id="integrantescomunas" role="form">

			<h2>Integrantes de Comunas </h2>
			<h3>* Datos Obligatorios</h3>
			<div id="tipogestion" class="hidden">consejos</div>
		<div class="row">
			<div class="col-xs-7 col-sm-6 col-md-6 col-lg-6">
				<div class="form-group">
					<label for="tipointcomuna" role="label">* tipo de Vocero</label>
					<select  id="tipointcomuna" class="form-control" required>
						<option value="">Elija tipo de Vocero</option>
						<option value="principal">Principal</option>
						<option value="suplente">Suplente</option>
					</select>
				</div>
				<label for="tiporifcodigocomuna" role="label">* elija Relacion</label>
				<div class="form-group input-group">
						<span class="input-group-addon" id="ayudaintcomunasselectrelacion"  title="Ayuda"><img margin="0px" padding="0px" width="22px" height="22px" src='../imagenes/ayuda.png'></span>
						<select id="tiporifcodigocomuna" class="form-control" required>
							<option value="">Elieja Relacion</option>
							<option value="rif">Rif</option>
							<option value="codigo">Codigo</option>
						</select>
				</div>
			</div>
			<div class="col-xs-5 col-sm-6 col-md-6 col-lg-6">
				<label for="relacion" role="label">* Relacion</label>
				<div class="form-group input-group">
					<span class="input-group-addon" id="ayudaintcomunasrelacion" title="Ayuda"><img margin="0px" padding="0px" width="22px" height="22px" src='../imagenes/ayuda.png'></span>
					<input type="text" name="relacion" id="intcomunarelacion" class="form-control" required>

				</div>
				<div class="form-group">
					<label for="cedula" role="label">* Cedula</label>
					<div class="row">
						<div class="col-xs-4 col-sm-3 col-md-3 col-lg-3" style="padding-right:2px;">
							<select id="comunanacionalidad" class="form-control" required>
								<option value="V-">V</option>
								<option value="E-">E</option>
							</select>
						</div>
						<div class="col-xs-8 col-sm-9 col-md-9 col-lg-9" style="padding-left:2px;">
							<input type="text" class="form-control" name="cedula" id="intcomunacedula" placeholder="Cedula" maxlength="8" required>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<select style="width:95%; margin:auto;" id="intcomunacargo" name="cargo" class="form-control" required>
			        <option value="">Elija Comite</option>
			        <option value="parlamento">Parlamento Comunal</option>
			        <option value="ejecutivo">Consejo Ejecutivo</option>
			        <option value="derechos humanos">Comite Derechos Humanos</option>
			        <option value="comite salud">Comite de Salud</option>
			        <option value="tierra">Comite de Tierra Urbana,Vivienda y Habitat</option>
			        <option value="bienes">Comite de Defensa de las Personas en el Acceso de Bienes y Servicios</option>
			        <option value="econimia y produccion">Comite de Economia y produccion comunal</option>
			        <option value="mujer">Comite de Mujer E Iguldad de Genero</option>
			        <option value="defensa y seguridad">comite de Defensa y Seguridad Integral</option>
			        <option value="familia">comite de Familia y proteccion de niños,niñas y Adolecentes</option>
			        <option value="deporte">Comite de Recreacion y deporte</option>
			        <option value="edcucacion">Comite de Educacion Cultura y Fomacion Socialista</option>
			        <option value="planificacion">Consejo de Planificacion Comunal</option>
			        <option value="economia comunal">Consejo de Economia Comunal</option>
			        <option value="administracion">Banco de la Comuna Coordinacion de Administracion</option>
			        <option value="aprobacion">Banco de la Comuna Comite de aprobacion</option>
			        <option value="seguimiento y control">Banco de la Comuna Comite de seguimiento y control</option>
			        <option value="organizaciones socio productiva">Banco de la Comuna Comite de seguimiento y control por las organizaciones socio-productiva</option>
			        <option value="seguimiento y control del parlamento">Banco de la Comuna Comite de seguimiento y control designado por el parlamento comunal</option>
			        <option value="contraloria">Consejo de Contraloria Comunal</option>
				</select>
			</div>
		</div>
			<button type="submit" class="btn btn-success" title="Guardar"><span class="glyphicon glyphicon-ok-sign"></span> Guardar</button>
			<button type="reset" class="btn btn-danger" title="Limpiar"><span class="glyphicon glyphicon-remove-sign"></span> Limpiar</button>
	</form>
	<!-- fin formulario de registro del administrador del los integrantes de las comunas-->

	<!---formulario de registro del administrador del los operadores-->
	<form class="form" id="operador" role="form">
		<h2>Registrar Operador</h2>
		<h3>* Datos Obligatorios</h3>
  		<div class="form-group input-group">
  			<span class="input-group-addon glyphicon glyphicon-asterisk"></span>
			<input type="text" class="form-control" id="nombreoperador" placeholder="Nombre" maxlength="20" required>
  		</div>
  		<div class="form-group input-group">
  			<span class="input-group-addon glyphicon glyphicon-asterisk"></span>
			<input type="password" class="form-control" id="claveoperador" placeholder="Clave" maxlength="12" required>
  		</div>
		<button type="submit" class="btn btn-success" title="Guardar"><span class="glyphicon glyphicon-ok-sign"></span> Guardar</button>
		<button type="reset" class="btn btn-danger" title="Limpiar"><span class="glyphicon glyphicon-remove-sign"></span> Limpiar</button>
	</form>
	 <!-- fin formulario de registro del administrador del los operadores-->

	<!--formulario de registro del administrador de los registros de los voceros electos por parroquia-->
	<form class="form" id="divvocerosparroquia" role="form">
		<h2>Voceros Electos Por Parroquia</h2>
		<h3>* Datos Obligatorios</h3>
		<label for="vocerotipo" role="label">* Elija Gestion Social</label>
		<div class="form-group input-group">
			<span class="input-group-addon" id="ayudavoceroselectos" title="Ayuda"><img margin="0px" padding="0px" width="22px" height="22px" src='../imagenes/ayuda.png'></span>
			<select id="vocerotipo" class="form-control" required>
				<option value="">Elija Gestion Social</option>
				<option value="consejos">Consejos Comunales</option>
				<option value="movimientos">Movimientos Sociales</option>
			</select>
		</div>
		<div class="form-group">
			<label for="voceronacionalida" role="label">* Cedula</label>
			<div class="row" style="margin:0px; padding:0px;">
				<div class="col-xs-1 col-sm-2 col-md-3 col-lg-3">
				</div>
				<div class="col-xs-10 col-sm-8 col-md-6 col-lg-6">
					<div class="row">
						<div class="col-xs-4 col-sm-3 col-md-3 col-lg-3" style="padding:2px;">
							<select id="voceronacionalida" class="form-control" required>
								<option value="V-">V</option>
								<option value="E-">E</option>
							</select>
						</div>
						<div class="col-xs-8 col-sm-9 col-md-9 col-lg-9" style="padding:2px;">
							<input type="text" class="form-control" id="vocerocedula" placeholder="Cedula" maxlength="8" required>
						</div>
					</div>
				</div>
				<div class="col-xs-1 col-sm-2 col-md-3 col-lg-3">
				</div>
			</div>
		</div>
		<button type="submit" class="btn btn-success" title="Guardar"><span class="glyphicon glyphicon-ok-sign"></span> Guardar</button>
		<button type="reset" class="btn btn-danger" title="Limpiar"><span class="glyphicon glyphicon-remove-sign"></span> Limpiar</button>
	</form>
	<!-- fin del formulario de registro del administrador de los registros de
	los voceros electos por parroquia-->

	<!---formulario de registro del administrador de los registro
	 de los consejos comunales en comunas-->
	<form class="form" role="form" id="consejos_comunas">
		<h2>Resgistro de Consejos en Comunas</h2>
		<h4>Todos Los Datos Son Obligatorios</h4>
			<div class="row">
				<div class="col-lg-6">
					<label for="tipocomunascodigorif" role="label">* Elija Relacion de Comunas</label>
					<div class="form-group input-group">
						<span class="input-group-addon" id="ayudacomunaselectrelacion" title="Ayuda"><img margin="0px" padding="0px" width="22px" height="22px" src='../imagenes/ayuda.png'></span>
						<select id="tipocomunascodigorif" class="form-control" required>
							<option value="">Eleija Relacion de Comunas</option>
							<option value="rif">Rif</option>
							<option value="codigo">Codigo</option>
						</select>
					</div>
					<label for="relacioncomunas" role="label">* Digite relacion de comuna</label>
					<div class="form-group input-group">
						<span class="input-group-addon" id="ayudacomunasrelacion" title="Ayuda"><img margin="0px" padding="0px" width="22px" height="22px" src='../imagenes/ayuda.png'></span>
						<input type="text" class="form-control" id="relacioncomunas" placeholder="digite relacion" required>
					</div>
				</div>
				<div class="col-lg-6">
					<label for="tipoconsejoscodigorif" role="label">* Elija Relacion de Consejos</label>
					<div class="form-group input-group">
						<span class="input-group-addon" id="ayudaconsejosselectrelacion" title="Ayuda"><img margin="0px" padding="0px" width="22px" height="22px" src='../imagenes/ayuda.png'></span>
						<select id="tipoconsejoscodigorif" class="form-control" required>
							<option value="">Elija Relacion de Consejos</option>
							<option value="rif">Rif</option>
							<option value="codigo">Codigo</option>
						</select>
					</div>
					<label for="" role="label">* Digite relacion de consejos</label>
					<div class="form-group input-group">
						<span class="input-group-addon" id="ayudaconsejosrelacion" title="Ayuda"><img margin="0px" padding="0px" width="22px" height="22px" src='../imagenes/ayuda.png'></span>
						<input type="text" class="form-control" id="relacionconsejos" placeholder="Digite relacion de consejos" required>
					</div>
				</div>
			</div>
		<button type="submit" class="btn btn-success" title="Guardar" id="registrarconsejosencomunas"><span class="glyphicon glyphicon-ok-sign"></span> Guardar</button>
		<button type="reset" class="btn btn-danger" title="Limpiar" id="eliminarconsejosencomunas"><span class="glyphicon glyphicon-remove-sign"></span> Limpiar</button>
	</form>
	<!-- fin formulario de registro del administrador de los registro
	 de los consejos comunales en comunas-->



	 <!--inicio del menu de registro de los operadores -->
	<?php
	}else if($_SESSION['tipo']=="operador"){
	?>
	<!---formulario de registro del operador -->
	<form class="form" id="formregistrardatos" role="form">
		<h2> Registrar Datos</h2>
		<div class="form-group">
			<select name="tipo" id="tipo" class="form-control" required>
				<option value=""></option>
				<option value="consejos">Registrar Consejos Comunales</option>
				<option value="registrosintegrantesconsejos">Registrar Integrantes de Consejos Comunales</option>
				<option value="comunas">Registrar Comunas</option>
				<option value="registrosintegrantescomunas">Registrar Integrantes de Comunas</option>
				<option value="registrarconsejoscomunas">Registrar Consejos Comunales en Comunas</option>
				<option value="movimientos">Registrar Movimientos Sociales</option>
				<option value="registrosintegrantesmovimientos">Registrar Integrantes de movimientos Sociales</option>
				<option value="voceroporparroquia">Registrar Voceros Electos Por Parroquia</option>
				<option value="consejales">Registrar Concejales</option>
			</select>
		</div>
		<button type="submit" class="btn btn-success" title="Elegir"><span class="glyphicon glyphicon-ok-sign"></span> Elegir</button>
		<button type="reset" class="btn btn-danger" title="Limpiar"><span class="glyphicon glyphicon-remove-sign"></span> Limpiar</button>
		</form>
		<!--- fin formulario de registros del operador -->
	<div id="mensajestodos"></div>

		<!---formulario de registro del operador del los consejos comunales-->
	<form class="form" id="rconsejocomunales" role="form">
		<h2>Consejos comunales</h2>
		<h3>* Datos Obligatorios</h3>
		<div class="form-group input-group">
			<span class="input-group-addon glyphicon glyphicon-asterisk"></span>
		  	<select id="consejoparroquia" name="parroquia" class="form-control" required>
				  <option value="">Elige Parroquia</option>
				  <option value="marhuanta">Marhuanta</option>
				  <option value="agua salada">Agua Salada</option>
				  <option value="sabanita">Sabanita</option>
				  <option value="catedral">Catedral</option>
				  <option value="vista hermosa">Vista Hermosa</option>
				  <option value="jose antonio paez">Jose Antonio Paez</option>
				  <option value="zea">Zea</option>
				  <option value="orinoco">Orinoco</option>
				  <option value="panapana">Panapana</option>
		    </select>
		</div>
		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<div class="form-group">
	       			<label for="sector" role="label">* Sector</label>
		        	<input type="text" class="form-control" name="sector" id="consejosector" placeholder="Sector" required>
				</div>
				<div class="form-group">
		    		<label for="sede" role="label">* Sede</label>
		        	<input type="text" class="form-control" name="sede" id="consejosede"placeholder="Sede" required>
		    	</div>
		    	<div class="form-group">
		    		<label for="rif" role="label">* Rif</label>
		        	<input type="text" class="form-control" name="rif" id="consejorif" placeholder="Rif" required>

		    	</div>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<div class="form-group">
		    		<label for="nombre" role="label">* Nombre</label>
		        	<input type="text" class="form-control" name="nombre" id="consejonombre" placeholder="Nombre" required>
		        </div>
		        <div class="form-group">

		        	<label for="consejosdia" role="label">* Fecha de Adecuacion</label>

		        	<div class="row">
		        		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

		    				<select id="consejosdia" class="form-control" required>
				      			<option value="">DIA </option>
								<option value="01" > 1 </option>
								<option value="02" > 2 </option>
								<option value= "03" > 3 </option>
								<option value= "04" > 4 </option>
								<option value= "05" > 5 </option>
								<option value= "06" > 6 </option>
								<option value= "07" > 7 </option>
								<option value= "08" > 8 </option>
								<option value= "09" > 9 </option>
								<option value= "10" > 10 </option>
								<option value= "11" > 11 </option>
								<option value= "12" > 12 </option>
								<option value= "13" > 13 </option>
								<option value= "14" > 14 </option>
								<option value= "15" > 15 </option>
								<option value= "16" > 16 </option>
								<option value= "17" > 17 </option>
								<option value= "18" > 18 </option>
								<option value= "19" > 19 </option>
								<option value= "20" > 20 </option>
								<option value= "21" > 21 </option>
								<option value= "22" > 22 </option>
								<option value= "23" > 23 </option>
								<option value= "24" > 24 </option>
								<option value= "25" > 25 </option>
								<option value= "26" > 26 </option>
								<option value= "27" > 27 </option>
								<option value= "28" > 28 </option>
								<option value= "29" > 29 </option>
								<option value= "30" > 30 </option>
								<option value= "31" > 31 </option>
		      				</select>
		      			</div>
		      			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
		      				<select id="consejosmes" class="form-control" required>
					      		<option value="">MES</option>
					      		<option value= "01" > 1 </option>
								<option value= "02" > 2 </option>
								<option value= "03" > 3 </option>
								<option value= "04" > 4 </option>
								<option value= "05" > 5 </option>
								<option value= "06" > 6 </option>
								<option value= "07" > 7 </option>
								<option value= "08" > 8 </option>
								<option value= "09" > 9 </option>
								<option value= "10" > 10 </option>
								<option value= "11" > 11 </option>
								<option value= "12" > 12 </option>
		      				</select>
		      			</div>
		      			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
		      				<select id="consejosanios" class="form-control" required>
								<option value="">AÑO</option>
								<?php

									for($i=Date("Y"); $i>=1998; $i--)
									{
										echo "<option value='{$i}'>{$i}</option>";
									}
								 ?>
		      				</select>
		      			</div>
		      		</div>
		    	</div>
		    	<div class="form-group">
		    		<label for="clave" role="label">* Clave</label>
		    		<input type="text" class="form-control" name="clave" id="consejoclave" placeholder="clave" required>
		    	</div>
			</div>
		</div>
		<h2>Anexos</h2>
		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<div class="form-group">
					<label for="consejosacta" role="label">Acta Constitutiva</label>
					<input type="checkbox" class="form-control"  id="consejosacta" value="si">
				</div>

				<div class="form-group">
					<label for="consejoscertificado" role="label">Certificado de Registro</label>
					<input type="checkbox" class="form-control"  id="consejoscertificado" value="si">
				</div>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<div class="form-group">
					<label for="consejosmiembro" role="label">Nomina de Miembros</label>
					<input type="checkbox" class="form-control"   id="consejosmiembro" value="si">
				</div>
				<div class="form-group">
					<label for="consejoscedulas" role="label">Cedula de Miembros</label>
					<input type="checkbox" class="form-control"  id="consejoscedulas" value="si">
				</div>
			</div>
		</div>
		      <button type="submit" class="btn btn-success" title="Guardar"><span class="glyphicon glyphicon-ok-sign"></span> Guardar</button>
		      <button type="reset" class="btn btn-danger" title="Limpiar"><span class="glyphicon glyphicon-remove-sign"></span> Limpiar</button>
	</form>

		<!--- fin formulario de registro del operador del los consejos comunales-->

		<!---formulario de registro del operador del los integrantes de los consejos comunales-->
	<form class="form" id="integrantesconsejos" role="form">
		<h2>Integrantes consejos comunales </h2>
		<h3>* Datos Obligatorios</h3>
		<div class="form-group input-group">
		<span class="input-group-addon glyphicon glyphicon-asterisk"></span>
			<select  id="tipointconsejos" class="form-control" required>
				<option value="">Elija tipo de vocero</option>
				<option value="principal">Principal</option>
				<option value="suplente">Suplente</option>
			</select>
		</div>
		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<div class="form-group">
					<label for="unidad" role="label">* Elija Unidad</label>
					<select id="unidad" class="form-control" required>
						<option value=''>Elija Unidad</option>
						<option value="ejecutiva">Unidad Ejecutiva</option>
						<option value="administrativa">Administrativa y Financiera</option>
						<option value="contraloria">Contraloria Social</option>
					</select>
				</div>
				<label for="tiporifcodigoconsejos" role="label">* Elija Relacion</label>
				<div class="form-group input-group">
					<span id="ayudaintconsejosselectrelacion" title="Ayuda" class="input-group-addon"><img margin="0px" padding="0px" width="22px" height="22px" src='../imagenes/ayuda.png'></span>
						<select id="tiporifcodigoconsejos" class="form-control" required>
							<option value="">Elija Relacion</option>
							<option value="rif">Rif</option>
							<option value="codigo_gestion">Codigo</option>
						</select>

				</div>
				<label for="relacion" role="label">* Relacion</label>
				<div class="form-group input-group">
					<span id="ayudaintconsejosrelacion" title="Ayuda" class="input-group-addon "><img margin="0px" padding="0px" width="22px" height="22px" src='../imagenes/ayuda.png'></span>
					<input type="text" class="form-control" name="relacion" id="intconsejosrelacion" required>
				</div>
				<div class="form-group">
					<label for="nombre" role="label">* Nombre</label>
					<input type="text" class="form-control" name="nombre" id="intconsejosnombre" placeholder="Nombre" maxlength="15" required>
				</div>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<div class="form-group">
					<label for="apellido" role="label">* Apellido</label>
					<input type="text" class="form-control" name="apellido" id="intconsejosapellido" placeholder="Apellido" maxlength="15" required>
				</div>
				<div class="form-group">
					<label for="consejosnacionalidad" role="label">* Cedula</label>
					<div class="row">
						<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="padding-right:2px;">
							<select id="consejosnacionalidad" class="form-control" required>
								<option value="V-">V</option>
								<option value="E-">E</option>
							</select>
						</div>
						<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9" style="padding-left:2px;">
							<input type="text" class="form-control" name="cedula" id="intconsejoscedula" placeholder="Cedula" maxlength="8" required>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="consejocodigotelefono" role="label"> Telefono</label>
					<div class="row">
						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding-right:2px;">
							<select id="consejocodigotelefono" class="form-control">
								<option value="">Codigo</option>
								<option value="0412">0412</option>
								<option value="0416">0416</option>
								<option value="0426">0426</option>
								<option value="0414">0414</option>
								<option value="0424">0424</option>
								<option value="0285">0285</option>
							</select>
						</div>
						<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" style="padding-left:2px;">
							<input type="text" class="form-control" name= "telefono" id="intconsejostelefono" placeholder="Telefono" maxlength="7">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="cargo" role="label">* Comite</label>
					<input type="text" class="form-control" name="cargo" id="intconsejoscargo" placeholder="Comite" required>
				</div>
			</div>
		</div>

		<button type="submit" class="btn btn-success" title="Guardar"><span class="glyphicon glyphicon-ok-sign"></span> Guardar</button>
		<button type="reset" class="btn btn-danger" title="Limpiar"><span class="glyphicon glyphicon-remove-sign"></span> Limpiar</button>
	</form>
		<!--- fin formulario de registro del operador del los integrantes
		 de los consejos comunales-->

		 <!---formulario de registro del operador del las comunas socialistas-->
	<form class="form" id="rcomunas" role="form">
		<h2>Comunas</h2>
		<h3>* Datos Obligatorios</h3>
		<div class="form-group input-group">
			<span class="input-group-addon glyphicon glyphicon-asterisk"></span>
			<select id="comunaparroquia" class="form-control" required>
				  <option value="">Elija Parroquia</option>
				  <option value="marhuanta">Marhuanta</option>
				  <option value="agua salada">Agua Salada</option>
				  <option value="sabanita">Sabanita</option>
				  <option value="catedral">Catedral</option>
				  <option value="vista hermosa">Vista Hermosa</option>
				  <option value="jose antonio paez">Jose Antonio Paez</option>
				  <option value="zea">Zea</option>
				  <option value="orinoco">Orinoco</option>
				  <option value="panapana">Panapana</option>
		      </select>
		</div>
		<div class="row">
			<div class="col-sm-6 col-md-6 col-lg-6">
				<div class="form-group">
					<label for="sector" role="label">* Sector</label>
		    		<input type="text" class="form-control" name="sector" id="comunasector"placeholder="Sector" required>
		    	</div>
		    	<div class="form-group">
		    		<label for="sede" role="label">* Sede</label>
		      		<input type="text" class="form-control" name="sede" id="comunasede"placeholder="Sede" required>
		   		</div>
		    	<div class="form-group">
		    		<label for="rif" role="label">* Rif</label>
		      		<input type="text" class="form-control" name="rif" id="comunarif" placeholder="Rif" required>
		    	</div>
		    </div>
		    <div class="col-sm-6 col-md-6 col-lg-6">
		    	<div class="form-group">
		    		<label for="nombre" role="label">* Nombre</label>
		      		<input type="text" class="form-control" name="nombre" id="comunanombre" placeholder="Nombre" required>
		    	</div>
		    	<div class="form-group">
		    		<label for="comunasdia" role="label">* Fecha de Adecuacion</label>
	      			<div class="row">
	      				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
		      				<select id="comunasdia" class="form-control" required>
				      			<option value="">DIA </option>
								<option value="01" > 1 </option>
								<option value="02" > 2 </option>
								<option value= "03" > 3 </option>
								<option value= "04" > 4 </option>
								<option value= "05" > 5 </option>
								<option value= "06" > 6 </option>
								<option value= "07" > 7 </option>
								<option value= "08" > 8 </option>
								<option value= "09" > 9 </option>
								<option value= "10" > 10 </option>
								<option value= "11" > 11 </option>
								<option value= "12" > 12 </option>
								<option value= "13" > 13 </option>
								<option value= "14" > 14 </option>
								<option value= "15" > 15 </option>
								<option value= "16" > 16 </option>
								<option value= "17" > 17 </option>
								<option value= "18" > 18 </option>
								<option value= "19" > 19 </option>
								<option value= "20" > 20 </option>
								<option value= "21" > 21 </option>
								<option value= "22" > 22 </option>
								<option value= "23" > 23 </option>
								<option value= "24" > 24 </option>
								<option value= "25" > 25 </option>
								<option value= "26" > 26 </option>
								<option value= "27" > 27 </option>
								<option value= "28" > 28 </option>
								<option value= "29" > 29 </option>
								<option value= "30" > 30 </option>
								<option value= "31" > 31 </option>
		      				</select>
		      			</div>
		      			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				      		<select id="comunasmes" class="form-control" required>
					      		<option value="">MES</option>
					      		<option value= "01" > 1 </option>
								<option value= "02" > 2 </option>
								<option value= "03" > 3 </option>
								<option value= "04" > 4 </option>
								<option value= "05" > 5 </option>
								<option value= "06" > 6 </option>
								<option value= "07" > 7 </option>
								<option value= "08" > 8 </option>
								<option value= "09" > 9 </option>
								<option value= "10" > 10 </option>
								<option value= "11" > 11 </option>
								<option value= "12" > 12 </option>
				      		</select>
				      	</div>
				      	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
					      	<select id="comunasanios" class="form-control" required>
								<option value="">AÑO</option>
								<?php
									for($i=Date("Y");$i>=1998;$i--)
									{
										echo "<option value='{$i}'>{$i}</option>";
									}
								 ?>
					      	</select>
					    </div>
	      			</div>
		    	</div>
		    	<div class="form-group">
		    		<label for="clave" role="label">* Clave</label>
		      		<input type="text" class="form-control" name="clave"  id="comunaclave" placeholder="clave" required>
		    	</div>
		    </div>
		</div>
		<h2>Anexos</h2>

		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<div>
					<div class="form-group">
						<label for="" role="label">Constancia de Elección</label>
						<input type="checkbox" class="form-control" value="si" id="comunaanexoconstancia">
					</div>
					<div class="form-group">
						<label for="" role="label">Acta de Constitutiva</label>
						<input type="checkbox" class="form-control" value="si" id="comunaanexoacta">
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<div class="form-group">
						<label for="" role="label">Certificado de registro</label>
						<input type="checkbox" class="form-control" value="si" id="comunaanexoregistro">
					</div>
					<div class="form-group">
						<label for="" role="label">Cedulas de miembros</label>
						<input type="checkbox" class="form-control" value="si" id="comunaanexocedula">
					</div>

			</div>
		</div>
		<button type="submit" class="btn btn-success" title="Guardar"><span class="glyphicon glyphicon-ok-sign"></span> Guardar</button>
		<button type="reset" class="btn btn-danger" title="Limpiar"><span class="glyphicon glyphicon-remove-sign"></span> Limpiar</button>
	</form>
   <!--- fin formulario de registro del operador del las comunas socialistas-->

    <!---formulario de registro del operador del los movimientos sociales-->
	<form class="form" role="form" id="rmovimientossociales">
		<h2>Movimientos Sociales</h2>
		<h3>* Datos Obligatorios</h3>

	 	<div id="hijomovimientos">
	 		<div class="row">
	 			<div class="col-sm-6 col-md-6 col-lg-6">
		 			<div class="form-group">
		 				<label for="parroquia" role="label">* Parroquia</label>
			 			<select id="moviparroquia" name="parroquia" class="form-control" required>
							<option value="">Elije Parroquia</option>
					  		<option value="marhuanta">Marhuanta</option>
					  		<option value="agua salada">Agua Salada</option>
					  		<option value="sabanita">Sabanita</option>
					  		<option value="catedral">Catedral</option>
					  		<option value="vista hermosa">Vista Hermosa</option>
					  		<option value="jose antonio paez">Jose Antonio Paez</option>
					  		<option value="zea">Zea</option>
					  		<option value="orinoco">Orinoco</option>
					  		<option value="panapana">Panapana</option>
						</select>
		  			</div>
					<div class="form-group">
						<label for="tipo" role="label">* Tipo De Movimiento</label>
						<select name="tipo" id="movitipo" class="form-control" required>
							<option value="">Elija tipo</option>
							<option value="campesino">Campesino</option>
							<option value="trabajadores">Trabajadores</option>
							<option value="intelectuales">Intelectuales</option>
							<option value="pescadores">Pescadores</option>
							<option value="deportista">Deportista</option>
							<option value="mujeres">Mujeres</option>
							<option value="culturales">Culturales</option>
							<option value="juventud">Juventud</option>
							<option value="asociacion civil">Asociacion Civil</option>
							<option value="cooperativa">Cooperativa</option>
						</select>
					</div>
					<div class="form-group">
						<label for="sector" role="label">* Sector</label>
						<input type="text" class="form-control" name="sector" id="movisector" placeholder="Sector" required>
					</div>
					<div class="form-group">
						<label for="sede" role="label">* Sede</label>
						<input type="text" class="form-control" name="sede"  id="movisede" placeholder="Sede" required>
					</div>
				</div>
				<div class="col-sm-6 col-md-6 col-lg-6">
					<div class="form-group">
						<label for="rif" role="label">* Rif</label>
						<input type="text" class="form-control" name="rif" id="movirif"placeholder="Rif" required>
					</div>
					<div class="form-group">
						<label for="nombre" role="label">* Nombre</label>
						<input type="text" class="form-control" name="nombre" id="movinombre" placeholder="Nombre" required>
					</div>
				      	<div class="form-group" id="adecuacion">
				      		<label for="movimientosdia" role="label">* Fecha de Adecuacion</label>
				      		<div class="row">
				      			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
					      			<select id="movimientosdia" class="form-control" required>
						      			<option value="">DIA </option>
										<option value="01" > 1 </option>
										<option value="02" > 2 </option>
										<option value= "03" > 3 </option>
										<option value= "04" > 4 </option>
										<option value= "05" > 5 </option>
										<option value= "06" > 6 </option>
										<option value= "07" > 7 </option>
										<option value= "08" > 8 </option>
										<option value= "09" > 9 </option>
										<option value= "10" > 10 </option>
										<option value= "11" > 11 </option>
										<option value= "12" > 12 </option>
										<option value= "13" > 13 </option>
										<option value= "14" > 14 </option>
										<option value= "15" > 15 </option>
										<option value= "16" > 16 </option>
										<option value= "17" > 17 </option>
										<option value= "18" > 18 </option>
										<option value= "19" > 19 </option>
										<option value= "20" > 20 </option>
										<option value= "21" > 21 </option>
										<option value= "22" > 22 </option>
										<option value= "23" > 23 </option>
										<option value= "24" > 24 </option>
										<option value= "25" > 25 </option>
										<option value= "26" > 26 </option>
										<option value= "27" > 27 </option>
										<option value= "28" > 28 </option>
										<option value= "29" > 29 </option>
										<option value= "30" > 30 </option>
										<option value= "31" > 31 </option>
							      	</select>
							    </div>
							    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
							      	<select id="movimientosmes" class="form-control" required>
							      		<option value="">MES</option>
							      		<option value= "01" > 1 </option>
										<option value= "02" > 2 </option>
										<option value= "03" > 3 </option>
										<option value= "04" > 4 </option>
										<option value= "05" > 5 </option>
										<option value= "06" > 6 </option>
										<option value= "07" > 7 </option>
										<option value= "08" > 8 </option>
										<option value= "09" > 9 </option>
										<option value= "10" > 10 </option>
										<option value= "11" > 11 </option>
										<option value= "12" > 12 </option>
							      	</select>
							    </div>
							    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
					      			<select id="movimientosanios" class="form-control" required>
										<option value="">AÑO</option>

										<?php
										for($i=Date("Y");$i>=1945;$i--)
										{
											echo "<option value='{$i}'>{$i}</option>";
										}
										 ?>
					      			</select>
					      		</div>
				      		</div>
				      	</div>
				  		<div class="form-group">
				  			<label for="clave" role="label">* Clave</label>
				      		<input type="text" class="form-control" name="clave" id="moviclave" placeholder="clave" required>
				  		</div>
				</div>
		  	</div>
		</div>
		<h2>Anexos</h2>
		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<div id="movirecaudos">
					<div class="form-group">
						<label for="acta" role="label">Acta Constitutiva</label>
						<input type="checkbox" value="si" id="acta" class="form-control">
					</div>
					<div class="form-group">
						<label for="constancia" role="label">Constancia de Elecciones</label>
						<input type="checkbox" value="si" id="constancia" class="form-control">
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<div class="form-group">
					<label for="" role="label">Nomina de Miembros</label>
					<input type="checkbox" value="si" id="miembro" class="form-control">
				</div>
				<div class="form-group">
					<label for="" role="label">Cedula de Miembros</label>
					<input type="checkbox" value="si" id="cedulas" class="form-control">
				</div>
			</div>
		</div>
		<button type="submit" class="btn btn-success"  title="Guardar"><span class="glyphicon glyphicon-ok-sign"></span> Guardar</button>
		<button type="reset" class="btn btn-danger" title="Limpiar"><span class="glyphicon glyphicon-remove-sign"></span> Limpiar</button>
	</form>
		<!--- fin formulario de registro del operador del los movimientos sociales-->

		<!---formulario de registro del operador del los concejales-->

	<form class="form" id="rconsejales" role="form">
		<h2>Concejales</h2>
		<h3>* Datos Obligatorios</h3>
		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">

			  	<div class="form-group">
			  		<label for="nombre" role="label">* Nombre</label>
					<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" maxlength="20" required>
			  	</div>
			  	<div class="form-group">
			  		<label for="apellido" role="label">* Apellido</label>
					<input type="text" class="form-control" name="apellido" id="apellido" placeholder="Apellido" maxlength="20" required>
			  	</div>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<div>
					<div class="form-group">
						<label for="consejalescodigocedula" role="label">* Cedula</label>
						<div class="row">
							<div class="col-xs-4 col-sm-3 col-md-3 col-lg-3" style="padding-right:2px;">
								<select id="consejalescodigocedula" class="form-control" required>
									<option value="V-">V</option>
									<option value="E-">E</option>
								</select>
							</div>
							<div class="col-xs-8 col-sm-9 col-md-9 col-lg-9" style="padding-left:2px;">
								<input type="text" class="form-control" name="cedula" id="cedula" placeholder="Cedula" maxlength="8" required>
							</div>
						</div>
					</div>
				</div>
				<div>
					<div class="form-group">
						<label for="consejalescodigotelefono" role="label">Teléfono</label>
						<div class="row">
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding-right:2px;">
								<select id="consejalescodigotelefono" class="form-control">
									<option value="">Codigo</option>
									<option value="0412">0412</option>
									<option value="0416">0416</option>
									<option value="0426">0426</option>
									<option value="0414">0414</option>
									<option value="0424">0424</option>
									<option value="0285">0285</option>
								</select>
							</div>
							<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" style="padding-left:2px;">
								<input type="text" class="form-control" name="telefono" id="telefono" placeholder="Telefono" maxlength="7">
							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="col-md-12">
			<div class="form-group">
					<label for="clave" role="label">* Clave</label>
					<input type="text" class="form-control" name="clave" id="clave" placeholder="Clave" maxlength="12" required>
				</div>
			</div>
			<button type="submit" class="btn btn-success" title="Guardar"><span class="glyphicon glyphicon-ok-sign"></span> Guardar</button>
			<button type="reset" class="btn btn-danger" title="Limpiar"><span class="glyphicon glyphicon-remove-sign"></span> Limpiar</button>
		</div>
	</form>
		<!--- fin formulario de registro del operador del los concejales-->

		<!---formulario de registro del operador del los integrantes de los movimientos sociales-->
	<form class="form" role="form" id="integrantesmovimientos">
		<h2>Integrantes de Movimientos </h2>
		<h3>* Datos Obligatorios</h3>
		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<div class="form-group">
					<label for="tipointmovi" role="label">* Tipo Vocero</label>
					<select  id="tipointmovi" class="form-control" required>
						<option value="">Elija Tipo de  Vocero</option>
						<option value="principal">Principal</option>
						<option value="suplente">Suplente</option>
					</select>
				</div>
				<div>
					<label for="tiporifcodigo" role="label">* Elija Relacion</label>
					<div class="form-group input-group">
						<span class="input-group-addon" id="ayudaintmovimientosselectrelacion"  title="Ayuda"><img margin="0px" padding="0px" width="22px" height="22px" src='../imagenes/ayuda.png'></span>
						<select id="tiporifcodigo" class="form-control" required>
							<option value="">Elija Relacion</option>
							<option value="rif">Rif</option>
							<option value="codigo_gestion">Codigo</option>
						</select>
					</div>
				</div>
					<label for="relacion" role="label">* Realcion</label>
					<div class="form-group input-group">
						<span class="input-group-addon" id="ayudaintmovimientosrelacion" title="Ayuda"><img margin="0px" padding="0px" width="22px" height="22px" src='../imagenes/ayuda.png'></span>
						<input type="text" class="form-control" name="relacion" id="intmovirelacion" placeholder="Digite relacion" required>
					</div>
				<div class="form-group">
					<label for="nombre" role="label">* Nombre</label>
					<input type="text" class="form-control" name="nombre" id="intmovinombre" placeholder="Nombre" maxlength="15" required>
				</div>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<div class="form-group">
					<label for="apellido" role="label">* Apellido</label>
					<input type="text" class="form-control" name="apellido" id="intmoviapellido" placeholder="Apellido" maxlength="15" required>
				</div>
				<div>
					<div class="form-group">
						<label for="movimientosnacionalidad" role="label">* Cedula</label>
						<div class="row">
							<div class="col-xs-4 col-sm-3 col-md-3 col-lg-3" style="padding-right:2px;">
								<select id="movimientosnacionalidad" class="form-control" required>
									<option value="V-">V</option>
									<option value="E-">E</option>
								</select>
							</div>
							<div class="col-xs-8 col-sm-9 col-md-9 col-lg-9" style="padding-left:2px;">
								<input type="text" class="form-control" name="cedula" id="intmovicedula" placeholder="Cedula" maxlength="8" required>
							</div>
						</div>
					</div>
				</div>
				<div>
					<div class="form-group">
						<label for="movimientoscodigotelefono" role="label">Telefono</label>
						<div class="row">
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding-right:2px;">
								<select id="movimientoscodigotelefono" class="form-control">
									<option value="">Codigo</option>
									<option value="0412">0412</option>
									<option value="0416">0416</option>
									<option value="0426">0426</option>
									<option value="0414">0414</option>
									<option value="0424">0424</option>
									<option value="0285">0285</option>
								</select>
							</div>
							<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" style="padding-left:2px;">
								<input type="text" class="form-control" name= "telefono" id="intmovitelefono" placeholder="Telefono" maxlength="7">
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="cargo" role="label">* Cargo</label>
					<input type="text" class="form-control" name="cargo" id="intmovicargo" placeholder="Cargo" required>
				</div>
			</div>
		</div>
		<button type="submit" class="btn btn-success" title="Guardar"><span class="glyphicon glyphicon-ok-sign"></span> Guardar</button>
		<button type="reset" class="btn btn-danger" title="Limpiar"><span class="glyphicon glyphicon-remove-sign"></span> Limpiar</button>
	</form>
<!-- fin formulario de registro del operador del los integrantes de los movimientos sociales-->

<!---formulario de registro del operador del los integrantes de las comunas-->
	<form class="form" id="integrantescomunas" role="form">

			<h2>Integrantes de Comunas </h2>
			<h3>* Datos Obligatorios</h3>
			<div id="tipogestion" class="hidden">consejos</div>
		<div class="row">
			<div class="col-xs-7 col-sm-6 col-md-6 col-lg-6">
				<div class="form-group">
					<label for="tipointcomuna" role="label">* tipo de Vocero</label>
					<select  id="tipointcomuna" class="form-control" required>
						<option value="">Elija tipo de Vocero</option>
						<option value="principal">Principal</option>
						<option value="suplente">Suplente</option>
					</select>
				</div>
				<label for="tiporifcodigocomuna" role="label">* elija Relacion</label>
				<div class="form-group input-group">
						<span class="input-group-addon" id="ayudaintcomunasselectrelacion"  title="Ayuda"><img margin="0px" padding="0px" width="22px" height="22px" src='../imagenes/ayuda.png'></span>
						<select id="tiporifcodigocomuna" class="form-control" required>
							<option value="">Elieja Relacion</option>
							<option value="rif">Rif</option>
							<option value="codigo">Codigo</option>
						</select>
				</div>
			</div>
			<div class="col-xs-5 col-sm-6 col-md-6 col-lg-6">
				<label for="relacion" role="label">* Relacion</label>
				<div class="form-group input-group">
					<span class="input-group-addon" id="ayudaintcomunasrelacion" title="Ayuda"><img margin="0px" padding="0px" width="22px" height="22px" src='../imagenes/ayuda.png'></span>
					<input type="text" name="relacion" id="intcomunarelacion" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="cedula" role="label">* Cedula</label>
					<div class="row">
						<div class="col-xs-4 col-sm-3 col-md-3 col-lg-3" style="padding-right:2px;">
							<select id="comunanacionalidad" class="form-control" required>
								<option value="V-">V</option>
								<option value="E-">E</option>
							</select>
						</div>
						<div class="col-xs-8 col-sm-9 col-md-9 col-lg-9" style="padding-left:2px;">
							<input type="text" class="form-control" name="cedula" id="intcomunacedula" placeholder="Cedula" maxlength="8" required>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="form-group">
				<select style="width:95%; margin:auto;" id="intcomunacargo" name="cargo" class="form-control" required>
			        <option value="">Elija Comite</option>
			        <option value="parlamento">Parlamento Comunal</option>
			        <option value="ejecutivo">Consejo Ejecutivo</option>
			        <option value="derechos humanos">Comite Derechos Humanos</option>
			        <option value="comite salud">Comite de Salud</option>
			        <option value="tierra">Comite de Tierra Urbana,Vivienda y Habitat</option>
			        <option value="bienes">Comite de Defensa de las Personas en el Acceso de Bienes y Servicios</option>
			        <option value="econimia y produccion">Comite de Economia y produccion comunal</option>
			        <option value="mujer">Comite de Mujer E Iguldad de Genero</option>
			        <option value="defensa y seguridad">comite de Defensa y Seguridad Integral</option>
			        <option value="familia">comite de Familia y proteccion de niños,niñas y Adolecentes</option>
			        <option value="deporte">Comite de Recreacion y deporte</option>
			        <option value="educacion">Comite de Educacion Cultura y Fomacion Socialista</option>
			        <option value="planificacion">Consejo de Planificacion Comunal</option>
			        <option value="economia comunal">Consejo de Economia Comunal</option>
			        <option value="administracion">Banco de la Comuna Coordinacion de Administracion</option>
			        <option value="aprobacion">Banco de la Comuna Comite de aprobacion</option>
			        <option value="seguimiento y control">Banco de la Comuna Comite de seguimiento y control</option>
			        <option value="organizaciones socio productiva">Banco de la Comuna Comite de seguimiento y control por las organizaciones socio-productiva</option>
			        <option value="seguimiento y control del parlamento">Banco de la Comuna Comite de seguimiento y control designado por el parlamento comunal</option>
			        <option value="contraloria">Consejo de Contraloria Comunal</option>
				</select>
			</div>
		</div>
		</div>
			<button type="submit" class="btn btn-success" title="Guardar"><span class="glyphicon glyphicon-ok-sign"></span> Guardar</button>
			<button type="reset" class="btn btn-danger" title="Limpiar"><span class="glyphicon glyphicon-remove-sign"></span> Limpiar</button>
	</form>
	<!-- fin formulario de registro del operador del los integrantes de las comunas-->



	<!--formulario de registro del operador de los registros de los voceros electos por parroquia-->
	<form class="form" id="divvocerosparroquia" role="form">
		<h2>Voceros Electos Por Parroquia</h2>
		<h3>* Datos Obligatorios</h3>
		<label for="vocerotipo" role="label">* Elija Gestion Social</label>
		<div class="form-group input-group">
			<span class="input-group-addon" id="ayudavoceroselectos" title="Ayuda"><img margin="0px" padding="0px" width="22px" height="22px" src='../imagenes/ayuda.png'></span>
			<select id="vocerotipo" class="form-control" required>
				<option value="">Elija Gestion Social</option>
				<option value="consejos">Consejos Comunales</option>
				<option value="movimientos">Movimientos Sociales</option>
			</select>
		</div>
		<div class="form-group">
			<label for="voceronacionalida" role="label">* Cedula</label>
			<div class="row" style="margin:0px; padding:0px;">
				<div class="col-xs-1 col-sm-2 col-md-3 col-lg-3">
				</div>
				<div class="col-xs-10 col-sm-8 col-md-6 col-lg-6">
					<div class="row">
						<div class="col-xs-4 col-sm-3 col-md-3 col-lg-3" style="padding:2px;">
							<select id="voceronacionalida" class="form-control" required>
								<option value="V-">V</option>
								<option value="E-">E</option>
							</select>
						</div>
						<div class="col-xs-8 col-sm-9 col-md-9 col-lg-9" style="padding:2px;">
							<input type="text" class="form-control" id="vocerocedula" placeholder="Cedula" maxlength="8" required>
						</div>
					</div>
				</div>
				<div class="col-xs-1 col-sm-2 col-md-3 col-lg-3">
				</div>
			</div>
		</div>
		<button type="submit" class="btn btn-success" title="Guardar"><span class="glyphicon glyphicon-ok-sign"></span> Guardar</button>
		<button type="reset" class="btn btn-danger" title="Limpiar"><span class="glyphicon glyphicon-remove-sign"></span> Limpiar</button>
	</form>
	<!-- fin del formulario de registro del operador de los registros de
	los voceros electos por parroquia-->

	<!---formulario de registro del operador de los registro
	 de los consejos comunales en comunas-->
	<form class="form" role="form" id="consejos_comunas">
		<h2>Resgistro de Consejos en Comunas</h2>
		<h4>Todos Los Datos Son Obligatorios</h4>
			<div class="row">
				<div class="col-lg-6">
					<label for="tipocomunascodigorif" role="label">* Elija Relacion de Comunas</label>
					<div class="form-group input-group">
						<span class="input-group-addon" id="ayudacomunaselectrelacion" title="Ayuda"><img margin="0px" padding="0px" width="22px" height="22px" src='../imagenes/ayuda.png'></span>
						<select id="tipocomunascodigorif" class="form-control" required>
							<option value="">Eleija Relacion de Comunas</option>
							<option value="rif">Rif</option>
							<option value="codigo">Codigo</option>
						</select>
					</div>
					<label for="relacioncomunas" role="label">* Digite relacion de comuna</label>
					<div class="form-group input-group">
						<span class="input-group-addon" id="ayudacomunasrelacion" title="Ayuda"><img margin="0px" padding="0px" width="22px" height="22px" src='../imagenes/ayuda.png'></span>
						<input type="text" class="form-control" id="relacioncomunas" placeholder="digite relacion" required>
					</div>
				</div>
				<div class="col-lg-6">
					<label for="tipoconsejoscodigorif" role="label">* Elija Relacion de Consejos</label>
					<div class="form-group input-group">
						<span class="input-group-addon" id="ayudaconsejosselectrelacion" title="Ayuda"><img margin="0px" padding="0px" width="22px" height="22px" src='../imagenes/ayuda.png'></span>
						<select id="tipoconsejoscodigorif" class="form-control" required>
							<option value="">Elija Relacion de Consejos</option>
							<option value="rif">Rif</option>
							<option value="codigo">Codigo</option>
						</select>
					</div>
					<label for="" role="label">* Digite relacion de consejos</label>
					<div class="form-group input-group">
						<span class="input-group-addon" id="ayudaconsejosrelacion" title="Ayuda"><img margin="0px" padding="0px" width="22px" height="22px" src='../imagenes/ayuda.png'></span>
						<input type="text" class="form-control" id="relacionconsejos" placeholder="Digite relacion de consejos" required>
					</div>
				</div>
			</div>
		<button type="submit" class="btn btn-success" title="Guardar" id="registrarconsejosencomunas"><span class="glyphicon glyphicon-ok-sign"></span> Guardar</button>
		<button type="reset" class="btn btn-danger" title="Limpiar" id="eliminarconsejosencomunas"><span class="glyphicon glyphicon-remove-sign"></span> Limpiar</button>
	</form>
	<!-- fin formulario de registro de los registro
	 de los consejos comunales en comunas-->


	<?php
	}
	?>
	<script src="../javascript/registrar.js"></script>
	<br><br>
	</body>
</html>
<?php
}else{
?>
<script>
window.location="../index.php";
</script>
<?php
}
?>
