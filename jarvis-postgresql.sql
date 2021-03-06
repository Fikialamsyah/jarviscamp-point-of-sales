PGDMP     "            
        y            jarvis    13.2    13.2     C           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            D           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            E           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            F           1262    16485    jarvis    DATABASE     f   CREATE DATABASE jarvis WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'English_Indonesia.1252';
    DROP DATABASE jarvis;
                postgres    false            >          0    16664    informasi_toko 
   TABLE DATA           2   COPY public.informasi_toko (id, nama) FROM stdin;
    public          postgres    false    221   k       8          0    16591 	   pembelian 
   TABLE DATA           v   COPY public.pembelian (id, tanggal, jumlah, produk_id, vendor_id, created_at, updated_at, kode_pembelian) FROM stdin;
    public          postgres    false    215   �       6          0    16575 	   penjualan 
   TABLE DATA           w   COPY public.penjualan (id, kode_penjualan, tgl_penjualan, jumlah_harga, produk_id, created_at, updated_at) FROM stdin;
    public          postgres    false    213   �       4          0    16562    produk 
   TABLE DATA           t   COPY public.produk (id, nama, harga_jual, deskripsi, stok, produk_kategori_id, kode_produk, harga_beli) FROM stdin;
    public          postgres    false    211   �       2          0    16554    produk_kategori 
   TABLE DATA           3   COPY public.produk_kategori (id, nama) FROM stdin;
    public          postgres    false    209   �       0          0    16541    profile 
   TABLE DATA           Y   COPY public.profile (id, nama, tempat_lahir, tanggal_lahir, user_id, gender) FROM stdin;
    public          postgres    false    207   �       <          0    16649    profile_has_toko 
   TABLE DATA           ?   COPY public.profile_has_toko (profile_id, toko_id) FROM stdin;
    public          postgres    false    219   -       ;          0    16638    riwayat_harga 
   TABLE DATA           W   COPY public.riwayat_harga (id, harga_jual, harga_beli, tanggal, produk_id) FROM stdin;
    public          postgres    false    218   J       .          0    16522    role 
   TABLE DATA           O   COPY public.role (id, nama_role, deskripsi, created_at, update_at) FROM stdin;
    public          postgres    false    205   g       9          0    16623    role_has_user 
   TABLE DATA           9   COPY public.role_has_user (role_id, user_id) FROM stdin;
    public          postgres    false    216   C       @          0    16673    toko 
   TABLE DATA           W   COPY public.toko (id, nama, alamat, telepon, produk_id, informasi_toko_id) FROM stdin;
    public          postgres    false    223   l       *          0    16489    user 
   TABLE DATA           W   COPY public."user" (id, username, password, email, created_at, updated_at) FROM stdin;
    public          postgres    false    201   �       ,          0    16500    vendor 
   TABLE DATA           H   COPY public.vendor (id, nama_vendor, alamat, telpon, email) FROM stdin;
    public          postgres    false    203   �       R           0    0    informasi_toko_id_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.informasi_toko_id_seq', 1, false);
          public          postgres    false    220            S           0    0    pembelian_id_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.pembelian_id_seq', 1, false);
          public          postgres    false    214            T           0    0    penjualan_id_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.penjualan_id_seq', 1, false);
          public          postgres    false    212            U           0    0    produk_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.produk_id_seq', 1, false);
          public          postgres    false    210            V           0    0    produk_kategori_id_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.produk_kategori_id_seq', 1, false);
          public          postgres    false    208            W           0    0    profile_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.profile_id_seq', 5, true);
          public          postgres    false    206            X           0    0    riwayat_harga_id_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.riwayat_harga_id_seq', 1, false);
          public          postgres    false    217            Y           0    0    role_id_seq    SEQUENCE SET     9   SELECT pg_catalog.setval('public.role_id_seq', 4, true);
          public          postgres    false    204            Z           0    0    toko_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.toko_id_seq', 1, false);
          public          postgres    false    222            [           0    0    user_id_seq    SEQUENCE SET     9   SELECT pg_catalog.setval('public.user_id_seq', 7, true);
          public          postgres    false    200            \           0    0    vendor_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.vendor_id_seq', 1, false);
          public          postgres    false    202            >      x������ � �      8      x������ � �      6      x������ � �      4      x������ � �      2      x������ � �      0   !   x�3��"S �e�������9����� '�
�      <      x������ � �      ;      x������ � �      .   �   x���ъ�0E�����d��6�R(S��!Q�����R���s��rQ�-r�a���21�Pa�Y&���@�@��a�t��"P,�����x2���u�uMS�~&�V��.~98o��Kd��H{
��KY�l_uݹ�����<�7ɿ���[ٗ3XYD�&�Q[�tPR~��IQ�4�瑙h�,c�-������w~s��K��~ �dy�      9      x�3�4�2�4�2�4����� �      @      x������ � �      *   )  x�u��n�P ��5<���މ;�j@�bE[�i��U�h��[ۘ46�O���1��)�J%�:����F�}������V�=6��7L��9����{\}�q�7)9������0��qZo���41�@�A���	�	1@R��&�{�@P)�Й��>�Mq���g�����)���%&�ƶU>2Jl����(<a?���~�뼝��Q��D`&���I����\+ӥ:����9r����SE�!
D����Mg������首�[����2� �s�� ����G¤PH���W����qy�      ,      x������ � �     