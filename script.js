// Show the loading screen when the page starts loading or refreshed
document.addEventListener('DOMContentLoaded', function () {
  var loadingScreen = document.querySelector('.loading-screen');
  if (loadingScreen) {
    loadingScreen.style.display = 'flex'; // Show the loading screen
  }
});

// Hide the loading screen when the page is fully loaded after a random delay
window.addEventListener('load', function () {
  var randomDelay = Math.floor(Math.random() * (700 - 200 + 1)) + 200; // Random number between 300 and 800
  setTimeout(function() {
    var loadingScreen = document.querySelector('.loading-screen');
    if (loadingScreen) {
      loadingScreen.style.display = 'none'; // Hide the loading screen
    }
  }, randomDelay); 
});
