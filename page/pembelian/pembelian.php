<?php 

    $kode = $_GET["kodepj"];

    if (isset($_POST["tambah"])) {
        $tgl = date("Y-m-d"); 
        $jumlah = $_POST["jumlah_barang"];
        $harga = $_POST["harga_barang"];
        $tambah = $myPDO->prepare("INSERT INTO pembelian (id, tanggal, jumlah, produk_id, vendor_id, kode_pembelian) VALUES (default, '$tgl', '$produk_id', '$vendor_id', '$kode_pembelian')");
        $tambah->execute();
    }
?>

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Transaksi Pembelian</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Transaksi Pembelian</li>
        </ol>
        <div class="card mb-4 shadow rounded">
            <div class="card-body">
                <h2>Data Barang</h2>
                <hr>
                <form method="POST">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Nomor Transaksi</label>
                            <input type="text" class="form-control" value="<?= $kode; ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Faktur</label>
                            <input type="text" class="form-control" value="<?= $kode; ?>">
                        </div>
                        <div class="form-group">
                            <label for="nama_vendor">Nama Vendor</label>
                            <select id="nama_vendor" class="form-control" name="nama_vendor">
                                <option>--Pilih--</option>
                                <?php 
                                    $sql = $myPDO->prepare("SELECT * FROM vendor");
                                    $sql->execute();
                                    while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                <option value="<?= $row["nama_vendor"] ?>"><?= $row["nama_vendor"] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pilih_barang">Pilih Barang</label>
                            <select id="pilih_barang" class="form-control" name="kode_produk" onchange="hitung()">
                                <option>--Pilih--</option>
                                <?php 
                                    $sql = $myPDO->prepare("SELECT * FROM produk");
                                    $sql->execute();
                                    while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                <option value="<?= $row["kode_produk"] ?>"><?= $row["nama"] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-7 mt-4">
                        <div class="form-group row">
                                <label for="tgl_pembelian" class="col-sm-5 col-form-label">Tanggal Pembelian : </label>
                                <div class=" input-group col-sm-7">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text">Date </div>
                                </div>
                                    <input type="Date" class="form-control" id="tgl_pembelian" name="tgl_pembelian" onkeyup="hitungSubTotal(detail_barang)">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="harga_barang" class="col-sm-5 col-form-label">Harga Barang :</label>
                            <div class=" input-group col-sm-7">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">Rp.</div>
                                </div>
                                <input type="text" class="form-control" id="harga_barang" name="harga_barang" onkeyup="hitungSubTotal(detail_barang)">
                            </div>
                        </div>
                        <div class="form-group row mt-4">
                            <label for="jumlah_barang" class="col-sm-5 col-form-label">Jumlah :</label>
                            <div class="col-sm-7">
                                <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang" min="1" onkeyup="hitungSubTotal(detail_barang)" value="1">
                            </div>
                        </div>
                        <div class="form-group row mt-4">
                            <label for="sub_total" class="col-sm-5 col-form-label">Sub Total :</label>
                            <div class="input-group col-sm-7">
                                <div class="input-group-prepend">
                                    <div class="input-group-text" value="download">Rp.</div>
                                </div>
                                <input type="number" class="form-control" id="sub_total" name="sub_total" value="<?= $harga * $jumlah ?>">
                            </div>
                        </div>
                    </div>
                    <!-- <button type="submit" class="col-md-12 btn btn-primary" name="tambah">Tambahkan</button> -->
                    <input type="submit" class="col-md-12 btn btn-primary mt-5" name="tambah" value="Tambahkan">
                </div>
                </form>
            </div>
        </div>

        <div class="card my-4 shadow rounded">
            <div class="card-body">
                <h2>Daftar Pembelian</h2>
                <hr>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Vendor</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Total</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1;
                                $total_bayar = 0;
                                $sql = $myPDO->prepare("SELECT penjualan.*, produk.nama, produk.harga_jual FROM penjualan JOIN produk ON penjualan.kode_produk = produk.kode_produk WHERE penjualan.kode_penjualan = '$kode' ");
                                $sql->execute();
                                while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                                $total_bayar += $row["total"];
                             ?>
                            <tr>
                                <th><?= $no++; ?></th>
                                <td><?= $row["kode_produk"]; ?></td>
                                <td><?= $row["nama"]; ?></td>
                                <td><?= "Rp. ".number_format($row["harga_beli"]); ?></td>
                                <td><?= $row["jumlah"]; ?></td>
                                <td><?= "Rp. ".number_format($total); ?></td>
                                <td>
                                    <a onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" href="?kodepj=<?= $kode ?>&page=penjualan&aksi=delete&id=<?php echo $row['id']?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php 
                                }
                             ?>
                        </tbody>
                    </table>
                </div>
                <div class="form-group row mt-4">
                    <label for="" class="col-sm-3 col-form-label">Total Harga :</label>
                    <div class="input-group col-sm-9">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Rp.</div>
                        </div>
                        <input type="text" class="form-control" id="" readonly value="<?= $total_bayar; ?>">
                    </div>
                </div>
                <button type="button" class="col-md-12 btn btn-success" data-toggle="modal" data-target="#exampleModal">
                  Bayar
                </button>
            </div>
        </div>
    </div>
</main>


<script type="text/javascript">
</script>