@extends('layouts.layout') @section('content')
<title>Edit Data</title>
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-dark">Edit Data</h6>
</div>
<div class="card-body">
    <div class="x_content">
        <form action="/keranjang_masuk/update" method="post">
            {{ csrf_field() }}
            
            <div class="form-group">
                <label for="">Barang</label>
                <input type="hidden" name="id_masuk" value="{{$masuk2->id_masuk}}">
                 <select name="id_barang" id="" class="form-control">
                 @foreach ($barang as $r)
                  @if ($masuk2->id_barang==$r->id_barang)
                  <option value="{{$r->id_barang}}" selected="selected">{{$r->nama_barang}}</option>
                  @else
                  <option value="{{$r->id_barang}}">{{$r->nama_barang}}</option>
                      @endif
                @endforeach
                </select> 
            </div>
            <div class="form-group">
                <label for="">Jumlah</label>
                <input type="number" name="jumlah" class="form-control" value="{{$masuk2->jumlah_asup}}" required placeholder="Masukan Jumlah">
            </div>

            <div class="form-group">
 <label for="">Harga Satuan</label>
                    <input type="number" name="harga_satuan" id="txt2[]" onkeyup="sum();" value="{{$masuk2->harga_satuan}}" class="form-control" required placeholder="Masukan Jumlah" required>
                
             </div>
                   
             <div class="form-group">
<label for="">Harga Total</label>
                    <input type="number" name="harga_total" id="txt3[]" readonly class="form-control" value="{{$masuk2->harga_total}}" required placeholder="Masukan Jumlah" required>
                
             </div>
                    
             <div class="form-group">
<label for="">Nama Toko</label>
                    <input type="text" name="nama_toko" class="form-control" value="{{$masuk2->nama_toko}}" required placeholder="Masukan Jumlah" required>
                
             </div>
                    
             <div class="form-group">
<label for="">Merek</label>
                    <input type="text" name="merek" class="form-control" required value="{{$masuk2->merek}}" placeholder="Masukan Jumlah" required>
                
             </div>
                    
              
          <div class="form-group">
              <label for="">Sumber Dana</label>
                <input type="text" name="sumber_dana" class="form-control" required value="{{$masuk2->sumber_dana}}" placeholder="Masukan Sumber dana" required>
          </div>
           
            <div class="form-group">
                <label for="">Tanggal Keluar</label>
                <input type="date" name="tanggal_masuk" class="form-control" value="{{$masuk2->tanggal_masuk}}" required>
            </div>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

</div>
@endsection