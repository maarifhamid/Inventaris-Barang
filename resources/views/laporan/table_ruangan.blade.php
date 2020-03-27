<table id="dataTable" class="table table-bordered" cellspacing="0">
          <thead>
            <tr>
                  <th>Ruangan</th>
                  <th>Barang</th>
                  <th>Jumlah Baik</th>
                  <th>Jumlah Rusak</th>
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