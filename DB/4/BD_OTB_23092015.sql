--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: anuncio; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE anuncio (
    pk_anuncio integer NOT NULL,
    pk_usuario integer,
    vch_anuntitulo text NOT NULL,
    vch_anuncontenido text,
    vch_anunfoto text,
    dtt_anunfechainicio date NOT NULL,
    dtt_anunfechafin date NOT NULL,
    vch_anunestado character(1) NOT NULL
);


ALTER TABLE anuncio OWNER TO postgres;

--
-- Name: anuncio_pk_anuncio_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE anuncio_pk_anuncio_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE anuncio_pk_anuncio_seq OWNER TO postgres;

--
-- Name: anuncio_pk_anuncio_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE anuncio_pk_anuncio_seq OWNED BY anuncio.pk_anuncio;


--
-- Name: asignado; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE asignado (
    pk_asignado integer NOT NULL,
    pk_privilegio integer,
    pk_rol integer,
    int_asigprivilegioasignado integer NOT NULL,
    vch_asigdescripcion text
);


ALTER TABLE asignado OWNER TO postgres;

--
-- Name: asignado_pk_asignado_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE asignado_pk_asignado_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE asignado_pk_asignado_seq OWNER TO postgres;

--
-- Name: asignado_pk_asignado_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE asignado_pk_asignado_seq OWNED BY asignado.pk_asignado;


--
-- Name: conceptomovimiento; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE conceptomovimiento (
    pk_concepto integer NOT NULL,
    vch_catenombre text,
    vch_cateestado character(1),
    vch_tipoconcepto character(1)
);


ALTER TABLE conceptomovimiento OWNER TO postgres;

--
-- Name: conceptomovimiento_pk_concepto_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE conceptomovimiento_pk_concepto_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE conceptomovimiento_pk_concepto_seq OWNER TO postgres;

--
-- Name: conceptomovimiento_pk_concepto_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE conceptomovimiento_pk_concepto_seq OWNED BY conceptomovimiento.pk_concepto;


--
-- Name: configuracion; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE configuracion (
    pk_configuracion integer NOT NULL,
    vch_conflogoempresa text,
    vch_conftitulosoftware text,
    vch_confdetallesoftware text,
    vch_confdescripcionsoftware text,
    int_conffuentesizets integer,
    int_conffuentesizedetallesoft integer,
    int_conffuentesizedescripsoft integer,
    vch_conflenguaje text,
    vch_conftemaskin text,
    vch_confcoloringresos text,
    vch_confcoloregresos text,
    vch_confimagenpdf text,
    int_conffuentesizetitulos integer,
    int_conffuentesizetitulocampos integer,
    int_conffuentesizedatos integer,
    int_conffuentesizebtn integer,
    dat_conffechacopyright date,
    vch_confnombredevsoft text,
    vch_conflogodevsoft text
);


ALTER TABLE configuracion OWNER TO postgres;

--
-- Name: configuracion_pk_configuracion_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE configuracion_pk_configuracion_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE configuracion_pk_configuracion_seq OWNER TO postgres;

--
-- Name: configuracion_pk_configuracion_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE configuracion_pk_configuracion_seq OWNED BY configuracion.pk_configuracion;


--
-- Name: gestion; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE gestion (
    pk_gestion integer NOT NULL,
    vch_gestnombreperiocidad text,
    vch_gestestado character(1)
);


ALTER TABLE gestion OWNER TO postgres;

--
-- Name: gestion_pk_gestion_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE gestion_pk_gestion_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE gestion_pk_gestion_seq OWNER TO postgres;

--
-- Name: gestion_pk_gestion_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE gestion_pk_gestion_seq OWNED BY gestion.pk_gestion;


--
-- Name: manzano; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE manzano (
    pk_manzano integer NOT NULL,
    pk_otb integer,
    vch_manznumeromanzano text NOT NULL,
    vch_manzdescripcion text,
    vch_manzestado character(1) NOT NULL
);


ALTER TABLE manzano OWNER TO postgres;

--
-- Name: manzano_pk_manzano_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE manzano_pk_manzano_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE manzano_pk_manzano_seq OWNER TO postgres;

--
-- Name: manzano_pk_manzano_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE manzano_pk_manzano_seq OWNED BY manzano.pk_manzano;


--
-- Name: movimiento; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE movimiento (
    pk_movimiento integer NOT NULL,
    pk_gestion integer,
    pk_usuario integer,
    dat_movfecha date,
    int_movmonto real,
    vch_movnotadetalle text,
    vch_movconcepto text,
    vch_movtipoie character(1)
);


