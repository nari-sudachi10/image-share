function showTab(tab) {

    document.querySelectorAll(".tab-content")
        .forEach(t => t.classList.remove("active"));

    document.querySelectorAll(".tab-btn")
        .forEach(t => t.classList.remove("active"));

    document.getElementById(tab).classList.add("active");

    event.target.classList.add("active");
}

function copyText() {

    const text = document.getElementById("copyText").value;

    navigator.clipboard.writeText(text)
        .then(() => {
            alert("コピーしました！");
        })
        .catch(() => {
            alert("コピーに失敗しました");
        });
}

function copyClip(id){

    const text=document.getElementById("clip"+id);

    navigator.clipboard.writeText(text.value);

}

function clearClip(id){

    document.getElementById("clip"+id).value="";

}

function saveClip(id){

const text=document.getElementById("clip"+id).value;

fetch("save_clip.php",{

method:"POST",

headers:{
"Content-Type":
"application/x-www-form-urlencoded"
},

body:
"id="+id+
"&text="+encodeURIComponent(text)

});

}
