<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Server sent events demo</title>
</head>
<body>
    <p>
        <button id="start">Start test</button>
        <button id="clean">Clean</button>
    </p>
    <p>
        Progress: <span id="progress">0</span>%
    </p>
    <p>
        <progress id="progress2" value="0" max="100"></progress>
    </p>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const button = document.getElementById('start');
            const clean = document.getElementById('clean');
            const progress = document.getElementById('progress');
            const progress2 = document.getElementById('progress2');
            let eventSource = null;

            button.addEventListener('click', function () {
                eventSource = new EventSource('http://localhost:3333/test');
                eventSource.addEventListener('onProgress', (event) => {
                    console.log('Data from event source', event);
                    progress.innerText = event.data;
                    progress2.value = event.data;
                    if (event.lastEventId === '100') {
                        eventSource.close();
                    }
                });
            });

            clean.addEventListener('click', function () {
                if (event !== null) {
                    eventSource.close();
                }
                progress.innerText = 0;
                progress2.value = 0;
            });
        });
    </script>
</body>
</html>