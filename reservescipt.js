// Show the loading screen when the page starts loading or refreshed
document.addEventListener('DOMContentLoaded', function () {
    var loadingScreen = document.querySelector('.loading-screen');
    if (loadingScreen) {
      loadingScreen.style.display = 'flex'; // Show the loading screen
    }
  });
  
  // Hide the loading screen when the page is fully loaded
  window.addEventListener('load', function () {
    var loadingScreen = document.querySelector('.loading-screen');
    if (loadingScreen) {
      loadingScreen.style.display = 'none'; // Hide the loading screen
    }
  });
  