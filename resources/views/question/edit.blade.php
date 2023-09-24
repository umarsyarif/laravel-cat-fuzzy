@extends('layouts.admin_template')
@section('content')

            <div class="row m-t-25">
                <div class="col-md-8">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between">
                            <h5 class="m-0 font-weight-bold">
                                <i class="zmdi zmdi-edit"></i>&ensp;Edit Soal
                            </h5>
                            <a type="button" href="{{ route('banksoals.index') }}" class="close" data-dismiss="modal" aria-label="Close">
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
                                    <form action="{{ route('banksoals.update', $edit->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                        @method('PUT')
                                        @csrf
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Kode Soal</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" name="kodesoal" value="{{ $edit->kodesoal }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="email-input" class=" form-control-label">Soal</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <textarea type="textarea" name="soal" class="form-control">{{ $edit->soal }}</textarea>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="email-input" class=" form-control-label">Indeks Daya</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" name="daya" value="{{ $edit->daya }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="email-input" class=" form-control-label">Indeks Kesukaran</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" name="level" value="{{ $edit->level }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="email-input" class=" form-control-label">Nilai</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" name="skor" value="{{ $edit->skor }}" class="form-control">
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