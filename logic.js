let icon = document.getElementById("lightdark");
let logo = document.getElementById("logoimg");
let footlogo = document.getElementById("footerlogo");
let twitter = document.getElementById("twitter");
let insta = document.getElementById("insta");
let facebook = document.getElementById("facebook");
let text = document.getElementById("main-text"); 
let signinlogo = document.getElementById("signinlogo");
icon.onclick = function toggleTheme() {
    const currentTheme = document.documentElement.getAttribute("data-bs-theme");
    if (currentTheme === "light") {
        document.documentElement.setAttribute("data-bs-theme", "dark");
        icon.src = "./assets/images/icons8-sun-50.png";
        logo.src = "./assets/images/icons8-share-24.png";
        footlogo.src = "./assets/images/icons8-share-24.png";
        twitter.src = "./assets/images/dark_twitter.png";
        insta.src = "./assets/images/insta_dark.png";
        facebook.src = "./assets/images/facebook_dark.png";
        text.style.color = "rgb(23, 69, 252)";
        signinlogo.src = "./assets/images/icons8-share-24.png";
    } 
    else {
        document.documentElement.setAttribute("data-bs-theme", "light");
        icon.src = "./assets/images/icons8-moon-100.png";
        logo.src = "./assets/images/share-fill.svg";
        footlogo.src = "./assets/images/icons8-share-32.png";
        twitter.src = "./assets/images/icons8-twitter-50.png";
        insta.src = "./assets/images/icons8-instagram-50.png";
        facebook.src = "./assets/images/icons8-facebook-50.png";
        text.style.color = "rgb(0, 0, 150)";
        signinlogo.src = "./assets/images/share-fill.svg";
        }
    }
