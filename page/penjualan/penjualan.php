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
                        <div class="form-group">
                                <?php 
                                    $sql = $myPDO->prepare("SELECT * FROM produk");
                                    $sql->execute();
                                    while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                            <button><img src="assets/produk/<?= $row['gambar_produk']; ?>" alt="" width="50px"></button>
                                <?php 
                                    }
                                ?>
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
                <form action="" method="POST" id="submit-button">
                <div class="form-group row mt-4">
                    <label for="total-harga" class="col-sm-3 col-form-label">Total Harga :</label>
                    <div class="input-group col-sm-9">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Rp.</div>
                        </div>
                        <input type="text" class="form-control total-harga" id="total-harga" name="total-harga" readonly value="<?= $total_bayar; ?>">
                    </div>
                </div>
                <div class="form-group row mt-4">
                    <label for="diskon-akhir" class="col-sm-3 col-form-label">Diskon :</label>
                    <div class="input-group col-sm-9">
                        <input type="number" class="form-control diskon-akhir" id="diskon-akhir" onkeyup="totalBayar()" name="diskon-akhir">
                    </div>
                </div>
                <div class="form-group row mt-4">
                    <label for="total_bayar" class="col-sm-3 col-form-label">Total Bayar :</label>
                    <div class="input-group col-sm-9">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Rp.</div>
                        </div>
                        <input type="text" class="form-control total-bayar" id="total_bayar" name="total_bayar" readonly>
                    </div>
                </div>
                <button type="submit" class="col-md-12 btn btn-danger" data-toggle="modal" data-target="#exampleModal" name="bayar">
                  Simpan Data Pembayaran
                </button>
                <button type="button" class="col-md-12 btn btn-success mt-2" data-toggle="modal" data-target="#exampleModal">
                  Pilih Metode Pembayaran
                </button>
                </form>
                <?php 
                    if (isset($_POST["bayar"])) {
                        $sub_total = $_POST['total-harga'];
                        $diskon_akhir = $_POST['diskon-akhir'];
                        $total_akhir = $_POST['total_bayar'];

                        $tambah = $myPDO->prepare("INSERT INTO total_bayar (id, kode_penjualan, sub_total, diskon, total) VALUES (default, '$kode', '$sub_total', '$diskon_akhir', '$total_akhir')");
                        $tambah->execute();
                    }
                 ?>
            </div>
        </div>
    </div>
</main>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Total : <?= $total_akhir; ?></h5>
      </div>
    <!-- <div class="modal-body"> -->
        <!-- <div class="row"> -->
    <!-- <div class="col-lg-7 mx-auto"> -->
      <div class="bg-white rounded-lg shadow-sm p-3">
        <!-- Credit card form tabs -->
        <ul role="tablist" class="nav bg-light nav-pills rounded-pill nav-fill mb-3">
          <li class="nav-item">
            <a data-toggle="pill" href="#nav-tab-card" class="nav-link active rounded-pill">
                                <i class="fa fa-credit-card"></i>
                                Kartu Kredit
                            </a>
          </li>
          <li class="nav-item">
            <a data-toggle="pill" href="#nav-tab-paypal" class="nav-link rounded-pill">
                                <i class="fa fa-paypal"></i>
                                Cash
                            </a>
          </li>
          <li class="nav-item">
            <a data-toggle="pill" href="#nav-tab-bank" class="nav-link rounded-pill">
                                <i class="fa fa-university"></i>
                                 Transfer Bank
                             </a>
          </li>
        </ul>
        <!-- End -->


        <!-- Credit card form content -->
        <div class="tab-content">

          <!-- credit card info-->
          <div id="nav-tab-card" class="tab-pane fade show active">
            <!-- <p class="alert alert-success">Some text success or error</p> -->
            <form role="form">
              <div class="form-group">
                <label for="username">Nama Lengkap (Kartu)</label>
                <input type="text" name="username" placeholder="Jason Doe" required class="form-control">
              </div>
              <div class="form-group">
                <label for="cardNumber">Nomer Kartu</label>
                <div class="input-group">
                  <input type="text" name="cardNumber" placeholder="Your card number" class="form-control" required>
                  <div class="input-group-append">
                    <span class="input-group-text text-muted">
                                                <i class="fa fa-cc-visa mx-1"></i>
                                                <i class="fa fa-cc-amex mx-1"></i>
                                                <i class="fa fa-cc-mastercard mx-1"></i>
                                            </span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-8">
                  <div class="form-group">
                    <label><span class="hidden-xs">Kadaluarsa</span></label>
                    <div class="input-group">
                      <input type="number" placeholder="MM" name="" class="form-control" required>
                      <input type="number" placeholder="YY" name="" class="form-control" required>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group mb-4">
                    <label data-toggle="tooltip" title="Three-digits code on the back of your card">CVV
                                                <i class="fa fa-question-circle"></i>
                                            </label>
                    <input type="text" required class="form-control">
                  </div>
                </div>



              </div>
              <button type="button" class="subscribe btn btn-primary btn-block rounded-pill shadow-sm" onclick="pindahLokasi()"> Confirm  </button>
            </form>
          </div>
          <!-- End -->

          <!-- Paypal info -->
          <div id="nav-tab-paypal" class="tab-pane fade">
            <p>Masukkan Nominal</p>
            <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Rp.</div>
                        </div>
                        <input type="number" class="form-control" id="">
            </div>
            <p class="mt-2">
              <button type="button" class="btn btn-primary rounded-pill" onclick="pindahLokasi()"><i class="fa fa-paypal mr-2"></i> Bayar</button>
            </p>
          </div>
          <!-- End -->

          <!-- bank transfer info -->
          <div id="nav-tab-bank" class="tab-pane fade">
            <!-- <h6>Bank account details</h6>
            <dl>
              <dt>Bank</dt>
              <dd> THE WORLD BANK</dd>
            </dl>
            <dl>
              <dt>Account number</dt>
              <dd>7775877975</dd>
            </dl>
            <dl>
              <dt>IBAN</dt>
              <dd>CZ7775877975656</dd>
            </dl>
            <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            </p> -->
            <div class="form-group "> <label for="Select Your Bank">
                                <h6>Select your Bank</h6>
                            </label> <select class="form-control" id="ccmonth">
                                <option value="" selected disabled>--Please select your Bank--</option>
                                <option>BCA - 138000067881975</option>
                                <option>Mandiri - 276000054367</option>
                            </select> </div>
                        <div class="form-group">
                            <p> <button type="button" class="btn btn-primary" onclick="pindahLokasi()"><i class="fas fa-mobile-alt mr-2"></i>Proses Pembayaran</button> </p>
                        </div>
          </div>
          <!-- End -->
        </div>
        <!-- End -->

      </div>
    <!-- </div> -->
  <!-- </div> -->
    <!-- </div> -->
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

    function totalBayar() {
        let total_harga = document.querySelector(".total-harga").value;
        let diskon_akhir = document.querySelector(".diskon-akhir").value;

        let potongan_akhir = total_harga * parseFloat(diskon_akhir) / parseInt(100);
        if (!isNaN(potongan_akhir)) {
            total_bayar = document.querySelector(".total-bayar").value = total_harga - potongan_akhir;
        }
    }

    function pindahLokasi(){
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