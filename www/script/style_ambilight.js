var timerID;
window.onload = function() {
  canvas = document.getElementById('myCanvas');
  ctx = canvas.getContext('2d');

  var video = document.getElementById('video');

  video.addEventListener('play', function() {
    video.currentTime = 0;
    timerID = window.setInterval(function() {
      ctx.drawImage(video, 0, 0, 600, 460)
    }, 30);
  });

  video.addEventListener('pause', function() {
    stopTimer();
  });

  video.addEventListener('ended', function() {
    stopTimer();
  });
}