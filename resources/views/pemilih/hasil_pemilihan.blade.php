@extends('layouts.pemilih', ['class' => 'bg-default'])

@section('content')
    @include('layouts.headers.guest')

    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-7">
                <div >
                    <center><h1>Hasil {{ $pemilihan->nama_pemilihan }}</h1></center>
                    <div class="row">
                        @foreach ($calon as $c)
                        <div class="col-12 col-sm-6 mt-2">
                            <div class="card p-1">
                                <img class="card-img-top" src="{{ url('/foto_calon/'.$c->foto) }}" height="250" alt="Card image cap">
                                <center>
                                <div class="card-body">
                                <h5 class="card-title">{{ $c->nama_pemilihan }}</h5>
                                <p class="card-text"> <strong>{{ $c->nomor_calon }}</strong> </p>
                                <p class="card-text"><strong>{{ $c->nama_calon }}</strong></p>
                                <h1>Jumlah Suara : <strong>{{ $c->jumlah_suara }}</strong></h1>
                                </div>
                                </center>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="card mt-2 p-1" >
                        <center>
                        <h1 style="color: grey">Jumlah Pemilih : <strong>{{ $jumlah_pemilih }}</strong></h1>
                        <h1 style="color: grey">Telah Memilih : <strong>{{ $jumlah_telah_memilih }}</strong></h1>
                        <h1 style="color: grey">Golongan Putih : <strong>{{ $jumlah_pemilih - $jumlah_telah_memilih }}</strong></h1>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection