CREATE TABLE documentos (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    codigo VARCHAR(50) NOT NULL,
    nombre VARCHAR(150) NOT NULL,
    archivo VARCHAR(150) NOT NULL,
    fecha DATE NOT NULL,
    area_id INTEGER NOT NULL,
    activo CHAR(1) NOT NULL,
    created_at TIMESTAMP NOT NULL,
    updated_at TIMESTAMP NOT NULL
);

CREATE TABLE area (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(150) NOT NULL,
    activo CHAR(1) NOT NULL,
    created_at TIMESTAMP NOT NULL,
    updated_at TIMESTAMP NOT NULL
);

CREATE TABLE version (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    descripcion VARCHAR(3) NOT NULL,
    activo CHAR(1) NOT NULL,
    created_at TIMESTAMP NOT NULL,
    updated_at TIMESTAMP NOT NULL
);

CREATE TABLE doc_ver (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    documentos_id INTEGER NOT NULL,
    version_id INTEGER NOT NULL
);

ALTER TABLE documentos ADD FOREIGN KEY (area_id) REFERENCES area (id);
ALTER TABLE doc_ver ADD FOREIGN KEY (documentos_id) REFERENCES documentos (id);
ALTER TABLE doc_ver ADD FOREIGN KEY (version_id) REFERENCES version (id);

INSERT INTO area VALUES (NULL, 'Contabilidad', 's', '2021-10-08 14:21:40', '2021-10-08 14:21:40');
INSERT INTO area VALUES (NULL, 'Recursos Humanos', 's', '2021-10-08 14:21:40', '2021-10-08 14:21:40');
INSERT INTO area VALUES (NULL, 'Calidad', 's', '2021-10-07 14:21:40', '2021-10-08 14:21:40');
INSERT INTO area VALUES (NULL, 'Financiero', 's', '2021-10-08 14:21:40', '2021-10-08 14:21:40');

INSERT INTO version VALUES (NULL, 1, 's', '2021-10-08 14:21:40', '2021-10-08 14:21:40');
INSERT INTO version VALUES (NULL, 2, 's', '2021-10-08 14:21:40', '2021-10-08 14:21:40');
INSERT INTO version VALUES (NULL, 3, 's', '2021-10-08 14:21:40', '2021-10-08 14:21:40');