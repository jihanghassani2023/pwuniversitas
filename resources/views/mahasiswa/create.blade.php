@extends('layout.main')
@section('title',
'Tambah Mahasiswa')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Tambah Mahasiswa</h4>
                <p class="card-description">
                 Formulir tambah mahasiswa
                </p>
                <form class="forms-sample" method="POST" action="{{route('mahasiswa.store')}}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="npm">Nomor Pokok Mahasiswa</label>
                        <input type="text" class="form-control" name="npm" placeholder="Nomor Pokok mahasiswa">

                          @error('npm')
                          <label class="text-danger">{{$message}}</label>
                          @enderror

                      </div>
                    <div class="form-group">
                      <label for="nama">Nama Mahasiswa</label>
                      <input type="text" class="form-control" name="nama" placeholder="Nama mahasiswa">
                        @error('nama')
                        <label class="text-danger">{{$message}}</label>
                        @enderror

                    </div>



                      <div class="form-group">
                        <label for="tempat_lahir">Tempat Lahir</label>
                        <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat lahir">

                          @error('tempat_lahir')
                          <label class="text-danger">{{$message}}</label>
                          @enderror

                      </div>
                      <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tanggal_lahir" placeholder="Tanggal Lahir">

                          @error('tanggal_lahir')
                          <label class="text-danger">{{$message}}</label>
                          @enderror

                      </div>
                      <div>
                        <input type="radio" id="jk" name="jk" value="L" checked />
                        <label for="jk">Laki-Laki</label>
                        <input type="radio" id="jk" name="jk" value="P" />
                        <label for="jk">Perempuan</label>
                        @error('jk')
                            <label class="text-danger">{{ $message }} </label>
                        @enderror
                    </div>

                      <div class="form-group">
                        <label for="foto">Foto</label>
                        <input type="file" class="form-control" name="foto" placeholder="Foto">

                          @error('foto')
                          <label class="text-danger">{{$message}}</label>
                          @enderror

                      </div>

                    <div class="form-group">
                        <label for="prodi_id">Nama Prodi</label>
                        <select name="prodi_id" class="form-control" >
                            <option value="">pilih</option>
                            {{--option diambil dari model fakults/ untuk membuat list fakultas di tambah prodi dana pada prodicontroller bagian function create--}}
                            @foreach ($prodi as $item)
                                <option value="{{ $item->id }}"> {{$item->nama}}
                                </option>

                            @endforeach

                        </select>

                          @error('prodi_id')
                          <label class="text-danger">{{$message}}</label>

                          @enderror
                      </div>

                    <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                    <a href="{{url('mahasiswa')}}" class="btn btn-light">Batal</a>
                  </form>

              </div>
            </div>
          </div>
    </div>

    @endsection
