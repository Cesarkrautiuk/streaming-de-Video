<p align="center" ><img src="https://i.ibb.co/5g3VFPbM/tube.jpg" alt="tube" border="0"></p>

## Streaming de Vídeo 
Sistema para upload e conversão de vídeos, com formulário para cadastro de novos vídeos.
## Tecnologias
- Laravel
- Mysql
- FFmpeg
- RabbitMQ
- Bootstrap
- JavaScript
## Funcionalidades
- Upload de Vídeos: Permite enviar arquivos de vídeo para o servidor.
  Os vídeos enviados são salvos em disco (pasta storage/app/private/upload) antes da conversão.
- Fila de Processamento: Vídeos são adicionados a uma fila para conversão no background.
- Conversão de Vídeos: Workers consomem a fila e executam o FFmpeg para converter arquivos para o formato MP4.
- Geração de Capas: Miniaturas (thumbnails) são geradas automaticamente,a uma fila para criação

## Uso
1. Acesse o formulário de cadastro e preencha os campos.
- Título
- Descrição
- Arquivo de Vídeo
2. Envie o formulário. O sistema irá:
- Salvar o vídeo em storage/app/private/upload.
- Adicionar uma tarefa de conversão à fila RabbitMQ.
3. Os workers de fila:
- Convertem o vídeo para MP4 usando FFmpeg.
- Envia para job de geração de thumbnail.
## Filas e Processamento
 Utilizamos filas para operações demoradas.
- RabbitMQ para enfileiramento de jobs de conversão e geração de thumbnails.
- Workers em Laravel Processam as filas de forma assíncrona.
- Desacoplamento: O ciclo de requisição–resposta não espera a conclusão do processamento.
## Imagens
<img src="https://i.ibb.co/4wC1S3BF/Captura-de-tela-2025-05-08-210422.png" alt="Captura-de-tela-2025-05-08-210422" border="0">
<img src="https://i.ibb.co/PGHmtwq3/Captura-de-tela-2025-05-08-210706.png" alt="Captura-de-tela-2025-05-08-210706" border="0">
