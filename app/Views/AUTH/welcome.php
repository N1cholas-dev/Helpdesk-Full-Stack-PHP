<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Welcome</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        /* Global Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            color: #fff;
            overflow-x: hidden;
        }

        /* Background Image */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background-image: url('<?= base_url("dist/img/earth2.jpg") ?>');
            background-size: cover;
            background-position: center;
            z-index: -1;
        }

        /* Header */
        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: rgba(255, 255, 255, 0);
            /* Transparent initially */
            padding: 12px 20px;
            z-index: 10;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        header.scrolled {
            background-color: rgba(255, 255, 255, 1);
            /* White background when scrolled */
            color: #000;
            /* Text color changes to black */
        }

        .logo {
            width: 100px;
            /* Adjusted logo size */
        }

        .about-btn {
            color: #fff;
            /* Initially white */
            font-size: 20px;
            /* Enlarged font size */
            cursor: pointer;
            text-decoration: none;
            padding: 5px 10px;
            position: fixed;
            /* Fixed position for About button */
            top: 45px;
            right: 40px;
            z-index: 20;
            transition: color 0.3s ease;

        }

        .about-btn.scrolled {
            color: #000;
            /* Changes to black when header turns white */
        }

        .about-btn:hover {
            text-decoration: underline;
        }

        /* Welcome Section */
        .welcome-page {
            margin-top: 60px;
            /* Adjusted margin for header */
            height: calc(100vh - 60px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            /* Center content vertically */
            align-items: center;
            text-align: center;
        }

        .header-text {
            font-size: 48px;
            /* Bigger font for welcome */
            font-weight: bold;
            margin-bottom: 10px;
        }

        .description-text {
            font-size: 24px;
            /* Adjusted font size for better alignment */
            margin-bottom: 30px;
        }

        .buttons-container {
            margin-top: 20px;
        }

        .download-btn {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 16px;
        }

        .download-btn:hover {
            background-color: #0056b3;
        }

        /* Helpdesk Body */
        .helpdesk-body {
            background-color: #111;
            color: #fff;
            padding: 50px 20px;
            text-align: center;
        }

        .helpdesk-body h3 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .helpdesk-body p {
            line-height: 1.8;
            max-width: 800px;
            margin: 0 auto 20px;
        }

        .helpdesk-body .download-btn {
            margin-top: 30px;
            /* Space below text */
        }

        /* Footer */
        footer {
            background-color: #222;
            color: #ccc;
            padding: 20px;
            text-align: center;
        }

        /* Scroll Up Icon */
        .scroll-up {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            background-color: rgba(0, 0, 0, 0.6);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
        }

        .scroll-up.visible {
            opacity: 1;
            visibility: visible;
        }

        .scroll-up:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }
    </style>

</head>

<body>
    <!-- Header -->
    <header id="header">
        <img src="<?= base_url('dist/img/robot.png') ?>" alt="Helpdesk Logo" class="logo">
        <a href="javascript:void(0);" class="about-btn" onclick="scrollToHelpdesk()">About</a>
    </header>

    <!-- Welcome Page -->
    <div class="welcome-page">
        <div class="header-text">Welcome to Helpdesk</div>
        <div class="description-text">Silahkan masuk untuk membuat tiket</div>
        <div class="buttons-container">
            <a href="/login" class="download-btn">Masuk</a>
        </div>
    </div>

    <!-- Helpdesk Body -->
    <div id="helpdesk" class="helpdesk-body">
        <h3>Butuh Bantuan?</h3>
        <p>
            Helpdesk adalah solusi yang kalian butuhkan untuk mendapatkan bantuan dari Departement IT.
            Klik tombol masuk untuk membuat tiket atau silahkan download/unduh file <b>Manual Book</b>
            untuk mempelajari tata cara penggunaan Helpdesk.<br>
            <b>"No Ticket No Support!"</b><br><br>
            Helpdesk memberikan kemudahan bagi Anda untuk mengajukan tiket dukungan terkait masalah IT
            yang Anda hadapi. Proses pembuatan tiket sangat mudah, cukup klik tombol 'Masuk' dan lengkapi
            informasi yang diperlukan.
        </p>
        <a href="#" class="download-btn">Unduh Manual Book</a>
    </div>

    <!-- Footer -->
    <footer>
        All Rights Reserved &copy; Helpdesk IT 2024
    </footer>

    <!-- Scroll Up Icon -->
    <div class="scroll-up" id="scrollUp">
        <i class="fas fa-chevron-up"></i>
    </div>

    <script>
        // Scroll to Helpdesk Section with smooth animation
        function scrollToHelpdesk() {
            const element = document.getElementById("helpdesk");
            if (element) {
                element.scrollIntoView({
                    behavior: "smooth"
                });
            } else {
                console.error("Element with ID 'helpdesk' not found");
            }
        }

        // Change Header Background and About Button Color on Scroll
        window.addEventListener("scroll", function () {
            const header = document.getElementById("header");
            const aboutBtn = document.querySelector(".about-btn");
            const scrollUp = document.getElementById("scrollUp");
            if (window.scrollY > 50) {
                header.classList.add("scrolled");
                aboutBtn.classList.add("scrolled"); // Change color of About button
                scrollUp.classList.add("visible");
            } else {
                header.classList.remove("scrolled");
                aboutBtn.classList.remove("scrolled");
                scrollUp.classList.remove("visible");
            }
        });

        // Scroll to Top
        document.getElementById("scrollUp").addEventListener("click", function () {
            window.scrollTo({
                top: 0,
                behavior: "smooth",
            });
        });

    </script>

</body>

</html>