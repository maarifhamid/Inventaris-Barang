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
                  <th>Tanggal Rusak</th>
                  <th>Status</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($rusak_luar as $m)
              <tr>
                  <td>{{$m->nama_barang}}</td>
                  <td>{{$m->jumlah_rusak_luar}}</td>
                  <td>{{$m->tanggal_rusak_luar}}</td>
                  @if ($m->status=='sudah_diperbaiki')
                  <td>Sudah Di Perbaiki</td>
                  @else
                  <td>Rusak</td>
                  @endif
                  </tr>
              @endforeach
          </tbody>
        </table>

        <div class="tandatangan">
          <br>
          <td>
            <td>
              <td>
          <td><p>Jambi, {{ Carbon\Carbon::now()->isoFormat('D MMMM Y')}} </p></td>
          <td>
            <td>
            <td><p>Diketahui, Camat</p></td>
          <td><br>
          <td><br>
            <br>
            <br>
            <td><p>Jauharul Ihsan, SH., KP.</p></td>
    
        </div>     