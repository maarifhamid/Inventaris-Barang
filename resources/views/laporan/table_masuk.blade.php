<style type="text/css">

 

  .tandatangan{

   text-align:center; margin-left:545px;

 }


</style>
</head>

<body>

  <div class="container">

    <div style="text-align:center; ">

      <h3><b>LAPORAN INVENTARIS BARANG</b></h3>
      <h3><b>KANTOR CAMAT KOTABARU KOTA JAMBI</b></h3>
      <h5>Jl. Jend. Basuki Rahmat, Paal Lima, Kec. Kota Baru, Kota Jambi, Jambi 36129</h5>
      <h5>Tahun {{ Carbon\Carbon::now()->isoFormat('Y')}}</h5>
      <br>
    </div> 
 
 <table id="dataTable" class="table table-bordered" cellspacing="0">
          <thead>
            <tr>
                  <th>Barang</th>
                  <th>Jumlah</th>
                  <th>Tanggal Masuk</th>
                  <th>Harga Satuan</th>
                  <th>Harga Total</th>
                  <th>Nama Toko</th>
                  <th>Merek</th>
                  <th>Sumber Dana</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($masuk as $m)
              <tr>
                  <td>{{$m->nama_barang}}</td>
                  <td>{{$m->jumlah_asup}}</td>
                  <td>{{$m->tanggal_masuk}}</td>
                  <td>{{$m->harga_satuan}}</td>
                  <td>{{$m->harga_total}}</td>
                  <td>{{$m->nama_toko}}</td>
                  <td>{{$m->merek}}</td>
                  <td>{{$m->sumber_dana}}</td>
                  </tr>
              @endforeach
          </tbody>
        </table>

        <div class="tandatangan">
          <br>
          <td>
            <td>
              <td>
                <td>
                  <td>
                    <td>
          <td><p>Jambi, {{ Carbon\Carbon::now()->isoFormat('D MMMM Y')}} </p></td>
          <td>
            <td>
              <td>
                <td>
                  <td>
            <td><p>Diketahui, Camat</p></td>
          <td><br>
          <td><br>
            <td>
              <td>
                <td>
            <br>
            <br>
            <td><p>Jauharul Ihsan, SH., KP.</p></td>
    
        </div>     