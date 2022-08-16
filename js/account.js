

const regPart = document.getElementById("register");
const logPart = document.getElementById("login");
const logNav = document.getElementById("logBtn");
const regNav = document.getElementById("regBtn");

regPart.style.display = "none";
logPart.style.display = "block";
logNav.style.backgroundColor = "teal";
logNav.style.color = "white";

logNav.addEventListener("click", (e)=> {
    e.preventDefault();
    if(regPart.style.display === "none"){
        return false;
    }else {
        regPart.style.display = "none";
        logPart.style.display = "block";
        logNav.style.backgroundColor = "teal";
        logNav.style.color = "white";
        regNav.style.backgroundColor = "white";
        regNav.style.color = "teal";
    }
})

regNav.addEventListener("click", (e)=> {
    e.preventDefault();
    if(regPart.style.display === "none"){
        regPart.style.display = "block";
        logPart.style.display = "none";
        regNav.style.backgroundColor = "teal";
        regNav.style.color = "white";
        logNav.style.backgroundColor = "white";
        logNav.style.color = "teal";
    }else {
        return false;
    }
})
