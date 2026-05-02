<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk | AdaStore</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
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
        --gold-line: rgba(191, 162, 106, 0.18);
        --obsidian: #06060A;
        --panel: #0F0F17;
        --panel-raise: #141420;
        --smoke: #1A1A26;
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
        padding: 3rem 1.5rem;
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
            radial-gradient(ellipse 60% 50% at 20% 50%, rgba(191, 162, 106, 0.05) 0%, transparent 60%),
            radial-gradient(ellipse 50% 40% at 80% 50%, rgba(191, 162, 106, 0.04) 0%, transparent 60%);
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

    .page-wrap {
        position: relative;
        z-index: 1;
        width: 100%;
        max-width: 540px;
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
        padding: 2.75rem 2.5rem 2.5rem;
    }

    .card-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        margin-bottom: 0.5rem;
    }

    .card-eyebrow {
        font-size: 0.55rem;
        font-weight: 500;
        letter-spacing: 0.35em;
        text-transform: uppercase;
        color: var(--gold);
        display: flex;
        align-items: center;
        gap: 0.6rem;
        margin-bottom: 0.75rem;
    }

    .card-eyebrow-line {
        width: 24px;
        height: 1px;
        background: var(--gold);
        opacity: 0.6;
    }

    .card-title {
        font-family: 'Playfair Display', serif;
        font-size: 2rem;
        font-weight: 400;
        font-style: italic;
        color: var(--ash);
        line-height: 1;
        letter-spacing: -0.01em;
    }

    .card-title span {
        color: var(--gold);
        font-weight: 700;
    }

    .card-subtitle {
        font-size: 0.55rem;
        font-weight: 400;
        letter-spacing: 0.28em;
        text-transform: uppercase;
        color: var(--dust);
        margin-top: 0.6rem;
    }

    .product-id-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        margin-top: 0.5rem;
        padding: 0.3rem 0.7rem;
        border: 1px solid var(--rim);
        background: var(--gold-dim);
    }

    .product-id-text {
        font-size: 0.52rem;
        font-weight: 500;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: var(--gold);
    }

    .btn-close {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border: 1px solid var(--rim);
        background: transparent;
        cursor: none;
        text-decoration: none;
        flex-shrink: 0;
        transition: border-color 0.25s, background 0.25s;
    }

    .btn-close:hover {
        border-color: var(--rim-hot);
        background: var(--gold-dim);
    }

    .btn-close-icon {
        width: 13px;
        height: 13px;
        color: var(--dust);
        transition: color 0.25s;
    }

    .btn-close:hover .btn-close-icon {
        color: var(--gold);
    }

    .card-divider {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin: 2rem 0 1.75rem;
    }

    .card-divider-line {
        flex: 1;
        height: 1px;
        background: var(--rim);
    }

    .card-divider-diamond {
        width: 5px;
        height: 5px;
        border: 1px solid rgba(191, 162, 106, 0.3);
        transform: rotate(45deg);
        flex-shrink: 0;
    }

    .form-section-label {
        font-size: 0.52rem;
        font-weight: 500;
        letter-spacing: 0.32em;
        text-transform: uppercase;
        color: var(--dust);
        margin-bottom: 1rem;
    }

    .toggle-wrap {
        display: flex;
        margin-bottom: 0.75rem;
    }

    .toggle-btn {
        font-size: 0.56rem;
        font-weight: 500;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        background: transparent;
        border: 1px solid var(--rim);
        color: var(--dust);
        padding: 0.45rem 1rem;
        cursor: none;
        transition: all 0.2s;
    }

    .toggle-btn:first-child {
        border-right: none;
    }

    .toggle-btn.active {
        background: var(--gold-dim);
        border-color: var(--rim-hot);
        color: var(--gold);
    }

    .form-group {
        margin-bottom: 1.1rem;
    }

    .form-label {
        display: block;
        font-size: 0.52rem;
        font-weight: 500;
        letter-spacing: 0.28em;
        text-transform: uppercase;
        color: var(--dust);
        margin-bottom: 0.5rem;
    }

    .input-wrap {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        width: 13px;
        height: 13px;
        color: var(--dust);
        pointer-events: none;
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
        padding: 0.85rem 1rem 0.85rem 2.5rem;
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

    .form-select {
        width: 100%;
        background: var(--obsidian);
        border: 1px solid var(--rim);
        color: var(--ash);
        font-family: 'Jost', sans-serif;
        font-size: 0.8rem;
        font-weight: 300;
        letter-spacing: 0.04em;
        padding: 0.85rem 2.5rem 0.85rem 2.5rem;
        outline: none;
        appearance: none;
        cursor: none;
        transition: border-color 0.25s, background 0.25s;
    }

    .form-select:focus {
        border-color: var(--rim-hot);
        background: #0a0a12;
    }

    .form-select option {
        background: var(--panel);
    }

    .select-chevron {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        width: 12px;
        height: 12px;
        color: var(--dust);
        pointer-events: none;
    }

    .price-prefix {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        font-family: 'Playfair Display', serif;
        font-size: 0.75rem;
        font-style: italic;
        color: var(--gold);
        pointer-events: none;
    }

    .price-input {
        width: 100%;
        background: var(--obsidian);
        border: 1px solid var(--rim);
        color: var(--gold);
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        font-style: italic;
        font-weight: 700;
        letter-spacing: -0.01em;
        padding: 0.75rem 1rem 0.75rem 3rem;
        outline: none;
        transition: border-color 0.25s, background 0.25s;
    }

    .price-input::placeholder {
        color: rgba(191, 162, 106, 0.25);
    }

    .price-input:focus {
        border-color: var(--rim-hot);
        background: #0a0a12;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .dropzone {
        border: 1px dashed var(--rim);
        background: var(--obsidian);
        padding: 2rem;
        text-align: center;
        cursor: none;
        position: relative;
        overflow: hidden;
        transition: border-color 0.25s, background 0.25s;
    }

    .dropzone:hover {
        border-color: var(--rim-hot);
        background: var(--gold-dim);
    }

    .dropzone.drag-over {
        border-color: var(--gold);
        background: rgba(191, 162, 106, 0.08);
    }

    .dropzone-icon {
        width: 1.75rem;
        height: 1.75rem;
        color: var(--dust);
        margin: 0 auto 0.6rem;
        display: block;
        transition: color 0.25s;
    }

    .dropzone:hover .dropzone-icon {
        color: var(--gold);
    }

    .dropzone-text {
        font-size: 0.58rem;
        font-weight: 500;
        letter-spacing: 0.25em;
        text-transform: uppercase;
        color: var(--dust);
    }

    .dropzone-sub {
        font-size: 0.52rem;
        letter-spacing: 0.15em;
        color: #2a2826;
        margin-top: 0.3rem;
    }

    .preview-overlay {
        position: absolute;
        inset: 0;
        background: rgba(6, 6, 10, 0.92);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0.5rem;
    }

    .preview-img {
        height: 100%;
        object-fit: contain;
    }

    .preview-clear {
        position: absolute;
        top: 0.5rem;
        right: 0.5rem;
        width: 26px;
        height: 26px;
        background: var(--gold-dim);
        border: 1px solid var(--rim-hot);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: none;
        transition: background 0.2s;
    }

    .preview-clear:hover {
        background: rgba(191, 162, 106, 0.2);
    }

    .preview-clear-icon {
        width: 11px;
        height: 11px;
        color: var(--gold);
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
        padding: 1.1rem;
        cursor: none;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        transition: color 0.35s;
        margin-top: 0.5rem;
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

    .btn-submit span,
    .btn-submit i {
        position: relative;
        z-index: 1;
    }

    .btn-submit-icon {
        width: 13px;
        height: 13px;
        transition: transform 0.5s;
    }

    .btn-submit:hover .btn-submit-icon {
        transform: rotate(180deg);
    }

    .hidden {
        display: none !important;
    }
    </style>
</head>

<body>

    <div class="cursor" id="cursor"></div>
    <div class="cursor-ring" id="cursorRing"></div>

    <div class="page-wrap">
        <div class="card">
            <div class="card-corner card-corner-tl"></div>
            <div class="card-corner card-corner-tr"></div>
            <div class="card-corner card-corner-bl"></div>
            <div class="card-corner card-corner-br"></div>

            <div class="card-inner">
                <div class="card-header">
                    <div>
                        <div class="card-eyebrow">
                            <div class="card-eyebrow-line"></div>
                            Modifikasi Data
                        </div>
                        <h1 class="card-title">Edit <span>Produk</span></h1>
                        <div class="product-id-badge">
                            <i data-lucide="hash" style="width:10px;height:10px;color:var(--gold);"></i>
                            <span class="product-id-text">ID {{ $product->id }} — Memodifikasi Record</span>
                        </div>
                    </div>
                    <a href="/" class="btn-close">
                        <i data-lucide="x" class="btn-close-icon"></i>
                    </a>
                </div>

                <form id="editForm" action="{{ route('products.update', $product->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-divider">
                        <div class="card-divider-line"></div>
                        <div class="card-divider-diamond"></div>
                        <div class="card-divider-line"></div>
                    </div>

                    <p class="form-section-label">Perbarui Visual</p>

                    <div class="toggle-wrap">
                        <button type="button" class="toggle-btn active" id="btn-url"
                            onclick="toggleImageInput('url')">URL Link</button>
                        <button type="button" class="toggle-btn" id="btn-file" onclick="toggleImageInput('file')">File
                            Lokal</button>
                    </div>

                    <div class="form-group" id="url-container">
                        <div class="input-wrap">
                            <i data-lucide="link" class="input-icon"></i>
                            <input type="url" name="image_url" value="{{ old('image_url', $product->image_url) }}"
                                placeholder="https://example.com/photo.jpg" class="form-input">
                        </div>
                    </div>

                    <div class="form-group hidden" id="file-container">
                        <div class="dropzone" id="dropzone">
                            <input type="file" name="image_file" id="file-input" class="hidden" accept="image/*">
                            <div id="preview-overlay" class="preview-overlay {{ $product->image_url ? '' : 'hidden' }}">
                                <img id="image-preview" src="{{ $product->image_url ?? '#' }}" class="preview-img">
                                <button type="button" class="preview-clear" onclick="clearImage()">
                                    <i data-lucide="trash-2" class="preview-clear-icon"></i>
                                </button>
                            </div>
                            <i data-lucide="cloud-upload" class="dropzone-icon"></i>
                            <p class="dropzone-text">Ganti dengan Gambar Baru</p>
                            <p class="dropzone-sub">Drag & Drop atau klik untuk pilih</p>
                        </div>
                    </div>

                    <div class="card-divider">
                        <div class="card-divider-line"></div>
                        <div class="card-divider-diamond"></div>
                        <div class="card-divider-line"></div>
                    </div>

                    <p class="form-section-label">Identitas & Stok</p>

                    <div class="form-group">
                        <label class="form-label">Nama Produk</label>
                        <div class="input-wrap">
                            <i data-lucide="package" class="input-icon"></i>
                            <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                                class="form-input">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Kategori</label>
                            <div class="input-wrap">
                                <i data-lucide="tag" class="input-icon"></i>
                                <select name="category_id" required class="form-select">
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <i data-lucide="chevron-down" class="select-chevron"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Stok</label>
                            <div class="input-wrap">
                                <i data-lucide="box" class="input-icon"></i>
                                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required
                                    class="form-input">
                            </div>
                        </div>
                    </div>

                    <div class="card-divider">
                        <div class="card-divider-line"></div>
                        <div class="card-divider-diamond"></div>
                        <div class="card-divider-line"></div>
                    </div>

                    <p class="form-section-label">Harga</p>

                    <div class="form-group">
                        <div class="input-wrap">
                            <span class="price-prefix">Rp</span>
                            <input type="text" id="display_price"
                                value="{{ number_format($product->price, 0, ',', '.') }}" required class="price-input">
                            <input type="hidden" name="price" id="real_price" value="{{ $product->price }}">
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">
                        <span>Simpan Perubahan</span>
                        <i data-lucide="refresh-cw" class="btn-submit-icon"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

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

    (function animateRing() {
        rx += (mx - rx) * 0.12;
        ry += (my - ry) * 0.12;
        ring.style.left = rx + 'px';
        ring.style.top = ry + 'px';
        requestAnimationFrame(animateRing);
    })();

    document.querySelectorAll('a, button, input, select, .dropzone').forEach(el => {
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

    function toggleImageInput(type) {
        const urlCont = document.getElementById('url-container');
        const fileCont = document.getElementById('file-container');
        const btnUrl = document.getElementById('btn-url');
        const btnFile = document.getElementById('btn-file');
        if (type === 'url') {
            urlCont.classList.remove('hidden');
            fileCont.classList.add('hidden');
            btnUrl.classList.add('active');
            btnFile.classList.remove('active');
        } else {
            urlCont.classList.add('hidden');
            fileCont.classList.remove('hidden');
            btnFile.classList.add('active');
            btnUrl.classList.remove('active');
        }
    }

    const dropzone = document.getElementById('dropzone');
    const fileInput = document.getElementById('file-input');
    const imgPreview = document.getElementById('image-preview');
    const overlay = document.getElementById('preview-overlay');

    dropzone.addEventListener('click', () => fileInput.click());
    dropzone.addEventListener('dragover', e => {
        e.preventDefault();
        dropzone.classList.add('drag-over');
    });
    ['dragleave', 'drop'].forEach(ev => dropzone.addEventListener(ev, () => dropzone.classList.remove('drag-over')));
    dropzone.addEventListener('drop', e => {
        e.preventDefault();
        handleFile(e.dataTransfer.files[0]);
    });
    fileInput.addEventListener('change', e => handleFile(e.target.files[0]));

    function handleFile(file) {
        if (!file || !file.type.startsWith('image/')) return;
        const reader = new FileReader();
        reader.onload = e => {
            imgPreview.src = e.target.result;
            overlay.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
        const dt = new DataTransfer();
        dt.items.add(file);
        fileInput.files = dt.files;
    }

    function clearImage() {
        overlay.classList.add('hidden');
        fileInput.value = '';
    }

    const inputDisp = document.getElementById('display_price');
    const inputReal = document.getElementById('real_price');
    inputDisp.addEventListener('keyup', function() {
        let val = this.value.replace(/[^0-9]/g, '');
        inputReal.value = val;
        this.value = val.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    });

    document.getElementById('editForm').addEventListener('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Simpan Perubahan?',
            text: 'Data produk akan diperbarui.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#BFA26A',
            cancelButtonColor: '#1A1A26',
            confirmButtonText: 'Ya, Perbarui',
            cancelButtonText: 'Batal',
            background: '#0F0F17',
            color: '#C8C4BE',
        }).then(res => {
            if (res.isConfirmed) this.submit();
        });
    });
    </script>
</body>

</html>