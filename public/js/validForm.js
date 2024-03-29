document
    .getElementById("creer_compte_tel")
    .addEventListener("focusout", function (event) {
        img = document.getElementById("creer_compte_tel").value;
        let regex = /^(0[1-9])(?:[0-9]{8})$/;
        let btn = document.querySelector("[type='submit']");
        console.log(btn);
        if (img.search(regex) != -1){
            document.getElementById("erreur").innerText="";
            btn.disabled = false;
        }

        else {document.getElementById("erreur").innerText="Invalide";
            btn.disabled = true;}
    })  

document
    .getElementById("creer_compte_mel")
    .addEventListener("focusout", function (event) {
        img = document.getElementById("creer_compte_mel").value;
        let mel = /^\S+@\S+\.\S+$/;
        let btn = document.querySelector("[type='submit']");
        console.log(btn);
        if (img.search(mel) != -1) {
            document.getElementById("erreur_mel").innerText = "";
            btn.disabled = false;}
        else { document.getElementById("erreur_mel").innerText = "Invalide";
            btn.disabled = true; }
    })  