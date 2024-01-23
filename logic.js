let icon = document.getElementById("lightdark");
let logo = document.getElementById("logoimg");
let footlogo = document.getElementById("footerlogo");
let twitter = document.getElementById("twitter");
let insta = document.getElementById("insta");
let facebook = document.getElementById("facebook");
let text = document.getElementById("main-text"); 
let signinlogo = document.getElementById("signinlogo");
let signuplogo = document.getElementById("img-logo");
let logmeout = document.getElementById("logmeout");
icon.onclick = function toggleTheme() {
    const currentTheme = document.documentElement.getAttribute("data-bs-theme");
    if (currentTheme === "light") {
        document.documentElement.setAttribute("data-bs-theme", "dark");
        icon.src = "./assets/images/icons8-sun-50.png";
        logo.src = "./assets/images/dark_logo.png";
        footlogo.src = "./assets/images/dark_logo.png";
        twitter.src = "./assets/images/dark_twitter.png";
        insta.src = "./assets/images/insta_dark.png";
        facebook.src = "./assets/images/facebook_dark.png";
        signinlogo.src = "./assets/images/register-logo-dark.png";
        signuplogo.src = "./assets/images/register-logo-dark.png";
        logmeout.src = "./assets/images/logmeout-dark.png";
        text.style.color = "rgb(23, 69, 252)";
    } 
    else {
        document.documentElement.setAttribute("data-bs-theme", "light");
        icon.src = "./assets/images/icons8-moon-100.png";
        logo.src = "./assets/images/light_logo.png";
        footlogo.src = "./assets/images/light_logo.png";
        twitter.src = "./assets/images/icons8-twitter-50.png";
        insta.src = "./assets/images/icons8-instagram-50.png";
        facebook.src = "./assets/images/icons8-facebook-50.png";
        signinlogo.src = "./assets/images/register-logo.png";
        signuplogo.src = "./assets/images/register-logo.png";
        logmeout.src = "./assets/images/logmeout.png";
        text.style.color = "rgb(0, 0, 150)";
        }
    }

/*let icon = document.getElementById("lightdark");
let logo = document.getElementById("logoimg");
let footlogo = document.getElementById("footerlogo");
let twitter = document.getElementById("twitter");
let insta = document.getElementById("insta");
let facebook = document.getElementById("facebook");
let text = document.getElementById("main-text");
let signinlogo = document.getElementById("signinlogo");

// Function to toggle theme
function toggleTheme() {
    const currentTheme = document.documentElement.getAttribute("data-bs-theme");
    const isDarkMode = currentTheme === "dark";

    if (!isDarkMode) {
        enableDarkMode();
    } else {
        disableDarkMode();
    }

    // Save user preference to local storage
    localStorage.setItem('darkMode', isDarkMode);
}

// Function to enable dark mode
function enableDarkMode() {
    document.documentElement.setAttribute("data-bs-theme", "dark");
    icon.src = "./assets/images/icons8-sun-50.png";
    logo.src = "./assets/images/dark_logo.png";
    footlogo.src = "./assets/images/dark_logo.png";
    twitter.src = "./assets/images/dark_twitter.png";
    insta.src = "./assets/images/insta_dark.png";
    facebook.src = "./assets/images/facebook_dark.png";
    text.style.color = "rgb(23, 69, 252)";
    signinlogo.src = "./assets/images/icons8-share-24.png";
}

// Function to disable dark mode
function disableDarkMode() {
    document.documentElement.setAttribute("data-bs-theme", "light");
    icon.src = "./assets/images/icons8-moon-100.png";
    logo.src = "./assets/images/light_logo.png";
    footlogo.src = "./assets/images/light_logo.png";
    twitter.src = "./assets/images/icons8-twitter-50.png";
    insta.src = "./assets/images/icons8-instagram-50.png";
    facebook.src = "./assets/images/icons8-facebook-50.png";
    text.style.color = "rgb(0, 0, 150)";
    signinlogo.src = "./assets/images/share-fill.svg";
}

// Check if user has a dark mode preference
const hasDarkModePreference = localStorage.getItem('darkMode') === 'true';

// Apply dark mode if user has a preference
if (hasDarkModePreference) {
    enableDarkMode();
}

// Attach the toggleTheme function to the icon's click event
icon.onclick = toggleTheme;
*/
