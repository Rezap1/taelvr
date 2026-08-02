<!-- Elvira Virtual Assistant Component -->
<div class="elvira-wrapper">
    <!-- Floating Button -->
    <div class="elvira-floating-btn" id="elvira-floating-btn" data-bs-toggle="offcanvas" data-bs-target="#elviraOffcanvas" aria-controls="elviraOffcanvas">
        <img src="{{ asset('assets/img/elvira.png') }}" alt="Elvira" onerror="this.src='https://ui-avatars.com/api/?name=Elvira&background=F4C542&color=fff&rounded=true'">
    </div>

    <!-- Greeting Bubble -->
    <div class="elvira-greeting-bubble" id="elvira-greeting-bubble">
        <button class="elvira-greeting-close" id="elvira-greeting-close" aria-label="Tutup"><i class="fas fa-times"></i></button>
        <div class="elvira-greeting-content">
            <div id="elvira-dynamic-text" class="mb-2">
                Halo! 👋<br>
                Saya Elvira, asisten virtual Fakultas Teknik Universitas Suryakancana.<br>
                Saya siap membantu Anda.
            </div>
        </div>
    </div>

    <!-- Offcanvas Panel -->
    <div class="offcanvas offcanvas-end elvira-offcanvas" tabindex="-1" id="elviraOffcanvas" aria-labelledby="elviraOffcanvasLabel" data-bs-backdrop="true">
        <!-- Header -->
        <div class="offcanvas-header d-flex justify-content-between align-items-center">
            <div class="elvira-header-profile">
                <img src="{{ asset('assets/img/elvira_avatar.png') }}" alt="Elvira" onerror="this.src='https://ui-avatars.com/api/?name=Elvira&background=fff&color=F4C542&rounded=true'">
                <div class="elvira-header-info">
                    <h5 id="elviraOffcanvasLabel">ELVIRA</h5>
                    <p>Virtual Guide</p>
                </div>
            </div>
            <button type="button" class="elvira-btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <!-- Body -->
        <div class="offcanvas-body elvira-body-layout p-0">
            <!-- Chat Area -->
            <div class="elvira-chat-history p-3" id="elvira-chat-history">
                <!-- Chat messages will be injected here by JS -->
            </div>
        </div>

        <!-- Footer -->
        <div class="offcanvas-footer elvira-offcanvas-footer">
            <button class="btn btn-sm btn-outline-primary rounded-pill elvira-reset-btn" id="elvira-reset-btn">
                <i class="fas fa-home"></i> Mulai Lagi
            </button>
            <div class="elvira-footer-text mt-2">
                Virtual Guide Fakultas Teknik Universitas Suryakancana
            </div>
        </div>
    </div>
</div>

<!-- Elvira Video Modal -->
<div class="modal fade" id="elviraVideoModal" tabindex="-1" aria-labelledby="elviraVideoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-dark border-0">
            <div class="modal-header border-0 text-white">
                <h5 class="modal-title" id="elviraVideoModalLabel">Video Profil Fakultas Teknik</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="ratio ratio-16x9 bg-black">
                    <!-- Actual Video -->
                    <iframe src="https://www.youtube.com/embed/MQV21JxGDrw?rel=0" title="Video Profil Fakultas Teknik" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen id="elvira-video-frame"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
