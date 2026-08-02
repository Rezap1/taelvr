@extends('layouts.frontend')

@section('title', 'Jadwal PMB - Fakultas Teknik Universitas Suryakancana')
@section('meta_description', 'Jadwal lengkap pendaftaran mahasiswa baru Fakultas Teknik Universitas Suryakancana.')

@section('content')
{{-- Page Header --}}
<x-frontend.breadcrumb 
    title="Jadwal Pendaftaran" 
    :breadcrumbs="['PMB' => route('pmb'), 'Jadwal PMB' => '#']" 
/>

{{-- Content Section --}}
<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="row g-5">
            {{-- Main Content --}}
            <div class="col-lg-8">
                <div class="bg-white rounded-4 shadow-sm p-4 p-md-5 mb-5" data-aos="fade-up">
                    <h3 class="fw-bold text-primary mb-4 border-bottom pb-3">Agenda & Jadwal Kegiatan PMB</h3>
                    <p class="text-muted mb-4" style="line-height: 1.8;">
                        Pastikan Anda memperhatikan jadwal kegiatan Penerimaan Mahasiswa Baru dengan saksama. Keterlambatan mengikuti proses pendaftaran atau seleksi dapat mengakibatkan gugurnya status kepesertaan.
                    </p>

                    @if($jadwal->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered align-middle border-light">
                                <thead class="bg-white">
                                    <tr>
                                        <th scope="col" class="py-3 text-center text-primary" style="width: 5%;">No</th>
                                        <th scope="col" class="py-3 text-primary" style="width: 45%;">Kegiatan</th>
                                        <th scope="col" class="py-3 text-primary">Tanggal Pelaksanaan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($jadwal as $index => $item)
                                        @php
                                            $isActive = $item->is_active;
                                        @endphp
                                        <tr class="{{ $isActive ? 'table-primary bg-opacity-10 border-primary border-opacity-50' : '' }}">
                                            <td class="text-center fw-bold {{ $isActive ? 'text-primary' : 'text-muted' }}">{{ $index + 1 }}</td>
                                            <td class="{{ $isActive ? 'fw-bold text-primary' : 'fw-medium' }}">{{ $item->nama_kegiatan }}</td>
                                            <td class="{{ $isActive ? 'fw-bold text-primary' : 'text-muted' }}">
                                                <i class="fas fa-calendar-day me-2 {{ $isActive ? 'text-primary' : 'text-warning' }}"></i> 
                                                {{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d F Y') }} 
                                                @if($item->tanggal_selesai)
                                                    - {{ \Carbon\Carbon::parse($item->tanggal_selesai)->translatedFormat('d F Y') }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <small class="text-muted fst-italic mt-2 d-block">* Jadwal sewaktu-waktu dapat berubah sesuai dengan kebijakan panitia PMB Universitas.</small>
                    @else
                        <x-frontend.empty-state message="Belum ada jadwal pendaftaran yang tersedia saat ini." icon="fas fa-calendar-times" />
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
                        <a href="{{ route('jadwal-pmb') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center fw-bold text-primary bg-white rounded-3 mb-2 border-0">
                            Jadwal Pendaftaran <i class="fas fa-chevron-right small"></i>
                        </a>
                        <a href="{{ route('biaya') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center border-0 mb-2 rounded-3 text-muted">
                            Biaya Pendidikan <i class="fas fa-chevron-right small"></i>
                        </a>
                        <a href="{{ route('program-studi') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center border-0 rounded-3 text-muted">
                            Daftar Program Studi <i class="fas fa-chevron-right small"></i>
                        </a>
                    </div>
                </div>

                <!-- CTA Pendaftaran -->
                <div class="bg-primary text-white rounded-4 shadow p-4 text-center" data-aos="fade-left" data-aos-delay="100">
                    <h5 class="fw-bold mb-3">Siap Mendaftar?</h5>
                    <p class="small text-white-50 mb-4">Pendaftaran dapat dilakukan secara online melalui portal resmi PMB UNSUR.</p>
                    <a href="{{ route('daftar-pmb') }}" target="_blank" class="btn btn-light text-primary fw-bold rounded-pill w-100 py-2 shadow-sm">Portal PMB Online <i class="fas fa-external-link-alt ms-2"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
