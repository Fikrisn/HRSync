<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRSync</title>
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            background-color: #f4f6f8;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Layout */
        .layout {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            position: relative;
        }

        /* Header */
        .header {
            background-color: #003366; /* Dark color for university elegance */
            padding: 10px 0;
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: space-between; /* Separate logo and menu */
            max-width: 1200px;
            margin: 0 auto;
        }

        .logo a {
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .logo img {
            height: 70px;
            vertical-align: middle;
        }

        .logo-text {
            font-size: 35px;
            margin-left: 1px;
            color: #ffffff;
            font-family: Arial, Helvetica, sans-serif;
        }

        /* Navigation Menu */
        .menu ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 5px; /* Space between menu items */
        }

        .menu ul li {
            display: inline;
        }

        .menu ul li a {
            color: #ffffff;
            text-decoration: none;
            font-size: 1em;
            padding: 10px 10px;
        }

        .menu ul li a:hover {
            color: #f0f0f0; /* Slight color change on hover */
        }

        .login-button {
            background-color: #0057b7; /* Button color for contrast */
            padding: 8px 12px;
            border-radius: 5px;
            color: #ffffff;
            font-weight: bold;
            text-decoration: none;
        }

        /* Main content */
        main {
            flex: 1;
            padding: 2rem;
            color: #1b2a49;
        }

        /* Section styling */
        /* Gaya untuk bagian kontak */
        .section {
            padding: 60px 0; /* Menambahkan ruang atas dan bawah */
            background-color: #f9f9f9; /* Warna latar belakang */
        }

        .section-title {
            font-size: 35px; /* Ukuran font untuk judul */
            font-weight: bold; /* Menebalkan font */
            text-align: left; /* Rata tengah */
            margin-bottom: 30px; /* Ruang bawah judul */
            color: #333; /* Warna teks judul */
        }

        .institution-name {
            font-size: 1.8rem; /* Ukuran font untuk nama institusi */
            margin: 10px 0; /* Ruang atas dan bawah */
            color: #007bff; /* Warna teks biru */
        }

        .address {
            font-size: 1rem; /* Ukuran font untuk alamat */
            color: #555; /* Warna teks alamat */
        }

        .card-body {
            margin-top: 40px; /* Ruang atas untuk card */
            padding: 20px; /* Ruang dalam untuk card */
            background-color: #fff; /* Warna latar belakang card */
            border-radius: 8px; /* Membulatkan sudut card */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Menambahkan bayangan */
        }

        .map-container {
            margin-top: 20px; /* Ruang atas untuk peta (lebih kecil untuk menjaga keselarasan) */
            text-align: center; /* Rata tengah untuk peta */
        }

        .map-container iframe {
            width: 100%; /* Lebar iframe 100% */
            height: 400px; /* Tinggi iframe yang lebih besar */
            border: 0; /* Menghilangkan border */
        }


        iframe {
            width: 100%; /* Lebar iframe 100% */
            height: 300px; /* Tinggi iframe */
            border: 0; /* Menghilangkan border */
        }


        .contact-header {
            font-size: 1.5rem; /* Ukuran font untuk header kontak */
            font-weight: bold; /* Menebalkan font */
            margin-bottom: 15px; /* Ruang bawah header */
            color: #333; /* Warna teks header */
        }

        .contact-list {
            list-style: none; /* Menghilangkan bullet point */
            padding: 0; /* Menghilangkan padding */
        }

        .contact-list li {
            margin-bottom: 10px; /* Ruang bawah untuk setiap item */
        }

        .contact-list a {
            text-decoration: none; /* Menghilangkan garis bawah */
            color: #007bff; /* Warna teks link */
            display: flex; /* Menggunakan flexbox */
            align-items: center; /* Rata tengah vertikal */
        }

        .contact-list a:hover {
            text-decoration: underline; /* Garis bawah saat hover */
        }

        .icon {
            margin-right: 10px; /* Ruang kanan untuk ikon */
            font-size: 1.2rem; /* Ukuran ikon */
        }

        .working-hours {
            margin-top: 5px; /* Ruang atas untuk jam kerja */
            padding-left: 20px; /* Indentasi jam kerja */
            font-size: 0.9rem; /* Ukuran font untuk jam kerja */
            color: #555; /* Warna teks jam kerja */
        }


        /* Breadcrumb */
        .breadcrumb {
            display: flex;
            list-style: none;
            margin-bottom: 1rem;
            color: #555;
        }

        .breadcrumb li:not(:last-child)::after {
            content: ">";
            margin: 0 0.5rem;
        }

        .breadcrumb a {
            color: #4a90e2;
            text-decoration: none;
        }

        /* Photo Slider */
        .photo-slider {
            margin-bottom: 2rem;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            height: 600px;
        }

        .slider-container {
            position: relative;
            max-width: 100%;
            margin: 0 auto;
            overflow: hidden;
            display: flex; /* Align images horizontally */
            width: 100%; /* Full width of the container */
        }

        .slider-image {
            width: 100%;
            height: auto;
            display: none;
            min-height: 100%;
            object-fit: cover;
            transition: opacity 1s ease-in-out;
        }

        .slider-image.active {
            display: block;
            opacity: 1;
        }

        /* Welcome section */
        .welcome h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
            font-weight: 600;
            color: #1b2a49;
        }

        .welcome p {
            font-size: 1.1rem;
            line-height: 1.7;
            color: #555;
        }

        /* Feature cards */
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
        }

        .feature-card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }

        .feature-card h3 {
            margin-bottom: 0.5rem;
            font-size: 1.3rem;
            font-weight: 600;
            color: #4a90e2;
        }

        /* Footer */
        .footer {
            background-color: #1b2a49;
            color: #fff;
            padding: 2rem 0;
            margin-top: 2rem;
        }

        .footer-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .footer-section {
            flex: 1;
            margin-bottom: 1rem;
            min-width: 200px;
        }

        .footer-section h3 {
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
            color: #4a90e2;
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section ul li {
            margin-bottom: 0.25rem;
        }

        .footer-section a {
            color: #fff;
            text-decoration: none;
        }

        .footer-bottom {
            margin-top: 1rem;
            text-align: center;
            font-size: 0.9rem;
        }

        .logo a {
            font-size: 50px;
            font-weight: bold;
            float: left;
            font-family: Courier;
            color: #364f6b;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .header .container {
                flex-wrap: wrap;
            }

            .header nav {
                width: 100%;
                margin-top: 1rem;
            }

            .header nav ul {
                flex-direction: column;
            }

            .header nav ul li {
                margin-left: 0;
                margin-bottom: 0.5rem;
            }
        }

        /* about */
        .about-section {
            padding: 50px 0;
            background-color: #f9f9f9; /* Light background for contrast */
        }

        .about-content {
            text-align: center; /* Center text and logo */
        }

        .polinema-logo {
            width: 150px; /* Adjust logo size as needed */
            margin-bottom: 20px; /* Space below the logo */
        }

        .section-title {
            font-size: 35px; /* Larger font size for the section title */
            text-align: center;
            margin-bottom: 30px; /* Space below the title */
            color: #007bff; /* Blue color for the title */
        }

        .about-card {
            margin: 30px auto; /* Center the card */
            border-radius: 15px; /* Rounded corners */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
            background-color: #ffffff; /* White background for the card */
            padding: 30px; /* Inner padding */
        }

        .polinema-logo {
            width: 150px; /* Adjust logo size as needed */
            margin-bottom: 20px; /* Space below the logo */
        }


        
    </style>
