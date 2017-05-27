$(document).ready(function(){
//boton de limpiar el select de los registro

//select del registro
$("#formregistrardatos").on("submit", function(e){
    e.preventDefault();
var opcion = $("#tipo").val();
if(opcion==""){
$("#rconsejocomunales, #rcomunas, #rmovimientossociales, #rconsejales, #integrantesmovimientos, #integrantescomunas, #integrantesconsejos, #operador, #divvocerosparroquia, #consejos_comunas").fadeOut(300).css("display","none");
}else{

if(opcion=="registrarconsejoscomunas"){
$("#consejos_comunas").fadeIn(300).css("display","block");
$("#rcomunas , #rmovimientossociales , #rconsejales, #integrantesmovimientos, #integrantescomunas, #integrantesconsejos, #operador, #divvocerosparroquia, #rconsejocomunales").fadeOut(300).css("display","none");

}else if(opcion=="consejos"){
$("#rconsejocomunales").fadeIn(300).css("display","block");
$("#rcomunas , #rmovimientossociales , #rconsejales, #integrantesmovimientos, #integrantescomunas, #integrantesconsejos, #operador, #divvocerosparroquia, #consejos_comunas").fadeOut(300).css("display","none");

}else if(opcion=="comunas"){
$("#rcomunas").fadeIn(300).css("display","block");
$("#rconsejocomunales ,  #rmovimientossociales , #rconsejales, #integrantesmovimientos, #integrantescomunas, #integrantesconsejos, #operador, #divvocerosparroquia, #consejos_comunas").fadeOut(300).css("display","none");

}else if(opcion=="movimientos"){
$("#rmovimientossociales").fadeIn(300).css("display","block");
$("#rconsejocomunales , #rcomunas , #rconsejales, #integrantesmovimientos, #integrantescomunas, #integrantesconsejos, #operador, #divvocerosparroquia, #consejos_comunas").fadeOut(300).css("display","none");

}else if(opcion=="consejales"){
$("#rconsejales").fadeIn(300).css("display","block");
$("#rconsejocomunales , #rcomunas , #rmovimientossociales, #integrantesmovimientos, #integrantescomunas, #integrantesconsejos, #operador, #divvocerosparroquia, #consejos_comunas").fadeOut(300).css("display","none");

}else if(opcion=="registrosintegrantesmovimientos"){
$("#integrantesmovimientos").fadeIn(300).css("display","block");
$("#rconsejocomunales , #rcomunas , #rmovimientossociales, #rconsejales, #integrantescomunas, #integrantesconsejos, #operador, #divvocerosparroquia, #consejos_comunas").fadeOut(300).css("display","none");

}else if(opcion=="registrosintegrantescomunas"){
$("#integrantescomunas").fadeIn(300).css("display","block");
$("#rconsejocomunales , #rcomunas , #rmovimientossociales, #rconsejales, #integrantesmovimientos, #integrantesconsejos, #operador, #divvocerosparroquia, #consejos_comunas").fadeOut(300).css("display","none");

}else if(opcion=="registrosintegrantesconsejos"){
$("#integrantesconsejos").fadeIn(300).css("display", "block");
$("#rconsejocomunales, #rcomunas, #rmovimientossociales, #rconsejales, #integrantesmovimientos, #integrantescomunas, #operador, #divvocerosparroquia, #consejos_comunas").fadeOut(300).css("display","none");

}else if(opcion=="registrooperador"){
$("#operador").fadeIn(300).css("display","block");
$("#rconsejocomunales, #rcomunas, #rmovimientossociales, #rconsejales, #integrantesmovimientos, #integrantescomunas, #integrantesconsejos, #divvocerosparroquia, #consejos_comunas").fadeOut(300).css("display","none");

}else if(opcion=="voceroporparroquia"){
$("#divvocerosparroquia").fadeIn(300).css("display","block");
$("#rconsejocomunales, #rcomunas, #rmovimientossociales, #rconsejales, #integrantesmovimientos, #integrantescomunas, #integrantesconsejos, #operador, #consejos_comunas").fadeOut(300).css("display","none");

}else{
$("#rconsejocomunales, #rcomunas, #rmovimientossociales, #rconsejales, #integrantesmovimientos, #integrantesconsejos, #integrantescomunas, #operador, #divvocerosparroquia, #consejos_comunas").fadeOut(300).css("display","none");
}
}
});
//fin del select de registro
//boton de limpiar datos de movimientos sociales


//registro de movimientos sociales
$("#rmovimientossociales").on("submit", function(e){
    e.preventDefault();
var sede        = $("#movisede").val();
var sector      = $("#movisector").val();
var rif         = $("#movirif").val();
var nombre      = $("#movinombre").val();
var anio        = $("#movimientosanios").val();
var mes         = $("#movimientosmes").val();
var dia         = $("#movimientosdia").val();
var clave       = $("#moviclave").val();
var parroquia   = $("#moviparroquia").val();
var tipo        = $("#movitipo").val();
var acta        = $("#acta:checked").val();
var constancia  = $("#constancia:checked").val();
var miembro     = $("#miembro:checked").val();
var cedulas     = $("#cedulas:checked").val();

if(acta==null){
acta='no';
}
if(constancia==null){
constancia='no';
}
if(miembro==null){
miembro='no';
}
if(cedulas==null){
cedulas='no';
}
$.ajax({
type : "post",
url : "registrarmovimientossociales.php",
data : { sede : sede, sector : sector, rif : rif, nombre : nombre, anio:anio, mes:mes, dia:dia, clave : clave, parroquia : parroquia, tipo : tipo, acta : acta, constancia : constancia, miembro : miembro, cedulas : cedulas },
beforeSend : function(){
$("#mensajestodos").fadeIn(300).css("display","block").html("<img src='../imagenes/loading.gif'>");
},
success :function(respuesta){
if(respuesta=="<h3>datos agregados con exito</h3>"){
$("#mensajestodos").css("background","green").html(respuesta).fadeOut(6000);
$("#movisede, #movisector, #movirif, #movinombre, #movifecha, #movicodigo, #moviclave, #moviparroquia, #movitipo, #movimientosanios, #movimientosmes, #movimientosdia").val("");
$("#acta, #constancia, #miembro, #cedulas").prop("checked","");
setTimeout(function(){
$("#datosmovimientos").load("obtener5ultimosmovimientos.php");
},6000);
}else{
$("#mensajestodos").css("background","red").html(respuesta).fadeOut(6000);
}
}
});
});
//fin de movimientos

//capturando relacion de integrantes de movimiento sociales
$(document).on("click","#tiporifcodigo",function(){
    $datos = $(this).val();
    if($datos=="rif"){
        $("#intmovirelacion").attr("placeholder","Digite rif J-00000000-0");
    }else if($datos=="codigo_gestion"){
        $("#intmovirelacion").attr("placeholder","Digite codigo ms-00000000-0");
    }else{
        $("#intmovirelacion").attr("placeholder","");
    }

});



//registro de intengranstes de movimientos sociales
$("#integrantesmovimientos").on("submit", function(e){
    e.preventDefault();

var nombre    = $("#intmovinombre").val();
var apellido  = $("#intmoviapellido").val();
var cedula    = $("#movimientosnacionalidad").val()+$("#intmovicedula").val();
var telefono  = $("#movimientoscodigotelefono").val()+$("#intmovitelefono").val();
var cargo     = $("#intmovicargo").val();
var tipo      = $("#tipointmovi").val();
var relacion  = $("#tiporifcodigo").val();
var codigo    = $("#intmovirelacion").val();

$.ajax({
type : "post",
url : "registrarintegrantesmovimientos.php",
data:{nombre : nombre , apellido : apellido, cedula: cedula , telefono : telefono , cargo: cargo , tipo : tipo , relacion : relacion, codigo : codigo},
beforeSend:function(){
$("#mensajestodos").fadeIn(300).css("display", "block").html("<img src='../imagenes/loading.gif'>");
},
success: function(respuesta){
if(respuesta == "<h3>datos agregados con exito</h3>"){
$("#mensajestodos").css("background","green").html(respuesta).fadeOut(6000);
var si = confirm("desea agregar otro integrante al mismo movimiento social");
if(si == true){
$("#tiporifcodigo").val(relacion);
$("#intmovirelacion").val(codigo);
$("#intmovinombre, #intmoviapellido, #intmovicedula, #intmovitelefono, #intmivicargo, #tipointmovi, #movimientoscodigotelefono, #movimientosnacionalidad,#intmovicargo").val("");
}else{
$("#intmovinombre, #intmoviapellido, #intmovicedula, #intmovitelefono, #intmovicargo, #tipointmovi, #tiporifcodigo, #intmovirelacion, #movimientoscodigotelefono, #movimientosnacionalidad").val("");
$("#intmovirelacion").attr("placeholder","");
}

}else{
$("#mensajestodos").css("background","red").html(respuesta).fadeOut(6000);
}
}
});
});
//fin de integrantes de movimientos

//registro de los consejos comunales
$("#rconsejocomunales").on("submit", function(e){
    e.preventDefault();

var clave       = $("#consejoclave").val();
var anio        = $("#consejosanios").val();
var mes         = $("#consejosmes").val();
var dia         = $("#consejosdia").val();
var nombre      = $("#consejonombre").val();
var parroquia   = $("#consejoparroquia").val();
var rif         = $("#consejorif").val();
var sector      = $("#consejosector").val();
var sede        = $("#consejosede").val();
var acta        = $("#consejosacta:checked").val();
var certificado = $("#consejoscertificado:checked").val();
var cedulas     = $("#consejoscedulas:checked").val();
var miembro     = $("#consejosmiembro:checked").val();

if(acta==null){
acta='no';
}
if(certificado==null){
certificado='no';
}
if(cedulas==null){
cedulas='no';
}
if(miembro==null){
miembro='no';
}
//envio por ajax
$.ajax({
type : "post",
url : "registrarconsejoscomunales.php",
data : {clave : clave , anio : anio, mes:mes, dia:dia, nombre : nombre, parroquia : parroquia, rif : rif , sector : sector, sede :sede, acta : acta, certificado:certificado, cedulas:cedulas, miembro: miembro},
beforeSend: function(){
$("#mensajestodos").fadeIn(300).css("display","block").html("<img src='../imagenes/loading.gif'>");
},
success: function(respuesta){
if(respuesta=="<h3>datos agregados con exito</h3>"){
$("#mensajestodos").css("background","green").html(respuesta).fadeOut(6000);
$("#consejoclave, #consejofecha, #consejonombre, #consejoparroquia, #consejorif, #consejosector, #consejosede, #consejosanios, #consejosmes, #consejosdia").val("");
$("#consejosacta, #consejoscertificado, #consejoscedulas, #consejosmiembro").prop("checked","");
setTimeout(function(){
$("#datosconsejos").load("obtener5ultimosconsejos.php");
},6000);
}else{
$("#mensajestodos").css("background","red").html(respuesta).fadeOut(6000);

}
}
});
});
//fin de consejos comunales



//registro de las comunas
$("#rcomunas").on("submit", function(e){
    e.preventDefault();

 sede        = $("#comunasede").val();
 sector      = $("#comunasector").val();
 rif         = $("#comunarif").val();
 nombre      = $("#comunanombre").val();
 anio        = $("#comunasanios").val();
 mes         = $("#comunasmes").val();
 dia         = $("#comunasdia").val();
 clave       = $("#comunaclave").val();
 parroquia   = $("#comunaparroquia").val();
 acta        = $("#comunaanexoacta:checked").val();
 constancia  = $("#comunaanexoconstancia:checked").val();
 cedulas     = $("#comunaanexocedula:checked").val();
 registro    = $("#comunaanexoregistro:checked").val();

if(acta==null){
acta='no';
}
if(constancia==null){
constancia='no';
}
if(cedulas==null){
cedulas='no';
}
if(registro==null){
registro='no';
}
//enviando datos por ajax
$.ajax({
type : "post",
url : "registrarcomunas.php",
data : {parroquia:parroquia, sede:sede, sector:sector, rif:rif, nombre:nombre, anio:anio, mes:mes, dia:dia, clave:clave, acta:acta, constancia:constancia,registro:registro, cedulas:cedulas},
beforeSend:function(){
$("#mensajestodos").fadeIn(300).css("display","block").html("<img src='../imagenes/loading.gif'>");
},
success: function(mensaje){
if(mensaje=="<h3>datos agregados con exito</h3>"){
$("#mensajestodos").css("background","green").html(mensaje).fadeOut(6000);
$("#comunaparroquia, #comunasede, #comunasector, #comunarif, #comunanombre, #comunafecha, #comunacodigo, #comunaclave, #comunasanios,#comunasmes,#comunasdia").val("");
$("#comunaanexoacta, #comunaanexoconstancia, #comunaanexorif, #comunaanexocedula, #comunaanexoregistro").prop("checked","");

setTimeout(function(){
    $("#datoscomunas").load("obtener5ultimascomunas.php");
},6000);

}else{
$("#mensajestodos").css("background","red").html(mensaje).fadeOut(6000);
}
}
});
});
//fin de registro de comunas


//registro de consejales
$("#rconsejales").on("submit", function(e){
e.preventDefault();
var nombre    = $("#nombre").val();
var apellido  = $("#apellido").val();
var cedula    = $("#consejalescodigocedula").val()+$("#cedula").val();
var telefono  = $("#consejalescodigotelefono").val()+$("#telefono").val();
var clave     = $("#clave").val();
//envair datos por ajax
$.ajax({
type : "post",
url : "registrarconsejales.php",
data : {nombre : nombre , apellido : apellido , cedula : cedula, telefono : telefono , clave : clave},
beforeSend : function(){
$("#mensajestodos").fadeIn(300).css("display","block").html("<img src='../imagenes/loading.gif'>");
},
success : function(respuesta){
if(respuesta == "<h3>datos agregados con exito</h3>"){
$("#mensajestodos").css("background","green").html(respuesta).fadeOut(6000);
$("#nombre , #apellido, #cedula , #telefono , #clave , #textareaconsejales , #parroquia, #consejalescodigotelefono").val("");
}else{
$("#mensajestodos").css("background","red").html(respuesta).fadeOut(6000);
}
}
});
});
//fin de consejales
//capturando la relacion del instegrante con la comuna
$(document).on("click","#tiporifcodigocomuna",function(){
    $datos = $(this).val();
    if($datos=="rif")
    {
        $("#intcomunarelacion").attr("placeholder","Introduzca rif J-00000000-0");
    }
    else if($datos=="codigo")
    {
        $("#intcomunarelacion").attr("placeholder","Introduzca codigo cm-00000000-0");
    }
    else
    {
        $("#intcomunarelacion").attr("");
    }

});

//registro de los integrantes de las comunas
$("#integrantescomunas").on("submit", function(e){
    e.preventDefault();
var cedula   = $("#comunanacionalidad").val()+ $("#intcomunacedula").val();
var cargo    = $("#intcomunacargo").val();
var tipo     = $("#tipointcomuna").val();
var relacion = $("#tiporifcodigocomuna").val();
var codigo   = $("#intcomunarelacion").val();
var gestion  = $("#tipogestion").text();
//enviar datos por ajax
$.ajax({
type : "post",
url : "registrarintegrantescomunas.php",
data:{cedula: cedula , cargo: cargo , tipo : tipo , relacion : relacion, codigo : codigo, gestion : gestion},
beforeSend:function(){
$("#mensajestodos").fadeIn(300).css("display", "block").html("<img src='../imagenes/loading.gif'>");
},
success: function(respuesta){
if(respuesta == "<h3>datos agregados con exito</h3>"){
$("#mensajestodos").css("background","green").html(respuesta).fadeOut(6000);
var si = confirm("desea agregar otro integrante al mismo consejo comunal");
if(si == true){
$("#tiporifcodigocomuna").val(relacion);
$("#intcomunarelacion").val(codigo);
$("#intcomunanombre, #intcomunaapellido, #intcomunacedula, #intcomunatelefono, #intcomunacargo, #tipointcomuna, #comunacodigotelefono, #comunanacionalidad, #tipogestion").val("");
}else{
$("#intcomunanombre, #intcomunaapellido, #intcomunacedula, #intcomunatelefono, #intcomunacargo, #tipointcomuna, #tiporifcodigocomuna, #intcomunarelacion, #comunacodigotelefono, #comunanacionalidad,#tipogestion").val("");
$("#intcomunarelacion").attr("");
}

}else{
$("#mensajestodos").css("background","red").html(respuesta).fadeOut(6000);
}
}
});
});
//fin de comunas


//capturando la unidad al que pertenece el integrante de consejos comunales
$(document).on('click',"#unidad",function(){
var ver=$("#unidad").val();


if(ver=="administrativa"){
$("#intconsejoscargo").val(ver);
$("#intconsejoscargo").attr("disabled","disabled");

}else if(ver=="contraloria"){
$("#intconsejoscargo").val(ver);
$("#intconsejoscargo").attr("disabled","disabled");

}else{
$("#intconsejoscargo").removeAttr("disabled");
$("#intconsejoscargo").val('');
}
});
//capturando la relacion del integrante con el consejo comunal
$(document).on('click','#tiporifcodigoconsejos',function(){
    $datos = $(this).val();
    if($datos=="rif"){
    $("#intconsejosrelacion").attr("placeholder","introduzca Rif J-00000000-0");
}else if($datos=="codigo_gestion"){
$("#intconsejosrelacion").attr("placeholder","introduzca codigo cc-00000000-0");
}else{
    $("#intconsejosrelacion").attr("placeholder","");
}
});
//registro de integrantes de consejos comunales
$("#integrantesconsejos").on("submit", function(e){
    e.preventDefault();

var nombre   = $("#intconsejosnombre").val();
var apellido = $("#intconsejosapellido").val();
var cedula   = $("#consejosnacionalidad").val()+$("#intconsejoscedula").val();
var telefono = $("#consejocodigotelefono").val()+$("#intconsejostelefono").val();
var tipo     = $("#tipointconsejos").val();
var relacion = $("#tiporifcodigoconsejos").val();
var codigo   = $("#intconsejosrelacion").val();
var unidad   = $("#unidad").val();
var cargo    = $("#intconsejoscargo").val();
$.ajax({
type:"post",
url:"registrarintegrantesconsejos.php",
data:{nombre : nombre, apellido : apellido, cedula : cedula, telefono : telefono, cargo : cargo, tipo : tipo, relacion : relacion, codigo : codigo, unidad:unidad},
beforeSend: function(){
$("#mensajestodos").fadeIn(300).css("display","block").html("<img src='../imagenes/loading.gif'>");
},
success: function(respuesta){
if(respuesta=="<h3>datos agregados con exito</h3>"){
$("#mensajestodos").css("background","green").html(respuesta).fadeOut(6000);
var si = confirm("desea agregar otro integrante al mismo consejo comunal");
if(si == true){
$("#tiporifcodigoconsejos").val(relacion);
$("#intconsejosrelacion").val(codigo);
$("#intconsejosnombre, #intconsejosapellido, #intconsejoscedula, #intconsejostelefono, #consejocodigotelefono,#intconsejoscargo, #tipointconsejos, #unidad, #consejosnacionalidad").val("");
}else{
$("#intconsejosnombre,#intconsejosapellido,#intconsejoscedula,#intconsejostelefono, #consejocodigotelefono, #intconsejoscargo, #tipointconsejos, #tiporifcodigoconsejos, #intconsejosrelacion, #unidad, #consejosnacionalidad").val("");
$("#intconsejosrelacion").attr("placeholder","");
}
}else{
$("#mensajestodos").css("background","red").html(respuesta).fadeOut(6000);
}
}
});
});
//fin de integrantes de consejos de consejos comunales

//registrar operador
$("#operador").on("submit",function(e){
    e.preventDefault();
var nombre = $("#nombreoperador").val();
var clave  = $("#claveoperador").val();
$.ajax({
type: "POST",
url : "registraroperador.php",
data : {nombre:nombre, clave:clave},
beforeSend:function(){
$("#mensajestodos").fadeIn(300).css("display","block").html("<img src='../imagenes/loading.gif'>");
},
success: function(respuesta){
if(respuesta=="<h3>datos agregados con exito</h3>"){
$("#mensajestodos").css("background","green").html(respuesta).fadeOut(6000);
$("#nombreoperador, #claveoperador").val("");
}else{
$("#mensajestodos").css("background","red").html(respuesta).fadeOut(6000);
}
}
});
});


//registrar voceros por electos parroquia

$("#divvocerosparroquia").on("submit",function(e){
    e.preventDefault();
var tipo   = $("#vocerotipo").val();
var cedula = $("#voceronacionalida").val()+$("#vocerocedula").val();
$.ajax({
type: "post",
url: "registrodevocerosporparroquia.php",
data : {tipo:tipo,cedula:cedula},
beforeSend: function(){
$("#mensajestodos").fadeIn(300).css("display","block").html("<img src='../imagenes/loading.gif'>");
},
success: function(respuesta){
if(respuesta =="<h3>datos agregados con exito</h3>"){
$("#mensajestodos").css("background","green").html(respuesta).fadeOut(6000);
$("#vocerocedula, #vocerotipo").val("");
}else{
$("#mensajestodos").css("background","red").html(respuesta).fadeOut(6000);
}
}
})
});
//capturar las relaciones de consejos y comunas
$(document).on('click',"#tipocomunascodigorif", function(){
    $datos = $(this).val();
    if($datos=="rif"){
        $("#relacioncomunas").attr("placeholder","Digite rif de la comuna J-00000000-0");
    }else if($datos=="codigo"){
        $("#relacioncomunas").attr("placeholder","Digite codigo de la comuna cm-00000000-0");
    }else{
        $("#relacioncomunas").attr("placeholder","");
    }
});

$(document).on('click',"#tipoconsejoscodigorif", function(){
    $datos = $(this).val();
    if($datos=="rif"){
        $("#relacionconsejos").attr("placeholder","Digite rif del consejo comunal J-00000000-0");
    }else if($datos=="codigo"){
        $("#relacionconsejos").attr("placeholder","Digite codigo del consejo comunal cc-00000000-0");
    }else{
        $("#relacionconsejos").attr("placeholder","");
    }
});

//registrar consejos en comunas
$("#consejos_comunas").on("submit",function(e){
    e.preventDefault();
var tipocodigocomunas  = $("#tipocomunascodigorif").val();
var relacioncomunas    = $("#relacioncomunas").val();
var tipocodigoconsejos = $("#tipoconsejoscodigorif").val();
var relacionconsejos   = $("#relacionconsejos").val();

$.ajax({
type:"POST",
url:"registrarconsejosencomunas.php",
data:{tipocodigocomunas: tipocodigocomunas, relacioncomunas:relacioncomunas, tipocodigoconsejos:tipocodigoconsejos, relacionconsejos:relacionconsejos},
beforeSend: function(){
$("#mensajestodos").fadeIn(300).css("display","block").html("<img src='../imagenes/loading.gif'>");
},
success: function(respuesta){
if(respuesta=="<h3>datos agregados con exito</h3>"){
$("#mensajestodos").css("background","green").html(respuesta).fadeOut(6000);
var si = confirm(" desea agregar otro consejos a la misma comuna ?");
if(si==true){
$("#tipocomunascodigorif").val(tipocodigocomunas);
$("#relacioncomunas").val(relacioncomunas);
$("#tipoconsejoscodigorif, #relacionconsejos").val("");
$("#relacionconsejos").attr("placeholder","");
}else{
$("#tipocomunascodigorif, #relacioncomunas, #tipoconsejoscodigorif, #relacionconsejos").val("");
$("#relacionconsejos,#relacioncomunas").attr("placeholder","");
}
}else{
$("#mensajestodos").css("background","red").html(respuesta).fadeOut(6000);
}
}
});
});


//botones de ayuda de los formularios de registro
$("#ayudacomunaselectrelacion").click(function(){
alert("Debes de seleccionar una opcion del tipo de datos que vas a relacionar con la comuna");
});

$("#ayudacomunasrelacion").click(function(){
alert("Debes de digitar el dato que ya hallas seleccionado, ejemplo el rif o el codigo de la comuna");
});

$("#ayudaconsejosrelacion").click(function(){
alert("Debes de digistar el dato que ya hallas seleccionado, ejemplo el rif o codigo del consejo comunal ");
});

$("#ayudaconsejosselectrelacion").click(function(){
alert("Debes de seleccionar una opcion del tipo de datos que vas a relacionar con el consejo comunal");
});

$("#ayudaintcomunasrelacion").click(function(){
alert("Debes de digistar el dato que ya halla seleccionado, ejemplo el rif o codigo de la comuna al que quieres agregarle el integrante");
});

$("#ayudaintcomunasselectrelacion").click(function(){
alert("Debes de seleccionar una opcion del tipo de datos que vas a relacionar la comuna, con el integrantes");
});

$("#ayudaintconsejosrelacion").click(function(){
alert("Debes de digitar el dato que ya halla seleccionado, ejemplo el rif o codigo del consejos comunal al que quieres agregarle el integrante");
});

$("#ayudaintconsejosselectrelacion").click(function(){
alert("Debes de seleccionar una opcion del tipo de datos que vas a relacionar del consejo comunal");
});

$("#ayudaintmovimientosrelacion").click(function(){
alert("Debes de digistar el datos que ya halla seleccionado, ejmeplo el rif o codigo del movimientos social al que quieres agregarle el integrante");
});

$("#ayudaintmovimientosselectrelacion").click(function(){
alert("Debes de seleccionar una opcion del tipo de datos que vas a relacionar del movimientos social");
});

$("#ayudavoceroselectos").click(function(){
alert("Debes de seleccionar la gestion social al que pertenece el voceros");
});

$("#ayudamovimientosselectrelacioncomunas").click(function(){
alert("Debes de seleccionar una opcion del tipo de datos que vas a relacionar con el movimiento social");
});

$("#ayudamovimientoscomunasrelacion").click(function(){
alert("Debes de digitar el dato que ya hallas seleccionado, ejemplo el rif o el codigo del movimiento social");
});

$("#ayudacomunaselectrelacionmovimientos").click(function(){
alert("Debes de seleccionar una opcion del tipo de datos que vas a relacionar con la comuna");
});

$("#ayudacomunasmovimientosrelacion").click(function(){
alert("Debes de digitar el dato que ya hallas seleccionado, ejemplo el rif o el codigo de la comuna");
});



});
