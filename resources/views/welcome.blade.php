<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home | AdaStore</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,700;0,900;1,400;1,700&family=Jost:wght@200;300;400;500&display=swap"
        rel="stylesheet">
    <style>
    :root {
        --gold: #BFA26A;
        --gold-light: #D4BC89;
        --gold-dim: rgba(191, 162, 106, 0.12);
        --gold-line: rgba(191, 162, 106, 0.22);
        --obsidian: #06060A;
        --void: #0A0A10;
        --panel: #0F0F17;
        --panel-raise: #141420;
        --rim: rgba(191, 162, 106, 0.14);
        --rim-hot: rgba(191, 162, 106, 0.45);
        --ash: #C8C4BE;
        --dust: #5C5954;
        --smoke: #1E1E28;
    }

    *,
    *::before,
    *::after {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    html {
        scroll-behavior: smooth;
    }

    body {
        background: var(--obsidian);
        color: var(--ash);
        font-family: 'Jost', sans-serif;
        font-weight: 300;
        overflow-x: hidden;
        cursor: none;
    }

    .cursor {
        position: fixed;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: var(--gold);
        pointer-events: none;
        z-index: 9999;
        transform: translate(-50%, -50%);
        transition: transform 0.1s, width 0.3s, height 0.3s, opacity 0.3s;
        mix-blend-mode: difference;
    }

    .cursor-ring {
        position: fixed;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        border: 1px solid rgba(191, 162, 106, 0.5);
        pointer-events: none;
        z-index: 9998;
        transform: translate(-50%, -50%);
        transition: transform 0.18s ease-out, width 0.3s, height 0.3s, border-color 0.3s;
    }

    body::before {
        content: '';
        position: fixed;
        inset: 0;
        background:
            radial-gradient(ellipse 55% 45% at 85% 5%, rgba(191, 162, 106, 0.055) 0%, transparent 55%),
            radial-gradient(ellipse 35% 50% at 5% 95%, rgba(191, 162, 106, 0.04) 0%, transparent 55%),
            radial-gradient(ellipse 80% 30% at 50% 50%, rgba(0, 0, 0, 0.4) 0%, transparent 80%);
        pointer-events: none;
        z-index: 0;
    }

    body::after {
        content: '';
        position: fixed;
        inset: 0;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='400'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='1'/%3E%3C/svg%3E");
        opacity: 0.028;
        pointer-events: none;
        z-index: 0;
    }

    .nav-wrap {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 100;
        border-bottom: 1px solid var(--rim);
        background: rgba(6, 6, 10, 0.82);
        backdrop-filter: blur(28px) saturate(1.4);
    }

    .nav-inner {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 3rem;
        height: 72px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .logo {
        font-family: 'Playfair Display', serif;
        font-size: 1.6rem;
        font-weight: 700;
        font-style: italic;
        letter-spacing: 0.01em;
        color: var(--ash);
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.2rem;
    }

    .logo-ada {
        color: var(--ash);
    }

    .logo-store {
        color: var(--gold);
    }

    .logo-ornament {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 2px;
        margin-left: 0.6rem;
        opacity: 0.7;
    }

    .logo-ornament span {
        display: block;
        background: var(--gold);
    }

    .logo-ornament span:nth-child(1) {
        width: 18px;
        height: 1px;
    }

    .logo-ornament span:nth-child(2) {
        width: 10px;
        height: 1px;
    }

    .nav-center {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        align-items: center;
        gap: 0.5rem;
        opacity: 0.35;
    }

    .nav-center-line {
        width: 40px;
        height: 1px;
        background: var(--gold);
    }

    .nav-center-diamond {
        width: 5px;
        height: 5px;
        background: var(--gold);
        transform: rotate(45deg);
    }

    .nav-actions {
        display: flex;
        align-items: center;
        gap: 2rem;
    }

    .nav-user-name {
        font-size: 0.62rem;
        font-weight: 500;
        letter-spacing: 0.22em;
        text-transform: uppercase;
        color: var(--gold);
    }

    .nav-link {
        font-size: 0.62rem;
        font-weight: 400;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: var(--dust);
        text-decoration: none;
        transition: color 0.25s;
    }

    .nav-link:hover {
        color: var(--ash);
    }

    .btn-nav-register {
        font-size: 0.6rem;
        font-weight: 500;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: var(--obsidian);
        background: var(--gold);
        border: none;
        padding: 0.6rem 1.6rem;
        cursor: none;
        text-decoration: none;
        transition: background 0.25s, box-shadow 0.25s;
    }

    .btn-nav-register:hover {
        background: var(--gold-light);
        box-shadow: 0 0 30px rgba(191, 162, 106, 0.3);
    }

    .btn-logout {
        font-size: 0.6rem;
        font-weight: 400;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: var(--dust);
        background: transparent;
        border: 1px solid var(--rim);
        padding: 0.55rem 1.3rem;
        cursor: none;
        transition: all 0.25s;
    }

    .btn-logout:hover {
        color: var(--gold);
        border-color: var(--rim-hot);
        background: var(--gold-dim);
    }

    .hero {
        position: relative;
        z-index: 1;
        padding: 12rem 3rem 6rem;
        max-width: 1400px;
        margin: 0 auto;
    }

    .hero-eyebrow {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 2.5rem;
    }

    .hero-eyebrow-line {
        width: 48px;
        height: 1px;
        background: var(--gold);
        opacity: 0.6;
    }

    .hero-eyebrow-text {
        font-size: 0.58rem;
        font-weight: 500;
        letter-spacing: 0.38em;
        text-transform: uppercase;
        color: var(--gold);
    }

    .hero-diamond {
        width: 4px;
        height: 4px;
        background: var(--gold);
        transform: rotate(45deg);
        opacity: 0.6;
    }

    .hero-title {
        font-family: 'Playfair Display', serif;
        font-size: clamp(4rem, 9vw, 8.5rem);
        font-weight: 400;
        line-height: 0.9;
        letter-spacing: -0.02em;
        color: var(--ash);
        margin-bottom: 1rem;
    }

    .hero-title-italic {
        font-style: italic;
        color: var(--gold);
        display: block;
    }

    .hero-title-bold {
        font-weight: 900;
        color: var(--ash);
        display: block;
    }

    .hero-sub {
        font-size: 0.6rem;
        font-weight: 400;
        letter-spacing: 0.3em;
        text-transform: uppercase;
        color: var(--dust);
        margin-top: 3rem;
    }

    .hero-rule {
        position: relative;
        margin-top: 5rem;
        height: 1px;
        display: flex;
        align-items: center;
    }

    .hero-rule::before {
        content: '';
        flex: 1;
        height: 1px;
        background: linear-gradient(to right, transparent, var(--gold-line) 20%, var(--gold-line) 80%, transparent);
    }

    .hero-rule-center {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 0 1.5rem;
        opacity: 0.5;
    }

    .hero-rule-diamond {
        width: 6px;
        height: 6px;
        border: 1px solid var(--gold);
        transform: rotate(45deg);
    }

    .controls-wrap {
        position: relative;
        z-index: 1;
        max-width: 1400px;
        margin: 0 auto;
        padding: 2.5rem 3rem;
    }

    .controls-inner {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
    }

    .controls-left {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .btn-create {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        font-size: 0.6rem;
        font-weight: 500;
        letter-spacing: 0.22em;
        text-transform: uppercase;
        color: var(--gold);
        background: var(--gold-dim);
        border: 1px solid var(--rim);
        padding: 0.7rem 1.5rem;
        text-decoration: none;
        transition: all 0.25s;
    }

    .btn-create:hover {
        border-color: var(--rim-hot);
        background: rgba(191, 162, 106, 0.18);
        box-shadow: 0 0 20px rgba(191, 162, 106, 0.1);
    }

    .search-wrap {
        position: relative;
    }

    .search-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        width: 13px;
        height: 13px;
        color: var(--dust);
        pointer-events: none;
    }

    .search-input {
        background: var(--panel);
        border: 1px solid var(--rim);
        color: var(--ash);
        font-family: 'Jost', sans-serif;
        font-size: 0.68rem;
        font-weight: 300;
        letter-spacing: 0.08em;
        padding: 0.7rem 2.8rem 0.7rem 2.5rem;
        width: 300px;
        outline: none;
        transition: border-color 0.25s, background 0.25s;
    }

    .search-input::placeholder {
        color: var(--dust);
    }

    .search-input:focus {
        border-color: var(--rim-hot);
        background: var(--panel-raise);
    }

    .search-clear {
        position: absolute;
        right: 0.9rem;
        top: 50%;
        transform: translateY(-50%);
        font-size: 0.7rem;
        color: var(--gold);
        text-decoration: none;
        opacity: 0.7;
        transition: opacity 0.2s;
    }

    .search-clear:hover {
        opacity: 1;
    }

    .sort-wrap {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        background: var(--panel);
        border: 1px solid var(--rim);
        padding: 0.55rem 1.1rem;
    }

    .sort-icon {
        width: 12px;
        height: 12px;
        color: var(--dust);
    }

    .sort-select {
        background: transparent;
        border: none;
        outline: none;
        font-family: 'Jost', sans-serif;
        font-size: 0.62rem;
        font-weight: 400;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: var(--ash);
        cursor: none;
        appearance: none;
        padding-right: 0.25rem;
    }

    .sort-select option {
        background: var(--panel);
    }

    .grid-wrap {
        position: relative;
        z-index: 1;
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 3rem;
    }

    .section-header {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .section-header-line {
        flex: 1;
        height: 1px;
        background: linear-gradient(to right, var(--rim), transparent);
    }

    .section-label {
        font-size: 0.55rem;
        font-weight: 500;
        letter-spacing: 0.32em;
        text-transform: uppercase;
        color: var(--dust);
    }

    .section-count {
        font-family: 'Playfair Display', serif;
        font-size: 0.85rem;
        font-style: italic;
        color: var(--gold);
    }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1px;
        background: var(--rim);
        border: 1px solid var(--rim);
        margin-bottom: 8rem;
    }

    @media (min-width: 640px) {
        .product-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (min-width: 1024px) {
        .product-grid {
            grid-template-columns: repeat(5, 1fr);
        }
    }

    .product-card {
        background: var(--panel);
        padding: 1.75rem 1.25rem 1.5rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        transition: background 0.4s;
        overflow: hidden;
    }

    .product-card::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 1.25rem;
        right: 1.25rem;
        height: 1px;
        background: linear-gradient(to right, transparent, var(--gold), transparent);
        transform: scaleX(0);
        transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        opacity: 0.6;
    }

    .product-card:hover::after {
        transform: scaleX(1);
    }

    .product-card:hover {
        background: var(--panel-raise);
    }

    .product-img-wrap {
        width: 100%;
        aspect-ratio: 1;
        background: var(--smoke);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        margin-bottom: 1.5rem;
        position: relative;
    }

    .product-img-corner {
        position: absolute;
        width: 12px;
        height: 12px;
        border-color: var(--gold);
        border-style: solid;
        opacity: 0;
        transition: opacity 0.4s;
    }

    .product-card:hover .product-img-corner {
        opacity: 0.6;
    }

    .product-img-corner-tl {
        top: 6px;
        left: 6px;
        border-width: 1px 0 0 1px;
    }

    .product-img-corner-tr {
        top: 6px;
        right: 6px;
        border-width: 1px 1px 0 0;
    }

    .product-img-corner-bl {
        bottom: 6px;
        left: 6px;
        border-width: 0 0 1px 1px;
    }

    .product-img-corner-br {
        bottom: 6px;
        right: 6px;
        border-width: 0 1px 1px 0;
    }

    .product-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.7s cubic-bezier(0.16, 1, 0.3, 1), filter 0.4s;
        filter: saturate(0.85) brightness(0.9);
    }

    .product-card:hover .product-img {
        transform: scale(1.06);
        filter: saturate(1) brightness(1);
    }

    .product-placeholder-icon {
        width: 2rem;
        height: 2rem;
        color: var(--smoke);
    }

    .product-stock {
        font-size: 0.52rem;
        font-weight: 400;
        letter-spacing: 0.28em;
        text-transform: uppercase;
        color: var(--dust);
        margin-bottom: 0.5rem;
        text-align: center;
    }

    .product-name {
        font-family: 'Playfair Display', serif;
        font-size: 0.95rem;
        font-weight: 500;
        font-style: italic;
        color: var(--ash);
        text-align: center;
        width: 100%;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        line-height: 1.25;
        transition: color 0.25s;
    }

    .product-card:hover .product-name {
        color: #e8e4de;
    }

    .product-price-wrap {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-top: 0.4rem;
    }

    .product-price-line {
        width: 16px;
        height: 1px;
        background: var(--gold);
        opacity: 0.5;
    }

    .product-price {
        font-family: 'Playfair Display', serif;
        font-size: 1rem;
        font-weight: 400;
        color: var(--gold);
        text-align: center;
        letter-spacing: 0.01em;
    }

    .product-actions {
        display: flex;
        gap: 0.5rem;
        width: 100%;
        margin-top: 1.5rem;
        padding-top: 1.2rem;
        border-top: 1px solid rgba(191, 162, 106, 0.1);
    }

    .btn-action {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0.65rem;
        background: transparent;
        border: 1px solid var(--rim);
        cursor: none;
        text-decoration: none;
        transition: all 0.25s;
    }

    .btn-action-icon {
        width: 13px;
        height: 13px;
        color: var(--dust);
        transition: color 0.25s;
    }

    .btn-delete:hover {
        border-color: rgba(191, 162, 106, 0.35);
        background: rgba(191, 162, 106, 0.06);
    }

    .btn-delete:hover .btn-action-icon {
        color: var(--gold);
    }

    .btn-edit:hover {
        border-color: rgba(200, 196, 190, 0.2);
        background: rgba(200, 196, 190, 0.04);
    }

    .btn-edit:hover .btn-action-icon {
        color: var(--ash);
    }

    .empty-state {
        grid-column: 1 / -1;
        background: var(--panel);
        padding: 10rem 2rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1.5rem;
    }

    .empty-icon-wrap {
        position: relative;
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .empty-icon-wrap::before {
        content: '';
        position: absolute;
        inset: 0;
        border: 1px solid var(--rim);
        transform: rotate(45deg);
    }

    .empty-icon {
        width: 1.5rem;
        height: 1.5rem;
        color: var(--dust);
    }

    .empty-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.4rem;
        font-weight: 400;
        font-style: italic;
        color: var(--dust);
    }

    .empty-sub {
        font-size: 0.58rem;
        letter-spacing: 0.25em;
        text-transform: uppercase;
        color: #2a2826;
    }

    .footer {
        position: relative;
        z-index: 1;
        border-top: 1px solid var(--rim);
        padding: 3rem 3rem;
    }

    .footer-inner {
        max-width: 1400px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .footer-logo {
        font-family: 'Playfair Display', serif;
        font-size: 1rem;
        font-style: italic;
        color: var(--dust);
    }

    .footer-logo span {
        color: var(--gold);
        opacity: 0.7;
    }

    .footer-text {
        font-size: 0.55rem;
        font-weight: 400;
        letter-spacing: 0.28em;
        text-transform: uppercase;
        color: #2a2826;
    }

    .footer-ornament {
        display: flex;
        align-items: center;
        gap: 8px;
        opacity: 0.3;
    }

    .footer-ornament-line {
        width: 30px;
        height: 1px;
        background: var(--gold);
    }

    .footer-ornament-diamond {
        width: 4px;
        height: 4px;
        background: var(--gold);
        transform: rotate(45deg);
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(24px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .hero {
        animation: fadeUp 0.9s ease both;
    }

    .controls-wrap {
        animation: fadeUp 0.9s 0.1s ease both;
    }

    .grid-wrap {
        animation: fadeUp 0.9s 0.18s ease both;
    }

    .product-card {
        animation: fadeUp 0.6s ease both;
    }

    .product-card:nth-child(1) {
        animation-delay: 0.05s;
    }

    .product-card:nth-child(2) {
        animation-delay: 0.1s;
    }

    .product-card:nth-child(3) {
        animation-delay: 0.15s;
    }

    .product-card:nth-child(4) {
        animation-delay: 0.2s;
    }

    .product-card:nth-child(5) {
        animation-delay: 0.25s;
    }

    .product-card:nth-child(n+6) {
        animation-delay: 0.3s;
    }

    .nav-wrap {
        animation: fadeUp 0.7s ease both;
    }
    </style>
</head>

<body>

    <div class="cursor" id="cursor"></div>
    <div class="cursor-ring" id="cursorRing"></div>

    <nav class="nav-wrap">
        <div class="nav-inner">
            <a href="/" class="logo">
                <span class="logo-ada">Ada</span><span class="logo-store">Store</span>
                <div class="logo-ornament">
                    <span></span>
                    <span></span>
                </div>
            </a>

            <div class="nav-center">
                <div class="nav-center-line"></div>
                <div class="nav-center-diamond"></div>
                <div class="nav-center-line"></div>
            </div>

            <div class="nav-actions">
                @auth
                <span class="nav-user-name">{{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-logout">Keluar</button>
                </form>
                @else
                <a href="{{ route('login') }}" class="nav-link">Masuk</a>
                <a href="{{ route('register') }}" class="btn-nav-register">Daftar</a>
                @endauth
            </div>
        </div>
    </nav>

    <header class="hero">
        <div class="hero-eyebrow">
            <div class="hero-eyebrow-line"></div>
            <span class="hero-eyebrow-text">Koleksi Terkurasi</span>
            <div class="hero-diamond"></div>
        </div>
        <h1 class="hero-title">
            <span class="hero-title-italic">Temukan Elektronik</span>
            <span class="hero-title-bold">Terbaik.</span>
        </h1>
        <p class="hero-sub">Final Project &nbsp;·&nbsp; Timedoor Academy &nbsp;·&nbsp; By Alek</p>
        <div class="hero-rule">
            <div class="hero-rule-center">
                <div class="hero-rule-diamond"></div>
            </div>
        </div>
    </header>

    <section class="controls-wrap">
        <div class="controls-inner">
            <div class="controls-left">
                @auth
                <a href="{{ route('products.create') }}" class="btn-create">
                    <i data-lucide="plus" style="width:11px;height:11px;"></i>
                    Tambah Produk
                </a>
                @endauth

                <form action="/" method="GET" class="search-wrap">
                    <i data-lucide="search" class="search-icon"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..."
                        class="search-input">
                    @if(request('search'))
                    <a href="/" class="search-clear">×</a>
                    @endif
                </form>
            </div>

            <form action="/" method="GET" id="sortForm">
                <input type="hidden" name="search" value="{{ request('search') }}">
                <div class="sort-wrap">
                    <i data-lucide="sliders-horizontal" class="sort-icon"></i>
                    <select name="sort" class="sort-select" onchange="document.getElementById('sortForm').submit()">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama A–Z</option>
                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama Z–A
                        </option>
                    </select>
                </div>
            </form>
        </div>
    </section>

    <div class="grid-wrap">
        <div class="section-header">
            <span class="section-label">Semua Produk</span>
            <span class="section-count">{{ $products->count() }} item</span>
            <div class="section-header-line"></div>
        </div>

        <main class="product-grid">
            @forelse($products as $product)
            <article class="product-card">
                <div class="product-img-wrap">
                    <div class="product-img-corner product-img-corner-tl"></div>
                    <div class="product-img-corner product-img-corner-tr"></div>
                    <div class="product-img-corner product-img-corner-bl"></div>
                    <div class="product-img-corner product-img-corner-br"></div>
                    @if($product->image_url)
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="product-img">
                    @else
                    <i data-lucide="package" class="product-placeholder-icon"></i>
                    @endif
                </div>

                <p class="product-stock">Stok: {{ $product->stock ?? 0 }}</p>
                <h3 class="product-name" title="{{ $product->name }}">{{ $product->name }}</h3>
                <div class="product-price-wrap">
                    <div class="product-price-line"></div>
                    <p class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <div class="product-price-line"></div>
                </div>

                @auth
                <div class="product-actions">
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="delete-form"
                        style="flex:1;display:flex;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-action btn-delete" style="flex:1;">
                            <i data-lucide="trash-2" class="btn-action-icon"></i>
                        </button>
                    </form>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn-action btn-edit">
                        <i data-lucide="pencil" class="btn-action-icon"></i>
                    </a>
                </div>
                @endauth
            </article>
            @empty
            <div class="empty-state">
                <div class="empty-icon-wrap">
                    <i data-lucide="search-x" class="empty-icon"></i>
                </div>
                <p class="empty-title">Tidak ada produk ditemukan.</p>
                <p class="empty-sub">Coba kata kunci lain atau tambahkan produk baru</p>
            </div>
            @endforelse
        </main>
    </div>

    <footer class="footer">
        <div class="footer-inner">
            <div class="footer-logo">Ada<span>Store</span></div>
            <div class="footer-ornament">
                <div class="footer-ornament-line"></div>
                <div class="footer-ornament-diamond"></div>
                <div class="footer-ornament-line"></div>
            </div>
            <p class="footer-text">&copy; 2026 Alexandro Francisco &nbsp;·&nbsp; Timedoor Academy</p>
        </div>
    </footer>

    <script>
    lucide.createIcons();

    const cursor = document.getElementById('cursor');
    const ring = document.getElementById('cursorRing');
    let mx = 0,
        my = 0,
        rx = 0,
        ry = 0;

    document.addEventListener('mousemove', e => {
        mx = e.clientX;
        my = e.clientY;
        cursor.style.left = mx + 'px';
        cursor.style.top = my + 'px';
    });

    function animateRing() {
        rx += (mx - rx) * 0.12;
        ry += (my - ry) * 0.12;
        ring.style.left = rx + 'px';
        ring.style.top = ry + 'px';
        requestAnimationFrame(animateRing);
    }
    animateRing();

    document.querySelectorAll('a, button, .product-card').forEach(el => {
        el.addEventListener('mouseenter', () => {
            cursor.style.width = '6px';
            cursor.style.height = '6px';
            ring.style.width = '52px';
            ring.style.height = '52px';
            ring.style.borderColor = 'rgba(191,162,106,0.8)';
        });
        el.addEventListener('mouseleave', () => {
            cursor.style.width = '10px';
            cursor.style.height = '10px';
            ring.style.width = '36px';
            ring.style.height = '36px';
            ring.style.borderColor = 'rgba(191,162,106,0.5)';
        });
    });

    @if(session('success'))
    Swal.fire({
        title: 'Berhasil',
        text: "{{ session('success') }}",
        icon: 'success',
        background: '#0F0F17',
        color: '#C8C4BE',
        confirmButtonColor: '#BFA26A',
        timer: 2500,
        showConfirmButton: false,
        timerProgressBar: true,
    });
    @endif

    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Hapus Produk?',
                text: 'Tindakan ini tidak dapat dibatalkan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#BFA26A',
                cancelButtonColor: '#1E1E28',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                background: '#0F0F17',
                color: '#C8C4BE',
            }).then((result) => {
                if (result.isConfirmed) this.submit();
            });
        });
    });
    </script>
</body>

</html>