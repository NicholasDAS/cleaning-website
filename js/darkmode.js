/*   in this file, you will
   - Toggles dark mode on click
   - Saves mode to localStorage
   - Restores mode on page load
  */

document.addEventListener("DOMContentLoaded", () => {
    
    const toggleBtn = document.getElementById("darkToggle");
    const body = document.body;

    // load saved mode from localStorage
    let savedMode = localStorage.getItem("dashboardMode");

    if (savedMode === "dark") {
        body.classList.add("dark-mode");
        if (toggleBtn) toggleBtn.innerHTML = `<i class="fas fa-sun"></i> Light Mode`;
    } else {
        if (toggleBtn) toggleBtn.innerHTML = `<i class="fas fa-moon"></i> Dark Mode`;
    }

    // toggle mode on click
    if (toggleBtn) {
        toggleBtn.addEventListener("click", () => {

            body.classList.toggle("dark-mode");

            if (body.classList.contains("dark-mode")) {
                localStorage.setItem("dashboardMode", "dark");
                toggleBtn.innerHTML = `<i class="fas fa-sun"></i> Light Mode`;
            } else {
                localStorage.setItem("dashboardMode", "light");
                toggleBtn.innerHTML = `<i class="fas fa-moon"></i> Dark Mode`;
            }
        });
    }

});
