<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow" style="background-color: rgba(1, 1, 1, 0.896); box-shadow: 15px 2px 10px;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="../../src/images/01.jpg" alt="Logo" style="width: 40px; height: 40px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav justify-content-center text-center mx-auto">
                <li class="nav-item px-2">
                    <a class="nav-link active" aria-current="page" href="/CRUD_JS2_VASQUEZ/view/index/index.php"><i class="bi bi-house-fill me-2"></i>Inicio</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link" href="/odontologia/view/paciente/index.php"><i class="bi bi-person-lines-fill me-2"></i>Pacientes</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link" href="/CRUD_JS2_VASQUEZ/view/doctores/index.php"><i class="bi bi-person-badge-fill me-2"></i>Doctores</a>
                </li>
                <li class="nav-item dropdown px-2">
                    <a class="nav-link dropdown-toggle" href="#" id="citasDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-calendar-check-fill me-2"></i>Citas</a>
                    <ul class="dropdown-menu" aria-labelledby="citasDropdown">
                        <li><a class="dropdown-item" href="/CRUD_JS2_VASQUEZ/view/citas/generar.php"><i class="bi bi-pencil-square me-2"></i>Generar Citas</a></li>
                        <li><a class="dropdown-item" href="/CRUD_JS2_VASQUEZ/view/citas/ver.php"><i class="bi bi-eye-fill me-2"></i>Ver Citas</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="navbar-text">
            <b>Clínica de Odontología</b>
        </div>
    </div>
</nav>
