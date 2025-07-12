--
-- PostgreSQL database dump
--

-- Dumped from database version 16.2
-- Dumped by pg_dump version 16.2

-- Started on 2025-07-12 13:45:48

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 225 (class 1255 OID 127106)
-- Name: activar_mesas(); Type: PROCEDURE; Schema: public; Owner: postgres
--

CREATE PROCEDURE public.activar_mesas()
    LANGUAGE plpgsql
    AS $$
BEGIN
    UPDATE mesa
    SET mesacondicion = 1
    WHERE num_mesa IN (
        SELECT num_mesa
        FROM reserva
        WHERE reservafecha + reservahora + interval '3 hours' < now()
    )
    AND mesacondicion = 0;
END;
$$;


ALTER PROCEDURE public.activar_mesas() OWNER TO postgres;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 215 (class 1259 OID 127107)
-- Name: cliente; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cliente (
    idcliente integer NOT NULL,
    clientenombre character varying(100) NOT NULL,
    clienteemail character varying(50) NOT NULL,
    rol smallint DEFAULT 0
);


ALTER TABLE public.cliente OWNER TO postgres;

--
-- TOC entry 216 (class 1259 OID 127111)
-- Name: cliente_idcliente_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.cliente_idcliente_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.cliente_idcliente_seq OWNER TO postgres;

--
-- TOC entry 4886 (class 0 OID 0)
-- Dependencies: 216
-- Name: cliente_idcliente_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.cliente_idcliente_seq OWNED BY public.cliente.idcliente;


--
-- TOC entry 217 (class 1259 OID 127112)
-- Name: jugos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.jugos (
    idjugo integer NOT NULL,
    jugonombre character varying(100) NOT NULL,
    jugodescripcion character varying(500) NOT NULL,
    jugotipo character varying(100) NOT NULL,
    jugoprecio character varying(50) NOT NULL,
    jugoimagen character varying(100) NOT NULL,
    jugocondicion smallint DEFAULT 1 NOT NULL
);


ALTER TABLE public.jugos OWNER TO postgres;

--
-- TOC entry 218 (class 1259 OID 127118)
-- Name: jugos_idjugo_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.jugos_idjugo_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.jugos_idjugo_seq OWNER TO postgres;

--
-- TOC entry 4887 (class 0 OID 0)
-- Dependencies: 218
-- Name: jugos_idjugo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.jugos_idjugo_seq OWNED BY public.jugos.idjugo;


--
-- TOC entry 219 (class 1259 OID 127119)
-- Name: menu; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.menu (
    idcomida integer NOT NULL,
    comidanombre character varying(100) NOT NULL,
    comidadescripcion character varying(500) NOT NULL,
    comidatipo character varying(100) NOT NULL,
    comidaprecio character varying(50) NOT NULL,
    comidaimagen character varying(100) NOT NULL,
    menucondicion smallint DEFAULT 1 NOT NULL
);


ALTER TABLE public.menu OWNER TO postgres;

--
-- TOC entry 220 (class 1259 OID 127125)
-- Name: menu_idcomida_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.menu_idcomida_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.menu_idcomida_seq OWNER TO postgres;

--
-- TOC entry 4888 (class 0 OID 0)
-- Dependencies: 220
-- Name: menu_idcomida_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.menu_idcomida_seq OWNED BY public.menu.idcomida;


--
-- TOC entry 221 (class 1259 OID 127126)
-- Name: mesa; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.mesa (
    num_mesa integer NOT NULL,
    mesacapacidad character varying(50) NOT NULL,
    mesacondicion smallint DEFAULT 1 NOT NULL
);


ALTER TABLE public.mesa OWNER TO postgres;

--
-- TOC entry 222 (class 1259 OID 127130)
-- Name: mesa_num_mesa_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.mesa_num_mesa_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.mesa_num_mesa_seq OWNER TO postgres;

--
-- TOC entry 4889 (class 0 OID 0)
-- Dependencies: 222
-- Name: mesa_num_mesa_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.mesa_num_mesa_seq OWNED BY public.mesa.num_mesa;


--
-- TOC entry 223 (class 1259 OID 127131)
-- Name: reserva; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.reserva (
    idreserva integer NOT NULL,
    num_comensales integer NOT NULL,
    num_mesa integer NOT NULL,
    reservahora time with time zone NOT NULL,
    reservafecha date NOT NULL,
    clientenombre character varying(200) NOT NULL
);


ALTER TABLE public.reserva OWNER TO postgres;

--
-- TOC entry 224 (class 1259 OID 127134)
-- Name: reserva_idreserva_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.reserva_idreserva_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.reserva_idreserva_seq OWNER TO postgres;

--
-- TOC entry 4890 (class 0 OID 0)
-- Dependencies: 224
-- Name: reserva_idreserva_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.reserva_idreserva_seq OWNED BY public.reserva.idreserva;


--
-- TOC entry 4709 (class 2604 OID 127135)
-- Name: cliente idcliente; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cliente ALTER COLUMN idcliente SET DEFAULT nextval('public.cliente_idcliente_seq'::regclass);


--
-- TOC entry 4711 (class 2604 OID 127136)
-- Name: jugos idjugo; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jugos ALTER COLUMN idjugo SET DEFAULT nextval('public.jugos_idjugo_seq'::regclass);


--
-- TOC entry 4713 (class 2604 OID 127137)
-- Name: menu idcomida; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.menu ALTER COLUMN idcomida SET DEFAULT nextval('public.menu_idcomida_seq'::regclass);


