<?php
session_start();
include_once 'connectDB/connect.php';

$pdo = connectDB();
$topProperties = [];
if ($pdo != null) {
    $consulta = "SELECT p.*, i.imagen FROM propiedades p LEFT JOIN imagenes i ON p.id = i.propiedad_id ORDER BY p.precio DESC LIMIT 3";
    $resul = $pdo->query($consulta);
    $topProperties = $resul->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CM Gestión Inmobiliaria - Tu Socio en Bienes Raíces</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/common.css">
    <link rel="stylesheet" href="styles/index.css">
</head>
<body>
    <?php include_once "./includes/header.php"; ?>

    <main>
        <!-- Carrusel mejorado y responsive -->
        <div id="mainCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php for ($i = 0; $i < 6; $i++): ?>
                    <li data-target="#mainCarousel" data-slide-to="<?php echo $i; ?>" <?php echo $i === 0 ? 'class="active"' : ''; ?>></li>
                <?php endfor; ?>
            </ol>
            <div class="carousel-inner">
                <?php
                $slides = [
                    ['img' => 'slide1.jpg', 'title' => 'Bienvenido a CM Gestión Inmobiliaria', 'desc' => 'Tu socio confiable en bienes raíces.'],
                    ['img' => 'slide2.jpg', 'title' => 'Asesoramiento Profesional', 'desc' => 'Te guiamos en cada paso del proceso.'],
                    ['img' => 'slide3.jpg', 'title' => 'Propiedades Exclusivas', 'desc' => 'Encuentra la propiedad de tus sueños.'],
                    ['img' => 'slide4.jpg', 'title' => 'Vende tu Propiedad', 'desc' => 'Te ayudamos a vender al mejor precio.'],
                    ['img' => 'slide5.jpg', 'title' => 'Servicios Personalizados', 'desc' => 'Adaptados a tus necesidades.'],
                    ['img' => 'slide6.jpg', 'title' => 'Contacta con Nosotros', 'desc' => 'Estamos aquí para ayudarte.']
                ];
                foreach ($slides as $index => $slide):
                ?>
                    <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                        <img src="img/<?php echo htmlspecialchars($slide['img']); ?>" class="d-block w-100" alt="<?php echo htmlspecialchars($slide['title']); ?>">
                        <div class="carousel-caption">
                            <h5><?php echo htmlspecialchars($slide['title']); ?></h5>
                            <p><?php echo htmlspecialchars($slide['desc']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <a class="carousel-control-prev" href="#mainCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#mainCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Siguiente</span>
            </a>
        </div>

        <div class="container mt-5">
            <!-- Sección Acerca de mejorada -->
            <section id="about" class="about-us py-5">
                <div class="container">
                    <div class="card">
                        <div class="card-header" id="aboutUsHeader">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#aboutUsContent" aria-expanded="true" aria-controls="aboutUsContent">
                                    <i class="fas fa-building mr-2"></i> Quiénes Somos
                                </button>
                            </h2>
                        </div>
                        <div id="aboutUsContent" class="collapse show" aria-labelledby="aboutUsHeader">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-lg-4 mb-4 mb-lg-0">
                                        <div class="about-image">
                                            <img src="img/about-us.jpg" alt="CM Gestión Inmobiliaria" class="img-fluid rounded">
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <p class="lead">En CM Gestión Inmobiliaria, nos dedicamos a una misión clara: vender tu propiedad en las mejores condiciones y en el menor tiempo posible. Nuestro equipo de expertos se especializa en guiarte a través de cada paso del proceso de venta, ofreciendo un servicio personalizado y de calidad.</p>
                                        <p>No somos simplemente agentes inmobiliarios; somos tus aliados estratégicos en el mercado inmobiliario, comprometidos a maximizar el valor de tu propiedad y a hacer que tu experiencia de venta sea lo más fluida y exitosa posible.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Sección Servicios mejorada -->
            <section id="services" class="services mt-5">
                <h2 class="text-center mb-4">Nuestros Servicios</h2>
                <div class="row">
                    <?php
                    $services = [
                        ['title' => 'Asesoramiento Legal', 'desc' => 'Te brindamos asesoramiento legal en todas las etapas del proceso de compra o venta, garantizando que todo esté en regla.', 'icon' => 'fas fa-gavel'],
                        ['title' => 'Homestaging', 'desc' => 'Preparamos tu propiedad para que luzca impecable y atraiga a más compradores potenciales.', 'icon' => 'fas fa-home'],
                        ['title' => 'Tasación de Propiedad', 'desc' => 'Realizamos una valoración precisa de tu propiedad para fijar un precio competitivo en el mercado.', 'icon' => 'fas fa-chart-line'],
                        ['title' => 'Sesión de Fotos Profesional', 'desc' => 'Incluimos fotos de alta calidad y videos con dron para mostrar tu propiedad de la mejor manera.', 'icon' => 'fas fa-camera'],
                        ['title' => 'Publicidad Digital', 'desc' => 'Promocionamos tu propiedad en todos los medios digitales y portales inmobiliarios online.', 'icon' => 'fas fa-ad'],
                        ['title' => 'Búsqueda Activa de Contactos', 'desc' => 'Realizamos una búsqueda activa de compradores o inquilinos interesados en tu propiedad.', 'icon' => 'fas fa-search'],
                        ['title' => 'Gestión de Visitas', 'desc' => 'Nos encargamos de coordinar y gestionar las visitas a tu propiedad de manera profesional.', 'icon' => 'fas fa-calendar-check'],
                        ['title' => 'Ayuda con los Papeles', 'desc' => 'Te asistimos en la formalización de la venta, asegurando que toda la documentación esté en orden.', 'icon' => 'fas fa-file-alt']
                    ];
                    foreach ($services as $service):
                    ?>
                        <div class="col-md-6 col-lg-3 mb-4">
                            <div class="card h-100 service-card">
                                <div class="card-body text-center">
                                    <i class="<?php echo $service['icon']; ?> fa-3x mb-3 service-icon"></i>
                                    <h5 class="card-title"><?php echo htmlspecialchars($service['title']); ?></h5>
                                    <p class="card-text"><?php echo htmlspecialchars($service['desc']); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <!-- Nueva sección: Estadísticas -->
            <section id="stats" class="stats-section mt-5 py-5">
                <div class="container">
                    <h2 class="text-center mb-5">¿Por qué elegir CM Gestión Inmobiliaria?</h2>
                    <div class="row">
                        <div class="col-6 col-md-3 mb-4">
                            <div class="stat-item text-center">
                                <div class="stat-icon">
                                    <i class="fas fa-home"></i>
                                </div>
                                <div class="stat-number" data-count="500">0</div>
                                <div class="stat-label">Propiedades Vendidas</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3 mb-4">
                            <div class="stat-item text-center">
                                <div class="stat-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="stat-number" data-count="350">0</div>
                                <div class="stat-label">Clientes Satisfechos</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3 mb-4">
                            <div class="stat-item text-center">
                                <div class="stat-icon">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                                <div class="stat-number" data-count="10">0</div>
                                <div class="stat-label">Años de Experiencia</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3 mb-4">
                            <div class="stat-item text-center">
                                <div class="stat-icon">
                                    <i class="fas fa-award"></i>
                                </div>
                                <div class="stat-number" data-count="15">0</div>
                                <div class="stat-label">Premios del Sector</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Nueva sección: Propiedades Destacadas -->
            <section id="featured-properties" class="featured-properties mt-5">
                <h2 class="text-center mb-4">Propiedades Destacadas</h2>
                <div class="row">
                    <?php foreach ($topProperties as $property): ?>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card property-card h-100">
                                <div class="card-img-container">
                                    <img src="data:image/jpeg;base64,<?php echo base64_encode($property['imagen']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($property['titulo']); ?>">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($property['titulo']); ?></h5>
                                    <p class="property-price"><?php echo number_format($property['precio'], 0, ',', '.'); ?>€</p>
                                    <p class="card-text"><i class="fas fa-info-circle mr-2"></i><?php echo htmlspecialchars($property['descripcion']); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="text-center mt-4">
                    <a href="propiedades.php" class="btn btn-gold">Ver todas las propiedades</a>
                </div>
            </section>

            <!-- Nueva sección: Call to Action -->
            <section id="cta" class="cta-section mt-5">
                <div class="card cta-card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-lg-8 mb-4 mb-lg-0">
                                <h3>¿Quieres vender tu propiedad o comprar una?</h3>
                                <p class="mb-0">Contáctanos hoy mismo y nuestro equipo de expertos te ayudará a conseguir el mejor acuerdo posible.</p>
                            </div>
                            <div class="col-lg-4 text-center text-lg-right">
                                <a href="contacto.php" class="btn btn-gold">Contactar ahora</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <?php include_once "./includes/footer.php"; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/cerrarSesion.js"></script>
    <script src="js/contacto.js"></script>
    <script src="js/index.js"></script>
</body>
</html>