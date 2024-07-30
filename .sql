create table pacientes (
    paciente_id SERIAL PRIMARY KEY NOT NULL,
    paciente_nombre VARCHAR(100) NOT NULL,
    paciente_telefono INTEGER NOT NULL,
    paciente_correo VARCHAR(50) NOT NULL,
    paciente_edad INTEGER NOT NULL,
    paciente_situacion SMALLINT DEFAULT 1
);