</head>
<body>
    <div class="layout">
        <header class="header">
            <div class="container">
                <!-- Left-aligned logo and text -->
                <div class="logo">
                    <a href="https://polinema.ac.id">
                        <img src="polinema.png" alt="Polinema Logo" style="height: 40px; vertical-align: middle;">
                        <span class="logo-text">HRSync</span>
                    </a>
                </div>
                
                <!-- Right-aligned navigation menu -->
                <nav class="menu">
                    <ul>
                        <li><a href="#home" onclick="showSection('home')">Home</a></li>
                        <li><a href="#about" onclick="showSection('about')">About</a></li>
                        <li><a href="#contact" onclick="showSection('contact')">Contact</a></li>
                        <li><a href="{{ route('login') }}" class="login-button btn btn-primary" id="loginButton">Login</a></li>
                    </ul>
                </nav>
            </div>
        </header>
        <main>
            <!-- Home Section -->
            <section id="home" class="section">
                <section class="photo-slider">
                    <div class="slider-container">
                        <img src="img/jtiblur.png" alt="Campus Photo 1" class="slider-image active">
                        <img src="img/poltek.png" alt="Campus Photo 2" class="slider-image">
                        <img src="img/poltek4.png" alt="Campus Photo 3" class="slider-image">
                    </div>
                </section>
                <section class="welcome">
                    <h2>Welcome to Our HR Management System</h2>
                    <p>
                        Welcome to our innovative HR Management System, tailored specifically for Politeknik Negeri Malang. Our platform is designed to facilitate efficient HR operations, empowering our staff and faculty with the tools they need to thrive in their roles.
                    </p>
                </section>
                <br>
                <section class="features">
                    <div class="feature-card">
                        <h3>Employee Management</h3>
                        <p>Easily manage employee information, roles, and responsibilities.</p>
                    </div>
                    <div class="feature-card">
                        <h3>Performance Tracking</h3>
                        <p>Monitor employee performance with clear metrics and feedback.</p>
                    </div>
                    <div class="feature-card">
                        <h3>Training & Development</h3>
                        <p>Facilitate employee growth with tailored training programs and development plans.</p>
                    </div>
                    <div class="feature-card">
                        <h3>Employee Engagement</h3>
                        <p>Enhance workplace culture through surveys and feedback mechanisms to foster engagement.</p>
                    </div>
                </section>
                
                <br>
                <section class="welcome">
                    <h2>Empowering Our Faculty and Staff</h2>
                    <p>
                        At Polinema, we understand the unique challenges faced by our faculty and administrative staff. Our HR Management System is designed to provide seamless access to essential resources, enabling staff to focus on their primary roles and responsibilities.
                    </p>
                </section>
                <br>
                <section class="features">
                    <div class="feature-card">
                        <h3>Streamlined Recruitment & Onboarding</h3>
                        <p>Empower your hiring teams with intuitive recruitment tools and onboarding workflows that make it easier to bring new talent into our community, allowing staff to concentrate on their educational missions.</p>
                    </div>
                    <div class="feature-card">
                        <h3>Customized Training & Development</h3>
                        <p>Support faculty and staff growth with personalized training programs that enhance skills and prepare them for future challenges, fostering a culture of continuous learning.</p>
                    </div>
                    <div class="feature-card">
                        <h3>Strengthening Employee Engagement</h3>
                        <p>Build a vibrant workplace culture by implementing engagement initiatives, such as surveys and feedback mechanisms, that ensure every voice is heard and valued, thus promoting a sense of belonging.</p>
                    </div>
                </section>
                
                <br>
                <section class="welcome">
                    <h2>Streamlined HR Processes</h2>
                    <p>
                        Our HR Management System simplifies various HR tasks, from recruitment to employee onboarding and training. By centralizing these processes, we enhance collaboration and communication within our institution, fostering a supportive work environment that promotes efficiency and effectiveness.
                    </p>
                </section>
                <br>
                <section class="features">
                    <div class="feature-card">
                        <h3>Efficient Recruitment & Onboarding</h3>
                        <p>Optimize the hiring journey with user-friendly recruitment tools that simplify candidate selection and onboarding, ensuring new employees feel welcomed and prepared.</p>
                    </div>
                    <div class="feature-card">
                        <h3>Comprehensive Training & Development</h3>
                        <p>Empower staff through customized training programs designed to enhance skills and foster professional growth, aligning with the institution's goals.</p>
                    </div>
                    <div class="feature-card">
                        <h3>Fostering Employee Engagement</h3>
                        <p>Create a thriving workplace culture by utilizing surveys and feedback mechanisms that encourage open communication and enhance employee satisfaction.</p>
                    </div>
                </section>
                <br>
                <section class="welcome">
                    <p>
                        Our HR Management System simplifies various HR tasks, from recruitment to employee onboarding and training. By centralizing these processes, we enhance collaboration and communication within our institution, fostering a supportive work environment that promotes efficiency and effectiveness.
                    </p>
                </section>
            </section>

            <!-- About Section -->
            <section id="about" class="section about-section">
            <div class="container">
                <div class="card about-card">
                    <h2 class="section-title">About Us</h2>
                    <div class="card-body">
                        <div class="about-content text-center">
                            <img src="polinema.png" alt="Politeknik Negeri Malang Logo" class="polinema-logo">
                            <p>
                                At Politeknik Negeri Malang (Polinema), we are dedicated to creating a comprehensive HR solution tailored specifically for our academic institution. Our platform is built with the needs of our faculty and administrative staff in mind, ensuring efficiency and ease of use. 
                                <br>
                                We strive to provide innovative tools and resources that facilitate effective communication, enhance collaboration, and streamline HR processes. By focusing on the unique challenges faced by our institution, we aim to foster a supportive environment that promotes professional growth and development for all staff members.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            </section>

            <!-- Contact Section -->
            <section id="contact" class="section">
                <h2 class="section-title">Contact Us</h2>
                <div class="container"> 
                    <div class="row mt-4">
                        <div class="col-12 text-center">
                            <h5 class="institution-name">Politeknik Negeri Malang</h5>
                            <p class="address text-muted">Jl. Soekarno Hatta No.9, Jatimulyo, Kec. Lowokwaru, Kota Malang, Jawa Timur 65141</p>
                        </div>
                        <div class="map-container">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15806.010732341647!2d112.6161209!3d-7.9468912!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e78827687d272e7%3A0x789ce9a636cd3aa2!2sPoliteknik%20Negeri%20Malang!5e0!3m2!1sid!2sid!4v1714835289599!5m2!1sid!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="contact-info">
                            <h4 class="contact-header">Hubungi Kami</h4>
                            <ul class="contact-list">
                                <li>
                                    <a href="tel:0341404424">
                                        <span class="icon"><i class="fas fa-phone"></i></span>
                                        (0341) 404424
                                    </a>
                                </li>
                                <li>
                                    <a href="mailto:humas@polinema.ac.id">
                                        <span class="icon"><i class="fas fa-envelope"></i></span>
                                        humas@polinema.ac.id
                                    </a>
                                </li>
                                <li>
                                    <span class="icon"><i class="fas fa-clock"></i></span>
                                    Jam Kerja: 
                                    <ul class="working-hours">
                                        <li>Senin - Jumat : 07:00 - 16:00 WIB</li>
                                        <li>Sabtu & Minggu : Tutup</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>            
        </main>

        <footer class="footer">
            <div class="footer-content container">
                <div class="footer-section">
                    <h3>About Us</h3>
                    <ul>
                        <li><a href="https://github.com/Fikrisn/HRSync/graphs/contributors">Our Team</a></li>
                        <li><a href="https://jti.polinema.ac.id/">PBL Info</a></li>
                        <li><a href="https://www.linkedin.com/in/moch-fikri-setiawan-43183b252/">Careers</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Resources</h3>
                    <ul>
                        <li><a href="Https://polinema.ac.id">Blog</a></li>
                        <li><a href="https://helpakademik.polinema.ac.id/">Help Center</a></li>
                        <li><a href="https://jpkm.polinema.ac.id/index.php/jpkm/about/privacy">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Connect</h3>
                    <ul>
                        <li><a href="https://ppid.polinema.ac.id/">Contact</a></li>
                        <li><a href="https://ppid.polinema.ac.id/regulasi/">Support</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="footer-bottom">
                    <strong>
                        Copyright &copy; 2024-2025 
                        <a href="https://polinema.ac.id" style="color: blue;">HRSync</a>.
                    </strong> All rights reserved.
                </div>                
            </div>
        </footer>
    </div>

    <script>
        // JavaScript to show and hide sections
        function showSection(sectionId) {
            const sections = document.querySelectorAll('.section');
            sections.forEach(section => {
                section.style.display = 'none'; // Hide all sections
            });

            const activeSection = document.getElementById(sectionId);
            if (activeSection) {
                activeSection.style.display = 'block'; // Show the selected section
            }
        }

        // Automatically show the home section on page load
        window.onload = function() {
            showSection('home');
        };

        // Slider functionality
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slider-image');
        function showSlides() {
            slides[currentSlide].classList.remove('active'); // Hide current slide
            currentSlide = (currentSlide + 1) % slides.length; // Move to the next slide
            slides[currentSlide].classList.add('active'); // Show new slide
        }
        setInterval(showSlides, 3000); // Change slide every 3 seconds
    </script>
</body>
</html>
