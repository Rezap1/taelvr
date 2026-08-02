{{-- Frontend Footer --}}
<footer class="footer">
    <div class="container">
        <div class="row g-4">
            {{-- About --}}
            <div class="col-lg-4 col-md-6">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="brand-icon" style="width:40px;height:40px;background:linear-gradient(135deg,var(--color-secondary),var(--color-accent));border-radius:var(--border-radius-sm);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:800;font-size:0.9rem;flex-shrink:0;">FT</div>
                    <div>
                        <h5 class="mb-0" style="padding-bottom:0;">FT UNSUR</h5>
                    </div>
                </div>
                <p>
                    Fakultas Teknik Universitas Suryakancana berkomitmen mencetak lulusan yang kompeten, inovatif,
                    dan berdaya saing tinggi di bidang teknik.
                </p>
                <div class="footer-social mt-3">
                    @if(!empty($settings['social_facebook']))
                        <a href="{{ $settings['social_facebook'] }}" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    @endif
                    @if(!empty($settings['social_instagram']))
                        <a href="{{ $settings['social_instagram'] }}" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    @endif
                    @if(!empty($settings['social_youtube']))
                        <a href="{{ $settings['social_youtube'] }}" target="_blank" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                    @endif
                    @if(!empty($settings['social_linkedin']))
                        <a href="{{ $settings['social_linkedin'] }}" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    @endif
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="col-lg-2 col-md-6">
                <h5>Menu</h5>
                <ul class="list-unstyled footer-links">
                    <li><a href="{{ route('home') }}"><i class="fas fa-chevron-right"></i> Beranda</a></li>
                    <li><a href="{{ route('profil') }}"><i class="fas fa-chevron-right"></i> Profil</a></li>
                    <li><a href="{{ route('program-studi') }}"><i class="fas fa-chevron-right"></i> Program Studi</a></li>
                    <li><a href="{{ route('fasilitas') }}"><i class="fas fa-chevron-right"></i> Fasilitas</a></li>
                    <li><a href="{{ route('prestasi') }}"><i class="fas fa-chevron-right"></i> Prestasi</a></li>
                    <li><a href="{{ route('galeri') }}"><i class="fas fa-chevron-right"></i> Galeri</a></li>
                </ul>
            </div>

            {{-- PMB Links --}}
            <div class="col-lg-2 col-md-6">
                <h5>Informasi</h5>
                <ul class="list-unstyled footer-links">
                    <li><a href="{{ route('pmb') }}"><i class="fas fa-chevron-right"></i> Info PMB</a></li>
                    <li><a href="{{ route('biaya') }}"><i class="fas fa-chevron-right"></i> Biaya</a></li>
                    <li><a href="{{ route('kontak') }}"><i class="fas fa-chevron-right"></i> Kontak</a></li>
                    <li><a href="{{ route('daftar-pmb') }}" target="_blank"><i class="fas fa-chevron-right"></i> Daftar PMB</a></li>
                </ul>
            </div>

            {{-- Contact Info --}}
            <div class="col-lg-4 col-md-6">
                <h5>Kontak</h5>
                <ul class="list-unstyled footer-contact">
                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        <span>{{ $settings['contact_address'] ?? 'Jl. Dr. Muwardi Komplek Pasir Gede Raya, Cianjur 43216' }}</span>
                    </li>
                    <li>
                        <i class="fas fa-phone-alt"></i>
                        <span>{{ $settings['contact_phone'] ?? '(0263) 270106' }}</span>
                    </li>
                    <li>
                        <i class="fas fa-envelope"></i>
                        <span>{{ $settings['contact_email'] ?? 'ft@unsur.ac.id' }}</span>
                    </li>
                    <li>
                        <i class="fas fa-clock"></i>
                        <span>Senin - Jumat: 08.00 - 16.00 WIB</span>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Bottom --}}
        <div class="footer-bottom text-center">
            <p>{!! $settings['footer_copyright'] ?? '&copy; ' . date('Y') . ' Fakultas Teknik Universitas Suryakancana. All rights reserved.' !!}</p>
        </div>
    </div>
</footer>
