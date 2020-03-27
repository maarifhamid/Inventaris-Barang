<table id="dataTable" class="table table-bordered" cellspacing="0">
          <thead>
            <tr>
                  <th>Barang</th>
                  <th>Jumlah</th>
                  <th>Tujuan</th>
                  <th>Tanggal Keluar</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($keluar as $m)
              <tr>
                  <td>{{$m->nama_barang}}</td>
                  <td>{{$m->jumlah_keluar}}</td>
                  <td>{{$m->untuk}}</td>
                  <td>{{$m->tanggal_keluar}}</td>
                  </tr>
              @endforeach
          </tbody>
        </table>