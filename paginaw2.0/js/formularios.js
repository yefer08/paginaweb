document.addEventListener("DOMContentLoaded", function() {
    const irARegistro = document.getElementById("ir-a-registro");
    const irAIngreso = document.getElementById("ir-a-ingreso");
    
    const formularioIngreso = document.getElementById("formulario-ingreso");
    const formularioRegistro = document.getElementById("formulario-registro");

    // Mostrar el formulario de registro y ocultar el de ingreso
    irARegistro.addEventListener("click", function(e) {
        e.preventDefault();  // Prevenir el comportamiento por defecto del enlace
        formularioIngreso.classList.add("hidden");  // Ocultar formulario de ingreso
        formularioRegistro.classList.remove("hidden");  // Mostrar formulario de registro
    });

    // Mostrar el formulario de ingreso y ocultar el de registro
    irAIngreso.addEventListener("click", function(e) {
        e.preventDefault();  // Prevenir el comportamiento por defecto del enlace
        formularioIngreso.classList.remove("hidden");  // Mostrar formulario de ingreso
        formularioRegistro.classList.add("hidden");  // Ocultar formulario de registro
    });
});
