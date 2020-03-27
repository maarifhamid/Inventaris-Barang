@extends('layouts.layout') @section('content')
<title>Input Barang Rusak</title>
<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-dark">Input Barang Rusak</h6>
</div>
<div class="card-body">
    <div class="x_content">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Scan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Tanpa Scan</a>
        </li>
        </ul>
        <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <form action="/input_rusak_dalam/input" method="post">
                @csrf
                <br>
                <div class="form-group">
                    <label for="" class="control-label">Kode Barang</label>
                    <input type="text" id="id_barang" name="id_barang" class="form-control input-lg">
                </div>
                <label for="video" style="form-control float:top" class="control-label">Scan</label><br>
                <div class="embed-responsive embed-responsive-21by9">
                <div class="form-group">
                    
                    <video name="video"  id="preview" class="embed-responsive-item"></video>
                </div>
                </div>
                <div class="form-group">
                    <label for="">Barang</label>
                    <input type="text"  id="nama" name="nama_barang" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="">Jumlah</label>
                    <input type="number" name="jumlah" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Ruangan</label>
                    <select name="id_ruangan" id="" class="form-control">
                        <option value="" disabled selected>Pilih ruangan</option>
                        @foreach ($ruangan as $a)
                        <option value="{{$a->id_ruangan}}">{{$a->ruangan}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Tanggal</label>
                    <input type="date" name="tanggal_rusak" value="{{ Carbon\Carbon::now()->format('Y-m-d')}}" class="form-control" readonly>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
            
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <form action="/input_rusak_dalam/input" method="post">
                @csrf
                <br>
                <div class="form-group">
                    <label for="">Kategori</label>
                    <select name="id_kategori" id="country" class="form-control">
                        <option value="" disabled selected>Pilih Kategori</option>
                        @foreach ($kategori as $b)
                        <option value="{{$b->id_kategori}}">{{$b->nama_kategori}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Barang</label>
                     <select name="id_barang" id="state" class="form-control" required>

                    </select>
                </div>
                <div class="form-group">
                    <label for="">Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Ruangan</label>
                    <select name="id_ruangan" id="" class="form-control" required>
                        <option value="" disabled selected>Pilih ruangan</option>
                        @foreach ($ruangan as $a)
                        <option value="{{$a->id_ruangan}}">{{$a->ruangan}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Tanggal</label>
                    <input type="date" name="tanggal_rusak" value="{{ Carbon\Carbon::now()->format('Y-m-d')}}" class="form-control" readonly>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
           
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">KONTROL 3</div>
        </div>
    </div>
</div>


<script type="text/javascript">

            let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
            scanner.addListener('scan', function (content) {
                $('#id_barang').val(content);
                $.get("{{url ('get-state-list2') }}"+'/'+content,function(data){
                    $('#nama').val(data);
                });
            });
            Instascan.Camera.getCameras().then(function (cameras) {
                if (cameras.length > 0) {
                    scanner.start(cameras[0]);
                } else {
                    console.error('No cameras found.');
                }
            }).catch(function (e) {
                console.error(e);
            });



        </script>
@push('scripts')
   
<script type="text/javascript">
    $('#country').change(function(){
    var kategoriID = $(this).val();    
    if(kategoriID){
        $.ajax({
           type:"GET",
           url:"{{url('get-state-list')}}?kategori_id="+kategoriID,
           success:function(res){               
            if(res){
                $("#state").empty();
                $("#state").append('<option></option>');
                $.each(res,function(key,value){
                    $("#state").append('<option value="'+key+'">'+value+'</option>');
                });
           
            }else{
               $("#state").empty();
            }
           }
        });
    }else{
        $("#state").empty();
       
    }      
   });

   setInterval(function(){ 
    if($('#id_barang').val()!=''){
       var id=$('#id_barang').val();
        $.get("{{url ('ambil') }}"+'/'+id,function(data){
        
    })
    }
}, 500);
</script>
 
@endpush
@endsection