ALTER TABLE movimiento OWNER TO postgres;

--
-- Name: movimiento_pk_movimiento_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE movimiento_pk_movimiento_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE movimiento_pk_movimiento_seq OWNER TO postgres;

--
-- Name: movimiento_pk_movimiento_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE movimiento_pk_movimiento_seq OWNED BY movimiento.pk_movimiento;


--
-- Name: nominaasistencia; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE nominaasistencia (
    pk_nominasistencia integer NOT NULL,
    pk_gestion integer,
    pk_usuario integer,
    vch_nomifecha date,
    vch_nominotadetalle text,
    bol_nomiasistenciaestado boolean
);


ALTER TABLE nominaasistencia OWNER TO postgres;

--
-- Name: nominaasistencia_pk_nominasistencia_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE nominaasistencia_pk_nominasistencia_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE nominaasistencia_pk_nominasistencia_seq OWNER TO postgres;

--
-- Name: nominaasistencia_pk_nominasistencia_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE nominaasistencia_pk_nominasistencia_seq OWNED BY nominaasistencia.pk_nominasistencia;


--
-- Name: otb; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE otb (
    pk_otb integer NOT NULL,
    vch_otbnombre text NOT NULL,
    vch_otbnombredistrito text,
    vch_otbnombremunicipio text,
    vch_obtestado character(1) NOT NULL
);


ALTER TABLE otb OWNER TO postgres;

--
-- Name: otb_pk_otb_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE otb_pk_otb_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE otb_pk_otb_seq OWNER TO postgres;

--
-- Name: otb_pk_otb_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE otb_pk_otb_seq OWNED BY otb.pk_otb;


--
-- Name: privilegio; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE privilegio (
    pk_privilegio integer NOT NULL,
    vch_privnombre text NOT NULL,
    vch_privpath text NOT NULL,
    bol_privcliente boolean,
    bol_privadmin boolean,
    vch_privestado character(1) NOT NULL
);


ALTER TABLE privilegio OWNER TO postgres;

--
-- Name: privilegio_pk_privilegio_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE privilegio_pk_privilegio_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE privilegio_pk_privilegio_seq OWNER TO postgres;

--
-- Name: privilegio_pk_privilegio_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE privilegio_pk_privilegio_seq OWNED BY privilegio.pk_privilegio;


--
-- Name: propiedad; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE propiedad (
    pk_propiedad integer NOT NULL,
    pk_usuario integer,
    pk_manzano integer,
    vch_proptipo text NOT NULL,
    vch_propnumerolote text,
    vch_propnumerocasa text,
    vch_propestado character(1) NOT NULL
);


ALTER TABLE propiedad OWNER TO postgres;

--
-- Name: propiedad_pk_propiedad_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE propiedad_pk_propiedad_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE propiedad_pk_propiedad_seq OWNER TO postgres;

--
-- Name: propiedad_pk_propiedad_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE propiedad_pk_propiedad_seq OWNED BY propiedad.pk_propiedad;


--
-- Name: rol; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE rol (
    pk_rol integer NOT NULL,
    vch_rolnombre text NOT NULL,
    vch_rolestado character(1) NOT NULL
);


ALTER TABLE rol OWNER TO postgres;

--
-- Name: rol_pk_rol_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE rol_pk_rol_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE rol_pk_rol_seq OWNER TO postgres;

--
-- Name: rol_pk_rol_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE rol_pk_rol_seq OWNED BY rol.pk_rol;


--
-- Name: total; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE total (
    pk_total integer NOT NULL,
    vch_conceptototalmov text,
    real_montototalmov real
);


ALTER TABLE total OWNER TO postgres;

--
-- Name: total_pk_total_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE total_pk_total_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE total_pk_total_seq OWNER TO postgres;

--
-- Name: total_pk_total_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE total_pk_total_seq OWNED BY total.pk_total;


--
-- Name: usuario; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE usuario (
    pk_usuario integer NOT NULL,
    pk_otb integer,
    pk_rol integer,
    vch_usuatipousuario text NOT NULL,
    vch_usuausername text NOT NULL,
    vch_usuanombre text NOT NULL,
    vch_usuaapp text NOT NULL,
    vch_usuaapm text,
    vch_usuasexo text NOT NULL,
    dat_usuafechanacimiento date NOT NULL,
    vch_usuaci text NOT NULL,
    vch_usuatelefono text,
    vch_usuadireccion text,
    vch_usuafoto text,
    vch_usuaestado character(1) NOT NULL
);


ALTER TABLE usuario OWNER TO postgres;

--
-- Name: usuario_pk_usuario_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE usuario_pk_usuario_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE usuario_pk_usuario_seq OWNER TO postgres;

--
-- Name: usuario_pk_usuario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE usuario_pk_usuario_seq OWNED BY usuario.pk_usuario;


--
-- Name: pk_anuncio; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY anuncio ALTER COLUMN pk_anuncio SET DEFAULT nextval('anuncio_pk_anuncio_seq'::regclass);


--
-- Name: pk_asignado; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY asignado ALTER COLUMN pk_asignado SET DEFAULT nextval('asignado_pk_asignado_seq'::regclass);


--
-- Name: pk_concepto; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY conceptomovimiento ALTER COLUMN pk_concepto SET DEFAULT nextval('conceptomovimiento_pk_concepto_seq'::regclass);


--
-- Name: pk_configuracion; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY configuracion ALTER COLUMN pk_configuracion SET DEFAULT nextval('configuracion_pk_configuracion_seq'::regclass);


--
-- Name: pk_gestion; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY gestion ALTER COLUMN pk_gestion SET DEFAULT nextval('gestion_pk_gestion_seq'::regclass);


--
-- Name: pk_manzano; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY manzano ALTER COLUMN pk_manzano SET DEFAULT nextval('manzano_pk_manzano_seq'::regclass);


--
-- Name: pk_movimiento; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY movimiento ALTER COLUMN pk_movimiento SET DEFAULT nextval('movimiento_pk_movimiento_seq'::regclass);


--
-- Name: pk_nominasistencia; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY nominaasistencia ALTER COLUMN pk_nominasistencia SET DEFAULT nextval('nominaasistencia_pk_nominasistencia_seq'::regclass);


--
-- Name: pk_otb; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY otb ALTER COLUMN pk_otb SET DEFAULT nextval('otb_pk_otb_seq'::regclass);


--
-- Name: pk_privilegio; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY privilegio ALTER COLUMN pk_privilegio SET DEFAULT nextval('privilegio_pk_privilegio_seq'::regclass);


--
-- Name: pk_propiedad; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY propiedad ALTER COLUMN pk_propiedad SET DEFAULT nextval('propiedad_pk_propiedad_seq'::regclass);


--
-- Name: pk_rol; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY rol ALTER COLUMN pk_rol SET DEFAULT nextval('rol_pk_rol_seq'::regclass);


--
-- Name: pk_total; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY total ALTER COLUMN pk_total SET DEFAULT nextval('total_pk_total_seq'::regclass);


--
-- Name: pk_usuario; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuario ALTER COLUMN pk_usuario SET DEFAULT nextval('usuario_pk_usuario_seq'::regclass);


