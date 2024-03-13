document.addEventListener("DOMContentLoaded", function() {
    var loader = document.getElementById("loader");
  
    function showLoader() {
      loader.classList.add("active");
    }
  
    function hideLoader() {
      loader.classList.remove("active");
    }
  
    // Simulate entrance loader
    showLoader();
  
    // Simulate exit loader after 3 seconds (adjust as needed)
    setTimeout(function() {
      hideLoader();
    }, 3000);
  });
  