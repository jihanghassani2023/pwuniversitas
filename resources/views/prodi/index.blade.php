@extends('layout.main')
@section('title','Program Studi')

@section('content')



    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Prodi</h4>
            <p class="card-description">
                Daftar Prodi Universitas Multi Data Palemban    g
            </p>
            @can ('create', App\Prodi::class) {{--saat menekan tombol ada tulisan auto....--}}
            <a href="{{route ('prodi.create')}}" class="btn btn-inverse-info btn-fw">Tambah</a>
            @endcan
            <div class="table-responsive">
              <table class="table">
                <thead>
                    <tr>

                        <th>Nama Prodi</th>
                        <th>Nama Fakultas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($prodi as $item)
                    <tr>
                        <td>{{ $item ['nama']}}</td>
                        <td>{{ $item ['fakultas']['nama']}}</td>
                        <td>

                            <div class="d-flex justify-content-center">

                                @can('update', $item)
                                <a href="{{ route('prodi.edit', $item->id)}}">
                                    <button class="btn btn-success btn-sm mx-3">Edit</button>
                                </a>
                                @endcan

                                <form method="post" action="{{route('prodi.destroy', $item->id)}}">
                                    @method('delete')
                                    @csrf

                                    @can('delete', $item) {{--menghapus tombol hapus di user--}}
                                    <button  type="submit" class="btn btn-xs btn-danger btn-rounded show_confirm"
                                    data-toggle="tooltip" title='Delete'
                                    data-nama='{{ $item->nama }}'>Delete</button>
                                    @endcan
                                </form>
                            </div>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    @endsection
