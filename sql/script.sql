CREATE DATABASE clinica_medica;

CREATE TABLE paciente(
    pac_id SERIAL NOT NULL,
    pac_nombre VARCHAR (50),
    pac_tel VARCHAR (09),
    pac_direccion VARCHAR (20),
    pac_correo VARCHAR (20),
    pac_sit SMALLINT DEFAULT 1,
    PRIMARY KEY (pac_id)
);

CREATE TABLE servicio (
    ser_id SERIAL NOT NULL,
    ser_nombre VARCHAR (30),
    ser_fecha DATETIME YEAR TO HOUR,
    ser_sit SMALLINT DEFAULT 1,
    PRIMARY KEY (ser_id)
);

CREATE TABLE detalle(
    det_id SERIAL NOT NULL,
    det_pac INTEGER,
    det_ser INTEGER,
    det_sit SMALLINT DEFAULT 1,
    PRIMARY KEY (det_id),
    FOREIGN KEY (det_pac) REFERENCES paciente (pac_id),
    FOREIGN KEY (det_ser) REFERENCES servicio (ser_id)
);