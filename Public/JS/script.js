// Fecha y hora en vivo
function actualizarHora(){
    let elementoFecha = document.getElementById("fechaHora");
    // Verificamos que el elemento exista antes de modificarlo
    if (elementoFecha) {
        let ahora = new Date();
        elementoFecha.textContent = ahora.toLocaleString();
    }
}
actualizarHora(); // ejecutar inmediatamente
setInterval(actualizarHora, 1000);

// Agregar artículos visualmente en la vista
function agregarArticulo(){
    let titulo = document.getElementById("titulo").value.trim();
    let descripcion = document.getElementById("descripcion").value.trim();

    if(titulo === "" || descripcion === ""){
        alert("Completa los campos");
        return;
    }

    let contenedor = document.getElementById("listaArticulos");
    if (!contenedor) return; // Defensa extra para evitar errores si no existe el contenedor

    let nuevo = document.createElement("div");
    nuevo.className = "column is-4";

    nuevo.innerHTML = `
        <div class="card">
            <div class="card-content">
                <p class="title is-5">${titulo}</p>
                <p>${descripcion}</p>
            </div>
        </div>
    `;

    contenedor.appendChild(nuevo);

    // Limpiar los campos después de agregar
    document.getElementById("titulo").value = "";
    document.getElementById("descripcion").value = "";
}

// Validación formulario de contacto
function validarFormulario(){
    let nombre = document.getElementById("nombre").value.trim();
    let mensaje = document.getElementById("mensaje").value.trim();

    if(nombre === "" || mensaje === ""){
        alert("Todos los campos son obligatorios");
        return false;
    }

    alert("Mensaje enviado correctamente");
    return true;
}

// Funcionalidad para el menú responsivo de Bulma
document.addEventListener('DOMContentLoaded', () => {
  const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
  if ($navbarBurgers.length > 0) {
    $navbarBurgers.forEach( el => {
      el.addEventListener('click', () => {
        const target = el.dataset.target;
        const $target = document.getElementById(target);
        el.classList.toggle('is-active');
        // Verificamos que el menú objetivo exista antes de alternar la clase
        if ($target) {
            $target.classList.toggle('is-active');
        }
      });
    });
  }
});