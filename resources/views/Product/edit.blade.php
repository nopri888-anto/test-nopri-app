@extends('layouts.app')

@section('content')

<div class="container">
  @if (count($errors)>0)
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
              <li>{{$error}}</li>
          @endforeach
        </ul>
      </div>
  @endif


  @if(\Session::has('success'))
  <div class="alert alert-success">
    <p>{{\Session::get('success')}}</p>
  </div>
  @endif
    <div class="row justify-content-center">
        <div class="col">
        <div class="card">
          <div class="card-head ">
          </div>
            <div class="card-body">
                <form action="{{route('product.update',$product->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                  <div class="modal-body">
                    <div class="form-group row">
                      <label for="NamaBarang" class="col-sm-3 text-end control-label col-form-label">Nama Produk</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{$product->NamaBarang}}" name="NamaBarang" placeholder="Nama Produk"/>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="HargaBeli" class="col-sm-3 text-end control-label col-form-label">Harga Beli</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{$product->HargaBeli}}" name="HargaBeli" placeholder="Harga Beli "/>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="HargaJual" class="col-sm-3 text-end control-label col-form-label">Harga Jual</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{$product->HargaJual}}" name="HargaJual" placeholder="Harga Jual "/>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="Stok" class="col-sm-3 text-end control-label col-form-label">Stok</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{$product->Stok}}" name="Stok" placeholder="Stok "/>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="FotoBarang" class="col-sm-3 text-end control-label col-form-label">Foto Barang</label>
                      <div class="col-sm-9">
                        <input type="hidden" name="oldImage" value="{{$product->FotoBarang}}">
                        @if($product->FotoBarang)
                        <img src="{{asset('storage/'.$product->FotoBarang)}}" class="img-preview img-fluid mb-3 col-sm-5" />
                        @else
                        <img class="img-preview img-fluid mb-3 col-sm-5" />
                        @endif
                        <input type="file" onchange="previewImage()" class="form-control" name="FotoBarang" id="FotoBarang"/>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Reset</button>
                    <button type="submit" class="btn btn-primary">Save Data</button>
                  </div>
                </form>
            </div>
          </div>
   
        </div>
    </div>
</div>

@include('sweetalert::alert')
<script>
function previewImage(){
    const image = document.querySelector('#FotoBarang');
    const imgPreview = document.querySelector('.img-preview');

    imgPreview.style.display= 'block';

    const oFReader = new FileReader();
    oFReader.readAsDataURL(FotoBarang.files[0]);

    oFReader.onload = function(oFREvent){
        imgPreview.src = oFREvent.target.result;
    }
}
</script>

@endsection