--
-- Data for Name: anuncio; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO anuncio VALUES (1, 7, 'Reunión Octubre', 'Se comunica que la reunión de octubre es el primer domingo del mes
', '', '2015-09-22', '2015-09-30', 'A');
INSERT INTO anuncio VALUES (2, 7, 'Reunión Aniversario OTB', 'Se comunica que la reunión para planificar la fiesta aniversario se realizara  el sábado  26 de Sept', '', '2015-09-23', '2015-09-25', 'A');


--
-- Name: anuncio_pk_anuncio_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('anuncio_pk_anuncio_seq', 5, true);


--
-- Data for Name: asignado; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO asignado VALUES (1, 1, 1, 1, 'asignado para administrador');
INSERT INTO asignado VALUES (2, 2, 1, 1, 'asignado para administrador');
INSERT INTO asignado VALUES (3, 3, 1, 1, 'asignado para administrador');
INSERT INTO asignado VALUES (4, 4, 1, 1, 'asignado para administrador');
INSERT INTO asignado VALUES (5, 5, 1, 1, 'asignado para administrador');


--
-- Name: asignado_pk_asignado_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('asignado_pk_asignado_seq', 5, true);


--
-- Data for Name: conceptomovimiento; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO conceptomovimiento VALUES (1, 'Aporte Mensual', 'A', 'I');
INSERT INTO conceptomovimiento VALUES (2, 'Multa Desfile', 'A', 'I');
INSERT INTO conceptomovimiento VALUES (4, 'Colaboracion', 'A', 'I');
INSERT INTO conceptomovimiento VALUES (5, 'Aniversario', 'A', 'I');
INSERT INTO conceptomovimiento VALUES (6, 'Colaboración a vecino Juan Pérez', 'I', 'E');
INSERT INTO conceptomovimiento VALUES (3, 'Trabajo Comunitario', 'I', 'I');


--
-- Name: conceptomovimiento_pk_concepto_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('conceptomovimiento_pk_concepto_seq', 5, true);


--
-- Data for Name: configuracion; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Name: configuracion_pk_configuracion_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('configuracion_pk_configuracion_seq', 1, false);


--
-- Data for Name: gestion; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO gestion VALUES (2, '2011', 'A');
INSERT INTO gestion VALUES (3, '2012', 'A');
INSERT INTO gestion VALUES (4, '2013', 'A');
INSERT INTO gestion VALUES (5, '2014', 'A');
INSERT INTO gestion VALUES (6, '2015', 'A');


--
-- Name: gestion_pk_gestion_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('gestion_pk_gestion_seq', 6, true);


--
-- Data for Name: manzano; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO manzano VALUES (1, 1, '5', 'Lado el colegio PJU', 'A');


--
-- Name: manzano_pk_manzano_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('manzano_pk_manzano_seq', 1, true);


--
-- Data for Name: movimiento; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO movimiento VALUES (1, 2, 1, '2015-07-29', 100, '                        aporte comunitario', '1', 'I');
INSERT INTO movimiento VALUES (2, 6, 1, '2015-07-28', 50, '                        ', '1', 'I');
INSERT INTO movimiento VALUES (3, 6, 1, '2015-07-28', 50, '                        ', '1', 'I');
INSERT INTO movimiento VALUES (4, 6, 6, '2015-07-28', 1.5, 'prueba del formulario', '1', 'I');
INSERT INTO movimiento VALUES (5, 6, 1, '2015-08-11', 10, 'aporte para la otb', '1', 'I');
INSERT INTO movimiento VALUES (6, 6, 1, '2015-08-11', 30, 'por inasistencia al desfile', '2', 'I');
INSERT INTO movimiento VALUES (7, 6, 2, '2015-08-11', 50, 'inasistencia de des...', '1', 'I');
INSERT INTO movimiento VALUES (8, 6, 1, '2015-08-11', 10, 'inasistencia desfile', '2', 'I');
INSERT INTO movimiento VALUES (9, 3, 5, '2015-08-11', 10.5, 'ddddddnnnn', '1', 'I');
INSERT INTO movimiento VALUES (10, 3, 2, '2015-08-11', 20, 'limpieza parque', '3', 'I');
INSERT INTO movimiento VALUES (11, 6, 5, '2015-08-11', 30, 'mantenimiento jardines', '3', 'I');
INSERT INTO movimiento VALUES (12, 6, 3, '2015-08-11', 10, 'aporte mensual', '1', 'I');
INSERT INTO movimiento VALUES (14, 6, 1, '2015-08-11', 10, 'verificar egreso', '1', 'E');


--
-- Name: movimiento_pk_movimiento_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('movimiento_pk_movimiento_seq', 16, true);


--
-- Data for Name: nominaasistencia; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Name: nominaasistencia_pk_nominasistencia_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('nominaasistencia_pk_nominasistencia_seq', 1, false);


--
-- Data for Name: otb; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO otb VALUES (1, 'Naranjal', '4', 'Chimore', 'A');


--
-- Name: otb_pk_otb_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('otb_pk_otb_seq', 1, true);


--
-- Data for Name: privilegio; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO privilegio VALUES (1, 'Inicio', 'inicio/', true, true, 'A');
INSERT INTO privilegio VALUES (2, 'Rol', 'rol/', false, true, 'A');
INSERT INTO privilegio VALUES (3, 'Privilegio', 'privilegio/', false, true, 'A');
INSERT INTO privilegio VALUES (4, 'Anuncio', 'anuncio/', false, true, 'A');
INSERT INTO privilegio VALUES (5, 'Actividad', 'actividad/', false, true, 'A');


--
-- Name: privilegio_pk_privilegio_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('privilegio_pk_privilegio_seq', 5, true);


--
-- Data for Name: propiedad; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO propiedad VALUES (1, 4, 1, 'Lote', '5', 'S/N', 'A');


--
-- Name: propiedad_pk_propiedad_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('propiedad_pk_propiedad_seq', 1, true);


--
-- Data for Name: rol; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO rol VALUES (2, 'Presidente', 'A');
INSERT INTO rol VALUES (3, 'Secretaria', 'A');
INSERT INTO rol VALUES (1, 'Administrador', 'A');
INSERT INTO rol VALUES (4, 'Vecino', 'I');


--
-- Name: rol_pk_rol_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('rol_pk_rol_seq', 4, true);


--
-- Data for Name: total; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Name: total_pk_total_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('total_pk_total_seq', 1, false);


--
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO usuario VALUES (1, 1, 1, 'otb', 'otb', '', '', '', 'NA', '1987-06-26', '', '', '', '', 'A');
INSERT INTO usuario VALUES (5, 1, 2, 'Vecino', 'budita', 'Diego', 'Gonzales', 'Soto', 'M', '1987-06-26', '6543216', '79972123', 'Quillacollo', '../img/foto.png', 'A');
INSERT INTO usuario VALUES (2, 1, 2, 'Presidente', 'Flaca', 'Claudia', 'Quijarro', 'Claros', 'F', '1999-01-10', '54321', '77654321', 'Av. Tronpillo', '../foto.png', 'A');
INSERT INTO usuario VALUES (3, 1, 3, 'Secretaria', 'Oli', 'Olivia', 'Fajardo', 'Sanchez', 'F', '2000-06-09', '456789', '78901234', 'Calle. Naranjal', '../foto.png', 'A');
INSERT INTO usuario VALUES (4, 1, 4, 'Vecino', 'Marce', 'Marcelino', 'Pan', 'Vino', 'M', '2001-12-10', '9876543', '76767676', 'Calle los pinos', '../foto.png', 'A');
INSERT INTO usuario VALUES (6, 1, 1, 'Administrador', 'Arnold', 'Jaime Arnold', 'Huanca', 'Valle', 'M', '1980-01-01', '0123456', '777777', 'cbba', '../img/foto.png', 'A');
INSERT INTO usuario VALUES (7, 1, 1, 'Administrador', 'Homero', 'Diego', 'Gonzales', 'Soto', 'M', '1989-06-26', '0123456', '79972123', 'CBBA-Quillacollo', '../foto/dgs12092015120545.png', 'A');


--
-- Name: usuario_pk_usuario_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('usuario_pk_usuario_seq', 7, true);


--
-- Name: pk_anuncio; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY anuncio
    ADD CONSTRAINT pk_anuncio PRIMARY KEY (pk_anuncio);


--
-- Name: pk_asignado; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY asignado
    ADD CONSTRAINT pk_asignado PRIMARY KEY (pk_asignado);


--
-- Name: pk_conceptoingresoegreso; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY conceptomovimiento
    ADD CONSTRAINT pk_conceptoingresoegreso PRIMARY KEY (pk_concepto);


--
-- Name: pk_configuracion; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY configuracion
    ADD CONSTRAINT pk_configuracion PRIMARY KEY (pk_configuracion);


--
-- Name: pk_gestion; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY gestion
    ADD CONSTRAINT pk_gestion PRIMARY KEY (pk_gestion);


--
-- Name: pk_manzano; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY manzano
    ADD CONSTRAINT pk_manzano PRIMARY KEY (pk_manzano);


--
-- Name: pk_movimiento; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY movimiento
    ADD CONSTRAINT pk_movimiento PRIMARY KEY (pk_movimiento);


--
-- Name: pk_nominaasistencia; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY nominaasistencia
    ADD CONSTRAINT pk_nominaasistencia PRIMARY KEY (pk_nominasistencia);


--
-- Name: pk_otb; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY otb
    ADD CONSTRAINT pk_otb PRIMARY KEY (pk_otb);


--
-- Name: pk_privilegio; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY privilegio
    ADD CONSTRAINT pk_privilegio PRIMARY KEY (pk_privilegio);


--
-- Name: pk_propiedad; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY propiedad
    ADD CONSTRAINT pk_propiedad PRIMARY KEY (pk_propiedad);


--
-- Name: pk_rol; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY rol
    ADD CONSTRAINT pk_rol PRIMARY KEY (pk_rol);


--
-- Name: pk_total; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY total
    ADD CONSTRAINT pk_total PRIMARY KEY (pk_total);


--
-- Name: pk_usuario; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT pk_usuario PRIMARY KEY (pk_usuario);


--
-- Name: anuncio_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX anuncio_pk ON anuncio USING btree (pk_anuncio);


--
-- Name: asignado_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX asignado_pk ON asignado USING btree (pk_asignado);


--
-- Name: conceptoingresoegreso_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX conceptoingresoegreso_pk ON conceptomovimiento USING btree (pk_concepto);


--
-- Name: configuracion_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX configuracion_pk ON configuracion USING btree (pk_configuracion);


--
-- Name: gestion_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX gestion_pk ON gestion USING btree (pk_gestion);


--
-- Name: manzano_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX manzano_pk ON manzano USING btree (pk_manzano);


--
-- Name: movimiento_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX movimiento_pk ON movimiento USING btree (pk_movimiento);


--
-- Name: nominaasistencia_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX nominaasistencia_pk ON nominaasistencia USING btree (pk_nominasistencia);


--
-- Name: otb_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX otb_pk ON otb USING btree (pk_otb);


--
-- Name: privilegio_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX privilegio_pk ON privilegio USING btree (pk_privilegio);


--
-- Name: propiedad_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX propiedad_pk ON propiedad USING btree (pk_propiedad);


--
-- Name: relationship_10_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship_10_fk ON nominaasistencia USING btree (pk_usuario);


--
-- Name: relationship_11_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship_11_fk ON propiedad USING btree (pk_usuario);


--
-- Name: relationship_12_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship_12_fk ON movimiento USING btree (pk_usuario);


--
-- Name: relationship_13_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship_13_fk ON nominaasistencia USING btree (pk_gestion);


--
-- Name: relationship_14_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship_14_fk ON anuncio USING btree (pk_usuario);


--
-- Name: relationship_1_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship_1_fk ON asignado USING btree (pk_privilegio);


--
-- Name: relationship_2_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship_2_fk ON asignado USING btree (pk_rol);


--
-- Name: relationship_3_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship_3_fk ON usuario USING btree (pk_rol);


--
-- Name: relationship_5_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship_5_fk ON usuario USING btree (pk_otb);


--
-- Name: relationship_6_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship_6_fk ON manzano USING btree (pk_otb);


--
-- Name: relationship_7_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship_7_fk ON propiedad USING btree (pk_manzano);


--
-- Name: relationship_9_fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX relationship_9_fk ON movimiento USING btree (pk_gestion);


--
-- Name: rol_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX rol_pk ON rol USING btree (pk_rol);


--
-- Name: usuario_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX usuario_pk ON usuario USING btree (pk_usuario);


--
-- Name: fk_anuncio_relations_usuario; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY anuncio
    ADD CONSTRAINT fk_anuncio_relations_usuario FOREIGN KEY (pk_usuario) REFERENCES usuario(pk_usuario) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_asignado_relations_privileg; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY asignado
    ADD CONSTRAINT fk_asignado_relations_privileg FOREIGN KEY (pk_privilegio) REFERENCES privilegio(pk_privilegio) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_asignado_relations_rol; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY asignado
    ADD CONSTRAINT fk_asignado_relations_rol FOREIGN KEY (pk_rol) REFERENCES rol(pk_rol) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_manzano_relations_otb; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY manzano
    ADD CONSTRAINT fk_manzano_relations_otb FOREIGN KEY (pk_otb) REFERENCES otb(pk_otb) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_movimiento_relations_gestion; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY movimiento
    ADD CONSTRAINT fk_movimiento_relations_gestion FOREIGN KEY (pk_gestion) REFERENCES gestion(pk_gestion) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_movimiento_relations_usuario; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY movimiento
    ADD CONSTRAINT fk_movimiento_relations_usuario FOREIGN KEY (pk_usuario) REFERENCES usuario(pk_usuario) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_nominaas_relations_gestion; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY nominaasistencia
    ADD CONSTRAINT fk_nominaas_relations_gestion FOREIGN KEY (pk_gestion) REFERENCES gestion(pk_gestion) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_nominaas_relations_usuario; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY nominaasistencia
    ADD CONSTRAINT fk_nominaas_relations_usuario FOREIGN KEY (pk_usuario) REFERENCES usuario(pk_usuario) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_propieda_relations_manzano; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY propiedad
    ADD CONSTRAINT fk_propieda_relations_manzano FOREIGN KEY (pk_manzano) REFERENCES manzano(pk_manzano) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_propieda_relations_usuario; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY propiedad
    ADD CONSTRAINT fk_propieda_relations_usuario FOREIGN KEY (pk_usuario) REFERENCES usuario(pk_usuario) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_usuario_relations_otb; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT fk_usuario_relations_otb FOREIGN KEY (pk_otb) REFERENCES otb(pk_otb) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_usuario_relations_rol; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT fk_usuario_relations_rol FOREIGN KEY (pk_rol) REFERENCES rol(pk_rol) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

