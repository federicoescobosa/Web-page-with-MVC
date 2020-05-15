
function mostrar_sugerencias(str) {
    //Si no se ha insertado nada
    if (str.length == 0) { 
        //Muestra el apartado de sugerencias vacío
        document.getElementById("sugerencias").innerHTML = "";
        return;
    } else {
        //Si se ha insertado algún término ejecutamos Ajax...
        //Creamos un nuevo objeto asyncReques de tipo XMLHttpRequest() que se 
        //encargará de:
        //    1. Conocer el estado de la conexión.
        //    2. Enviar los datos.
        //    3. Recoger la respuesta del procesamiento los de datos enviados.
        var asyncRequest = new XMLHttpRequest();
        
        //Registramos el controlador de eventos
        asyncRequest.onreadystatechange = stateChange;
        
        // Preparamos la solicitud de conexión para enviar los términos de la 
        // búsqueda del usuario como variable "q" a la URL "sugerencias.php?q=" 
        // a través del método GET.
        asyncRequest.open("GET", "modelo/sugerenciasPHP.php?q="+str, true);
        // Enviamos la solicitud
        asyncRequest.send(null);

        // Muestra los datos de la respuesta en la página
        function stateChange(){
            // Si el estado de la conexión = 4 (solicitud finalizada y 
            // respuesta lista) y el la página tiene estatus 200 = Ok 
            //(Si 404 página no existe)
            if (asyncRequest.readyState == 4 && asyncRequest.status == 200) {
                // Mostramos la respuesta que nos da el servidor en el span con
                // id "sugerencias"
                document.getElementById("sugerencias").innerHTML = 
                                                    asyncRequest.responseText;
            }
        }
    }
}