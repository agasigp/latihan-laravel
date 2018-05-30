@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @if (Session::has('info_message'))
            <div class="alert alert-info"><p>{{ Session::get('info_message') }}</p></div>
            @endif
            @if (Session::has('success_message'))
            <div class="alert alert-success"><p>{{ Session::get('success_message') }}</p></div>
            @endif
            <form action="{{ route('pasien.update', $pasien->id) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('put') }}
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Pasien</div>
                    <div class="panel-body">
                        <div class="form-group row {{ $errors->has('no_rm') ? ' has-error' : '' }}">
                            <label for="nama" class="col-sm-2 form-control-label">No RM</label>
                            <div class="col-sm-6">
                                <input type="text" name="no_rm" class="form-control" placeholder="No Rekam Medis" value="{{ $pasien->no_rm }}">
                                @if ($errors->has('no_rm'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('no_rm') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('nama') ? ' has-error' : '' }}">
                            <label for="nama" class="col-sm-2 form-control-label">Nama</label>
                            <div class="col-sm-6">
                                <input type="text" name="nama" class="form-control" placeholder="Nama" value="{{ $pasien->nama }}">
                                @if ($errors->has('nama'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('nama') ? ' has-error' : '' }}">
                            <label for="nama" class="col-sm-2 form-control-label">Jenis Kelamin</label>
                            <div class="col-sm-6">
                                <label class="radio-inline">
                                    <input type="radio" name="jenis_kelamin" id="inlineRadio1" value="L" {{ $pasien->jenis_kelamin == 'L' ? 'checked' : '' }}> L
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="jenis_kelamin" id="inlineRadio2" value="P" {{ $pasien->jenis_kelamin == 'P' ? 'checked' : '' }}> P
                                </label>
                                @if ($errors->has('jenis_kelamin'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('jenis_kelamin') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('nama') ? ' has-error' : '' }}">
                            <label for="nama" class="col-sm-2 form-control-label">Alamat</label>
                            <div class="col-sm-6">
                                <input type="text" name="alamat" class="form-control" placeholder="Alamat" value="{{ $pasien->alamat }}">
                                @if ($errors->has('nama'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nama') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <input type="submit" class="btn btn-primary" value="Simpan">
                                <a class="btn btn-default" href="{{ url('pasien') }}" role="button">Batal</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection