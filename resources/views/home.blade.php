<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Rental Kendaraan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --cream: #faf8f5;
            --paper: #f3f0ea;
            --sand: #e8e3d8;
            --tan: #c9bfa8;
            --bark: #7a6e5f;
            --ink: #1a1916;
            --ink2: #3d3930;
            --ink3: #6b6358;
            --rust: #c05c2e;
            --rust-light: #f5ede7;
            --white: #ffffff;
            --r: 12px;
            --r2: 20px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--cream);
            color: var(--ink);
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }

        .wrap { max-width: 1120px; margin: 0 auto; padding: 0 28px; }

        /* ── NAV ── */
        nav {
            padding: 20px 0;
            border-bottom: 1px solid var(--sand);
            background: var(--cream);
            position: sticky; top: 0; z-index: 50;
        }

        .nav-inner {
            display: flex; align-items: center; justify-content: space-between;
        }

        .logo-row { display: flex; align-items: center; gap: 10px; }

        .logo-badge {
            background: var(--ink);
            color: var(--cream);
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.04em;
            padding: 6px 11px;
            border-radius: 6px;
        }

        .logo-name {
            font-family: 'Instrument Serif', serif;
            font-size: 19px;
            color: var(--ink);
        }

        .btn-nav {
            font-size: 13px;
            font-weight: 500;
            color: var(--ink);
            text-decoration: none;
            border: 1px solid var(--sand);
            border-radius: var(--r);
            padding: 9px 20px;
            background: var(--white);
            transition: border-color .15s, background .15s;
        }

        .btn-nav:hover { border-color: var(--tan); background: var(--paper); }

        /* ── HERO ── */
        .hero {
            padding: 80px 0 64px;
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 48px;
            align-items: center;
            border-bottom: 1px solid var(--sand);
        }

        @media (max-width: 820px) { .hero { grid-template-columns: 1fr; padding: 52px 0 48px; gap: 36px; } }

        .hero-tag {
            display: inline-flex; align-items: center; gap: 7px;
            background: var(--rust-light);
            color: var(--rust);
            font-size: 11px; font-weight: 600;
            letter-spacing: 0.12em; text-transform: uppercase;
            padding: 5px 12px 5px 8px;
            border-radius: 999px;
            margin-bottom: 24px;
        }

        .hero-tag span {
            width: 6px; height: 6px; border-radius: 50%; background: var(--rust);
        }

        .hero-title {
            font-family: 'Instrument Serif', serif;
            font-size: clamp(44px, 6.5vw, 76px);
            line-height: 1.05;
            color: var(--ink);
            letter-spacing: -0.02em;
        }

        .hero-title em {
            font-style: italic;
            color: var(--rust);
        }

        .hero-desc {
            margin-top: 20px;
            font-size: 15px;
            line-height: 1.8;
            color: var(--ink3);
            max-width: 460px;
            font-weight: 400;
        }

        /* ── HERO CARD ── */
        .hero-card {
            background: var(--white);
            border: 1px solid var(--sand);
            border-radius: var(--r2);
            overflow: hidden;
        }

        .hc-top {
            background: var(--ink);
            padding: 20px 24px;
            display: flex; align-items: center; justify-content: space-between;
        }

        .hc-top-label {
            font-size: 11px; font-weight: 500; letter-spacing: 0.12em;
            text-transform: uppercase; color: rgba(255,255,255,.5);
        }

        .hc-dot {
            width: 8px; height: 8px; border-radius: 50%;
            background: #4ade80;
            box-shadow: 0 0 6px #4ade80;
        }

        .hc-row {
            display: flex; align-items: flex-start; gap: 14px;
            padding: 17px 24px;
            border-bottom: 1px solid var(--sand);
        }

        .hc-row:last-child { border-bottom: none; }

        .hc-icon {
            width: 34px; height: 34px; border-radius: 8px;
            background: var(--paper);
            display: flex; align-items: center; justify-content: center;
            font-size: 15px; flex-shrink: 0;
        }

        .hc-label { font-size: 10px; font-weight: 600; letter-spacing: .14em; text-transform: uppercase; color: var(--ink3); }
        .hc-val   { font-size: 13px; font-weight: 500; color: var(--ink); margin-top: 3px; line-height: 1.4; }

        /* ── SECTION LABEL ── */
        .sec-label { font-size: 11px; font-weight: 600; letter-spacing: .18em; text-transform: uppercase; color: var(--rust); }

        .sec-title {
            font-family: 'Instrument Serif', serif;
            font-size: clamp(30px, 4vw, 46px);
            color: var(--ink);
            letter-spacing: -0.02em;
            margin-top: 8px;
        }

        /* ── VEHICLES ── */
        .vehicles-section { padding: 64px 0 72px; }

        .vehicles-header {
            display: flex; align-items: flex-end; justify-content: space-between;
            margin-bottom: 32px;
        }

        /* carousel nav buttons */
        .carousel-nav {
            display: flex; align-items: center; gap: 8px;
        }

        .c-btn {
            width: 38px; height: 38px;
            border: 1px solid var(--sand);
            border-radius: 50%;
            background: var(--white);
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            transition: background .15s, border-color .15s;
            flex-shrink: 0;
        }

        .c-btn:hover { background: var(--paper); border-color: var(--tan); }
        .c-btn:disabled { opacity: .35; cursor: default; }

        .c-btn svg { width: 16px; height: 16px; stroke: var(--ink2); stroke-width: 2; fill: none; stroke-linecap: round; stroke-linejoin: round; }

        /* dots */
        .carousel-dots {
            display: flex; align-items: center; gap: 5px; margin-top: 20px;
        }

        .c-dot {
            width: 6px; height: 6px; border-radius: 50%;
            background: var(--sand); cursor: pointer;
            transition: background .2s, transform .2s;
            border: none; padding: 0;
        }

        .c-dot.active { background: var(--rust); transform: scale(1.3); }

        /* strip */
        .cars-viewport {
            overflow: hidden;
            border-radius: var(--r2);
        }

        .cars-strip {
            display: flex; gap: 16px;
            transition: transform .4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            will-change: transform;
        }

        /* ── VEHICLE CARD ── */
        .v-card {
            flex-shrink: 0; width: 252px;
            background: var(--white);
            border: 1px solid var(--sand);
            border-radius: var(--r2);
            overflow: hidden;
            scroll-snap-align: start;
            cursor: pointer;
            transition: transform .2s, box-shadow .2s, border-color .2s;
        }

        .v-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 48px rgba(26,25,22,.08);
            border-color: var(--tan);
        }

        .v-img {
            aspect-ratio: 1;
            background: var(--paper);
            display: flex; align-items: center; justify-content: center;
            position: relative; overflow: hidden;
        }

        .v-img img {
            width: 100%; height: 100%;
            object-fit: contain; padding: 20px;
            transition: transform .35s;
        }

        .v-card:hover .v-img img { transform: scale(1.05); }

        .v-badge {
            position: absolute; top: 12px; left: 12px;
            font-size: 9px; font-weight: 600; letter-spacing: .14em; text-transform: uppercase;
            background: var(--ink); color: var(--cream);
            padding: 4px 9px; border-radius: 5px;
        }

        .v-body { padding: 18px 20px 20px; }

        .v-name {
            font-family: 'Instrument Serif', serif;
            font-size: 20px; color: var(--ink);
            line-height: 1.2; letter-spacing: -0.01em;
        }

        .v-desc {
            font-size: 12px; color: var(--ink3); line-height: 1.65; margin-top: 6px;
            display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
        }

        .v-bottom {
            display: flex; align-items: center; justify-content: space-between;
            margin-top: 16px; padding-top: 14px; border-top: 1px solid var(--sand);
        }

        .v-price-num {
            font-size: 16px; font-weight: 600; color: var(--ink);
        }

        .v-price-per { font-size: 11px; color: var(--ink3); font-weight: 400; }

        .v-cta {
            font-size: 11px; font-weight: 600; letter-spacing: .1em; text-transform: uppercase;
            color: var(--rust); background: var(--rust-light);
            padding: 7px 13px; border-radius: 8px;
            border: none;
            transition: background .15s;
            pointer-events: none;
        }

        .v-card:hover .v-cta { background: #eedad3; }

        .v-empty {
            flex-shrink: 0; width: 260px; padding: 48px 32px;
            border: 1px dashed var(--sand); border-radius: var(--r2);
            font-size: 13px; color: var(--ink3); text-align: center;
        }

        /* ── KONTAK ── */
        .contact-section {
            border-top: 1px solid var(--sand); padding: 72px 0 80px;
        }

        .contact-grid {
            display: grid; grid-template-columns: 1fr 1fr;
            gap: 64px; margin-top: 40px; align-items: start;
        }

        @media (max-width: 720px) { .contact-grid { grid-template-columns: 1fr; gap: 40px; } }

        .c-list { display: flex; flex-direction: column; gap: 0; margin-top: 4px; }

        .c-item {
            display: flex; gap: 16px; padding: 15px 0;
            border-bottom: 1px solid var(--sand);
        }

        .c-item:first-child { border-top: 1px solid var(--sand); }

        .c-item-label {
            font-size: 11px; font-weight: 600; letter-spacing: .14em; text-transform: uppercase;
            color: var(--ink3); min-width: 96px; padding-top: 1px;
        }

        .c-item-val { font-size: 14px; color: var(--ink); line-height: 1.6; }

        .wa-block {
            background: var(--ink);
            border-radius: var(--r2);
            padding: 36px 32px;
            display: flex; flex-direction: column; gap: 20px;
        }

        .wa-title {
            font-family: 'Instrument Serif', serif;
            font-size: 26px; color: var(--white);
            line-height: 1.2; letter-spacing: -0.01em;
        }

        .wa-subtitle {
            font-size: 13px; color: rgba(255,255,255,.55); line-height: 1.7; margin-top: -8px;
        }

        .wa-btn {
            display: inline-flex; align-items: center; gap: 10px;
            background: #25d366; color: var(--white);
            font-size: 13px; font-weight: 600;
            padding: 13px 22px; border-radius: var(--r);
            text-decoration: none;
            transition: filter .15s, transform .15s;
            align-self: flex-start;
        }

        .wa-btn:hover { filter: brightness(1.1); transform: translateY(-1px); }

        .wa-btn svg { width: 18px; height: 18px; fill: var(--white); flex-shrink: 0; }

        /* ── FOOTER ── */
        footer {
            border-top: 1px solid var(--sand);
            padding: 22px 0;
            display: flex; align-items: center; justify-content: space-between;
            flex-wrap: wrap; gap: 8px;
        }

        .footer-txt { font-size: 12px; color: var(--ink3); }

        /* ── MODAL ── */
        #vehicle-modal {
            position: fixed; inset: 0; z-index: 200;
            background: rgba(26,25,22,.6);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            display: none; align-items: center; justify-content: center;
            padding: 20px;
        }

        #vehicle-modal.open { display: flex; }

        .modal-box {
            background: var(--white);
            border: 1px solid var(--sand);
            border-radius: var(--r2);
            width: 100%; max-width: 820px;
            overflow: hidden; max-height: 90vh;
            display: grid; grid-template-rows: auto 1fr;
        }

        .modal-head {
            display: flex; align-items: center; justify-content: space-between;
            padding: 20px 28px; border-bottom: 1px solid var(--sand);
        }

        .modal-eyebrow { font-size: 10px; font-weight: 600; letter-spacing: .2em; text-transform: uppercase; color: var(--rust); }

        #vehicle-modal-name {
            font-family: 'Instrument Serif', serif;
            font-size: 26px; color: var(--ink); margin-top: 3px; letter-spacing: -0.01em;
        }

        #vehicle-modal-close {
            font-family: 'Inter', sans-serif;
            font-size: 12px; font-weight: 500;
            color: var(--ink3); background: var(--paper);
            border: 1px solid var(--sand); border-radius: 8px;
            padding: 8px 16px; cursor: pointer;
            transition: background .15s;
        }

        #vehicle-modal-close:hover { background: var(--sand); }

        .modal-body {
            display: grid; grid-template-columns: 1fr 1fr;
            overflow: auto;
        }

        @media (max-width: 560px) { .modal-body { grid-template-columns: 1fr; } }

        .modal-img {
            background: var(--paper);
            display: flex; align-items: center; justify-content: center;
            padding: 36px; min-height: 240px;
            border-right: 1px solid var(--sand);
        }

        .modal-img img { max-width: 100%; max-height: 260px; object-fit: contain; }

        #vehicle-modal-placeholder { font-size: 4.5rem; }

        .modal-details { padding: 32px 28px; display: flex; flex-direction: column; gap: 24px; }

        .modal-field label {
            font-size: 10px; font-weight: 600; letter-spacing: .2em; text-transform: uppercase;
            color: var(--ink3); display: block; margin-bottom: 7px;
        }

        .modal-field p { font-size: 14px; color: var(--ink); line-height: 1.75; }

        #vehicle-modal-price {
            font-family: 'Instrument Serif', serif;
            font-size: 30px; color: var(--ink); letter-spacing: -0.01em;
        }
    </style>
</head>
<body>

    <nav>
        <div class="wrap nav-inner">
            <div class="logo-row">
                <div class="logo-badge">RK</div>
                <div class="logo-name">Rental Kendaraan</div>
            </div>
            <a href="{{ route('login') }}" class="btn-nav">Masuk</a>
        </div>
    </nav>

    <div class="wrap">

        <!-- HERO -->
        <section class="hero">
            <div>
                <div class="hero-tag"><span></span>{{ $settings['hero_badge'] }}</div>
                <h1 class="hero-title">
                    Kendaraan<br>
                    <em>Terbaik</em> untuk<br>
                    Perjalananmu
                </h1>
                <p class="hero-desc">{{ $settings['hero_description'] }}</p>
            </div>

            <div class="hero-card">
                <div class="hc-top">
                    <span class="hc-top-label">Info Layanan</span>
                    <div class="hc-dot"></div>
                </div>
                <div class="hc-row">
                    <div class="hc-icon">🏍️</div>
                    <div>
                        <div class="hc-label">Layanan</div>
                        <div class="hc-val">Rental Motor &amp; Mobil</div>
                    </div>
                </div>
                <div class="hc-row">
                    <div class="hc-icon">📍</div>
                    <div>
                        <div class="hc-label">Alamat</div>
                        <div class="hc-val">{{ $settings['contact_address'] }}</div>
                    </div>
                </div>
                <div class="hc-row">
                    <div class="hc-icon">🕐</div>
                    <div>
                        <div class="hc-label">Jam Operasional</div>
                        <div class="hc-val">{{ $settings['contact_hours'] }}</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- VEHICLES -->
        <section class="vehicles-section" id="kendaraan">
            <div class="vehicles-header">
                <div>
                    <div class="sec-label">{{ $settings['vehicles_badge'] }}</div>
                    <h2 class="sec-title">{{ $settings['vehicles_title'] }}</h2>
                </div>
                <div class="carousel-nav">
                    <button class="c-btn" id="car-prev" aria-label="Sebelumnya" disabled>
                        <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
                    </button>
                    <button class="c-btn" id="car-next" aria-label="Berikutnya">
                        <svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
                    </button>
                </div>
            </div>

            <div class="cars-viewport">
                <div class="cars-strip" id="cars-strip">
                    @forelse($vehicles as $vehicle)
                        <article class="v-card vehicle-preview-btn"
                            data-vehicle-name="{{ $vehicle->nama }}"
                            data-vehicle-type="{{ ucfirst($vehicle->tipe) }}"
                            data-vehicle-price="Rp {{ number_format($vehicle->harga_per_hari, 0, ',', '.') }} / hari"
                            data-vehicle-description="{{ $vehicle->keterangan ?: 'Kendaraan tersedia di sistem dan siap dipakai untuk proses rental.' }}"
                            data-vehicle-image="{{ $vehicle->gambar_url }}"
                        >
                            <div class="v-img">
                                @if($vehicle->gambar_url)
                                    <img src="{{ $vehicle->gambar_url }}" alt="{{ $vehicle->nama }}">
                                @else
                                    <span style="font-size:3rem;">🚗</span>
                                @endif
                                <span class="v-badge">{{ $vehicle->tipe }}</span>
                            </div>
                            <div class="v-body">
                                <div class="v-name">{{ $vehicle->nama }}</div>
                                <div class="v-desc">{{ $vehicle->keterangan ?: 'Kendaraan tersedia dan siap dipakai untuk proses rental.' }}</div>
                                <div class="v-bottom">
                                    <div>
                                        <span class="v-price-num">Rp {{ number_format($vehicle->harga_per_hari, 0, ',', '.') }}</span>
                                        <span class="v-price-per"> / hari</span>
                                    </div>
                                    <div class="v-cta">Detail</div>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="v-empty">Belum ada kendaraan tersedia.</div>
                    @endforelse
                </div>
            </div>

            <div class="carousel-dots" id="carousel-dots"></div>
        </section>

        <!-- KONTAK -->
        <section class="contact-section">
            <div class="sec-label">{{ $settings['contact_badge'] }}</div>
            <h2 class="sec-title">{{ $settings['contact_title'] }}</h2>

            <div class="contact-grid">
                <div class="c-list">
                    <div class="c-item">
                        <span class="c-item-label">Alamat</span>
                        <span class="c-item-val">{{ $settings['contact_address'] }}</span>
                    </div>
                    <div class="c-item">
                        <span class="c-item-label">WhatsApp</span>
                        <span class="c-item-val">{{ $settings['contact_whatsapp'] }}</span>
                    </div>
                    <div class="c-item">
                        <span class="c-item-label">Operasional</span>
                        <span class="c-item-val">{{ $settings['contact_hours'] }}</span>
                    </div>
                </div>

                <div class="wa-block">
                    <div>
                        <div class="wa-title">Hubungi Kami Sekarang</div>
                        <div class="wa-subtitle">Respon cepat melalui WhatsApp, siap membantu kebutuhan rental kamu.</div>
                    </div>
                    @php
                        $whatsappNumber = preg_replace('/[^0-9]/', '', $settings['contact_whatsapp']);
                        $whatsappNumber = ltrim($whatsappNumber, '0');
                    @endphp
                    <a href="https://wa.me/62{{ $whatsappNumber }}" target="_blank" rel="noreferrer" class="wa-btn">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347zM12 2C6.477 2 2 6.477 2 12c0 1.89.525 3.66 1.438 5.168L2 22l4.975-1.301A9.956 9.956 0 0012 22c5.523 0 10-4.477 10-10S17.523 2 12 2zm0 18.182a8.18 8.18 0 01-4.164-1.13l-.3-.177-3.1.812.826-3.017-.196-.311A8.143 8.143 0 013.818 12C3.818 7.476 7.476 3.818 12 3.818c4.523 0 8.182 3.658 8.182 8.182 0 4.523-3.659 8.182-8.183 8.182z"/></svg>
                        Chat WhatsApp
                    </a>
                </div>
            </div>
        </section>

    </div>

    <footer>
        <div class="wrap" style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px;width:100%;">
            <span class="footer-txt">{{ $settings['footer_left'] }}</span>
            <span class="footer-txt">{{ $settings['footer_right'] }}</span>
        </div>
    </footer>

    <!-- MODAL -->
    <div id="vehicle-modal">
        <div class="modal-box">
            <div class="modal-head">
                <div>
                    <div class="modal-eyebrow">Detail Kendaraan</div>
                    <h4 id="vehicle-modal-name">Nama Kendaraan</h4>
                </div>
                <button type="button" id="vehicle-modal-close">Tutup</button>
            </div>
            <div class="modal-body">
                <div class="modal-img">
                    <img id="vehicle-modal-image" src="" alt="Detail kendaraan" style="display:none;">
                    <div id="vehicle-modal-placeholder">🚗</div>
                </div>
                <div class="modal-details">
                    <div class="modal-field">
                        <label>Tipe</label>
                        <p id="vehicle-modal-type">Motor</p>
                    </div>
                    <div class="modal-field">
                        <label>Harga</label>
                        <p id="vehicle-modal-price">Rp 0 / hari</p>
                    </div>
                    <div class="modal-field">
                        <label>Keterangan</label>
                        <p id="vehicle-modal-description">Keterangan kendaraan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    (() => {
        /* ── CAROUSEL ── */
        const strip = document.getElementById('cars-strip');
        const prevBtn = document.getElementById('car-prev');
        const nextBtn = document.getElementById('car-next');
        const dotsWrap = document.getElementById('carousel-dots');

        if (strip && strip.children.length) {
            const cards = Array.from(strip.children);
            const GAP = 16;
            let current = 0;
            let visibleCount = 1;

            const getCardW = () => cards[0] ? cards[0].offsetWidth : 252;

            const calcVisible = () => {
                const vw = strip.parentElement.offsetWidth;
                const cw = getCardW();
                visibleCount = Math.max(1, Math.floor((vw + GAP) / (cw + GAP)));
            };

            const totalSlides = () => Math.max(1, cards.length - visibleCount + 1);

            /* build dots */
            const buildDots = () => {
                dotsWrap.innerHTML = '';
                const n = totalSlides();
                for (let i = 0; i < n; i++) {
                    const d = document.createElement('button');
                    d.className = 'c-dot' + (i === current ? ' active' : '');
                    d.setAttribute('aria-label', 'Slide ' + (i + 1));
                    d.addEventListener('click', () => goTo(i));
                    dotsWrap.appendChild(d);
                }
            };

            const updateDots = () => {
                Array.from(dotsWrap.children).forEach((d, i) => {
                    d.classList.toggle('active', i === current);
                });
            };

            const goTo = (idx) => {
                const max = totalSlides() - 1;
                current = Math.max(0, Math.min(idx, max));
                const offset = current * (getCardW() + GAP);
                strip.style.transform = 'translateX(-' + offset + 'px)';
                prevBtn.disabled = current === 0;
                nextBtn.disabled = current >= max;
                updateDots();
            };

            prevBtn.addEventListener('click', () => goTo(current - 1));
            nextBtn.addEventListener('click', () => goTo(current + 1));

            /* touch/swipe */
            let touchX = 0;
            strip.addEventListener('touchstart', e => { touchX = e.touches[0].clientX; }, { passive: true });
            strip.addEventListener('touchend', e => {
                const dx = touchX - e.changedTouches[0].clientX;
                if (Math.abs(dx) > 40) goTo(current + (dx > 0 ? 1 : -1));
            }, { passive: true });

            const init = () => {
                calcVisible();
                current = Math.min(current, totalSlides() - 1);
                buildDots();
                goTo(current);
            };

            init();
            window.addEventListener('resize', init);

            /* ── AUTO-PLAY ── */
            let timer = null;

            const startAuto = () => {
                stopAuto();
                timer = setInterval(() => {
                    const next = current + 1 >= totalSlides() ? 0 : current + 1;
                    goTo(next);
                }, 3500);
            };

            const stopAuto = () => clearInterval(timer);

            startAuto();

            strip.parentElement.addEventListener('mouseenter', stopAuto);
            strip.parentElement.addEventListener('mouseleave', startAuto);
            prevBtn.addEventListener('click', () => { stopAuto(); startAuto(); });
            nextBtn.addEventListener('click', () => { stopAuto(); startAuto(); });
            strip.addEventListener('touchstart', stopAuto, { passive: true });
            strip.addEventListener('touchend', () => startAuto(), { passive: true });
        }

        /* ── MODAL ── */
        const modal = document.getElementById('vehicle-modal');
        const modalClose = document.getElementById('vehicle-modal-close');
        const modalImage = document.getElementById('vehicle-modal-image');
        const modalPlaceholder = document.getElementById('vehicle-modal-placeholder');
        const modalName = document.getElementById('vehicle-modal-name');
        const modalType = document.getElementById('vehicle-modal-type');
        const modalPrice = document.getElementById('vehicle-modal-price');
        const modalDescription = document.getElementById('vehicle-modal-description');

        const openModal = (button) => {
            modalName.textContent = button.dataset.vehicleName || 'Detail Kendaraan';
            modalType.textContent = button.dataset.vehicleType || '-';
            modalPrice.textContent = button.dataset.vehiclePrice || '-';
            modalDescription.textContent = button.dataset.vehicleDescription || '-';
            const image = button.dataset.vehicleImage || '';
            if (image) {
                modalImage.src = image;
                modalImage.style.display = 'block';
                modalPlaceholder.style.display = 'none';
            } else {
                modalImage.src = '';
                modalImage.style.display = 'none';
                modalPlaceholder.style.display = 'block';
            }
            modal.classList.add('open');
            document.body.style.overflow = 'hidden';
        };

        const closeModal = () => {
            modal.classList.remove('open');
            document.body.style.overflow = '';
        };

        document.querySelectorAll('.vehicle-preview-btn').forEach(btn => btn.addEventListener('click', () => openModal(btn)));
        modalClose?.addEventListener('click', closeModal);
        modal?.addEventListener('click', e => { if (e.target === modal) closeModal(); });
        document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });
    })();
</script>
</body> 
</html>