<header>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="img/logo.jpg" alt="CM Gestión Inmobiliaria">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="propiedades.php">Propiedades</a></li>
                    <li class="nav-item"><a class="nav-link" href="homestaging.php">Homestaging</a></li>
                    <li class="nav-item"><a class="nav-link" href="solicitarVisita.php">Solicitar Visita</a></li>
                    <li class="nav-item"><a class="nav-link" href="contacto.php">Contacto</a></li>
                </ul>
                <div class="user-info d-flex align-items-center ml-3">
                    <?php if (isset($_SESSION['user'])): ?>
                        <i class="fas fa-user-circle fa-2x mr-2"></i>
                        <a href="<?php echo esAdmin($_SESSION['user']) ? 'login/admin.php' : 'login/perfil.php'; ?>" class="btn btn-outline-light mr-2"><?php echo htmlspecialchars($_SESSION['user']); ?></a>
                        <button class="btn btn-outline-light" onclick="cerrarSesion()">Cerrar Sesión</button>
                    <?php else: ?>
                        <button class="btn btn-outline-light" onclick="window.location.href='login/login.php'">Iniciar Sesión</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
</header>