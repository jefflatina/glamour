window.addEventListener('DOMContentLoaded', () => {
    const audio = new Audio('CSS/Pictures/bgmusic.mp3');
    audio.volume = 0.5; // Adjust the volume as needed
    audio.loop = true; // Enable looping of the music
  
    // Play the music when the audio is loaded
    audio.addEventListener('canplaythrough', () => {
      audio.play();
    });
  
    // Pause the music when navigating away from the website
    window.addEventListener('beforeunload', () => {
      audio.pause();
    });
  });
  