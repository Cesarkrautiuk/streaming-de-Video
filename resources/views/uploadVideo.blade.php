<!DOCTYPE html>
<html lang="pt-br">
<head>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<h1>Enviar Vídeo</h1>

<div id="drag-drop-area"></div>
<div id="status" style="margin-top:1em;">Aguardando envio…</div>
</body>
</html>

