@extends('layout.main')
@section('title',
'Tambah Fakultas')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Tambah Fakultas</h4>
                <p class="card-description">
                 Formulir tambah fakultas
                </p>
                <form class="forms-sample" method="POST" action="{{route('fakultas.store')}}">
                    @csrf
                    <div class="form-group">
                      <label for="nama">Nama Fakultas</label>
                      <input type="text" class="form-control" name="nama" placeholder="Nama Fakultas">
                        @error('nama')
                        <label class="text-danger">{{$message}}</label>

                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                    <a href="{{url('fakultas')}}" class="btn btn-light">Batal</a>
                  </form>

              </div>
            </div>
          </div>
    </div>

    @endsection
