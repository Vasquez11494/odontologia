create table pacientes (
    paciente_id SERIAL PRIMARY KEY NOT NULL,
    paciente_nombre VARCHAR(100) NOT NULL,
    paciente_telefono INTEGER NOT NULL,
    paciente_correo VARCHAR(50) NOT NULL,
    paciente_edad INTEGER NOT NULL,
    paciente_situacion SMALLINT DEFAULT 1
);

create table doctores (
    doctor_id SERIAL PRIMARY KEY NOT NULL,
    doctor_nombre VARCHAR(100) NOT NULL,
    doctor_telefono INTEGER NOT NULL,
    doctor_colegiado VARCHAR(50) NOT NULL,
    doctor_edad INTEGER NOT NULL,
    doctor_situacion SMALLINT DEFAULT 1
);

CREATE TABLE citas (
    cita_id SERIAL PRIMARY KEY NOT NULL,
    cita_paciente INT NOT NULL,
    cita_doctor INT NOT NULL,
    cita_fecha DATETIME YEAR TO MINUTE NOT NULL,
    cita_descripcion VARCHAR(150),
    cita_situacion SMALLINT DEFAULT 1,
    FOREIGN KEY (cita_paciente) REFERENCES pacientes (paciente_id),
    FOREIGN KEY (cita_doctor) REFERENCES doctores (doctor_id)
);