--
-- TOC entry 4715 (class 2604 OID 127138)
-- Name: mesa num_mesa; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mesa ALTER COLUMN num_mesa SET DEFAULT nextval('public.mesa_num_mesa_seq'::regclass);


--
-- TOC entry 4717 (class 2604 OID 127139)
-- Name: reserva idreserva; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.reserva ALTER COLUMN idreserva SET DEFAULT nextval('public.reserva_idreserva_seq'::regclass);


--
-- TOC entry 4871 (class 0 OID 127107)
-- Dependencies: 215
-- Data for Name: cliente; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cliente (idcliente, clientenombre, clienteemail, rol) FROM stdin;
\.


--
-- TOC entry 4873 (class 0 OID 127112)
-- Dependencies: 217
-- Data for Name: jugos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.jugos (idjugo, jugonombre, jugodescripcion, jugotipo, jugoprecio, jugoimagen, jugocondicion) FROM stdin;
5	COCA COLA	SODA 	SIN ALCOHOL	12	1717733127.jpg	1
11	DDD	TTTTT	TTTTT	22	1718345184.jpg	0
9	TTTT	FFFF	TTTTT	666	1717798402.jpg	0
10	JUGO DE DURAZNO	JUGO DEL VALLE	SIN ALCOHOL	8	1718140535.jpg	0
6	PEPSI	SODA 	SIN ALCOHOL	12	1717733167.jpg	0
12	JUGO DEL VALLE	UN JUGO NATURAL	FRUTAL	10		0
\.


--
-- TOC entry 4875 (class 0 OID 127119)
-- Dependencies: 219
-- Data for Name: menu; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.menu (idcomida, comidanombre, comidadescripcion, comidatipo, comidaprecio, comidaimagen, menucondicion) FROM stdin;
22	PIQUE MACHO	PLATO TIPICO COCHABAMBINO	ALMUERZO	30	1717731151.jpg	1
21	FRICASE	FRICASE DE CHANCO	ALMUERZO	25	1717731101.jpg	1
23	ASADO	ASADO DE RES	ALMUERZO	30	1717731174.jpg	0
24	SAICE	PLATO TIPICO TARIJEÑO	ALMUERZO	20	1717731200.jpg	0
20	SOPA DE MANI	SOPA DE MANI CRIOLLA	SOPA	-6666	1717730907.jpg	1
\.


--
-- TOC entry 4877 (class 0 OID 127126)
-- Dependencies: 221
-- Data for Name: mesa; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.mesa (num_mesa, mesacapacidad, mesacondicion) FROM stdin;
15	4	1
14	4	1
13	4	1
12	4	1
11	4	1
10	2	1
8	2	1
7	2	1
16	4	0
2	6	1
3	4	1
4	4	1
9	2	1
5	4	1
1	6	0
6	4	0
\.


--
-- TOC entry 4879 (class 0 OID 127131)
-- Dependencies: 223
-- Data for Name: reserva; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.reserva (idreserva, num_comensales, num_mesa, reservahora, reservafecha, clientenombre) FROM stdin;
6	1	1	02:20:00-04	2024-06-12	Paolo Alejandro Velarde Ramírez
7	5	5	05:30:00-04	2024-06-11	Paolo Alejandro Velarde Ramirez
8	8	6	03:30:00-04	2024-06-10	Paolo Alejandro Velarde Ramirez
9	3	1	05:30:00-04	2024-07-06	Paolo Alejandro Velarde Ramirez
10	6	6	06:06:00-04	2024-06-06	Paolo Alejandro Velarde Ramirez
\.


--
-- TOC entry 4891 (class 0 OID 0)
-- Dependencies: 216
-- Name: cliente_idcliente_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.cliente_idcliente_seq', 10, true);


--
-- TOC entry 4892 (class 0 OID 0)
-- Dependencies: 218
-- Name: jugos_idjugo_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.jugos_idjugo_seq', 12, true);


--
-- TOC entry 4893 (class 0 OID 0)
-- Dependencies: 220
-- Name: menu_idcomida_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.menu_idcomida_seq', 26, true);


--
-- TOC entry 4894 (class 0 OID 0)
-- Dependencies: 222
-- Name: mesa_num_mesa_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.mesa_num_mesa_seq', 1, true);


--
-- TOC entry 4895 (class 0 OID 0)
-- Dependencies: 224
-- Name: reserva_idreserva_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.reserva_idreserva_seq', 10, true);


--
-- TOC entry 4719 (class 2606 OID 127141)
-- Name: cliente cliente_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cliente
    ADD CONSTRAINT cliente_pkey PRIMARY KEY (idcliente);


--
-- TOC entry 4721 (class 2606 OID 127143)
-- Name: jugos jugos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jugos
    ADD CONSTRAINT jugos_pkey PRIMARY KEY (idjugo);


--
-- TOC entry 4723 (class 2606 OID 127145)
-- Name: menu menu_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.menu
    ADD CONSTRAINT menu_pkey PRIMARY KEY (idcomida);


--
-- TOC entry 4725 (class 2606 OID 127147)
-- Name: mesa mesa_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mesa
    ADD CONSTRAINT mesa_pkey PRIMARY KEY (num_mesa);


--
-- TOC entry 4727 (class 2606 OID 127149)
-- Name: reserva reserva_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.reserva
    ADD CONSTRAINT reserva_pkey PRIMARY KEY (idreserva);


-- Completed on 2025-07-12 13:45:48

--
-- PostgreSQL database dump complete
--

