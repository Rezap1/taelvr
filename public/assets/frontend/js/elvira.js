document.addEventListener('DOMContentLoaded', function() {
    const elviraBtn = document.getElementById('elvira-floating-btn');
    const greetingBubble = document.getElementById('elvira-greeting-bubble');
    const chatHistory = document.getElementById('elvira-chat-history');
    
    // Page-Aware Greeting Logic
    const currentPath = window.location.pathname.replace(/\/$/, "") || "/";
    const lastPage = sessionStorage.getItem('elvira_last_page');
    
    if (lastPage !== currentPath && greetingBubble) {
        sessionStorage.setItem('elvira_last_page', currentPath);
        
        const pathMappings = {
            '/': { text: "Selamat datang di Website Resmi Fakultas Teknik UNSUR! Ada yang bisa saya bantu hari ini?", btnText: "Mulai Percakapan", nextNode: "node_kenal" },
            '/profil': { text: "Halo! Anda sedang berada di halaman Profil. Di sini Anda dapat melihat sejarah dan visi misi kami.", btnText: "Tanya Profil", nextNode: "node_kenal" },
            '/program-studi': { text: "Anda sedang melihat Program Studi! Kami memiliki beberapa jurusan unggulan yang siap mencetak lulusan berkualitas.", btnText: "Tanya Prodi", nextNode: "node_kenal" },
            '/fasilitas': { text: "Selamat datang di halaman Fasilitas. Kampus kami dilengkapi dengan berbagai laboratorium modern.", btnText: "Tanya Fasilitas", nextNode: "node_kenal" },
            '/prestasi': { text: "Halaman Prestasi! Lihat penghargaan membanggakan yang diraih oleh mahasiswa dan dosen kami.", btnText: "Tanya Prestasi", nextNode: "node_kenal" },
            '/galeri': { text: "Sedang melihat Galeri? Ini adalah dokumentasi berbagai kegiatan seru di lingkungan kampus.", btnText: "Tanya Galeri", nextNode: "node_kenal" },
            '/pmb': { text: "Halaman PMB! Informasi lengkap seputar Pendaftaran Mahasiswa Baru bisa Anda pelajari di sini.", btnText: "Tanya PMB", nextNode: "node_pmb" },
            '/jadwal-pmb': { text: "Sedang mengecek jadwal PMB? Jangan sampai terlewat tanggal-tanggal penting ya!", btnText: "Tanya Jadwal", nextNode: "node_pmb" },
            '/biaya': { text: "Halaman Biaya Pendidikan. Jika ada yang kurang jelas mengenai rincian biaya, tanyakan saja pada saya.", btnText: "Tanya Biaya", nextNode: "node_pmb" },
            '/kontak': { text: "Halaman Kontak! Ingin menghubungi kami atau mengetahui lokasi kampus? Semuanya ada di sini.", btnText: "Tanya Kontak", nextNode: "node_kenal" }
        };

        let pageGreeting = pathMappings[currentPath];
        
        // Fallback for unknown pages
        if (!pageGreeting) {
            pageGreeting = { text: "Halo 👋 Saya Elvira, asisten virtual Fakultas Teknik UNSUR. Ada yang bisa saya bantu?", btnText: "Mulai Percakapan", nextNode: "node_kenal" };
        }

        const dynamicText = document.getElementById('elvira-dynamic-text');

        if (dynamicText) {
            dynamicText.innerHTML = pageGreeting.text;
            
            setTimeout(() => {
                if (!elviraBtn.classList.contains('chat-open')) {
                    greetingBubble.classList.add('show');
                    
                    // Auto hide after 8 seconds
                    setTimeout(() => {
                        if (greetingBubble.classList.contains('show')) {
                            greetingBubble.classList.remove('show');
                        }
                    }, 8000);
                }
            }, 1000); // Show 1s after page load
        }
    }
    
    // Close button for the greeting bubble
    const greetingCloseBtn = document.getElementById('elvira-greeting-close');
    if (greetingCloseBtn && greetingBubble) {
        greetingCloseBtn.addEventListener('click', function() {
            greetingBubble.classList.remove('show');
            sessionStorage.setItem('elvira_greeted', 'true');
        });
    }
    
    // Hide bubble when opening offcanvas
    if (elviraBtn && greetingBubble) {
        elviraBtn.addEventListener('click', function() {
            greetingBubble.classList.remove('show');
            sessionStorage.setItem('elvira_greeted', 'true');
        });
    }

    // Offcanvas Events to move character
    const offcanvasEl = document.getElementById('elviraOffcanvas');
    if (offcanvasEl && elviraBtn) {
        offcanvasEl.addEventListener('show.bs.offcanvas', function () {
            elviraBtn.classList.add('chat-open');
            // Trigger animation on open
            const img = elviraBtn.querySelector('img');
            if (img) {
                img.classList.add('elvira-nod');
                setTimeout(() => img.classList.remove('elvira-nod'), 400);
            }
        });
        offcanvasEl.addEventListener('hide.bs.offcanvas', function () {
            elviraBtn.classList.remove('chat-open');
        });
    }

    // CONVERSATION TREE LOGIC
    const conversationTree = {
        'main': {
            bot: "Halo 👋<br><br>Ada yang bisa saya bantu hari ini?",
            options: [
                { id: 'pmb', text: "🎓 Saya ingin menjadi Mahasiswa Baru", next: 'node_pmb' },
                { id: 'kenal', text: "🏛 Saya ingin mengenal Fakultas Teknik", next: 'node_kenal' },
                { id: 'video', text: "🎥 Saya ingin menonton Video Profil", next: 'node_video' },
                { id: 'kontak', text: "📞 Saya ingin menghubungi Fakultas", next: 'node_kontak' }
            ]
        },
        'node_pmb': {
            user: "🎓 Saya ingin menjadi Mahasiswa Baru",
            bot: "Senang mendengarnya 😊<br><br>Saya akan membantu Anda mendapatkan informasi mengenai PMB.",
            options: [
                { text: "Jalur PMB", link: "/pmb#jalur" },
                { text: "Jadwal PMB", link: "/pmb#jadwal" },
                { text: "Biaya Pendidikan", link: "/pmb#biaya" },
                { text: "Persyaratan", link: "/pmb#syarat" },
                { text: "Daftar Sekarang", link: "/daftar-pmb" },
                { text: "← Kembali", next: 'main' }
            ]
        },
        'node_kenal': {
            user: "🏛 Saya ingin mengenal Fakultas Teknik",
            bot: "Baik 😊<br><br>Silakan pilih informasi yang ingin Anda ketahui.",
            options: [
                { text: "Sejarah", link: "/profil" },
                { text: "Visi & Misi", link: "/profil" },
                { text: "Struktur Organisasi", link: "/profil" },
                { text: "Program Studi", link: "/program-studi" },
                { text: "Fasilitas", link: "/fasilitas" },
                { text: "Prestasi", link: "/prestasi" },
                { text: "Galeri", link: "/galeri" },
                { text: "← Kembali", next: 'main' }
            ]
        },
        'node_video': {
            user: "🎥 Saya ingin menonton Video Profil",
            bot: "Video Profil Fakultas Teknik akan membantu Anda mengenal lingkungan kampus, fasilitas, program studi, dan berbagai aktivitas mahasiswa.",
            options: [
                { text: "▶ Tonton Video", action: "play_video" },
                { text: "← Kembali", next: 'main' }
            ]
        },
        'node_video_after': {
            bot: "Semoga video tadi membantu 😊<br><br>Apakah ada informasi lain yang ingin Anda ketahui?",
            options: [
                { text: "🎓 Mahasiswa Baru", next: 'node_pmb' },
                { text: "🏛 Mengenal Fakultas", next: 'node_kenal' },
                { text: "📞 Hubungi Kami", next: 'node_kontak' }
            ]
        },
        'node_kontak': {
            user: "📞 Saya ingin menghubungi Fakultas",
            bot: "Silakan pilih media komunikasi yang tersedia.",
            options: [
                { text: "WhatsApp", link: "/kontak" },
                { text: "Email", link: "/kontak" },
                { text: "Lokasi", link: "/kontak" },
                { text: "Jam Operasional", link: "/kontak" },
                { text: "Halaman Kontak", link: "/kontak" },
                { text: "← Kembali", next: 'main' }
            ]
        }
    };

    let isTyping = false;

    function scrollToBottom() {
        if (chatHistory) {
            chatHistory.scrollTop = chatHistory.scrollHeight;
        }
    }

    function triggerBlinkAnimation() {
        if(elviraBtn) {
            const img = elviraBtn.querySelector('img');
            if (img) {
                img.classList.remove('elvira-blink');
                void img.offsetWidth; // trigger reflow
                img.classList.add('elvira-blink');
            }
        }
    }

    function renderBotOptions(options) {
        if (!options || options.length === 0) return '';
        let html = '<div class="elvira-action-list">';
        options.forEach(opt => {
            if (opt.link) {
                html += `<a href="${opt.link}" class="elvira-action-btn">${opt.text} <i class="fas fa-arrow-right"></i></a>`;
            } else if (opt.action === 'play_video') {
                html += `<button class="elvira-action-btn elvira-play-video-btn">${opt.text} <i class="fas fa-play"></i></button>`;
            } else if (opt.next) {
                html += `<button class="elvira-action-btn elvira-node-btn" data-next="${opt.next}">${opt.text} <i class="fas fa-chevron-right"></i></button>`;
            }
        });
        html += '</div>';
        return html;
    }

    function appendUserMessage(text) {
        const msgDiv = document.createElement('div');
        msgDiv.className = 'elvira-message user';
        msgDiv.innerHTML = `<div class="elvira-bubble">${text}</div>`;
        chatHistory.appendChild(msgDiv);
        scrollToBottom();
    }

    function appendBotMessage(text, options = []) {
        const msgDiv = document.createElement('div');
        msgDiv.className = 'elvira-message bot';
        
        let html = `<div class="elvira-bubble">${text}</div>`;
        html += renderBotOptions(options);
        
        msgDiv.innerHTML = html;
        chatHistory.appendChild(msgDiv);
        scrollToBottom();
        
        // Attach event listeners to newly created buttons
        const nodeBtns = msgDiv.querySelectorAll('.elvira-node-btn');
        nodeBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                if (isTyping) return;
                const nextNode = this.getAttribute('data-next');
                if (nextNode) loadNode(nextNode);
            });
        });

        const videoBtn = msgDiv.querySelector('.elvira-play-video-btn');
        if (videoBtn) {
            videoBtn.addEventListener('click', function() {
                if (isTyping) return;
                const videoModal = new bootstrap.Modal(document.getElementById('elviraVideoModal'));
                videoModal.show();
                
                // Add event listener when modal is hidden to show after_video message and stop video
                document.getElementById('elviraVideoModal').addEventListener('hidden.bs.modal', function () {
                    // Stop video playing in background
                    const iframe = document.getElementById('elvira-video-frame');
                    if (iframe) {
                        const iframeSrc = iframe.src;
                        iframe.src = iframeSrc; 
                    }

                    // Only load it once to prevent spam if they open/close multiple times
                    if (!chatHistory.querySelector('.elvira-video-after-msg')) {
                        setTimeout(() => loadNode('node_video_after', true), 500);
                    }
                }, { once: true });
            });
        }
    }

    function showTypingIndicator() {
        isTyping = true;
        const typingDiv = document.createElement('div');
        typingDiv.className = 'elvira-message bot elvira-typing-indicator';
        typingDiv.id = 'elvira-typing-indicator';
        typingDiv.innerHTML = `
            <div class="typing-indicator">
                <div class="typing-dot"></div>
                <div class="typing-dot"></div>
                <div class="typing-dot"></div>
            </div>
        `;
        chatHistory.appendChild(typingDiv);
        scrollToBottom();
        triggerBlinkAnimation();
    }

    function removeTypingIndicator() {
        const indicator = document.getElementById('elvira-typing-indicator');
        if (indicator) {
            indicator.remove();
        }
        isTyping = false;
    }

    function loadNode(nodeId, skipUser = false) {
        if (!conversationTree[nodeId]) return;
        
        const node = conversationTree[nodeId];
        
        // If node has a user message, append it (unless skipping, like for auto-messages)
        if (node.user && !skipUser) {
            appendUserMessage(node.user);
        }

        // Show typing indicator
        showTypingIndicator();

        // Delay 600-800ms
        const delay = Math.floor(Math.random() * 200) + 600;
        
        setTimeout(() => {
            removeTypingIndicator();
            if (nodeId === 'node_video_after') {
                // Add a special class so we don't duplicate it
                appendBotMessage(node.bot, node.options);
                chatHistory.lastElementChild.classList.add('elvira-video-after-msg');
            } else {
                appendBotMessage(node.bot, node.options);
            }
        }, delay);
    }

    // Initialize chat
    if (chatHistory) {
        // Clear history
        chatHistory.innerHTML = '';
        // Load main node instantly on first open
        appendBotMessage(conversationTree['main'].bot, conversationTree['main'].options);
    }

    // Reset Chat logic
    const resetBtn = document.getElementById('elvira-reset-btn');
    if (resetBtn && chatHistory) {
        resetBtn.addEventListener('click', function() {
            chatHistory.innerHTML = '';
            appendBotMessage(conversationTree['main'].bot, conversationTree['main'].options);
        });
    }

    // Context-Aware Scrolling Logic (Only on Home Page)
    if (window.location.pathname === '/' || window.location.pathname === '/index.php' || window.location.pathname === '') {
        const contextualMessages = {
            'section-profil': {
                text: "Wah, Anda sedang melihat profil Fakultas Teknik! Ingin mengenal lebih dekat pimpinan dan visi misi kami?",
                btnText: "Lihat Profil Lengkap",
                action: "document.getElementById('elvira-floating-btn').click(); setTimeout(()=>document.querySelector('.elvira-node-btn[data-next=\"node_kenal\"]').click(), 500); return false;"
            },
            'section-keunggulan': {
                text: "Penasaran mengapa Fakultas Teknik UNSUR adalah pilihan terbaik? Anda bisa bertanya langsung kepada saya!",
                btnText: "Mulai Percakapan",
                action: "document.getElementById('elvira-floating-btn').click(); return false;"
            },
            'section-prodi': {
                text: "Sedang mempertimbangkan program studi? Temukan jurusan yang paling pas untuk masa depan Anda di sini.",
                btnText: "Jelajahi Program Studi",
                action: "document.getElementById('elvira-floating-btn').click(); setTimeout(()=>document.querySelector('.elvira-node-btn[data-next=\"node_kenal\"]').click(), 500); return false;"
            },
            'section-fasilitas': {
                text: "Fakultas Teknik dilengkapi dengan berbagai fasilitas modern untuk menunjang perkuliahan lho!",
                btnText: "Lihat Fasilitas",
                action: "document.getElementById('elvira-floating-btn').click(); setTimeout(()=>document.querySelector('.elvira-node-btn[data-next=\"node_kenal\"]').click(), 500); return false;"
            },
            'section-prestasi': {
                text: "Mahasiswa kami telah meraih banyak prestasi! Anda bisa menjadi salah satu dari mereka.",
                btnText: "Lihat Prestasi",
                action: "document.getElementById('elvira-floating-btn').click(); setTimeout(()=>document.querySelector('.elvira-node-btn[data-next=\"node_kenal\"]').click(), 500); return false;"
            },
            'section-pmb': {
                text: "Tertarik untuk mendaftar? Jangan lewatkan informasi penting mengenai pendaftaran mahasiswa baru.",
                btnText: "Info PMB",
                action: "document.getElementById('elvira-floating-btn').click(); setTimeout(()=>document.querySelector('.elvira-node-btn[data-next=\"node_pmb\"]').click(), 500); return false;"
            }
        };

        let scrollTimeout;
        const observer = new IntersectionObserver((entries) => {
            if (!sessionStorage.getItem('elvira_greeted') || elviraBtn.classList.contains('chat-open')) return;

            entries.forEach(entry => {
                if (entry.isIntersecting && contextualMessages[entry.target.id]) {
                    clearTimeout(scrollTimeout);
                    scrollTimeout = setTimeout(() => {
                        if (elviraBtn.classList.contains('chat-open')) return;
                        
                        const msgData = contextualMessages[entry.target.id];
                        const dynamicText = document.getElementById('elvira-dynamic-text');
                        
                        if (dynamicText) {
                            dynamicText.innerHTML = msgData.text;
                            
                            greetingBubble.classList.add('show');
                            
                            setTimeout(() => {
                                if (greetingBubble.classList.contains('show')) {
                                    greetingBubble.classList.remove('show');
                                }
                            }, 8000);
                        }
                    }, 1500);
                }
            });
        }, { threshold: 0.55 });

        Object.keys(contextualMessages).forEach(id => {
            const section = document.getElementById(id);
            if (section) observer.observe(section);
        });
    }
});
