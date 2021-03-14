<?php 

    $kode = $_GET["kodepj"];

    if (isset($_POST["tambah"])) {
        $tgl = date("Y-m-d");
        $kode_produk = $_POST["kode_produk"];
        $jumlah = $_POST["jumlah_barang"];
        $diskon = $_POST["diskon"];
        $potongan = $_POST["potongan_diskon"];
        $total = $_POST["sub_total"];

        $tambah = $myPDO->prepare("INSERT INTO penjualan (id, kode_penjualan, tgl_penjualan, kode_produk, jumlah, diskon, potongan, total) VALUES (default, '$kode', '$tgl', '$kode_produk', '$jumlah', '$diskon', '$potongan', '$total')");
        $tambah->execute();
    }
?>

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Transaksi Penjualan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Transaksi Penjualan</li>
        </ol>
        <div class="card mb-4 shadow rounded">
            <div class="card-body">
                <h2>Data Barang</h2>
                <hr>
                <form method="POST">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <input type="text" class="form-control-plaintext" readonly value="<?= $kode; ?>">
                        </div>
                        <div class="form-group">
                            <label for="kode_barang">Kode Barang</label>
                            <select id="kode_barang" class="form-control" name="kode_produk" onchange="hitung()">
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
                    <div class="col-md-7">
                        <div class="form-group row mt-4">
                            <label for="harga_barang" class="col-sm-5 col-form-label">Harga Barang :</label>
                            <div class=" input-group col-sm-7">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">Rp.</div>
                                </div>
                                <input type="text" class="form-control" id="harga_barang" readonly name="harga_barang" onkeyup="hitungSubTotal(detail_barang)">
                            </div>
                        </div>
                        <div class="form-group row mt-4">
                            <label for="jumlah_barang" class="col-sm-5 col-form-label">Jumlah :</label>
                            <div class="col-sm-7">
                                <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang" min="1" onkeyup="hitungSubTotal(detail_barang)" value="1">
                            </div>
                        </div>
                        <div class="form-group row mt-4">
                            <label for="diskon" class="col-sm-5 col-form-label">Diskon (%) :</label>
                            <div class="col-sm-7">
                                <input type="number" class="form-control" id="diskon" name="diskon" onkeyup="hitungSubTotal(detail_barang)" value="0">
                            </div>
                        </div>
                        <div class="form-group row mt-4">
                            <label for="potongan_diskon" class="col-sm-5 col-form-label">Potongan Diskon :</label>
                            <div class="input-group col-sm-7">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp.</div>
                                </div>
                                <input type="number" class="form-control" id="potongan_diskon" name="potongan_diskon">
                            </div>
                        </div>
                        <div class="form-group row mt-4">
                            <label for="sub_total" class="col-sm-5 col-form-label">Sub Total :</label>
                            <div class="input-group col-sm-7">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp.</div>
                                </div>
                                <input type="number" class="form-control" id="sub_total" name="sub_total">
                            </div>
                        </div>
                    </div>
                    <!-- <button type="submit" class="col-md-12 btn btn-primary" name="tambah">Tambahkan</button> -->
                    <input type="submit" class="col-md-12 btn btn-primary" name="tambah" value="Tambahkan">
                </div>
                </form>
            </div>
        </div>

        <div class="card my-4 shadow rounded">
            <div class="card-body">
                <h2>Daftar Belanja</h2>
                <hr>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode</th>
                                <th scope="col">Nama</th>
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
                                <td><?= "Rp. ".number_format($row["harga_jual"]); ?></td>
                                <td><?= $row["jumlah"]; ?></td>
                                <td><?= "Rp. ".number_format($row["total"]); ?></td>
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="total-amount">Total harga</h5>
            <div class="amount-container"><span class="amount-text"><span class="dollar-sign">Rp.</span><?= number_format($total_bayar); ?></span></div>
        </div>
        <div class="pt-4"> 
        <label class="d-flex justify-content-between"> 
        <span class="label-text label-text-cc-number">Metode Pembayaran :</span>
        </label> 
        <select id="metode_pem" class="form-control col-md-6">
            <option value="">Mandiri -- 0110219085</option>
            <option value="">BCA -- 0110219085</option>
            <option value="">BRI -- 0110219085</option>
        </select>
        </div>
        <div class="d-flex justify-content-between pt-4">
        <h4>Sisa waktu pembayaran :</h4>
            <div id="ten-countdown" class="timer"></div>
        </div>
        <h6>Upload bukti pembayaran :</h6>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">Upload</span>
          </div>
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="inputGroupFile01">
            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="informasi()">Kirim</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    
    let detail_barang = null;

    function hitung() {
        let kode_barcode = document.querySelector("#kode_barang").value;
        if(kode_barcode != ""){
            axios.get("page/penjualan/ambil-detail-barang.php?kode_barcode=" + kode_barcode)
            .then(function(res) {
                detail_barang = res.data;

                if(detail_barang == null) {
                    document.querySelector("#harga_barang").value = 1;
                } else {
                    document.querySelector("#harga_barang").value = detail_barang.harga_jual;
                }
                hitungSubTotal(detail_barang);
            })
        }
    }

    function hitungSubTotal(detail_barang_sekarang) {
        let jumlah = parseInt(document.querySelector("#jumlah_barang").value);
        detail_barang_sekarang.stok = parseInt(detail_barang.stok);

        if (jumlah > detail_barang_sekarang.stok) {
            alert("Jumlah barang melebihi stok");
            document.querySelector("#jumlah_barang").value = 0;
        } else if (jumlah == 0) {
            alert("Jumlah barang tidak boleh kosong");
            document.querySelector("#jumlah_barang").value = 1;
        } else {
            let total_bayar = document.querySelector("#harga_barang").value * jumlah;
            let diskon = document.querySelector("#diskon").value;
            let diskon_pot = parseInt(total_bayar) * parseFloat(diskon) / parseInt(100);
            if (!isNaN(diskon_pot)) {
                let potongan = document.querySelector("#potongan_diskon").value = diskon_pot;
            }
            let sub_total = parseInt(total_bayar) - parseInt(diskon_pot);
            if (!isNaN(sub_total)) {
                let s_total = document.querySelector("#sub_total").value = sub_total;
            }
        }
    }

    function informasi() {
        alert("Data sudah dikirim");
        window.location.href="index.php";
    }

    
    function countdown( elementName, minutes, seconds )
{
    var element, endTime, hours, mins, msLeft, time;

    function twoDigits( n )
    {
        return (n <= 9 ? "0" + n : n);
    }

    function updateTimer()
    {
        msLeft = endTime - (+new Date);
        if ( msLeft < 1000 ) {
            element.innerHTML = "Time is up!";
        } else {
            time = new Date( msLeft );
            hours = time.getUTCHours();
            mins = time.getUTCMinutes();
            element.innerHTML = (hours ? hours + ':' + twoDigits( mins ) : mins) + ':' + twoDigits( time.getUTCSeconds() );
            setTimeout( updateTimer, time.getUTCMilliseconds() + 500 );
        }
    }

    element = document.getElementById( elementName );
    endTime = (+new Date) + 1000 * (60*minutes + seconds) + 500;
    updateTimer();
}

countdown( "ten-countdown", 10, 0 );

</script>