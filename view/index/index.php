<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Clínica de Odontología</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        .hero-section {
            background: url('../../src/images/portada.webp') no-repeat center center/cover;
            color: white;
            padding: 100px 0;
            text-align: center;
            position: relative;
        }

        .hero-section .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .hero-section .content {
            position: relative;
            z-index: 2;
        }

        .hero-section h1 {
            font-size: 3.5rem;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .hero-section p {
            font-size: 1.5rem;
            margin-bottom: 30px;
        }

        .btn-custom {
            border-radius: 50px;
            padding: 15px 30px;
            font-size: 1.2rem;
            margin: 10px;
        }

        .features-icon {
            font-size: 3rem;
            color: #007bff;
        }

        .card-custom {
            border: none;
            border-radius: 15px;
            transition: transform 0.3s;
        }

        .card-custom:hover {
            transform: scale(1.05);
        }

        .footer {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
        }
    </style>
</head>

<body>
    <?php include '../template/navbar.php'; ?>

    <div class="hero-section">
        <div class="overlay"></div>
        <div class="container content">
            <h1>Bienvenido a la Clínica de Odontología</h1>
            <p>EL DIENTE FELIZ</p>
            <a href="/odontologia/view/paciente/index.php" class="btn btn-primary btn-custom">Gestionar Pacientes</a>
            <a href="/odontologia/view/doctor/index.php" class="btn btn-secondary btn-custom">Gestionar Odontólogos</a>
            <a href="/odontologia/view/citas/index.php" class="btn btn-success btn-custom">Gestionar Citas</a>
        </div>
    </div>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Características de Nuestro Sistema</h2>
        <div class="row text-center">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card card-custom shadow-sm h-100">
                    <div class="card-body">
                        <i class="bi bi-person-bounding-box features-icon mb-3"></i>
                        <h5 class="card-title">Gestión de Pacientes</h5>
                        <p class="card-text">Administra la información de los pacientes y su historial médico de manera eficiente.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card card-custom shadow-sm h-100">
                    <div class="card-body">
                        <i class="bi bi-person-check features-icon mb-3"></i>
                        <h5 class="card-title">Gestión de Odontólogos</h5>
                        <p class="card-text">Maneja la información de los odontólogos y sus especialidades.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card card-custom shadow-sm h-100">
                    <div class="card-body">
                        <i class="bi bi-calendar-check features-icon mb-3"></i>
                        <h5 class="card-title">Gestión de Citas</h5>
                        <p class="card-text">Programa y administra las citas de los pacientes con nuestros odontólogos.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer text-center">
        <div class="container">
            <p>&copy; 2024 Clínica de Odontología. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
