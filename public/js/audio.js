let grabando = document.getElementById("grabando");
let startButton = document.getElementById("start");
let stopButton = document.getElementById("stop");
let grabacion = document.getElementById("grabacion");
let reproducir = document.getElementById("reproducir");

startButton.addEventListener("click", () => {
    navigator.mediaDevices.getUserMedia({ audio: true, video: false })
        .then(handleSuccess)
        .catch(() => {
            navigator.permissions.query({name: 'microphone'}).then(function (result) {
                if (result.state == 'prompt') {
                    alert("Micrófono no permitido");
                } else if (result.state == 'denied') {
                    alert("Micrófono denegado");
                }
              });
        });
});

const handleSuccess = (stream) => {

    const options = {mimeType: 'audio/webm'};
    const recordedChunks = [];
    const mediaRecorder = new MediaRecorder(stream, options);

    stopButton.disabled = false;
    startButton.disabled = true;
    grabando.innerHTML = "Grabando...";

    mediaRecorder.addEventListener('dataavailable', (e) => {
    if (e.data.size > 0) recordedChunks.push(e.data);
    });

    mediaRecorder.addEventListener('stop', () => {
    // downloadLink.href = URL.createObjectURL(new Blob(recordedChunks));
    // downloadLink.download = 'acetest.wav';
    stopButton.disabled = true;
    startButton.disabled = false;
    let audioBlob = new Blob(recordedChunks);
    let file = new File([audioBlob], "audio.wav");
    let container = new DataTransfer();
    container.items.add(file);
    grabacion.files = container.files;
    reproducir.src = URL.createObjectURL(audioBlob);
    });

    stopButton.addEventListener('click', () => {
    mediaRecorder.stop();
    grabando.innerHTML = "";
    reproducir.hidden = false;
    });

    mediaRecorder.start();
};