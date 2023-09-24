@extends('layouts.admin_template')
@section('content')

            <div class="row m-t-25">
                <div class="col-md-8">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between">
                            <h5 class="m-0 font-weight-bold">
                                <i class="fas fa-plus"></i>&ensp;Tambah Siswa
                            </h5>
                            <a type="button" href="{{ route('siswas.index') }}" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </a>
                        </div>
                        <div class="card-body">
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
                                <div class="card">
                                    <div class="card-body card-block">
                                    <form action="{{ route('siswas.store') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                        @csrf
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">NISN</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input required type="text" name="nisn" placeholder="Masukan NISN" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="email-input" class=" form-control-label">Nama Siswa</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input required type="text" name="nama_siswa" placeholder="Masukan nama lengkap" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="email-input" class=" form-control-label">Kelas</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select required  name="kelas" id="select" class="form-control">
                                                        <option selected="selected">Masukan pilihan</option>
                                                        <option value="VII">VII</option>
                                                        <option value="VIII">VIII</option>
                                                        <option value="IX">IX</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="email-input" class=" form-control-label">Foto</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input required type="text" name="foto" placeholder="Masukan foto" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="email-input" class=" form-control-label">Jenis Kelamin</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select required  name="jenis_kelamin" id="select" class="form-control">
                                                        <option selected="selected">Masukan pilihan</option>
                                                        <option value="L">Laki-laki</option>
                                                        <option value="P">Perempuan</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="email-input" class=" form-control-label">Alamat</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <textarea required type="textarea" name="alamat" placeholder="Masukan alamat" class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="submit" name="save" class="btn btn-primary"value="Simpan">
                                                <input type="reset" name="reset" class="btn btn-danger" data-dismiss="modal" value="Batal">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- akhir si data baru -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@push('scriptsjs')
    
@endpush