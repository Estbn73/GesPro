import 'bootstrap';

document.addEventListener('DOMContentLoaded', function () {
    // Encontrar todos los botones con la clase 'option-btn'
    const optionButtons = document.querySelectorAll('.option-btn');

    // Agregar el evento de clic para cada botón
    optionButtons.forEach(button => {
        button.addEventListener('click', function () {
            // Obtener el ID del modal objetivo del atributo de datos del botón
            const modalId = button.getAttribute('data-bs-target');
            const modalElement = document.getElementById(modalId.replace('#', ''));

            // Mostrar el modal si existe
            if (modalElement) {
                const modal = new bootstrap.Modal(modalElement);
                modal.show();
            } else {
                console.error('Modal no encontrado:', modalId);
            }
        });
    });
});

// Función para cargar contenido dinámico en el modal
window.loadModalContent = function (section, view, proyectoId) {
    
    console.log("Cargando contenido para:", section, view, proyectoId); // Para depuración
    const url = `/proyectos/${proyectoId}/${section}/${view}`;



    fetch(url)
        .then(response => response.text())
        .then(html => {
            const modalContent = document.getElementById(`modal-content-${section}`);
            if (modalContent) {
                modalContent.innerHTML = html;
            } else {
                console.error('Elemento de contenido del modal no encontrado para la sección:', section);
            }
        })
        .catch(error => console.error('Error al cargar el contenido del modal:', error));
};


        // Toggle para ocultar y mostrar el sidebar con suavidad
        const sidebar = document.getElementById('sidebar');
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                sidebar.classList.toggle('hidden');
            }
        });

        document.addEventListener('DOMContentLoaded', () => {
            const toggleSidebar = document.getElementById('toggle-sidebar');
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');

            toggleSidebar.addEventListener('click', () => {
                sidebar.classList.toggle('hidden');
                
                if (sidebar.classList.contains('hidden')) {
                    mainContent.style.marginLeft = '0';
                } else {
                    mainContent.style.marginLeft = '250px';
                }
            });
        });
      document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            // Detecta si hay un modal abierto
            const modalOpen = document.querySelector('.modal.show');

            if (modalOpen) {
                modalOpen.querySelector('[data-bs-dismiss="modal"]').click();
                event.stopImmediatePropagation(); 
            }
        }
      });


    
    
