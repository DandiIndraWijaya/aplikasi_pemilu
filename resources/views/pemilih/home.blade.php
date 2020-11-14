@extends('layouts.pemilih', ['class' => 'bg-default'])

@section('content')
    @include('layouts.headers.guest')

    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-7">
                <div >
                    <div class="row">
                        @foreach ($pemilihan as $p)
                        <div class="col-12 col-sm-6 mt-2">
                            <div class="card p-1">
                                <center>
                                    <h3>{{ $p->nama_pemilihan }}</h3>
                                    <p style="font-size: 11pt">{{ $p->deskripsi }}</p>
                                   
                                    <p style="font-size: 10pt">
                                        @php
                                            $pemilihan_dimulai = strtotime($p->pemilihan_dimulai);
                                            $pemilihan_berakhir = strtotime($p->pemilihan_berakhir);
                                            $sekarang = time();

                                            $p->pemilihan_dimulai = str_replace('-', '/', $p->pemilihan_dimulai);
                                            $p->pemilihan_berakhir = str_replace('-', '/', $p->pemilihan_berakhir);
                                        @endphp

                                        @if ($pemilihan_dimulai < $sekarang && $pemilihan_berakhir > $sekarang)
                                            <strong>Sudah Dimulai</strong> <br/>
                                            Berakhir : <strong><span data-countdown="{{ $p->pemilihan_berakhir }}"></span></strong>
                                            <br/>
                                            <a href="{{ url('pilih_calon/' . $p->id) }}" class="btn btn-warning mt-1 p-2">
                                                Pilih Calon!
                                            </a>
                                        @elseif ($pemilihan_dimulai > $sekarang && $pemilihan_berakhir > $sekarang)
                                            Dimulai : <strong><span data-countdown="{{ $p->pemilihan_dimulai }}"></span></strong> <br/>
                                            Berakhir : <strong><span>{{ $p->pemilihan_berakhir_carbon }}</span></strong>
                                        @else
                                            <strong><h2 class="text-danger">Pemilihan Sudah Berakhir</h2></strong>
                                        @endif
                                    </p>
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

@push('js')
    <script src="{{ URL::to('/') }}/js/jquery.countdown.js"></script>
    <script>
       $('[data-countdown]').each(function() {
            var $this = $(this), finalDate = $(this).data('countdown');
            $this.countdown(finalDate, function(event) {
                $this.html(event.strftime('%D Hari %H:%M:%S'));
            });
        });
        
    </script>
@endpush