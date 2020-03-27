<table id="dataTable" class="table table-bordered" cellspacing="0">
          <thead>
            <tr>
                 
                  <th>Nama Peminjam</th>
                  <th>Barang</th>
                  <th>Jumlah</th>
                  <th>Tanggal Kembali</th>
                  <th>Status</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($peminjaman as $m)
              <tr>
                 
                  <td>{{$m->nama_peminjam}}</td>
                  <td>{{$m->nama_barang}}</td>
                  <td>{{$m->jumlah_pinjam}}</td>
                  <td>{{$m->tanggal_kembali}}</td>
                  <td>{{$m->status}}</td>
                  </tr>
              @endforeach
          </tbody>
        </table>