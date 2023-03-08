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
                  <th>Ruangan</th>
                  <th>Barang</th>
                  <th>Kondisi Baik</th>
                  <th>Kondisi Rusak</th>
                  <th>Total</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($inputruangan as $m)
              <tr>
                  <td>{{$m->ruangan}}</td>
                  <td>{{$m->nama_barang}}</td>
                  <td>{{$m->jumlah_masuk}}</td>
                  <td>{{$m->jumlah_rusak_ruangan}}</td>
                  <td>{{$m->jumlah_rusak_ruangan + $m->jumlah_masuk}}</td>
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
          <td><p>Jambi, {{ Carbon\Carbon::now()->isoFormat('D MMMM Y')}} </p></td>
          <td>
            <td>
              <td>
            <td><p>Diketahui, Camat</p></td>
          <td><br>
          <td><br>
            <td>
            <br>
            <br>
            <td><p>Jauharul Ihsan, SH., KP.</p></td>
    
        </div>     