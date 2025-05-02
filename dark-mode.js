// Function to apply the saved theme on all pages
function applyDarkMode() {
    const isDarkMode = localStorage.getItem("darkMode") === "enabled";
    if (isDarkMode) {
        document.documentElement.classList.add("dark");
    } else {
        document.documentElement.classList.remove("dark");
    }
}

// Function to toggle dark mode and save the preference
function toggleDarkMode() {
    const isDarkMode = document.documentElement.classList.toggle("dark");
    localStorage.setItem("darkMode", isDarkMode ? "enabled" : "disabled");
}

// Run when the page loads
document.addEventListener("DOMContentLoaded", function () {
    applyDarkMode(); // Apply saved dark mode setting

    // Attach event listener to the button
    const themeToggle = document.getElementById("theme-toggle");
    if (themeToggle) {
        themeToggle.addEventListener("click", toggleDarkMode);
    }
});
