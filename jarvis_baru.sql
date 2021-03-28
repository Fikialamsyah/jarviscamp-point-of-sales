--
-- PostgreSQL database dump
--

-- Dumped from database version 13.2
-- Dumped by pg_dump version 13.2

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
-- Name: gender; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE public.gender AS ENUM (
    'Pria',
    'Wanita'
);


ALTER TYPE public.gender OWNER TO postgres;

--
-- Name: trigger_set_timestamp(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.trigger_set_timestamp() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
    NEW.updated_at = now();
RETURN NEW;
END;
$$;


ALTER FUNCTION public.trigger_set_timestamp() OWNER TO postgres;

--
-- Name: user_to_profile(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.user_to_profile() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
    INSERT INTO profile (user_id) VALUES (NEW.id);
RETURN NEW;
END;
$$;


ALTER FUNCTION public.user_to_profile() OWNER TO postgres;

--
-- Name: user_to_role(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.user_to_role() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
    INSERT INTO role_has_user (role_id, user_id) VALUES (4, NEW.id);
RETURN NEW;
END;
$$;


ALTER FUNCTION public.user_to_role() OWNER TO postgres;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: informasi_toko; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.informasi_toko (
    id integer NOT NULL,
    nama character varying(20)
);


ALTER TABLE public.informasi_toko OWNER TO postgres;

--
-- Name: informasi_toko_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.informasi_toko_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.informasi_toko_id_seq OWNER TO postgres;

--
-- Name: informasi_toko_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.informasi_toko_id_seq OWNED BY public.informasi_toko.id;


--
-- Name: pembelian; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pembelian (
    id integer NOT NULL,
    tanggal date,
    jumlah integer,
    produk_id integer,
    vendor_id integer,
    created_at timestamp without time zone DEFAULT now(),
    updated_at timestamp without time zone DEFAULT now(),
    kode_pembelian character varying(45)
);


ALTER TABLE public.pembelian OWNER TO postgres;

--
-- Name: pembelian_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.pembelian_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.pembelian_id_seq OWNER TO postgres;

--
-- Name: pembelian_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.pembelian_id_seq OWNED BY public.pembelian.id;


--
-- Name: penjualan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.penjualan (
    id integer NOT NULL,
    kode_penjualan character varying(45),
    tgl_penjualan date,
    kode_produk character varying(45),
    jumlah integer,
    diskon integer,
    potongan double precision,
    total double precision,
    created_at timestamp without time zone DEFAULT now(),
    updated_at timestamp without time zone DEFAULT now()
);


ALTER TABLE public.penjualan OWNER TO postgres;

--
-- Name: penjualan_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.penjualan_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.penjualan_id_seq OWNER TO postgres;

--
-- Name: penjualan_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.penjualan_id_seq OWNED BY public.penjualan.id;


--
-- Name: produk; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.produk (
    id integer NOT NULL,
    nama character varying(45),
    harga_jual double precision,
    deskripsi character varying(45),
    stok integer,
    produk_kategori_id integer,
    kode_produk character varying(45),
    harga_beli double precision,
    gambar_produk text
);


ALTER TABLE public.produk OWNER TO postgres;

--
-- Name: produk_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.produk_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.produk_id_seq OWNER TO postgres;

--
-- Name: produk_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.produk_id_seq OWNED BY public.produk.id;


--
-- Name: produk_kategori; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.produk_kategori (
    id integer NOT NULL,
    nama character varying(45)
);


ALTER TABLE public.produk_kategori OWNER TO postgres;

--
-- Name: produk_kategori_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.produk_kategori_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.produk_kategori_id_seq OWNER TO postgres;

--
-- Name: produk_kategori_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.produk_kategori_id_seq OWNED BY public.produk_kategori.id;


--
-- Name: profile; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.profile (
    id integer NOT NULL,
    nama character varying(45),
    tempat_lahir character varying(30),
    tanggal_lahir date,
    user_id integer,
    gender public.gender,
    gambar_profile text
);


ALTER TABLE public.profile OWNER TO postgres;

--
-- Name: profile_has_toko; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.profile_has_toko (
    profile_id integer,
    toko_id integer
);


ALTER TABLE public.profile_has_toko OWNER TO postgres;

--
-- Name: profile_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.profile_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.profile_id_seq OWNER TO postgres;

--
-- Name: profile_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.profile_id_seq OWNED BY public.profile.id;


--
-- Name: role; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.role (
    id integer NOT NULL,
    nama_role character varying(20),
    deskripsi text,
    created_at timestamp without time zone DEFAULT now(),
    update_at timestamp without time zone DEFAULT now()
);


ALTER TABLE public.role OWNER TO postgres;

--
-- Name: role_has_user; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.role_has_user (
    role_id integer,
    user_id integer
);


ALTER TABLE public.role_has_user OWNER TO postgres;

--
-- Name: role_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.role_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.role_id_seq OWNER TO postgres;

--
-- Name: role_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.role_id_seq OWNED BY public.role.id;


--
-- Name: toko; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.toko (
    id integer NOT NULL,
    nama character varying(45),
    alamat character varying(45),
    telepon character varying(13),
    produk_id integer,
    informasi_toko_id integer
);


ALTER TABLE public.toko OWNER TO postgres;

--
-- Name: toko_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.toko_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.toko_id_seq OWNER TO postgres;

--
-- Name: toko_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.toko_id_seq OWNED BY public.toko.id;


--
-- Name: total_bayar; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.total_bayar (
    id integer NOT NULL,
    kode_penjualan character varying(45),
    sub_total double precision,
    diskon double precision,
    total double precision
);


ALTER TABLE public.total_bayar OWNER TO postgres;

--
-- Name: total_bayar_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.total_bayar_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.total_bayar_id_seq OWNER TO postgres;

--
-- Name: total_bayar_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.total_bayar_id_seq OWNED BY public.total_bayar.id;


--
-- Name: user; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."user" (
    id integer NOT NULL,
    username character varying(10),
    password character varying(100),
    email character varying(45),
    created_at timestamp without time zone DEFAULT now(),
    updated_at timestamp without time zone DEFAULT now()
);


ALTER TABLE public."user" OWNER TO postgres;

--
-- Name: user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.user_id_seq OWNER TO postgres;

--
-- Name: user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.user_id_seq OWNED BY public."user".id;


--
-- Name: vendor; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.vendor (
    id integer NOT NULL,
    nama_vendor character varying(45),
    alamat text,
    telpon character varying(45),
    email character varying(45)
);


ALTER TABLE public.vendor OWNER TO postgres;

--
-- Name: vendor_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.vendor_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.vendor_id_seq OWNER TO postgres;

--
-- Name: vendor_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.vendor_id_seq OWNED BY public.vendor.id;


--
-- Name: informasi_toko id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.informasi_toko ALTER COLUMN id SET DEFAULT nextval('public.informasi_toko_id_seq'::regclass);


--
-- Name: pembelian id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pembelian ALTER COLUMN id SET DEFAULT nextval('public.pembelian_id_seq'::regclass);


--
-- Name: penjualan id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.penjualan ALTER COLUMN id SET DEFAULT nextval('public.penjualan_id_seq'::regclass);


--
-- Name: produk id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.produk ALTER COLUMN id SET DEFAULT nextval('public.produk_id_seq'::regclass);


--
-- Name: produk_kategori id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.produk_kategori ALTER COLUMN id SET DEFAULT nextval('public.produk_kategori_id_seq'::regclass);


--
-- Name: profile id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.profile ALTER COLUMN id SET DEFAULT nextval('public.profile_id_seq'::regclass);


--
-- Name: role id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.role ALTER COLUMN id SET DEFAULT nextval('public.role_id_seq'::regclass);


--
-- Name: toko id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.toko ALTER COLUMN id SET DEFAULT nextval('public.toko_id_seq'::regclass);


--
-- Name: total_bayar id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.total_bayar ALTER COLUMN id SET DEFAULT nextval('public.total_bayar_id_seq'::regclass);


--
-- Name: user id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."user" ALTER COLUMN id SET DEFAULT nextval('public.user_id_seq'::regclass);


--
-- Name: vendor id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.vendor ALTER COLUMN id SET DEFAULT nextval('public.vendor_id_seq'::regclass);


--
-- Data for Name: informasi_toko; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.informasi_toko (id, nama) FROM stdin;
1	Retail
2	Resto
3	Coffeshop
\.


--
-- Data for Name: pembelian; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pembelian (id, tanggal, jumlah, produk_id, vendor_id, created_at, updated_at, kode_pembelian) FROM stdin;
\.


--
-- Data for Name: penjualan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.penjualan (id, kode_penjualan, tgl_penjualan, kode_produk, jumlah, diskon, potongan, total, created_at, updated_at) FROM stdin;
2	JARVIS-41114	2021-03-27	m2	1	90	15300	1700	2021-03-28 01:00:49.149898	2021-03-28 01:00:49.149898
\.


--
-- Data for Name: produk; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.produk (id, nama, harga_jual, deskripsi, stok, produk_kategori_id, kode_produk, harga_beli, gambar_produk) FROM stdin;
10	LEE KUM KEE Minyak Wijen 115ml	45000	minyak goreng	20	5	m1	39000	605ef0a22479e.jpg
11	Bimoli Minyak Goreng Pounch 1L	17000	minyak goreng	20	5	m2	16100	605ef10938aa6.jpg
12	Bimoli Special Minyak Goreng Pounch 1 Liter	17000	minyak goreng	20	5	m3	16200	605ef18b5b91d.jpg
13	Sovia Minyak Goreng Pounch 2 Liter	30000	minyak goreng	20	5	m4	29500	605ef1cce13ce.jpg
14	DELIMA Minyak Goreng Ekonomis Pounch 1L	12000	minyak goreng	20	5	m5	11000	605ef2150c6d6.jpg
15	Alfamart Beras Merah 2kg	33000	beras merah	20	5	ber1	31900	605ef2869c037.jpg
16	Alfamart Beras Pandan Wangi 5kg	89000	beras putih	20	5	ber2	87900	605ef2bb8b177.jpg
17	Alfamart Beras Setra Ramos 5kg	65000	beras putih	20	5	ber3	64000	605ef2fac5822.jpg
18	TROPICANA SLIM Classic 50 x 2.5g	49000	gula putih	20	5	Gul1	47600	605ef3592411a.jpg
19	MANISKITA Gula Pasir 1kg	14000	gula putih	20	5	Gul2	12500	605ef38fc4529.jpg
20	ROSE BRAND Gula Tebu Premium 1kg	14000	gula putih	20	5	Gul3	12500	605ef3be944f5.jpg
21	ROSE BRAND Tepung Beras 500 gr	13000	tepung beras	20	5	Tep1	10900	605ef4285e27f.jpg
22	Daging Slice Shortplate ala Yosinoya	38500	daging	20	5	DagSap1	37500	605ef482db1cf.jpg
23	Ayam Kampung Kalasan	54000	daging ayam	20	5	DagAy1	53000	605ef4dc727d2.jpg
24	Cabai Merah Besar 1 kg	76000	cabe	20	5	Cab1	75000	605ef5534a743.jpg
25	Cabai Hijau Besar 1 kg	36800	cabe	20	5	Cab2	35800	605ef5a168364.jpg
26	Daun Bawang 1kg	15300	daun bawang	20	5	Daun1	14300	605ef6511e125.jpg
27	FILMA Margarin 200g	6000	margarin	20	5	Marg1	5000	605ef68e3343c.jpg
28	forVITA - Margarin Krim Sachet Serbaguna 200g	6500	margarin	20	5	Marg2	5500	605ef6ce5771b.jpg
29	FILMA - Margarin Krim Sachet Serbaguna 200g	6500	margarin	20	5	Marg3	5500	605ef72069b70.jpg
30	HATARI See Hong Puff Kelapa 260g	8900	snack ringan	20	6	Snac1	7900	605ef96933e6d.jpg
31	Tango Wafer Cheese 130g	8700	snack ringan	20	6	Snac2	7700	605efa6721b2a.jpg
32	Biskies Chocolate 108g	9100	snack ringan	20	6	Snac3	8100	605efe4bd0e51.jpg
34	Dua Kelinci 	25400	snack ringan	20	6	Snac5	24400	605f004c1d15b.jpg
33	Biskies Vanilla 108g	9100	snack ringan	20	6	Snac4	8100	605efffe1edd2.jpg
\.


--
-- Data for Name: produk_kategori; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.produk_kategori (id, nama) FROM stdin;
5	Sembako
6	Snack
7	Lain-Lain
\.


--
-- Data for Name: profile; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.profile (id, nama, tempat_lahir, tanggal_lahir, user_id, gender, gambar_profile) FROM stdin;
3	superadmin	Surakarta	2000-01-02	5	Pria	profile.jpg
5	pegawai	Jakarta	2021-03-09	7	Wanita	profile.jpg
4	admin_toko	Depok	2021-03-07	6	Wanita	profile.jpg
\.


--
-- Data for Name: profile_has_toko; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.profile_has_toko (profile_id, toko_id) FROM stdin;
\.


--
-- Data for Name: role; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.role (id, nama_role, deskripsi, created_at, update_at) FROM stdin;
1	superadmin	role yang memiliki kendali penuh terhadap aplikasi	2021-03-10 15:53:44.01201	2021-03-10 15:53:44.01201
2	admin_toko	role yang berperan sebagai admin toko	2021-03-10 15:56:38.669815	2021-03-10 15:56:38.669815
3	pegawai_toko	role yang berperan sebagai pegawai toko	2021-03-10 15:57:01.31138	2021-03-10 15:57:01.31138
4	user	role yang didapatkan pertama kali saat sign up	2021-03-10 15:58:03.319201	2021-03-10 15:58:03.319201
\.


--
-- Data for Name: role_has_user; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.role_has_user (role_id, user_id) FROM stdin;
1	5
2	6
3	7
\.


--
-- Data for Name: toko; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.toko (id, nama, alamat, telepon, produk_id, informasi_toko_id) FROM stdin;
1	Starbucks	Depok	1234567890	\N	3
\.


--
-- Data for Name: total_bayar; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.total_bayar (id, kode_penjualan, sub_total, diskon, total) FROM stdin;
3	JARVIS-41114	1700	90	170
\.


--
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."user" (id, username, password, email, created_at, updated_at) FROM stdin;
6	admin toko	$2y$10$8pfJ6GZX26drqa4SaD9W9.NTPuCCanP5pF.knMfuM.SRz2JmKvJKm	admin_toko@gmail.com	2021-03-10 16:06:22.538268	2021-03-10 16:57:42.532417
7	pegawai	$2y$10$HR71FBm72RsP9zr3w9F3a.SGQzlYXYYvBDKC4FDeBHEhjEnSoJSpS	pegawai@gmail.com	2021-03-10 16:07:15.029081	2021-03-10 16:58:40.403856
5	Superadmin	$2y$10$/UHWTC.Gsf.WBdlyuMgQEOd2TVNHNkcHLhxGWRJue3w3NsJOrIOnq	superadmin@gmail.com	2021-03-10 16:03:02.170461	2021-03-15 18:00:43.365999
\.


--
-- Data for Name: vendor; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.vendor (id, nama_vendor, alamat, telpon, email) FROM stdin;
1	PT Jarvis	Depok	083866379756	jarvis@gmail.com
\.


--
-- Name: informasi_toko_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.informasi_toko_id_seq', 3, true);


--
-- Name: pembelian_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pembelian_id_seq', 1, false);


--
-- Name: penjualan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.penjualan_id_seq', 2, true);


--
-- Name: produk_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.produk_id_seq', 34, true);


--
-- Name: produk_kategori_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.produk_kategori_id_seq', 7, true);


--
-- Name: profile_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.profile_id_seq', 5, true);


--
-- Name: role_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.role_id_seq', 4, true);


--
-- Name: toko_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.toko_id_seq', 1, true);


--
-- Name: total_bayar_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.total_bayar_id_seq', 3, true);


--
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.user_id_seq', 7, true);


--
-- Name: vendor_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.vendor_id_seq', 1, true);


--
-- Name: informasi_toko informasi_toko_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.informasi_toko
    ADD CONSTRAINT informasi_toko_pkey PRIMARY KEY (id);


--
-- Name: pembelian pembelian_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pembelian
    ADD CONSTRAINT pembelian_pkey PRIMARY KEY (id);


--
-- Name: penjualan penjualan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.penjualan
    ADD CONSTRAINT penjualan_pkey PRIMARY KEY (id);


--
-- Name: produk_kategori produk_kategori_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.produk_kategori
    ADD CONSTRAINT produk_kategori_pkey PRIMARY KEY (id);


--
-- Name: produk produk_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.produk
    ADD CONSTRAINT produk_pkey PRIMARY KEY (id);


--
-- Name: profile profile_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.profile
    ADD CONSTRAINT profile_pkey PRIMARY KEY (id);


--
-- Name: role role_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.role
    ADD CONSTRAINT role_pkey PRIMARY KEY (id);


--
-- Name: toko toko_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.toko
    ADD CONSTRAINT toko_pkey PRIMARY KEY (id);


--
-- Name: total_bayar total_bayar_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.total_bayar
    ADD CONSTRAINT total_bayar_pkey PRIMARY KEY (id);


--
-- Name: user user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);


--
-- Name: vendor vendor_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.vendor
    ADD CONSTRAINT vendor_pkey PRIMARY KEY (id);


--
-- Name: pembelian pembelian_timestamp; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER pembelian_timestamp BEFORE UPDATE ON public.pembelian FOR EACH ROW EXECUTE FUNCTION public.trigger_set_timestamp();


--
-- Name: penjualan penjualan_timestamp; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER penjualan_timestamp BEFORE UPDATE ON public.penjualan FOR EACH ROW EXECUTE FUNCTION public.trigger_set_timestamp();


--
-- Name: role role_timestamp; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER role_timestamp BEFORE UPDATE ON public.role FOR EACH ROW EXECUTE FUNCTION public.trigger_set_timestamp();


--
-- Name: user user_profile; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER user_profile AFTER INSERT ON public."user" FOR EACH ROW EXECUTE FUNCTION public.user_to_profile();


--
-- Name: user user_role; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER user_role AFTER INSERT ON public."user" FOR EACH ROW EXECUTE FUNCTION public.user_to_role();


--
-- Name: user user_timestamp; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER user_timestamp BEFORE UPDATE ON public."user" FOR EACH ROW EXECUTE FUNCTION public.trigger_set_timestamp();


--
-- Name: pembelian pembelian_vendor_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pembelian
    ADD CONSTRAINT pembelian_vendor_id_fkey FOREIGN KEY (vendor_id) REFERENCES public.vendor(id);


--
-- Name: produk produk_produk_kategori_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.produk
    ADD CONSTRAINT produk_produk_kategori_id_fkey FOREIGN KEY (produk_kategori_id) REFERENCES public.produk_kategori(id);


--
-- Name: profile_has_toko profile_has_toko_profile_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.profile_has_toko
    ADD CONSTRAINT profile_has_toko_profile_id_fkey FOREIGN KEY (profile_id) REFERENCES public.profile(id);


--
-- Name: profile profile_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.profile
    ADD CONSTRAINT profile_user_id_fkey FOREIGN KEY (user_id) REFERENCES public."user"(id);


--
-- Name: role_has_user role_has_user_role_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.role_has_user
    ADD CONSTRAINT role_has_user_role_id_fkey FOREIGN KEY (role_id) REFERENCES public.role(id);


--
-- Name: role_has_user role_has_user_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.role_has_user
    ADD CONSTRAINT role_has_user_user_id_fkey FOREIGN KEY (user_id) REFERENCES public."user"(id);


--
-- Name: toko toko_informasi_toko_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.toko
    ADD CONSTRAINT toko_informasi_toko_id_fkey FOREIGN KEY (informasi_toko_id) REFERENCES public.informasi_toko(id);


--
-- PostgreSQL database dump complete
--

