@extends('layout.main')
@section('title',
'Fakultas')

@section('content')


    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Fakultas</h4>
                <p class="card-description">
                 Daftar Fakultas Universitas Multi Data Palembang
                </p>
                @if (Auth::user()->role == 'A')
                <a href="{{route ('fakultas.create')}}" class="btn btn-inverse-info btn-fw">Tambah</a>
                @endif
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                        <tr>

                            <th>Nama Fakultas</th>
                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($fakultas as $item)
                        <tr>
                            <td>{{ $item ['nama']}}</td>
                            <td>

                                <div class="d-flex justify-content-center">

                                    @if (Auth::user()->role == 'A')
                                    <a href="{{ route('fakultas.edit', $item->id)}}">
                                        <button class="btn btn-success btn-sm mx-3">Edit</button>
                                    </a>
                                    @endif

                                    @if (Auth::user()->role == 'A')
                                    <form method="POST" action="{{ route('fakultas.destroy', $item->id) }}">
                                        @csrf
                                        @method('delete')
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button type="submit" class="btn btn-xs btn-danger btn-rounded show_confirm"
                                            data-toggle="tooltip" title='Delete'
                                            data-nama='{{ $item->nama }}'>Hapus</button>
                                        </form>
                                        @endif
                                </div>

                            </td>
                        </tr>
                    </div>

                        @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
    </div>

    @endsection
