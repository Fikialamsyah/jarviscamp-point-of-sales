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
-- Data for Name: tb_barang; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tb_barang (kode_barcode, nama_barang, harga_beli, stock, harga_jual, profit) FROM stdin;
\.


--
-- Data for Name: tb_konsumen; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tb_konsumen (kode_konsumen, nama, alamat, telpon, email) FROM stdin;
\.


--
-- Data for Name: tb_pembelian; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tb_pembelian (id, no_faktur, tanggal, nama_vendor, kode_barcode, stok) FROM stdin;
\.


--
-- Data for Name: tb_penjualan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tb_penjualan (id, kode_penjualan, tgl_penjualan, id_konsumen, bayar, kembali) FROM stdin;
\.


--
-- Data for Name: tb_penjualan_detail; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tb_penjualan_detail (kode_penjualan, id, kode_barcode, jumlah, diskon, potongan, total) FROM stdin;
\.


--
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."user" (id, username, name, password, level) FROM stdin;
\.


--
-- Data for Name: vendor; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.vendor (id, nama_vendor, telpon, alamat) FROM stdin;
\.


--
-- Name: tb_konsumen_kode_konsumen_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tb_konsumen_kode_konsumen_seq', 1, false);


--
-- Name: tb_pembelian_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tb_pembelian_id_seq', 1, false);


--
-- Name: tb_penjualan_detail_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tb_penjualan_detail_id_seq', 1, false);


--
-- Name: tb_penjualan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tb_penjualan_id_seq', 1, false);


--
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.user_id_seq', 1, false);


--
-- Name: vendor_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.vendor_id_seq', 1, false);


--
-- PostgreSQL database dump complete
--

