// Tampilkan/Menyembunyikan Kata Sandi
const togglePassword = document.querySelector("#togglePassword");
const passwordField = document.querySelector("#exampleInputPassword");

togglePassword.addEventListener("click", function () {
    const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
    passwordField.setAttribute("type", type);

    if (type === "text") {
        this.classList.remove("fa-eye-slash");
        this.classList.add("fa-eye");
        this.style.color = "red";
    } else {
        this.classList.remove("fa-eye");
        this.classList.add("fa-eye-slash");
        this.style.color = "grey";
    }
});

togglePassword.addEventListener("mouseenter", function () {
    this.style.color = "red";
});

togglePassword.addEventListener("mouseleave", function () {
    if (passwordField.getAttribute("type") === "password") {
        this.style.color = "grey";
    } else {
        this.style.color = "red";
    }
});

// Cegah aksi copy dan paste pada input
document.querySelectorAll('.form-control-user').forEach(input => {
    input.addEventListener('paste', function (event) {
        event.preventDefault();
        Swal.fire({
            icon: 'warning',
            title: 'Aksi Tidak Diizinkan',
            text: 'Anda tidak diizinkan untuk melakukan tempel teks!',
            confirmButtonText: 'OK',
        });
    });

    input.addEventListener('copy', function (event) {
        event.preventDefault();
        Swal.fire({
            icon: 'warning',
            title: 'Aksi Tidak Diizinkan',
            text: 'Anda tidak diizinkan untuk menyalin teks!',
            confirmButtonText: 'OK',
        });
    });
});

// Tampilkan informasi Tim Pengembang
document.getElementById("developerTeam").addEventListener("click", function (event) {
    event.preventDefault();

    Swal.fire({
        title: 'Tim Pengembang',
        html: `
            <div class="popup-content">
                <img src="./img/sipelita.jpg" alt="Logo" class="popup-logo">
                <hr>
                <img src="./img/developer.jpg" alt="Tim Pengembang" class="popup-image">
                <div class="popup-footer">
                    <button class="swal2-confirm swal2-styled" onclick="Swal.close()">Tutup</button>
                </div>
            </div>
        `,
        showConfirmButton: false,
        showCloseButton: true,
        customClass: {
            popup: 'swal2-full-popup',
        }
    });
});
