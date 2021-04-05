<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<form action="" id="form-search">
	   <input type="text" class="form-control total-harga" id="total-harga" name="total-harga" value="65000"><br>
	   <input type="number" class="form-control diskon-akhir" id="diskon-akhir" name="diskon-akhir" value="0"><br>
        <input type="text" class="form-control total-bayar" id="total_bayar" name="total_bayar" value="65000"><br>
        <input type="text" name="kodepj" id="kodepj" value="JARVIS-123"><br>
	</form>
	<button id="save" name="save" onclick="jalan()">Serialize form values</button>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script>

// function ajaxAction(){
//     var data = $("#form-search").serialize();
//     $.ajax({
//          data: data,
//          type: "post",
//          url: "simpan-data.php",
//          success: function(simpan){
//               alert(simpan);
//          }
//     });

//     return false;
// };

    function jalan() {
            let kodepj = $('#kodepj').val();
            let total_harga = $('#total-harga').val();
            let diskon = $('#diskon-akhir').val();
            let total = $('#total_bayar').val();
            if(total_harga!="" && diskon!="" && total!=""){
                $.ajax({
                    url: "page/penjualan/simpan-data.php",
                    type: "POST",
                    data: {
                        kode: kodepj,
                        total_harga: total_harga,
                        diskon: diskon,
                        total: total,              
                    },
                    cache: false,
                    success: function(data){
                        $("#exampleModal").modal("show");
                    }
                });
            }
            else{
                alert('Please fill all the field !');
            }
    }
</script>
</body>
</html>