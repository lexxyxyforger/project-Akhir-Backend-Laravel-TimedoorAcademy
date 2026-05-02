<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | AdaStore</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,700;1,400;1,700&family=Jost:wght@200;300;400;500&display=swap"
        rel="stylesheet">
    <style>
    :root {
        --gold: #BFA26A;
        --gold-light: #D4BC89;
        --gold-dim: rgba(191, 162, 106, 0.1);
        --gold-line: rgba(191, 162, 106, 0.2);
        --obsidian: #06060A;
        --panel: #0F0F17;
        --panel-raise: #141420;
        --rim: rgba(191, 162, 106, 0.14);
        --rim-hot: rgba(191, 162, 106, 0.45);
        --ash: #C8C4BE;
        --dust: #5C5954;
    }

    *,
    *::before,
    *::after {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        background: var(--obsidian);
        color: var(--ash);
        font-family: 'Jost', sans-serif;
        font-weight: 300;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow-x: hidden;
        cursor: none;
        padding: 2rem 0;
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
        mix-blend-mode: difference;
        transition: width 0.3s, height 0.3s;
    }

    .cursor-ring {
        position: fixed;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        border: 1px solid rgba(191, 162, 106, 0.45);
        pointer-events: none;
        z-index: 9998;
        transform: translate(-50%, -50%);
        transition: width 0.3s, height 0.3s, border-color 0.3s;
    }

    body::before {
        content: '';
        position: fixed;
        inset: 0;
        background:
            radial-gradient(ellipse 70% 60% at 15% 50%, rgba(191, 162, 106, 0.05) 0%, transparent 55%),
            radial-gradient(ellipse 60% 50% at 85% 50%, rgba(191, 162, 106, 0.04) 0%, transparent 55%);
        pointer-events: none;
    }

    body::after {
        content: '';
        position: fixed;
        inset: 0;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='400'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='1'/%3E%3C/svg%3E");
        opacity: 0.028;
        pointer-events: none;
    }

    .bg-lines {
        position: fixed;
        inset: 0;
        pointer-events: none;
        overflow: hidden;
    }

    .bg-lines::before {
        content: '';
        position: absolute;
        left: 50%;
        top: 0;
        bottom: 0;
        width: 1px;
        background: linear-gradient(to bottom, transparent, var(--gold-line) 20%, var(--gold-line) 80%, transparent);
        transform: translateX(-50%);
        opacity: 0.3;
    }

    .bg-lines::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(to right, transparent, var(--gold-line) 20%, var(--gold-line) 80%, transparent);
        transform: translateY(-50%);
        opacity: 0.15;
    }

    .page-wrap {
        position: relative;
        z-index: 1;
        width: 100%;
        max-width: 480px;
        padding: 2rem;
        animation: fadeUp 0.9s ease both;
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(28px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .card {
        background: var(--panel);
        border: 1px solid var(--rim);
        position: relative;
    }

    .card-corner {
        position: absolute;
        width: 16px;
        height: 16px;
        border-color: var(--gold);
        border-style: solid;
        opacity: 0.5;
    }

    .card-corner-tl {
        top: -1px;
        left: -1px;
        border-width: 1px 0 0 1px;
    }

    .card-corner-tr {
        top: -1px;
        right: -1px;
        border-width: 1px 1px 0 0;
    }

    .card-corner-bl {
        bottom: -1px;
        left: -1px;
        border-width: 0 0 1px 1px;
    }

    .card-corner-br {
        bottom: -1px;
        right: -1px;
        border-width: 0 1px 1px 0;
    }

    .card-inner {
        padding: 3rem 2.5rem 2.5rem;
    }

    .card-header {
        text-align: center;
        margin-bottom: 2.5rem;
    }

    .logo-link {
        text-decoration: none;
        display: inline-block;
        margin-bottom: 2rem;
    }

    .logo {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        font-weight: 700;
        font-style: italic;
        color: var(--ash);
    }

    .logo span {
        color: var(--gold);
    }

    .card-title {
        font-size: 0.6rem;
        font-weight: 400;
        letter-spacing: 0.35em;
        text-transform: uppercase;
        color: var(--dust);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
    }

    .card-title-line {
        width: 28px;
        height: 1px;
        background: var(--gold-line);
    }

    .error-box {
        background: rgba(191, 162, 106, 0.06);
        border: 1px solid rgba(191, 162, 106, 0.25);
        color: var(--gold);
        padding: 0.75rem 1rem;
        margin-bottom: 1.75rem;
        font-size: 0.68rem;
        font-weight: 400;
        letter-spacing: 0.05em;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .form-group {
        margin-bottom: 1.1rem;
    }

    .form-label {
        display: block;
        font-size: 0.55rem;
        font-weight: 500;
        letter-spacing: 0.28em;
        text-transform: uppercase;
        color: var(--dust);
        margin-bottom: 0.5rem;
    }

    .form-input {
        width: 100%;
        background: var(--obsidian);
        border: 1px solid var(--rim);
        color: var(--ash);
        font-family: 'Jost', sans-serif;
        font-size: 0.8rem;
        font-weight: 300;
        letter-spacing: 0.04em;
        padding: 0.85rem 1rem;
        outline: none;
        transition: border-color 0.25s, background 0.25s;
    }

    .form-input::placeholder {
        color: var(--dust);
        font-size: 0.75rem;
    }

    .form-input:focus {
        border-color: var(--rim-hot);
        background: #0a0a12;
    }

    .form-divider {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin: 1.5rem 0 1.25rem;
    }

    .form-divider-line {
        flex: 1;
        height: 1px;
        background: var(--rim);
    }

    .form-divider-text {
        font-size: 0.5rem;
        font-weight: 500;
        letter-spacing: 0.3em;
        text-transform: uppercase;
        color: var(--dust);
    }

    .btn-submit {
        width: 100%;
        background: transparent;
        border: 1px solid var(--gold);
        color: var(--gold);
        font-family: 'Jost', sans-serif;
        font-size: 0.62rem;
        font-weight: 500;
        letter-spacing: 0.28em;
        text-transform: uppercase;
        padding: 1rem;
        cursor: none;
        margin-top: 0.5rem;
        position: relative;
        overflow: hidden;
        transition: color 0.35s;
    }

    .btn-submit::before {
        content: '';
        position: absolute;
        inset: 0;
        background: var(--gold);
        transform: translateY(100%);
        transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .btn-submit:hover::before {
        transform: translateY(0);
    }

    .btn-submit:hover {
        color: var(--obsidian);
    }

    .btn-submit span {
        position: relative;
        z-index: 1;
    }

    .card-footer {
        text-align: center;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--rim);
        font-size: 0.62rem;
        font-weight: 400;
        letter-spacing: 0.1em;
        color: var(--dust);
    }

    .card-footer a {
        color: var(--gold);
        text-decoration: none;
        letter-spacing: 0.15em;
        font-weight: 500;
        transition: color 0.2s;
    }

    .card-footer a:hover {
        color: var(--gold-light);
    }

    .ornament {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-bottom: 2rem;
        opacity: 0.35;
    }

    .ornament-line {
        width: 36px;
        height: 1px;
        background: var(--gold);
    }

    .ornament-diamond {
        width: 5px;
        height: 5px;
        border: 1px solid var(--gold);
        transform: rotate(45deg);
    }
    </style>
</head>

<body>

    <div class="cursor" id="cursor"></div>
    <div class="cursor-ring" id="cursorRing"></div>
    <div class="bg-lines"></div>

    <div class="page-wrap">
        <div class="card">
            <div class="card-corner card-corner-tl"></div>
            <div class="card-corner card-corner-tr"></div>
            <div class="card-corner card-corner-bl"></div>
            <div class="card-corner card-corner-br"></div>

            <div class="card-inner">
                <div class="card-header">
                    <a href="/" class="logo-link">
                        <div class="logo">Ada<span>Store</span></div>
                    </a>
                    <div class="ornament">
                        <div class="ornament-line"></div>
                        <div class="ornament-diamond"></div>
                        <div class="ornament-line"></div>
                    </div>
                    <p class="card-title">
                        <span class="card-title-line"></span>
                        Buat Akun Baru
                        <span class="card-title-line"></span>
                    </p>
                </div>

                @if ($errors->any())
                <div class="error-box">{{ $errors->first() }}</div>
                @endif

                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Alek Francisco" required
                            class="form-input">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="alek@email.com"
                            required class="form-input">
                    </div>

                    <div class="form-divider">
                        <div class="form-divider-line"></div>
                        <span class="form-divider-text">Keamanan</span>
                        <div class="form-divider-line"></div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" placeholder="••••••••" required class="form-input">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Konfirmasi</label>
                            <input type="password" name="password_confirmation" placeholder="••••••••" required
                                class="form-input">
                        </div>
                    </div>

                    <button type="submit" class="btn-submit"><span>Buat Akun</span></button>
                </form>

                <div class="card-footer">
                    Sudah punya akun? &nbsp;<a href="{{ route('login') }}">Masuk</a>
                </div>
            </div>
        </div>
    </div>

    <script>
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

    document.querySelectorAll('a, button, input').forEach(el => {
        el.addEventListener('mouseenter', () => {
            ring.style.width = '52px';
            ring.style.height = '52px';
            ring.style.borderColor = 'rgba(191,162,106,0.7)';
        });
        el.addEventListener('mouseleave', () => {
            ring.style.width = '36px';
            ring.style.height = '36px';
            ring.style.borderColor = 'rgba(191,162,106,0.45)';
        });
    });
    </script>
</body>

</html>