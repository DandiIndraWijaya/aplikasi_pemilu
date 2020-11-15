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
        <!-- Import Excel -->
		<div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<form method="post" action="/import_pemilih" enctype="multipart/form-data">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
						</div>
						<div class="modal-body">
 
							{{ csrf_field() }}
 
							<label>Pilih file excel</label>
							<div class="form-group">
								<input type="file" name="file" required="required">
							</div>
 
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-warning">Import</button>
						</div>
					</div>
				</form>
			</div>
        </div>
        
        <button type="button" class="btn btn-warning mr-5" data-toggle="modal" data-target="#importExcel">
			IMPORT EXCEL
        </button>
        
        <div class="row mt-1">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-lg-4 col-xl-4">
                                <h3 class="m-2">Pemilih</h3>
                                <form action="/dashboard/cari_pemilih" method="GET">
                                    <div class="form-group mb-0">
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                            </div>
                                            @php
                                                if(isset($nama)){
                                                    $nama_value = $nama;
                                                }else{
                                                    $nama_value = '';
                                                }
                                            @endphp
                                            <input class="form-control" style="color: gray" placeholder="Cari Pemilih" name="nama" value="{{ $nama_value }}" type="text">
                                            
                                        </div>
                                    </div>
                                    <input type="submit" class="btn btn-primary btn-sm m-1" value="Cari">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Alamat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pemilih as $p)
                                <tr>
                                    <td>
                                        {{ $p->id_pemilih }}
                                    </td>
                                    <td>
                                        {{ $p->name }}
                                    </td>
                                    <td>
                                        {{ $p->alamat }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="m-2">
                        {{ $pemilih->links() }}
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
@endpush