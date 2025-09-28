    function toggleDropdown() {
        const menu = document.getElementById('perfilDropdownMenu');
        menu.classList.toggle('show');
    }

    // Cerrar el dropdown si el usuario hace clic fuera de él
    window.onclick = function(event) {
        if (!event.target.matches('.dropdown-toggle') && !event.target.closest('.dropdown-toggle')) {
            const dropdown = document.getElementById('perfilDropdownMenu');
            if (dropdown.classList.contains('show')) {
                dropdown.classList.remove('show');
            }
        }
    }
