@extends('layouts.frontend')

@section('title', 'Biaya Pendidikan - Fakultas Teknik Universitas Suryakancana')
@section('meta_description', 'Rincian biaya pendidikan dan pembayaran di Fakultas Teknik Universitas Suryakancana.')

@section('content')
{{-- Page Header --}}
<x-frontend.breadcrumb 
    title="Biaya Pendidikan" 
    :breadcrumbs="['PMB' => route('pmb'), 'Biaya Pendidikan' => '#']" 
/>

{{-- Content Section --}}
<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="row g-5">
            {{-- Main Content --}}
            <div class="col-lg-8">
                <div class="bg-white rounded-4 shadow-sm p-4 p-md-5 mb-5" data-aos="fade-up">
                    <h3 class="fw-bold text-primary mb-4 border-bottom pb-3">Rincian Biaya Pendidikan</h3>
                    <p class="text-muted mb-4" style="line-height: 1.8;">
                        Berikut adalah estimasi rincian biaya pendidikan untuk mahasiswa baru Fakultas Teknik Universitas Suryakancana. Biaya dapat dicicil sesuai dengan ketentuan yang berlaku di bagian keuangan universitas.
                    </p>

                    @if($biayaGrouped->count() > 0)
                        <!-- Biaya per Prodi -->
                        <div class="accordion mb-4" id="accordionBiaya">
                            @foreach($biayaGrouped as $prodiName => $biayaItems)
                                @php
                                    $index = $loop->index;
                                    $totalBiaya = collect($biayaItems)->sum('jumlah');
                                @endphp
                                <div class="accordion-item border-0 shadow-sm mb-3 rounded-3 overflow-hidden">
                                    <h2 class="accordion-header" id="heading{{ $index }}">
                                        <button class="accordion-button {{ $index == 0 ? '' : 'collapsed' }} fw-bold bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="{{ $index == 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $index }}">
                                            S1 {{ $prodiName }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}" aria-labelledby="heading{{ $index }}" data-bs-parent="#accordionBiaya">
                                        <div class="accordion-body p-0">
                                            <table class="table table-hover mb-0">
                                                <tbody>
                                                    @foreach($biayaItems as $item)
                                                    <tr>
                                                        <td class="ps-4 py-3 text-muted">{{ $item->nama_biaya }} {!! $item->keterangan ? '<br><small class="fst-italic text-secondary">'.$item->keterangan.'</small>' : '' !!}</td>
                                                        <td class="pe-4 py-3 text-end fw-medium">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot class="bg-white bg-opacity-50">
                                                    <tr>
                                                        <td class="ps-4 py-3 fw-bold text-primary">Estimasi Total</td>
                                                        <td class="pe-4 py-3 text-end fw-bold text-primary fs-5">Rp {{ number_format($totalBiaya, 0, ',', '.') }}</td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <small class="text-muted fst-italic d-block mt-3">* Keterangan: Rincian biaya di atas adalah estimasi dan dapat berubah sesuai SK Rektor terbaru. Silakan hubungi panitia PMB atau bagian keuangan untuk kepastian biaya dan opsi cicilan.</small>
                    @else
                        <x-frontend.empty-state message="Data biaya pendidikan belum tersedia." icon="fas fa-money-bill-wave" />
                    @endif
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                <!-- Navigasi PMB -->
                <div class="bg-white rounded-4 shadow-sm p-4 mb-4" data-aos="fade-left">
                    <h5 class="fw-bold text-primary mb-4">Menu PMB</h5>
                    <div class="list-group list-group-flush">
                        <a href="{{ route('pmb') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center border-0 mb-2 rounded-3 text-muted">
                            Informasi PMB <i class="fas fa-chevron-right small"></i>
                        </a>
                        <a href="{{ route('jadwal-pmb') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center border-0 mb-2 rounded-3 text-muted">
                            Jadwal Pendaftaran <i class="fas fa-chevron-right small"></i>
                        </a>
                        <a href="{{ route('biaya') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center fw-bold text-primary bg-white rounded-3 mb-2 border-0">
                            Biaya Pendidikan <i class="fas fa-chevron-right small"></i>
                        </a>
                        <a href="{{ route('program-studi') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center border-0 rounded-3 text-muted">
                            Daftar Program Studi <i class="fas fa-chevron-right small"></i>
                        </a>
                    </div>
                </div>

                <!-- Rekening Info -->
                <div class="bg-white rounded-4 shadow-sm p-4 text-center" data-aos="fade-left" data-aos-delay="100">
                    <div class="mb-3 text-primary">
                        <i class="fas fa-university fa-3x"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Informasi Pembayaran</h5>
                    <p class="small text-muted mb-2">Pembayaran hanya dilakukan melalui nomor rekening resmi universitas:</p>
                    <div class="bg-white border p-3 rounded-3 mb-3">
                        <span class="d-block small text-muted mb-1">Bank Mandiri Cabang Cianjur</span>
                        <strong class="fs-5 d-block text-dark font-monospace mb-1">132-00-1234567-8</strong>
                        <span class="small fw-bold">a.n. Universitas Suryakancana</span>
                    </div>
                    <p class="small text-danger fw-bold mb-0"><i class="fas fa-exclamation-triangle me-1"></i> Hati-hati penipuan!</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
