<!DOCTYPE html>
<html lang="pt-br" data-bs-theme="dark">
<head>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <!-- Bootstrap 5 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT"
        crossorigin="anonymous"
    />
</head>
<body>
<nav class="nav">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" width="220" height="129">
        </a>
    </div>
</nav>
<div class="container py-5">
    <h1 class="text-center mb-5">📹 Envie seu Vídeo</h1>
    <div class="row g-4">
        <div class="col-12 col-lg-4">
            <div class="form-section">
                <h5 class="mb-3">Detalhes do Vídeo</h5>
                <form id="video-metadata" class="row g-3">
                    <div class="col-12">
                        <label for="video-title" class="form-label">Título</label>
                        <input
                            type="text"
                            id="video-titulo"
                            name="titulo"
                            class="form-control form-control-dark"
                            placeholder="Digite o título…"
                            required
                        />
                    </div>
                    <div class="col-12">
                        <label for="video-description" class="form-label">Descrição</label>
                        <textarea
                            id="video-descricao"
                            name="descricao"
                            class="form-control form-control-dark"
                            rows="3"
                            placeholder="Digite a descrição…"
                        ></textarea>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12 col-lg-8">
            <div class="card card-uploader p-3">
                <div id="drag-drop-area"></div>
                <div id="status" class="mt-3 text-center text-muted">Aguardando envio…</div>
            </div>
        </div>

    </div>
</div>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-3sL5A9ZJPJ+XoBLxcI+7pz6YWpL0FifDFy0Q0nXqOcVAFh6K4RM+qGiDQhOT2Pdv"
    crossorigin="anonymous"
></script>

</body>
</html>
