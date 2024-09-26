document.addEventListener("DOMContentLoaded", function () {
    const avatars = [
          "Avatar1.jpeg",
          "Avatar2.jpeg",
          "Avatar3.jpeg",
          "Avatar4.jpeg",
          "Avatar5.jpeg",
          "Avatar6.jpeg",
          "Avatar7.jpeg",
          "Avatar8.jpeg",
          "Avatar9.jpeg",
          "Avatar10.jpeg"


    ];

    // Seleccionar avatar aleatorio
    const randomAvatar = avatars[Math.floor(Math.random() * avatars.length)];

    // Asignar avatar al campo oculto y mostrarlo
    document.getElementById("avatar").value = randomAvatar;
    document.getElementById("avatarPreview").innerHTML = `<img src="avatars/${randomAvatar}" alt="Avatar" width="100">`;
});