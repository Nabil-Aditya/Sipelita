<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./img/icon-tittle-sipelita.jpg">
    <!-- css loader -->
    <link href="css/loader.css" rel="stylesheet">

</head>

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
