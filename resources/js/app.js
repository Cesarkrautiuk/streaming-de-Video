import './bootstrap';
import Uppy from '@uppy/core';
import Dashboard from '@uppy/dashboard';
import XHRUpload from '@uppy/xhr-upload';
import '@uppy/core/dist/style.css';
import '@uppy/dashboard/dist/style.css';

document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('drag-drop-area');
    if (!container) return;

    const uppy = new Uppy({
        restrictions: {
            maxFileSize: 2_147_483_648, // 2 GB
            allowedFileTypes: ['video/*'],
            maxNumberOfFiles: 1,
        },
    });

    uppy.use(Dashboard, {
        inline: true,
        target: container,
        showProgressDetails: true,
        note: 'Arraste ou selecione um vídeo (max 2 GB)',
        proudlyDisplayPoweredByUppy: false,
    });

    uppy.use(XHRUpload, {
        endpoint: '/upload-video',
        fieldName: 'video',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                .content,
        },
    });
    uppy.on('upload-success', (file, resp) => {
        const status = document.getElementById('status');
        if (status)
            status.innerText =
                resp.body.message || 'Upload concluído em background.';
    });

    uppy.on('upload-error', (file, err) => {
        const status = document.getElementById('status');
        if (status) status.innerText = 'Erro no upload.';
        console.error(err);
    });
});
