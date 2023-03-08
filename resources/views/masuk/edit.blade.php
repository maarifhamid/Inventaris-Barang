@extends('layouts.layout') @section('content')
<title>Edit Data</title>
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-dark">Edit Data</h6>
</div>
<div class="card-body">
    <div class="x_content">
        <form action="/masuk/update" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            
            <div class="form-group">
                <label for="">Barang</label>
                <input type="hidden" name="id_masuk" value="{{$masuk2->id_masuk}}">
                 @foreach ($barang as $r)
                  @if ($masuk2->id_barang==$r->id_barang)
                  <input value="{{$r->id_barang}}" type="hidden" class="form-control" name="id_barang">
                  <input value="{{$r->nama_barang}}" type="text" class="form-control" name="" readonly>
                      @endif
                @endforeach
               
            </div>

            <div class="form-group">
                <label for="">Jumlah</label>
                <input type="number" name="jumlah" class="form-control" value="{{$masuk2->jumlah_asup}}" required placeholder="Masukan Jumlah">
            </div>

            <label for="">Harga Satuan</label>
                    <input type="number" name="harga_satuan" id="txt2[]" onkeyup="sum();" value="{{$masuk2->harga_satuan}}" class="form-control" required placeholder="Masukan Harga Satuan" required>
                
             </div>
                   
             <div class="form-group">
<label for="">Harga Total</label>
                    <input type="number" name="harga_total" id="txt3[]" readonly class="form-control" value="{{$masuk2->harga_total}}" required placeholder="Harga Total" required>
                
             </div>
                    
             <div class="form-group">
<label for="">Nama Toko</label>
                    <input type="text" name="nama_toko" class="form-control" value="{{$masuk2->nama_toko}}" required placeholder="Masukan Nama Toko" required>
                
             </div>
                    
             <div class="form-group">
<label for="">Merek</label>
                    <input type="text" name="merek" class="form-control" required value="{{$masuk2->merek}}" placeholder="Masukan Merek" required>
                
             </div>
                    
              
          <div class="form-group">
              <label for="">Sumber Dana</label>
                <input type="text" name="sumber_dana" class="form-control" required value="{{$masuk2->sumber_dana}}" placeholder="Masukan Sumber dana" required>
          </div>
           
            <div class="form-group">
                <label for="">Tanggal Masuk</label>
                <input type="date" name="tanggal_masuk" class="form-control" value="{{$masuk2->tanggal_masuk}}" required>
            </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

</div>
@endsection