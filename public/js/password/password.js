let iconPassword = document.getElementById("icon-password").addEventListener("click", toggleSenha);
let inputPassword = document.getElementsByName("password")[0];

function toggleSenha(){
    let type = inputPassword.type;
    if(type === "password"){
        inputPassword.type = "text";
        this.className = "fas fa-eye-slash"
    } else {
        inputPassword.type = "password";
        this.className = "fas fa-eye"
    }
}