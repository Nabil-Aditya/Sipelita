<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./img/icon-tittle-sipelita.jpg">
</head>

<style>
    /* Loader Styles */
    #loader {
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: white;
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: opacity 0.5s ease;
    }

    /* New Loader Styles */
    .loader {
        width: 40px; /* Ukuran disesuaikan dengan yang lama */
        aspect-ratio: 1;
        border-radius: 50%;
        background: rgb(25, 25, 112); /* Warna biru */
        box-shadow: 0 0 0 0 rgba(25, 25, 112, 0.4); /* Shadow dengan warna biru */
        animation: l2 1.5s infinite linear;
        position: relative;
    }

    .loader:before,
    .loader:after {
        content: "";
        position: absolute;
        inset: 0;
        border-radius: inherit;
        box-shadow: 0 0 0 0 rgba(25, 25, 112, 0.4);
        animation: inherit;
        animation-delay: -0.5s;
    }

    .loader:after {
        animation-delay: -1s;
    }

    @keyframes l2 {
        100% {
            box-shadow: 0 0 0 40px rgba(25, 25, 112, 0);
        }
    }

    /* Hide the content until the loader is finished */
    .content {
        display: none;
    }
</style>

<body>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            window.addEventListener("load", function () {
                const loader = document.getElementById("loader");
                const content = document.querySelector(".content");

                setTimeout(function () {
                    loader.style.opacity = "0"; // Fade-out loader
                    loader.style.transition = "opacity 0.5s ease"; // Smooth transition

                    setTimeout(function () {
                        loader.style.display = "none"; // Sembunyikan loader
                        content.style.display = "block"; // Tampilkan konten halaman
                    }, 500); // Tunggu 500ms agar transisi fade-out selesai
                }, 500); // Loader akan terlihat selama setidaknya  setengah detik
            });
        });
    </script>

    <!-- Loader -->
    <div id="loader">
        <div class="loader"></div>
    </div>

</body>

</html>
