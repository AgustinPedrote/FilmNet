/* Funciones de la aplicación */

/* Script para enviar el formulario al cambiar la selección de Rol */
function submitForm(select) {
    select.form.submit();
}

/* Botón para volver a la página anterior  */
function goBack() {
    window.history.back();
}

/* Control malsonante en Mis Críticas */
 // Seleccionar todos los formularios dentro de modales de edición
 var editForms = document.querySelectorAll('[id^="EditarModal"] form');
 // Iterar sobre cada formulario
 editForms.forEach(function(form) {
     // Agregar un listener de evento submit a cada formulario
     form.addEventListener('submit', function(event) {
         // Evitar que el formulario se envíe automáticamente
         event.preventDefault();

         // Obtener el contenido de la crítica específica
         var critica = this.querySelector('textarea[name="critica"]').value.toLowerCase();

         // Lista de palabras malsonantes
         var palabrasMalsonantes = ['horrible', 'basura', 'asquerosa'];

         // Verificar si la crítica contiene palabras malsonantes
         var contenidoMalsonante = palabrasMalsonantes.some(function(palabra) {
             return critica.includes(palabra);
         });

         // Mostrar mensaje de error si contenidoMalsonante es true (tiene palabras malsonantes)
         if (contenidoMalsonante) {
             // Mostrar el mensaje de error específico para este formulario
             this.parentNode.querySelector('.error').innerText =
                 "No se puede editar la crítica debido a contenido malsonante.";
         } else {
             // Crítica válida, enviar el formulario
             this.submit();
         }
     });
 });

