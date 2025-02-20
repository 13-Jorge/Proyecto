<?php
session_start();
include_once 'connectDB/connect.php';
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
        <!-- Carrusel mejorado -->
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
                        <div class="carousel-caption d-none d-md-block">
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
            <!-- Sección Acerca de -->
            <section id="about" class="about-us text-center py-5">
                <div class="container">
                    <div class="card">
                        <div class="card-header" id="aboutUsHeader">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#aboutUsContent" aria-expanded="false" aria-controls="aboutUsContent">
                                    Quiénes Somos
                                </button>
                            </h2>
                        </div>
                        <div id="aboutUsContent" class="collapse" aria-labelledby="aboutUsHeader">
                            <div class="card-body">
                                <p class="lead">En CM Gestión Inmobiliaria, nos dedicamos a una misión clara: vender tu propiedad en las mejores condiciones y en el menor tiempo posible. Nuestro equipo de expertos se especializa en guiarte a través de cada paso del proceso de venta, ofreciendo un servicio personalizado y de calidad. No somos simplemente agentes inmobiliarios; somos tus aliados estratégicos en el mercado inmobiliario, comprometidos a maximizar el valor de tu propiedad y a hacer que tu experiencia de venta sea lo más fluida y exitosa posible.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Sección Servicios -->
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
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <i class="<?php echo $service['icon']; ?> fa-3x mb-3 text-primary"></i>
                                    <h5 class="card-title"><?php echo htmlspecialchars($service['title']); ?></h5>
                                    <p class="card-text"><?php echo htmlspecialchars($service['desc']); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <!-- Sección Testimonios -->
            <section id="testimonials" class="testimonials mt-5">
                <h2 class="text-center mb-4">Testimonios</h2>
                <div class="row">
                    <?php
                    $testimonials = [
                        ['text' => 'Excelente servicio, me ayudaron a vender mi casa rápidamente.', 'author' => 'Ana López'],
                        ['text' => 'Muy profesionales, todo el proceso fue transparente y fácil.', 'author' => 'Pedro Martínez'],
                        ['text' => 'Recomiendo CM Gestión Inmobiliaria, son los mejores.', 'author' => 'Laura Sánchez']
                    ];
                    foreach ($testimonials as $testimonial):
                    ?>
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-text"><i class="fas fa-quote-left mr-2"></i><?php echo htmlspecialchars($testimonial['text']); ?></p>
                                    <h5 class="card-title text-right">- <?php echo htmlspecialchars($testimonial['author']); ?></h5>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
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
</body>
</html>