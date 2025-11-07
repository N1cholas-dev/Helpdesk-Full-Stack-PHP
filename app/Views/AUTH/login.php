<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>LOGIN</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        /* Global Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            color: #fff;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            position: relative;
        }

        /* Background Image */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('<?= base_url("dist/img/earth2.jpg") ?>');
            /* Masukkan path gambar */
            background-size: cover;
            background-position: center;
            z-index: -2;
            /* Diletakkan di bawah semua elemen lainnya */
        }

        /* Background Canvas for Interactive Effect */
        #backgroundCanvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            /* Efek partikel tetap di atas background */
        }

        /* Header Text */
        .header-text {
            font-size: 24px;
            color: #fff;
            position: absolute;
            top: 120px;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            z-index: 1;
        }

        .header-text b {
            font-weight: bold;
        }

        /* Login Box */
        .login-box {
            background-color: #fff;
            color: #333;
            padding: 20px 25px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 300px;
            z-index: 2;
        }

        .login-title {
            font-size: 16px;
            font-weight: normal;
            color: #333;
            text-align: center;
            margin-bottom: 15px;
        }

        /* Label dan Input Field */
        .login-box label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            text-align: left;
        }

        .input-wrapper {
            position: relative;
            margin-bottom: 15px;
        }

        .input-wrapper input {
            width: 100%;
            padding: 10px;
            padding-left: 35px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .input-icon {
            position: absolute;
            top: 70%;
            left: 10px;
            transform: translateY(-50%);
            color: #007bff;
            font-size: 16px;
        }

        /* Remember Me dan Login */
        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .form-actions .remember-me {
            display: flex;
            align-items: center;
        }

        .form-actions .remember-me input[type="checkbox"] {
            margin-right: 5px;
            width: 16px;
            height: 16px;
        }

        .form-actions .remember-me label {
            font-size: 12px;
            color: #333;
            margin: 0;
            line-height: 16px;
        }

        .form-actions button {
            padding: 8px 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .form-actions button:hover {
            background-color: #0056b3;
        }

        /* Create Account dan Forgot Password */
        .create-forgot {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .create-forgot a {
            font-size: 14px;
            color: #007bff;
            text-decoration: none;
        }

        .create-forgot a:hover {
            text-decoration: underline;
        }
    </style>

</head>

<body>
    <!-- Interactive Canvas Background -->
    <canvas id="backgroundCanvas"></canvas>

    <!-- Header Text -->
    <div class="header-text"><b>Helpdesk</b> IT</div>

    <!-- Login Box -->
    <div class="login-box">
        <div class="login-title">Login to start your session</div>
        <form action="<?= site_url('login') ?>" method="post">
            <?= csrf_field(); ?>
            <div class="input-wrapper">
                <label for="email">Email</label>
                <i class="fas fa-user input-icon"></i>
                <input type="email" name="email" id="email" placeholder="Enter your email" required>
            </div>
            <div class="input-wrapper">
                <label for="password">Password</label>
                <i class="fas fa-lock input-icon"></i>
                <input type="password" name="password" id="password" placeholder="Enter your password" required>
            </div>
            <div class="form-actions">
                <div class="remember-me">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Remember Me</label>
                </div>
                <button type="submit">Login</button>
            </div>
            <div class="create-forgot">
                <a href="AUTH/register">Create Account</a>
                <a href="AUTH/forgot-password">Forgot Password?</a>
            </div>
        </form>
    </div>
    
    <script>
        const canvas = document.getElementById('backgroundCanvas');
        const ctx = canvas.getContext('2d');
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;

        let particles = [];
        const maxParticles = 100;
        const connectDistance = 100; // Jarak maksimal untuk menggambar garis antar partikel
        const mouse = { x: null, y: null, radius: 150 }; // Menentukan radius interaksi kursor

        class Particle {
            constructor() {
                this.x = Math.random() * canvas.width;
                this.y = Math.random() * canvas.height;
                this.size = Math.random() * 3 + 1;
                this.speedX = Math.random() * 2 - 1.5; // Kecepatan lebih cepat
                this.speedY = Math.random() * 2 - 1.5; // Kecepatan lebih cepat
            }

            update() {
                this.x += this.speedX;
                this.y += this.speedY;

                // Partikel kembali ke layar jika keluar dari batas
                if (this.x > canvas.width) this.x = 0;
                if (this.x < 0) this.x = canvas.width;
                if (this.y > canvas.height) this.y = 0;
                if (this.y < 0) this.y = canvas.height;

                // Interaksi kursor: memperbesar radius partikel saat kursor mendekat
                const dx = this.x - mouse.x;
                const dy = this.y - mouse.y;
                const distance = Math.sqrt(dx * dx + dy * dy);

                // Menarik garis ke kursor jika partikel berada dalam radius interaksi
                if (distance < mouse.radius) {
                    this.size = Math.min(this.size + 0.1, 5); // Membesar hingga ukuran tertentu
                    // Menggambar garis dari partikel ke kursor
                    ctx.strokeStyle = `rgba(255, 255, 255, ${1 - distance / mouse.radius})`;
                    ctx.lineWidth = 0.5;
                    ctx.beginPath();
                    ctx.moveTo(this.x, this.y);
                    ctx.lineTo(mouse.x, mouse.y);
                    ctx.stroke();
                } else {
                    this.size = Math.max(this.size - 0.1, 1); // Mengecil kembali
                }
            }

            draw() {
                ctx.fillStyle = 'rgba(255, 255, 255, 0.7)';
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                ctx.fill();
            }
        }

        // Update mouse position
        window.addEventListener('mousemove', (e) => {
            mouse.x = e.x;
            mouse.y = e.y;
        });

        // Create particles
        function createParticles() {
            for (let i = 0; i < maxParticles; i++) {
                particles.push(new Particle());
            }
        }

        function animateParticles() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            for (let i = 0; i < particles.length; i++) {
                particles[i].update();
                particles[i].draw();

                // Menggambar garis antar partikel jika dekat satu sama lain
                for (let j = i; j < particles.length; j++) {
                    const dx = particles[i].x - particles[j].x;
                    const dy = particles[i].y - particles[j].y;
                    const distance = Math.sqrt(dx * dx + dy * dy);
                    if (distance < connectDistance) {
                        ctx.strokeStyle = `rgba(255, 255, 255, ${1 - distance / connectDistance})`;
                        ctx.lineWidth = 0.5;
                        ctx.beginPath();
                        ctx.moveTo(particles[i].x, particles[i].y);
                        ctx.lineTo(particles[j].x, particles[j].y);
                        ctx.stroke();
                    }
                }
            }
            requestAnimationFrame(animateParticles);
        }
        createParticles();
        animateParticles();

    </script>

</body>

</html>