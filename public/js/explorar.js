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

const contenedor = document.getElementById("contenedor3");

data.forEach((item) => {
  const tipoDiv = document.createElement("div");
  const tipoSlug = item.tipo.toLowerCase().replace(/\s/g,'-').replace(/[^\w-]/g, '');

  tipoDiv.className = `tipo tipo-${tipoSlug}`;

  const titulo = document.createElement("h2");
  titulo.textContent = item.tipo;
  tipoDiv.appendChild(titulo);

  item.categorias.forEach((cat) => {
    const catLink = document.createElement("a");
    catLink.className = "categoria";
    catLink.textContent = cat;
    catLink.href = '/servicios?categoria=' + encodeURIComponent(cat);
    tipoDiv.appendChild(catLink);
  });

  contenedor.appendChild(tipoDiv);
});

