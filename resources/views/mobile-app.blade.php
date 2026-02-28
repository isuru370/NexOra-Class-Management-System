<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Mobile App - NEXORA Education System</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-blue: #1e40af;
            --secondary-blue: #3b82f6;
            --accent-green: #10b981;
            --accent-purple: #8b5cf6;
            --dark-bg: #0f172a;
            --light-bg: #f8fafc;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --card-bg: rgba(255, 255, 255, 0.05);
            --border-color: rgba(255, 255, 255, 0.1);
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: white;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Navigation Bar */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(10px);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
            border-bottom: 1px solid var(--border-color);
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 1rem;
            text-decoration: none;
        }

        .logo-container img {
            height: 40px;
            width: auto;
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(to right, var(--accent-green), #3b82f6);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav-link {
            color: #cbd5e1;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--accent-green);
        }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
        }

        .mobile-menu {
            display: none;
            position: fixed;
            top: 70px;
            left: 0;
            width: 100%;
            background: rgba(15, 23, 42, 0.98);
            backdrop-filter: blur(20px);
            padding: 1rem;
            z-index: 999;
        }

        .mobile-menu.active {
            display: block;
        }

        .mobile-nav-links {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .mobile-nav-link {
            color: #cbd5e1;
            text-decoration: none;
            padding: 0.75rem;
            border-radius: 8px;
        }

        /* Background Animation */
        .background-animation {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 1;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            border-radius: 50%;
            background: rgba(59, 130, 246, 0.1);
            animation: float 15s infinite linear;
        }

        .grid-overlay {
            position: fixed;
            width: 100%;
            height: 100%;
            background-image:
                linear-gradient(rgba(30, 64, 175, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(30, 64, 175, 0.05) 1px, transparent 1px);
            background-size: 50px 50px;
            pointer-events: none;
            z-index: 2;
        }

        /* Main Content */
        .main-container {
            position: relative;
            z-index: 10;
            width: 100%;
            min-height: 100vh;
            padding-top: 80px;
        }

        /* Hero Section */
        .app-hero {
            padding: 2rem 2rem 1rem;
            text-align: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            background: linear-gradient(to right, #fff, #a5b4fc);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .hero-subtitle {
            font-size: 1.1rem;
            color: #cbd5e1;
            max-width: 700px;
            margin: 0 auto;
        }

        /* App Features */
        .features-section {
            padding: 1rem 2rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .feature-card {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            border: 1px solid var(--border-color);
            transition: all 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            border-color: var(--accent-green);
        }

        .feature-icon {
            width: 50px;
            height: 50px;
            background: rgba(16, 185, 129, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
        }

        .feature-icon i {
            color: var(--accent-green);
            font-size: 1.5rem;
        }

        .feature-title {
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
            color: white;
        }

        .feature-description {
            color: #94a3b8;
            font-size: 0.9rem;
        }

        /* Screenshot Showcase - නව design එක */
        .showcase-section {
            padding: 1rem 2rem 3rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 2rem;
            color: white;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: var(--accent-green);
        }

        /* Screenshot Grid - Horizontal scroll එක නැතුව, grid එකක් විදියට */
        .screenshot-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .screenshot-card {
            background: var(--card-bg);
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid var(--border-color);
            transition: all 0.3s;
            cursor: pointer;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .screenshot-card:hover {
            transform: translateY(-8px);
            border-color: var(--accent-green);
            box-shadow: 0 20px 30px rgba(16, 185, 129, 0.2);
        }

        .screenshot-image {
            width: 100%;
            height: 500px;
            overflow: hidden;
            background: #1e293b;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .screenshot-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
            display: block;
        }

        .screenshot-card:hover .screenshot-image img {
            transform: scale(1.05);
        }

        .screenshot-info {
            padding: 1.2rem;
            background: rgba(15, 23, 42, 0.95);
        }

        .screenshot-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: white;
            margin-bottom: 0.3rem;
        }

        .screenshot-description {
            color: #94a3b8;
            font-size: 0.9rem;
            line-height: 1.4;
        }

        /* Full Screen Modal - Scroll bar නැතුව */
        .fullscreen-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.98);
            backdrop-filter: blur(20px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 2000;
            opacity: 0;
            transition: opacity 0.3s;
            overflow: hidden;
            /* Scroll bars නැති කරන්න */
        }

        .fullscreen-modal.active {
            display: flex;
            opacity: 1;
        }

        .modal-content {
            position: relative;
            width: 100vw;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            /* Scroll bars නැති කරන්න */
        }

        .modal-image-container {
            position: relative;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .modal-image-container img {
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
            object-fit: contain;
            transition: transform 0.3s;
            cursor: zoom-in;
        }

        .modal-image-container img.zoomed {
            transform: scale(1.8);
            cursor: zoom-out;
        }

        /* Modal Controls - පැහැදිලි buttons */
        .modal-close {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            background: rgba(16, 185, 129, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            z-index: 10;
            backdrop-filter: blur(10px);
        }

        .modal-close:hover {
            background: var(--accent-green);
            transform: rotate(90deg);
        }

        .modal-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 60px;
            height: 60px;
            background: rgba(16, 185, 129, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            color: white;
            font-size: 2rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            z-index: 10;
            backdrop-filter: blur(10px);
        }

        .modal-nav:hover {
            background: var(--accent-green);
            transform: translateY(-50%) scale(1.1);
        }

        .modal-nav.prev {
            left: 20px;
        }

        .modal-nav.next {
            right: 20px;
        }

        .modal-info {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.9), transparent);
            padding: 2rem 2rem 1.5rem;
            color: white;
            transform: translateY(0);
            transition: transform 0.3s;
            pointer-events: none;
        }

        .modal-info.hidden {
            transform: translateY(100%);
        }

        .modal-info h3 {
            font-size: 1.5rem;
            margin-bottom: 0.3rem;
        }

        .modal-info p {
            color: #94a3b8;
            font-size: 1rem;
        }

        .modal-counter {
            position: absolute;
            top: 20px;
            left: 20px;
            background: rgba(16, 185, 129, 0.3);
            backdrop-filter: blur(10px);
            padding: 0.5rem 1rem;
            border-radius: 30px;
            font-size: 0.9rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            z-index: 10;
        }

        /* Image counter and indicators */
        .image-counter {
            text-align: center;
            margin: 1rem 0 0.5rem;
            color: #94a3b8;
            font-size: 0.9rem;
        }

        /* Download Section */
        .download-section {
            padding: 3rem 2rem;
            text-align: center;
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(59, 130, 246, 0.1));
            margin: 1rem auto 2rem;
            border-radius: 20px;
            max-width: 1000px;
        }

        .download-title {
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }

        .download-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 1.5rem;
        }

        .download-btn {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-color);
            padding: 0.8rem 1.8rem;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            gap: 1rem;
            color: white;
            text-decoration: none;
            transition: all 0.3s;
        }

        .download-btn:hover {
            background: rgba(16, 185, 129, 0.1);
            border-color: var(--accent-green);
            transform: translateY(-3px);
        }

        .download-btn i {
            font-size: 1.8rem;
            color: var(--accent-green);
        }

        /* Footer */
        .footer {
            padding: 2rem;
            text-align: center;
            border-top: 1px solid var(--border-color);
            color: #94a3b8;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }

        .footer-link {
            color: #94a3b8;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-link:hover {
            color: var(--accent-green);
        }

        /* Animations */
        @keyframes float {
            0% {
                transform: translate(0, 0) rotate(0deg);
            }

            33% {
                transform: translate(30px, -30px) rotate(120deg);
            }

            66% {
                transform: translate(-20px, 20px) rotate(240deg);
            }

            100% {
                transform: translate(0, 0) rotate(360deg);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .mobile-menu-btn {
                display: block;
            }

            .hero-title {
                font-size: 2rem;
            }

            .screenshot-image {
                height: 350px;
            }

            .modal-nav {
                width: 45px;
                height: 45px;
                font-size: 1.3rem;
            }

            .modal-nav.prev {
                left: 10px;
            }

            .modal-nav.next {
                right: 10px;
            }

            .modal-close {
                width: 40px;
                height: 40px;
                font-size: 1.2rem;
            }

            .modal-info h3 {
                font-size: 1.2rem;
            }
        }

        @media (max-width: 480px) {
            .screenshot-image {
                height: 300px;
            }

            .screenshot-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar">
        <a href="{{ url('/') }}" class="logo-container">
            <img src="{{ asset('uploads/logo/white_logo.png') }}" alt="NEXORA Logo">
            <span class="logo-text">NEXORA</span>
        </a>

        <button class="mobile-menu-btn" id="mobileMenuBtn">
            <i class="fas fa-bars"></i>
        </button>

        <div class="nav-links">
            <a href="{{ url('/') }}" class="nav-link">Home</a>
            <a href="{{ route('mobile-app') }}" class="nav-link active">Mobile App</a>
            <a href="{{ route('web-platform') }}" class="mobile-nav-link">Web Platform</a>
            <a href="{{ route('pricing') }}" class="nav-link">Pricing</a>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <div class="mobile-nav-links">
            <a href="{{ url('/') }}" class="mobile-nav-link">Home</a>
            <a href="{{ route('mobile-app') }}" class="mobile-nav-link">Mobile App</a>
            <a href="{{ route('web-platform') }}" class="mobile-nav-link">Web Platform</a>
            <a href="{{ route('pricing') }}" class="mobile-nav-link">Pricing</a>
        </div>
    </div>

    <!-- Full Screen Modal -->
    <div class="fullscreen-modal" id="fullscreenModal">
        <div class="modal-content">
            <div class="modal-counter" id="modalCounter"></div>
            <button class="modal-close" id="closeModal"><i class="fas fa-times"></i></button>
            <button class="modal-nav prev" id="prevImage"><i class="fas fa-chevron-left"></i></button>
            <button class="modal-nav next" id="nextImage"><i class="fas fa-chevron-right"></i></button>

            <div class="modal-image-container" id="modalImageContainer">
                <img src="" alt="App Screenshot" id="modalImage">
            </div>

            <div class="modal-info" id="modalInfo">
                <h3 id="modalTitle"></h3>
                <p id="modalDescription"></p>
            </div>
        </div>
    </div>

    <!-- Background Animation -->
    <div class="background-animation" id="particles"></div>
    <div class="grid-overlay"></div>

    <!-- Main Content -->
    <div class="main-container">
        <!-- Hero Section -->
        <section class="app-hero">
            <h1 class="hero-title">NEXORA Mobile App</h1>
            <p class="hero-subtitle">
                Complete institute management in your pocket. Student management, attendance, payments and more.
            </p>
        </section>

        <!-- Features -->
        <section class="features-section">
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-user-graduate"></i></div>
                    <h3 class="feature-title">Student Management</h3>
                    <p class="feature-description">Full student profiles with ID, grades, contacts</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-camera"></i></div>
                    <h3 class="feature-title">Capture Image</h3>
                    <p class="feature-description">Take and store student photos</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-qrcode"></i></div>
                    <h3 class="feature-title">QR Attendance</h3>
                    <p class="feature-description">Temporary & Activated QR codes</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-wallet"></i></div>
                    <h3 class="feature-title">Payments</h3>
                    <p class="feature-description">Fee collection & tracking</p>
                </div>
            </div>
        </section>

        <!-- Screenshot Grid -->
        <section class="showcase-section">
            <h2 class="section-title">App Screenshots</h2>
            <p class="image-counter" id="imageCounter">Loading 16 screenshots...</p>

            <div class="screenshot-grid" id="screenshotGrid">
                <!-- Images will be loaded here -->
            </div>
        </section>

        <!-- Download -->
        <section class="download-section">
            <h2 class="download-title">Download NEXORA Mobile App</h2>
            <p class="download-text" style="color: #94a3b8;">Available for Android</p>
            <div class="download-buttons">
                <a href="#" class="download-btn"><i class="fab fa-google-play"></i> Google Play</a>
            </div>
        </section>

        <!-- Footer -->
        <footer class="footer">
            <div class="footer-links">
                <a href="{{ url('/') }}" class="footer-link">Home</a>
                <a href="{{ route('mobile-app') }}" class="nav-link">Mobile App</a>
                <a href="{{ route('web-platform') }}" class="footer-link">Web Platform</a>
                <a href="{{ route('pricing') }}" class="footer-link">Pricing</a>
            </div>
            <p>&copy; 2024 NEXORA Education System. All rights reserved.</p>
        </footer>
    </div>

    <script>
        // Mobile app images data - Screenshot එකට අනුව descriptions update කරලා
        const appImages = [
            {
                id: 1,
                src: '/uploads/mobile/1.png',
                title: 'Splash Screen',
                description: 'NEXORA mobile app splash screen featuring logo and smooth loading animation.'
            },
            {
                id: 2,
                src: '/uploads/mobile/2.png',
                title: 'Sign In Screen',
                description: 'Secure user login screen with email and password fields. Includes sign-in button and password recovery option.'
            },
            {
                id: 3,
                src: '/uploads/mobile/9.png',
                title: 'Dashboard',
                description: 'Main dashboard displaying daily collection, new student registrations, and today\'s classes with timings and hall allocation. Quick access to student details using ID search.'
            },
            {
                id: 4,
                src: '/uploads/mobile/3.png',
                title: 'Side Menu',
                description: 'Main navigation menu providing access to all app features: All Grades/Students, Student ID Numbers, Capture Image, Attendance, Payments, Temporary QR, Activated QR, Profile, and Logout.'
            },
            {
                id: 5,
                src: '/uploads/mobile/4.png',
                title: 'All Students View',
                description: 'Comprehensive list of all enrolled students with powerful search and filter options. Click on any student name or ID to view complete details.'
            },
            {
                id: 6,
                src: '/uploads/mobile/5.png',
                title: 'Student Details View',
                description: 'Complete student profile displaying personal information, academic records, contact details, and enrollment history in one place.'
            },
            {
                id: 7,
                src: '/uploads/mobile/6.png',
                title: 'Student Classes View',
                description: 'Overview of all classes where the student is enrolled. Includes attendance history and payment records for each class.'
            },
            {
                id: 8,
                src: '/uploads/mobile/7.png',
                title: 'Payment History',
                description: 'Complete payment records for students including fee collections, pending payments, and transaction history with receipt generation.'
            },
            {
                id: 9,
                src: '/uploads/mobile/8.png',
                title: 'Attendance History',
                description: 'Detailed attendance records showing present/absent status, attendance percentage, and historical data for each student.'
            },
            {
                id: 10,
                src: '/uploads/mobile/11.png',
                title: 'Mark Attendance',
                description: 'Quick attendance marking for today\'s classes using QR code scanning or manual entry. Option to mark whether TUTE (teaching material) has been issued to students.'
            },
            {
                id: 11,
                src: '/uploads/mobile/10.png',
                title: 'Attendance Summary',
                description: 'View separate lists of students who attended and those who were absent for today\'s classes. Easy options to mark attendance and issue TUTE materials.'
            },
            {
                id: 12,
                src: '/uploads/mobile/13.png',
                title: 'Mark Payment',
                description: 'Scan student ID card to instantly view tuition details and last payment information. Process payments for tuition and other fees directly from this screen.'
            },
            {
                id: 13,
                src: '/uploads/mobile/16.png',
                title: 'Pay Class Fees',
                description: 'Monthly fee collection interface. Select year and month, click pay button to process payment. Automatic SMS notification sent to parents. Option to generate and print payment receipt instantly.'
            },
            {
                id: 14,
                src: '/uploads/mobile/14.png',
                title: 'Quick Image Capture',
                description: 'Capture student photo before registration. System generates a quick image ID that can be used in registration forms to automatically link the photo with student records.'
            },
            {
                id: 15,
                src: '/uploads/mobile/15.png',
                title: 'Temporary QR Code',
                description: 'Generate time-limited QR codes for quick attendance marking. Students can scan these codes to mark attendance and payments without logging in. Ideal for temporary access.'
            },
            {
                id: 16,
                src: '/uploads/mobile/12.png',
                title: 'Student Custom ID',
                description: 'View and manage custom ID numbers assigned to students. Generate unique QR codes linked to each ID for easy identification and attendance tracking.'
            }
        ];

        // DOM Elements
        const screenshotGrid = document.getElementById('screenshotGrid');
        const modal = document.getElementById('fullscreenModal');
        const modalImage = document.getElementById('modalImage');
        const modalTitle = document.getElementById('modalTitle');
        const modalDescription = document.getElementById('modalDescription');
        const modalCounter = document.getElementById('modalCounter');
        const closeModal = document.getElementById('closeModal');
        const prevBtn = document.getElementById('prevImage');
        const nextBtn = document.getElementById('nextImage');
        const modalInfo = document.getElementById('modalInfo');
        const imageCounter = document.getElementById('imageCounter');

        let currentIndex = 0;
        let isZoomed = false;

        // Load screenshot grid
        function loadScreenshots() {
            screenshotGrid.innerHTML = '';

            appImages.forEach((image, index) => {
                const card = document.createElement('div');
                card.className = 'screenshot-card';
                card.dataset.index = index;

                card.innerHTML = `
                    <div class="screenshot-image">
                        <img src="${image.src}" alt="${image.title}" loading="lazy" 
                             onerror="this.src='https://via.placeholder.com/300x500?text=Image+${image.id}'">
                    </div>
                    <div class="screenshot-info">
                        <h3 class="screenshot-title">${image.title}</h3>
                        <p class="screenshot-description">${image.description}</p>
                    </div>
                `;

                card.addEventListener('click', () => openModal(index));
                screenshotGrid.appendChild(card);
            });

            imageCounter.textContent = `Showing ${appImages.length} app screenshots`;
        }

        // Open modal
        function openModal(index) {
            currentIndex = index;
            updateModalContent();
            modal.classList.add('active');
            document.body.style.overflow = 'hidden'; // Body scroll එක නවත්වන්න
            isZoomed = false;
            modalImage.classList.remove('zoomed');
        }

        // Close modal
        function closeModalFunc() {
            modal.classList.remove('active');
            document.body.style.overflow = 'auto'; // Body scroll එක ආයේ start කරන්න
        }

        // Update modal content
        function updateModalContent() {
            const image = appImages[currentIndex];
            modalImage.src = image.src;
            modalTitle.textContent = image.title;
            modalDescription.textContent = image.description;
            modalCounter.textContent = `${currentIndex + 1} / ${appImages.length}`;
        }

        // Previous image
        function prevImage() {
            currentIndex = (currentIndex - 1 + appImages.length) % appImages.length;
            updateModalContent();
            isZoomed = false;
            modalImage.classList.remove('zoomed');
        }

        // Next image
        function nextImage() {
            currentIndex = (currentIndex + 1) % appImages.length;
            updateModalContent();
            isZoomed = false;
            modalImage.classList.remove('zoomed');
        }

        // Toggle zoom
        function toggleZoom(e) {
            e.stopPropagation();
            isZoomed = !isZoomed;
            if (isZoomed) {
                modalImage.classList.add('zoomed');
            } else {
                modalImage.classList.remove('zoomed');
            }
        }

        // Mobile menu
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');

        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('active');
            mobileMenuBtn.innerHTML = mobileMenu.classList.contains('active')
                ? '<i class="fas fa-times"></i>'
                : '<i class="fas fa-bars"></i>';
        });

        // Event Listeners
        closeModal.addEventListener('click', closeModalFunc);
        prevBtn.addEventListener('click', prevImage);
        nextBtn.addEventListener('click', nextImage);
        modalImage.addEventListener('click', toggleZoom);

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (!modal.classList.contains('active')) return;

            switch (e.key) {
                case 'Escape':
                    closeModalFunc();
                    break;
                case 'ArrowLeft':
                    prevImage();
                    break;
                case 'ArrowRight':
                    nextImage();
                    break;
                case ' ':
                    e.preventDefault();
                    modalInfo.classList.toggle('hidden');
                    break;
            }
        });

        // Click outside to close (on backdrop)
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                closeModalFunc();
            }
        });

        // Create particles
        function createParticles() {
            const container = document.getElementById('particles');
            for (let i = 0; i < 15; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.width = `${Math.random() * 80 + 20}px`;
                particle.style.height = particle.style.width;
                particle.style.left = `${Math.random() * 100}%`;
                particle.style.top = `${Math.random() * 100}%`;
                particle.style.animationDelay = `${Math.random() * 10}s`;
                particle.style.background = `rgba(${Math.random() * 100 + 50}, ${Math.random() * 100 + 50}, 255, 0.1)`;
                container.appendChild(particle);
            }
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', () => {
            createParticles();
            loadScreenshots();

            // Error handling for images
            const images = document.querySelectorAll('img');
            images.forEach(img => {
                img.onerror = function () {
                    this.src = 'https://via.placeholder.com/300x500?text=Image+Not+Found';
                };
            });
        });
    </script>
</body>

</html>