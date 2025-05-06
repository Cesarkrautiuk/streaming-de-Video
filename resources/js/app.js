import './bootstrap';
import Uppy from '@uppy/core';
import Dashboard from '@uppy/dashboard';
import XHRUpload from '@uppy/xhr-upload';
import ThumbnailGenerator from '@uppy/thumbnail-generator';

import '@uppy/core/dist/style.css';
import '@uppy/dashboard/dist/style.css';
import pt_BR from '@uppy/locales/lib/pt_BR.js';

document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('drag-drop-area');
    if (!container) return;

    const uppy = new Uppy({
        locale: pt_BR,
        autoProceed: false,
        restrictions: {
            maxFileSize: 2_147_483_648,
            allowedFileTypes: ['video/*'],
            maxNumberOfFiles: 1,
        },
    });
    const titleInput = document.getElementById('video-title');
    const descInput = document.getElementById('video-description');

    titleInput?.addEventListener('input', (e) => {
        uppy.setMeta({title: e.target.value});
    });
    descInput?.addEventListener('input', (e) => {
        uppy.setMeta({description: e.target.value});
    });

    uppy.use(Dashboard, {
        inline: true,
        target: container,
        showProgressDetails: true,
        showSelectedFiles: true,
        note: 'Arraste ou selecione um vídeo (max 2 GB)',
        proudlyDisplayPoweredByUppy: false,
        theme: 'dark',
        browserBackButtonClose: true,
    });

    uppy.use(XHRUpload, {
        endpoint: '/upload-video',
        fieldName: 'video',
        allowedMetaFields: ['title', 'description'],
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
    });


    uppy.on('upload-success', (file, resp) => {
        document.getElementById('status').innerText =
            resp.body.message || 'Upload concluído em background.';
        document.getElementById('video-title').value = '';
        document.getElementById('video-description').value = '';
        uppy.setMeta({title: '', description: ''});

    });

    uppy.on('upload-error', (file, err) => {
        document.getElementById('status').innerText = 'Erro no upload.';
        console.error(err);
    });
});
