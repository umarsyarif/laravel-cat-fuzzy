@extends('layouts.admin_template')
@section('content')

            <div class="row m-t-25">
                <div class="col">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between">
                            <h5 class="m-0 font-weight-bold">
                                <i class="fas fa-user"></i>&ensp;Data Siswa
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="card-title">
                                <a class='btn btn-light' href="{{ route('siswas.create') }}"><i class="fas fa-plus"></i>&ensp;Tambah</a>
                            </div>
                            {{-- display erorr --}}
                            @if ($message = Session::get('success'))
                                <div class="alert alert-primary alert-missible">
                                    {{ $message }}
                                    <button class="close" type="button" data-dismiss="alert">x</button>
                                </div>  
                            @elseif ($message = Session::get('failed'))
                                <div class="alert alert-danger alert-missible">
                                    {{ $message }}
                                    <button class="close" type="button" data-dismiss="alert">x</button>
                                </div>  
                            @endif

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="text-white" style="background-color: #365cad;">
                                        <tr>
                                            <th>No</th>
                                            <th>NISN</th>
                                            <th>Nama Siswa</th>
                                            <th>Kelas</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no =1;
                                        @endphp

                                        @forelse ($siswas as $data)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $data->nisn }}</td>
                                                <td>{{ $data->nama_siswa }}</td>
                                                <td>{{ $data->kelas }}</td>
                                                <td>{{ $data->jenis_kelamin }}</td>
                                                <td>{{ $data->alamat }}</td>
                                                <td>
                                                    <div class="au-btn-group text-center" role="group">
                                                        <a type="button" class="btn btn-light btn-sm" href="{{ route('siswas.edit', $data->id) }}" data-placement="top" title="Edit"><i class="zmdi zmdi-edit"></i></a>
                                                        <button type="button" data-target="#hapususer{{ $data->id }}" class="btn btn-light btn-sm" data-placement="top" title="Delete" data-toggle="modal" data-target="#hapususer"><i class="fas fa-trash"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">Tidak ada data</td>
                                            </tr>
                                        @endforelse
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- isi data baru -->
@foreach ($users as $data)

<div class="modal fade" id="hapususer{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">
                    <i class="fas fa-trash"></i>&emsp; Hapus Pengguna
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body card-block">
                    <form action="{{ route('users.destroy', $data->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                        @csrf
                        @method('DELETE')
                            <div class="row form-group">
                                <div class="col col-md justify-content">
                                    <label>Apakah anda ingin menghapus Pengguna <b style="color: red">{{ $data->name }}</b> ini ?</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" name="save" class="btn btn-primary"value="Hapus">
                                <input type="reset" name="reset" class="btn btn-danger" data-dismiss="modal" value="Batal">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endforeach
<!-- akhir si data baru -->


@endsection

@push('scriptsjs')
    
@endpush