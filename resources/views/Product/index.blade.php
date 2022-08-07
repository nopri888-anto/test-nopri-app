@extends('layouts.app')

@section('content')

<!--Create Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
      <div class="modal-body">
        <div class="form-group row">
          <label for="NamaBarang" class="col-sm-3 text-end control-label col-form-label">Nama Produk</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="NamaBarang" placeholder="Nama Produk"/>
          </div>
        </div>
        <div class="form-group row">
          <label for="HargaBeli" class="col-sm-3 text-end control-label col-form-label">Harga Beli</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="HargaBeli" placeholder="Harga Beli "/>
          </div>
        </div>
        <div class="form-group row">
          <label for="HargaJual" class="col-sm-3 text-end control-label col-form-label">Harga Jual</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="HargaJual" placeholder="Harga Jual "/>
          </div>
        </div>
        <div class="form-group row">
          <label for="Stok" class="col-sm-3 text-end control-label col-form-label">Stok</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="Stok" placeholder="Stok "/>
          </div>
        </div>
        <div class="form-group row">
          <label for="FotoBarang" class="col-sm-3 text-end control-label col-form-label">Foto Barang</label>
          <div class="col-sm-9">
            <input type="file" class="form-control" name="FotoBarang"/>
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

<!--End Create Modal -->


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
              
<!-- Button trigger modal -->
<button type="button" class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Add New Product
</button>
              <div class="table-responsive">
                <table
                  id="zero_config"
                  class="table table-striped table-bordered"
                >
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Product</th>
                      <th>Name Product</th>
                      <th>Price Buy</th>
                      <th>Price Sell</th>
                      <th>Stock</th>
                      <th>#</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($products as $key => $product)
                      <tr>
                        <td>{{$key+1}}</td>
                        <td>
                          @if ($product->FotoBarang)
                          <div>
                            <img src="{{asset('storage/'.$product->FotoBarang)}}" style="max-height: 40px;" alt="{{$product->FotoBarang}}" class="img-responsive">
                          </div>
                          @else
                              <img src="https://source.unsplash.com/40x40?{{$product->FotoBarang}}" alt="{{$product->FotoBarang}}" class="img-fluid">
                          @endif
                        </td>
                        <td>{{$product->NamaBarang}}</td>
                        <td>{{$product->HargaBeli}}</td>
                        <td>{{$product->HargaJual}}</td>
                        <td>{{$product->Stok}}</td>
                        <td>
                          
                          <form action="{{route('product.destroy',$product)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="{{route('product.edit',$product->id)}}" class="btn btn-warning"><i
                              class="fa fa-pencil me-1"></i></a>
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Delete Data?')"><i
                              class="fa fa-trash me-1"></i></button>
                          </form>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
   
        </div>
    </div>
</div>
@include('sweetalert::alert')
@endsection
