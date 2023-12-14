// Show the loading screen
function showLoadingScreen() {
    document.getElementById('loader-container').style.opacity = '1';
  }
  
  // Hide the loading screen
  function hideLoadingScreen() {
    document.getElementById('loader-container').style.opacity = '0';
  }
  
  // Call the showLoadingScreen function immediately on page load
  showLoadingScreen();
  
  // Call the hideLoadingScreen function after a certain delay (e.g., 2 seconds)
  setTimeout(hideLoadingScreen, 3000);
  