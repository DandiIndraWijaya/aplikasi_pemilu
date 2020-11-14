<div class="header bg-gradient-primary py-7 py-lg-8">
    <div class="container">
        <div class="header-body text-center mb-4">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-6">
                    <h1 class="text-white">{{ __('Pemilu SMP N X') }}</h1>
                    {{-- notifikasi sukses --}}
                    @if ($sukses = Session::get('sukses_pilih_calon'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $sukses }}</strong>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>