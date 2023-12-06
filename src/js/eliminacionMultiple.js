document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('eliminarSeleccionadosBtn').addEventListener('click', async function() {
        await eliminarSeleccionados();
        window.location.reload();
    });
});

async function eliminarSeleccionados() {
    var checkboxes = document.querySelectorAll('.checkItem:checked');
    
    for (const checkbox of checkboxes) {
        // Obtén el elemento padre tr
        var tr = checkbox.closest('.table__tr');
        
        // Encuentra el botón "Eliminar" dentro del elemento tr
        var eliminarBoton = tr.querySelector('.table__accion--eliminar');
        
        // Simula un clic en el botón "Eliminar"
        await hacerPeticion(eliminarBoton.href);
    }
}

async function hacerPeticion(url) {
    try {
        const response = await fetch(url, {
            method: 'GET', // O el método HTTP correcto para eliminar
        });
        
        // Manejar la respuesta aquí si es necesario
        if (response.ok) {
            console.log('Elemento eliminado correctamente');
        } else {
            console.error('Error al eliminar el elemento');
        }
    } catch (error) {
        console.error('Error de red:', error);
    }
}