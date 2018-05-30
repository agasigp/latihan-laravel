@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if (Session::has('info_message'))
            <div class="alert alert-info"><p>{{ Session::get('info_message') }}</p></div>
            @endif
            @if (Session::has('warning_message'))
            <div class="alert alert-warning"><p>{{ Session::get('warning_message') }}</p></div>
            @endif
            @if (Session::has('success_message'))
            <div class="alert alert-success"><p>{{ Session::get('success_message') }}</p></div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Pasien</div>
                <div class="panel-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-3" style="border">
                                <div class="btn-group btn-group-sm" role="group" aria-label="...">
                                    <a href="{{ route('pasien.create')}}" class="btn btn-success"><i class="fa fa-plus fa-fw"></i></a>
                                </div>
                            </div>
                            <div class="col-xs-3" align="center">
                                <form method="get" class="input-group input-group-sm">
                                    <input name="page" type="hidden" value="{{ $pasien->currentPage() }}" />
                                    <input name="q" type="text" class="form-control" placeholder="Cari" value="{{ $request->input('q')}}" />
                                    <div class="input-group-btn">
                                        <input type="submit" class="btn btn-success" value="Cari">
                                    </div>
                                </form>
                            </div>
                            <div class="col-xs-4">
                                <form method="get" class="input-group input-group-sm">
                                    <span class="input-group-btn">
                                        <a class="btn btn-default" href="{{ str_replace('/?', '?', $pasien->url(1))}}"
                                           @if($pasien->currentPage() == 1) disabled @endif>&laquo;</a>
                                        <a class="btn btn-default"
                                           href="{{ str_replace('/?', '?', $pasien->previousPageUrl())}}"
                                           @if($pasien->currentPage() == 1) disabled @endif><</a>
                                    </span>
                                    <span class="input-group-addon" id="basic-addon2">page</span>
                                    <input name="page" type="number" style="border-left: 0; border-right: 0;" value="{{ $pasien->currentPage()}}" min="1" max="{{ $pasien->lastPage()}}" class="form-control crud-page-number">
                                    <span class="input-group-addon">of {{ $pasien->lastPage()}}</span>
                                    <span class="input-group-btn">
                                        <a class="btn btn-default" href="{{ str_replace('/?', '?', $pasien->nextPageUrl())}}"
                                           @if($pasien->currentPage() == $pasien->lastPage()) disabled @endif>></a>
                                        <a class="btn btn-default" href="{{ str_replace('/?', '?', $pasien->url($pasien->lastPage()))}}"
                                           @if($pasien->currentPage() == $pasien->lastPage()) disabled @endif>&raquo;</a>
                                    </span>
                                </form>
                            </div>
                            <div class="col-xs-2">
                                <div class="input-group input-group-sm">
                                    Total: {{ $pasien->total() }} data
                                </div>
                            </div>
                        </div><!-- /.row -->
                        <br />
                        <div class="row">
                            <div class="col-sm-12">
                                @if ( !$pasien->count() )
                                <div class="alert alert-warning">
                                    <p>Tidak ada data</p>
                                </div>
                                @else
                                <table class="table table-striped table-condensed table-hover table-bordered">
                                    <tr>
                                        <th>#</th>
                                        <th>No RM</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Alamat</th>
                                        <th>Created At</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <?php
                                        if ($pasien->currentPage() == 1) {
                                            $no = 1;
                                        } else {
                                            $no = $pasien->perPage() * ($pasien->currentPage() - 1) + 1;
                                        }
                                    ?>
                                    @foreach($pasien as $orang)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $orang->no_rm }}</td>
                                        <td><a href="{{ route('pasien.show', $orang->id) }}">{{ $orang->nama }}</a></td>
                                        <td>{{ $orang->jenis_kelamin }}</td>
                                        <td>{{ $orang->alamat }}</td>
                                        <td>{{ $orang->created_at }}</td>
                                        <td align="center">
                                            <form method="POST" action="{{ route('pasien.destroy', $orang->id)}}" accept-charset="UTF-8">
                                                {!! csrf_field() !!}
                                                <input name="_method" type="hidden" value="DELETE">
                                                <div class="btn-group btn-group-xs">
                                                    <a class="btn btn-default" href="{{ route('pasien.edit', $orang->id)}}"><i class="fa fa-pencil fa-fw"></i></a>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection