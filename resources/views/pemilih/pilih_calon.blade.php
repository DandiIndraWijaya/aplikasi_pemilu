@extends('layouts.pemilih', ['class' => 'bg-default'])

@section('content')
    @include('layouts.headers.guest')

    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-7">
                <div >
                    <center><h1>{{ $pemilihan->nama_pemilihan }}</h1></center>
                    <div class="row">
                        @foreach ($calon as $c)
                        <div class="modal fade" id="calon{{ $c->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" id="exampleModalLabel">Konfirmasi Pilihan</h3>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card p-1">
                                                <img class="card-img-top" src="{{ url('/foto_calon/'.$c->foto) }}" height="250" alt="Card image cap">
                                                <center>
                                                <div class="card-body">
                                                <h5 class="card-title">{{ $c->nama_pemilihan }}</h5>
                                                <p class="card-text"> <strong>{{ $c->nomor_calon }}</strong> </p>
                                                <p class="card-text"><strong>{{ $c->nama_calon }}</strong></p>
                                                </div>
                                                </center>
                                            </div>
                                        </div>
                                        <form method="post" action="/proses/pilih_calon">
                                            {{ csrf_field() }}
                                            <div class="modal-footer">
                                                <input type="text" value="{{ $c->id }}" name="id_calon" hidden>
                                                <input type="text" value="{{ $pemilihan->id }}" name="id_pemilihan" hidden>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
                                                <button type="submit" class="btn btn-warning">Pilih</button>
                                            </div>
                                        </form>
                                    </div>
                            </div>
                        </div>
                        
                        <div class="col-12 col-sm-6 mt-2">
                            <div class="card p-1">
                                <img class="card-img-top" src="{{ url('/foto_calon/'.$c->foto) }}" height="250" alt="Card image cap">
                                <center>
                                <div class="card-body">
                                <h5 class="card-title">{{ $c->nama_pemilihan }}</h5>
                                <p class="card-text"> <strong>{{ $c->nomor_calon }}</strong> </p>
                                <p class="card-text"><strong>{{ $c->nama_calon }}</strong></p>
                                <form action="/admin/hapus_calon" method="post">
                                    {{ csrf_field() }}
                                    <input type="text" name="id_calon" value="{{ $c->id }}" hidden>
                                    <input type="text" name="foto_calon" value="{{ $c->foto }}" hidden>
                                    <input type="text" name="nama_calon" value="{{ $c->nama_calon }}" hidden>
                                    
                                    <button type="button" style="width: 90%" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#calon{{ $c->id }}">
                                            Pilih
                                    </button>
                                </form>
                                </div>
                                </center>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection