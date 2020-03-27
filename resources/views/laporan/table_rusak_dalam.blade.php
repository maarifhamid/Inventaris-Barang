<table id="dataTable" class="table table-bordered" cellspacing="0">
          <thead>
            <tr>
                  <th>Barang</th>
                  <th>Jumlah</th>
                  <th>Ruangan</th>
                  <th>Tanggal Kembali</th>
                  <th>Status</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($rusak_dalam as $m)
              <tr>
                  <td>{{$m->nama_barang}}</td>
                  <td>{{$m->jumlah_rusak_ruangan}}</td>
                  <td>{{$m->ruangan}}</td>
                  <td>{{$m->tanggal_rusak}}</td>
                 @if($m->status=='sudah_diperbaiki')
                 <td>Sudah Di Perbaiki</td>
                 @else
                 <td>Rusak</td>
                 @endif
                  </tr>
              @endforeach
          </tbody>
        </table>