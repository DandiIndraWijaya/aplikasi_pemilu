@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    
    
    <div class="container-fluid mt--7">
        {{-- notifikasi form validasi --}}
		@if ($errors->has('file'))
		<span class="invalid-feedback" role="alert">
			<strong>{{ $errors->first('file') }}</strong>
		</span>
		@endif
 
		{{-- notifikasi sukses --}}
		@if ($sukses = Session::get('sukses'))
		<div class="alert alert-success alert-block">
			<button type="button" class="close" data-dismiss="alert">×</button> 
			<strong>{{ $sukses }}</strong>
		</div>
		@endif
        <!-- Buat Pemilihan -->
		<div class="modal fade" id="buatpemilihan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<form method="post" action="/admin/input_pemilihan" enctype="multipart/form-data">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Buat Pemilihan</h5>
						</div>
						<div class="modal-body">
 
							{{ csrf_field() }}
                            
                            <label>Nama Pemilihan</label>
                            <div class="form-group">
                                <input type="text" class="form-control" style="color: gray;" placeholder="Contoh: Pemilihan Ketua Osis" name="nama_pemilihan" required="required">
                            </div>

                            <label>Deskripsi</label>
                            <div class="form-group">
                                <textarea style="color: gray;" class="form-control" name="deskripsi" placeholder="Deskripsikan Pemilihan" rows="2" required="required"></textarea>
                            </div>
                            
                            <label>Pemilihan Dimulai</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                    </div>
                                    <input class="flatpickr datetimepicker form-control" type="text" placeholder="Pemilihan Dimulai" name="pemilihan_dimulai" required="required">
                                  </div>
                            </div>

                            <label>Pemilihan Berakhir</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                    </div>
                                    <input class="flatpickr datetimepicker form-control" type="text" placeholder="Batas akhir memilih" name="pamilihan_berakhir" required="required">
                                  </div>
                            </div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
							<button type="submit" class="btn btn-warning">Simpan</button>
						</div>
					</div>
				</form>
			</div>
        </div>
        
        <button type="button" class="btn btn-warning mr-5" data-toggle="modal" data-target="#buatpemilihan">
			Buat Pemilihan
        </button>

        <div class="row mt-1">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Pemilihan</h3>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Nama Pemilihan</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Pemilihan Dimulai</th>
                                    <th scope="col">Pemilihan Berakhir</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pemilihan as $p)
                                <div class="modal fade" id="edit{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form method="post" action="/admin/update_pemilihan">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Buat Pemilihan</h5>
                                                    </div>
                                                    <div class="modal-body">
                            
                                                        {{ csrf_field() }}
                                                        <input type="text" name="id" value="{{ $p->id }}" hidden>
                                                        <label>Nama Pemilihan</label>
                                                        <div class="form-group">
                                                        <input type="text" class="form-control" style="color: gray;" placeholder="Contoh: Pemilihan Ketua Osis" name="nama_pemilihan" value="{{ $p->nama_pemilihan }}" required="required">
                                                        </div>
                            
                                                        <label>Deskripsi</label>
                                                        <div class="form-group">
                                                        <textarea style="color: gray;" class="form-control" name="deskripsi" placeholder="Deskripsikan Pemilihan" rows="2" required="required">{{ $p->deskripsi }}</textarea>
                                                        </div>
                                                        
                                                        <label>Pemilihan Dimulai</label>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                                                </div>
                                                            <input class="flatpickr datetimepicker form-control" type="text" placeholder="Pemilihan Dimulai" name="pemilihan_dimulai" value="{{ $p->pemilihan_dimulai }}" required="required">
                                                            </div>
                                                        </div>
                            
                                                        <label>Pemilihan Berakhir</label>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                                                </div>
                                                                <input class="flatpickr datetimepicker form-control" type="text" placeholder="Batas akhir memilih" name="pamilihan_berakhir" value="{{ $p->pemilihan_berakhir }}" required="required">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-warning">Simpan</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                <tr>
                                    <td>
                                        {{ $p->nama_pemilihan }}
                                    </td>
                                    <td>
                                        {{ $p->deskripsi }}
                                    </td>
                                    <td>
                                        {{ $p->pemilihan_dimulai }}
                                    </td>
                                    <td>
                                        {{ $p->pemilihan_berakhir }}
                                    </td>
                                    <td>
                                        
                                        <form action="/admin/hapus_pemilihan" method="POST">
                                            {{ csrf_field() }}
                                            <input type="text" name="nama_pemilihan" value="{{ $p->nama_pemilihan }}" hidden>
                                            <input type="text" name="id" value="{{ $p->id }}" hidden>
                                            <button type="button" class="btn btn-primary btn-sm mr-1" data-toggle="modal" data-target="#edit{{ $p->id }}">
                                                Edit
                                            </button>
                                            <input type="submit" value="Hapus" class="btn btn-danger btn-sm mr-1">
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script type="text/javascript">
        <!-- javascript for init -->

        <!-- Datepicker -->
        flatpickr('.flatpickr', {});

        <!-- Datepicker - range -->
        flatpickr('.range', {
            mode: "range"
        });
        <!-- DateTimePicker -->
        flatpickr('.datetimepicker', {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
        });
    </script> 
    
@endpush