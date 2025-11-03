const data = [
  {
    tipo: "Hogar y Mantenimiento",
    categorias: ["Plomería", "Electricidad", "Limpieza", "Jardinería", "Carpintería"]
  },
  {
    tipo: "Construcción y Reformas",
    categorias: ["Albañilería", "Pintura", "Herrería", "Instalaciones", "Impermeabilización"]
  },
  {
    tipo: "Tecnología y Soporte Técnico",
    categorias: ["Reparación de PC", "Redes", "Soporte remoto", "Celulares", "Cámaras de seguridad"]
  },
  {
    tipo: "Salud y Bienestar",
    categorias: ["Masajes", "Nutrición", "Estética", "Terapias alternativas", "Entrenamiento"]
  },
  {
    tipo: "Educación y Clases",
    categorias: ["Clases particulares", "Idiomas", "Música", "Programación", "Apoyo escolar"]
  },
  {
    tipo: "Transporte y Mudanzas",
    categorias: ["Fletes", "Mudanzas", "Motoenvíos", "Chofer privado", "Repartos"]
  },
  {
    tipo: "Eventos y Entretenimiento",
    categorias: ["Fotografía", "DJ", "Organización de eventos", "Animadores", "Decoración"]
  },
  {
    tipo: "Cuidado Personal y Belleza",
    categorias: ["Peluquería", "Maquillaje", "Manicura", "Barbería", "Depilación"]
  },
  {
    tipo: "Servicios Profesionales",
    categorias: ["Abogados", "Contadores", "Arquitectos", "Psicólogos", "Traductores"]
  },
  {
    tipo: "Mascotas y Animales",
    categorias: ["Paseadores", "Baño y corte", "Entrenamiento", "Cuidado a domicilio", "Veterinario"]
  },
  {
    tipo: "Reparaciones y Técnicos",
    categorias: ["Electrodomésticos", "Aire acondicionado", "Gasistas", "Mantenimiento general"]
  },
  {
    tipo: "Diseño y Marketing",
    categorias: ["Diseño gráfico", "Redes sociales", "Publicidad", "Fotografía de producto"]
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

