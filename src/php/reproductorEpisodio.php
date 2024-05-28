<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Player</title>
    <link rel="stylesheet" href="https://cdn.plyr.io/3.6.8/plyr.css">
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/reproductorEpisodio.css">
</head>
<body>
    <video id="myVideo" class="video-js vjs-default-skin" controls>
        <source id="mySource" src="../img/Episodios/13-1-1-prueba.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <script src="https://cdn.plyr.io/3.6.8/plyr.js"></script>
    <script>
        

        document.addEventListener('DOMContentLoaded', () => {
            const video = document.getElementById('myVideo');
            const player = new Plyr(video);

            // Espera a que el evento 'ready' de Plyr se active
            player.addEventListener('ready', event => {
                console.log('Plyr ready');
                const progressInput = player.elements.inputs.seek;
                const nativeDuration = video.duration;

                // Actualiza manualmente los atributos de la barra de progreso
                if (progressInput) {
                    progressInput.setAttribute('max', nativeDuration);
                }
            });

        });

        const urlParams = new URLSearchParams(window.location.search);
        const vid = urlParams.get('src');
        if(vid != null || vid != ""){
            console.log("hola");
            document.getElementById('mySource').src = vid;
        }
    </script>
</body>
</html>
