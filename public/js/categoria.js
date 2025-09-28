const data = [
    {
        tipo: "Hogar y Mantenimiento",
        categorias: ["Plomeria", "Electricidad", "Limpieza", "Jardineria", "Carpinteria"]
    },
    {
        tipo: "Construccion y Reformas",
        categorias: ["Albanileria", "Pintura", "Herrería", "Instalaciones", "Impermeabilizacion"]
    },
    {
        tipo: "Tecnologia y Soporte Tecnico",
        categorias: ["Reparacion de PC", "Redes", "Soporte remoto", "Celulares", "Camaras de seguridad"]
    },
    {
        tipo: "Salud y Bienestar",
        categorias: ["Masajes", "Nutricion", "Estetica", "Terapias alternativas", "Entrenamiento"]
    },
    {
        tipo: "Educacion y Clases",
        categorias: ["Clases particulares", "Idiomas", "Musica", "Programacion", "Apoyo escolar"]
    },
    {
        tipo: "Transporte y Mudanzas",
        categorias: ["Fletes", "Mudanzas", "Motoenvios", "Chofer privado", "Repartos"]
    },
    {
        tipo: "Eventos y Entretenimiento",
        categorias: ["Fotografia", "DJ", "Organizacion de eventos", "Animadores", "Decoracion"]
    },
    {
        tipo: "Cuidado Personal y Belleza",
        categorias: ["Peluqueria", "Maquillaje", "Manicuria", "Barberia", "Depilacion"]
    },
    {
        tipo: "Servicios Profesionales",
        categorias: ["Abogados", "Contadores", "Arquitectos", "Psicologos", "Traductores"]
    },
    {
        tipo: "Mascotas y Animales",
        categorias: ["Paseadores", "Bano y corte", "Entrenamiento", "Cuidado a domicilio", "Veterinario"]
    },
    {
        tipo: "Reparaciones y Tecnicos",
        categorias: ["Electrodomesticos", "Aire acondicionado", "Gasistas", "Mantenimiento general"]
    },
    {
        tipo: "Diseno y Marketing",
        categorias: ["Diseno grafico", "Redes sociales", "Publicidad", "Fotografia de producto"]
    }
];

const tipoSelect = document.getElementById('tipo');
const categoriaSelect = document.getElementById('categoria');

function cargarTiposPrincipales() {
    data.forEach(item => {
        const option = document.createElement('option');
        option.value = item.tipo; 
        option.textContent = item.tipo;
        tipoSelect.appendChild(option);
    });
}

function actualizarCategorias() {
    const tipoSeleccionado = tipoSelect.value;
    
    categoriaSelect.innerHTML = '<option value="">-- Selecciona una categoría --</option>';
    categoriaSelect.disabled = true;

    if (tipoSeleccionado) {
        const tipoEncontrado = data.find(item => item.tipo === tipoSeleccionado);
        
        if (tipoEncontrado) {
            categoriaSelect.disabled = false;
            
            tipoEncontrado.categorias.forEach(categoria => {
                const option = document.createElement('option');
                option.value = categoria; 
                option.textContent = categoria;
                categoriaSelect.appendChild(option);
            });
        }
    }
}


cargarTiposPrincipales();

tipoSelect.addEventListener('change', actualizarCategorias);
