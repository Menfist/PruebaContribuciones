document.addEventListener("DOMContentLoaded", function () {
    const avatars = [
          "Avatar1.png", 
        "Avatar2.png", 
        "Avatar3.png", 
        "Avatar4.png", 
        "Avatar5.png", 
        "Avatar6.png",
        "Avatar7.png",
        "Avatar8.png",
        "Avatar9.png",
        "Avatar10.png"
    ];
    // Seleccionar avatar aleatorio
    const randomAvatar = avatars[Math.floor(Math.random() * avatars.length)];
    // Asignar avatar al campo oculto y mostrarlo
    document.getElementById("avatar").value = randomAvatar;
    document.getElementById("avatarPreview").innerHTML = `<img src="avatars/${randomAvatar}" alt="Avatar" width="100">`;
});