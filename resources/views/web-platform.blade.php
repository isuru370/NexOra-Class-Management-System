<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Web Platform - NEXORA Education System</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-blue: #1e40af;
            --secondary-blue: #3b82f6;
            --accent-green: #10b981;
            --accent-purple: #8b5cf6;
            --dark-bg: #0f172a;
            --light-bg: #f8fafc;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: white;
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
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
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
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
            color: white;
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
            position: relative;
            padding: 0.5rem 0;
        }

        .nav-link:hover {
            color: var(--accent-green);
        }

        .nav-link.active {
            color: var(--accent-green);
        }

        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: var(--accent-green);
            border-radius: 1px;
        }

        .nav-cta {
            background: linear-gradient(135deg, var(--accent-green), #0da271);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }

        .nav-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3);
        }

        /* Mobile Menu */
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
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
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
            font-weight: 500;
            padding: 0.75rem;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .mobile-nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: var(--accent-green);
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
            top: 0;
            left: 0;
            z-index: 2;
            pointer-events: none;
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
        .platform-hero {
            padding: 6rem 2rem 4rem;
            text-align: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            background: linear-gradient(to right, #fff, #a5b4fc);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .hero-subtitle {
            font-size: 1.5rem;
            color: #cbd5e1;
            max-width: 800px;
            margin: 0 auto 3rem;
            line-height: 1.6;
        }

        /* Platform Dashboard Preview */
        .dashboard-section {
            padding: 4rem 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 3rem;
            color: white;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: var(--accent-green);
            border-radius: 2px;
        }

        .dashboard-preview {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            padding: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
            margin-bottom: 4rem;
        }

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        @media (max-width: 1024px) {
            .dashboard-stats {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .dashboard-stats {
                grid-template-columns: 1fr;
            }
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: transform 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            border-color: var(--accent-green);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            background: rgba(16, 185, 129, 0.1);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .stat-icon i {
            color: var(--accent-green);
            font-size: 1.5rem;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            color: #94a3b8;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Video Guides Section */
        .video-guides-section {
            padding: 4rem 2rem;
            background: rgba(255, 255, 255, 0.02);
            border-radius: 20px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .video-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .video-card {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: transform 0.3s;
        }

        .video-card:hover {
            transform: translateY(-10px);
            border-color: var(--accent-green);
        }

        .video-thumbnail {
            width: 100%;
            height: 200px;
            background: linear-gradient(45deg, #1e293b, #334155);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .video-thumbnail::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.3);
        }

        .play-button {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 2;
            cursor: pointer;
            transition: transform 0.3s;
        }

        .play-button:hover {
            transform: scale(1.1);
        }

        .play-button i {
            color: var(--accent-green);
            font-size: 1.5rem;
            margin-left: 3px;
        }

        .video-info {
            padding: 1.5rem;
        }

        .video-title {
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
            color: white;
        }

        .video-duration {
            color: #94a3b8;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .video-description {
            color: #cbd5e1;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        /* Feature Walkthrough */
        .walkthrough-section {
            padding: 4rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .walkthrough-steps {
            display: flex;
            flex-direction: column;
            gap: 3rem;
            margin-top: 3rem;
        }

        .walkthrough-step {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: center;
        }

        @media (max-width: 768px) {
            .walkthrough-step {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .walkthrough-step:nth-child(even) .step-content {
                order: 2;
            }
        }

        .step-number {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--accent-green), #0da271);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .step-content h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: white;
        }

        .step-content p {
            color: #cbd5e1;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .step-features {
            list-style: none;
        }

        .step-features li {
            color: #cbd5e1;
            padding: 0.5rem 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .step-features li i {
            color: var(--accent-green);
            font-size: 0.9rem;
        }

        .step-preview {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            padding: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Video Modal */
        .video-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            backdrop-filter: blur(10px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 2000;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .video-modal.active {
            display: flex;
            opacity: 1;
        }

        .modal-content {
            width: 90%;
            max-width: 900px;
            background: rgba(15, 23, 42, 0.95);
            border-radius: 20px;
            overflow: hidden;
            position: relative;
            transform: scale(0.9);
            transition: transform 0.3s;
        }

        .video-modal.active .modal-content {
            transform: scale(1);
        }

        .modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            font-size: 1.5rem;
            color: white;
        }

        .close-modal {
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s;
        }

        .close-modal:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .modal-body {
            padding: 2rem;
        }

        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            /* 16:9 Aspect Ratio */
            height: 0;
            overflow: hidden;
            border-radius: 10px;
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

        /* CTA Section */
        .cta-section {
            padding: 4rem 2rem;
            text-align: center;
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(59, 130, 246, 0.1));
            margin-top: 2rem;
            border-radius: 20px;
            max-width: 1200px;
            margin: 4rem auto;
        }

        .cta-title {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: white;
        }

        .cta-text {
            font-size: 1.1rem;
            color: #cbd5e1;
            max-width: 600px;
            margin: 0 auto 2rem;
            line-height: 1.6;
        }

        .cta-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 1rem 2rem;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent-green), #0da271);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-3px);
        }

        /* Footer */
        .footer {
            padding: 3rem 2rem;
            text-align: center;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: #94a3b8;
            margin-top: 4rem;
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
                transform: translate(30px, -50px) rotate(120deg);
            }

            66% {
                transform: translate(-20px, 20px) rotate(240deg);
            }

            100% {
                transform: translate(0, 0) rotate(360deg);
            }
        }

        @keyframes pulse {
            0% {
                opacity: 0.5;
                transform: scale(1);
            }

            50% {
                opacity: 1;
                transform: scale(1.05);
            }

            100% {
                opacity: 0.5;
                transform: scale(1);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .mobile-menu-btn {
                display: block;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }

            .video-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .hero-title {
                font-size: 2.2rem;
            }

            .section-title {
                font-size: 1.8rem;
            }

            .dashboard-preview {
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
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
            <a href="{{ route('mobile-app') }}" class="nav-link">Mobile App</a>
            <a href="{{ route('web-platform') }}" class="nav-link active">Web Platform</a>
            <a href="{{ route('pricing') }}" class="nav-link">Pricing</a>
            <a href="{{ route('interactive-learning') }}" class="nav-link">Features</a>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <div class="mobile-nav-links">
            <a href="{{ url('/') }}" class="mobile-nav-link">Home</a>
            <a href="{{ route('mobile-app') }}" class="mobile-nav-link">Mobile App</a>
            <a href="{{ route('web-platform') }}" class="mobile-nav-link active">Web Platform</a>
            <a href="{{ route('pricing') }}" class="mobile-nav-link">Pricing</a>
            <a href="{{ route('interactive-learning') }}" class="mobile-nav-link">Features</a>
            <a href="{{ route('login') }}" class="mobile-nav-link"
                style="background: var(--accent-green); color: white;">
                <i class="fas fa-sign-in-alt"></i> ACCESS LOGIN
            </a>
        </div>
    </div>

    <!-- Video Modal -->
    <div class="video-modal" id="videoModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalTitle">Video Guide</h3>
                <button class="close-modal" id="closeModal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="video-container" id="videoContainer">
                    <!-- Video will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Background Animation -->
    <div class="background-animation" id="particles"></div>
    <div class="grid-overlay"></div>

    <!-- Main Content -->
    <div class="main-container">
        <!-- Hero Section -->
        <section class="platform-hero">
            <h1 class="hero-title">Complete Institute Management Platform</h1>
            <p class="hero-subtitle">
                Manage your entire educational institution from one powerful web dashboard.
                From student enrollment to financial management, everything you need is here.
            </p>

            <div class="cta-buttons">
                <a href="#videos" class="btn-secondary">
                    <i class="fas fa-play-circle"></i> Watch Tutorials
                </a>
                <a href="{{ route('login') }}" class="btn-primary">
                    <i class="fas fa-sign-in-alt"></i> Access Web Platform
                </a>
            </div>
        </section>

        {{-- <!-- Dashboard Preview -->
        <section class="dashboard-section" id="dashboard">
            <h2 class="section-title">Powerful Admin Dashboard</h2>

            <div class="dashboard-preview">
                <div class="dashboard-header">
                    <h3 style="color: white;">Institute Management Dashboard</h3>
                    <div style="display: flex; gap: 1rem;">
                        <span style="color: #94a3b8; font-size: 0.9rem;">
                            <i class="fas fa-sync-alt"></i> Live Data
                        </span>
                    </div>
                </div>

                <div class="dashboard-stats">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="stat-number">1,250</div>
                        <div class="stat-label">Total Students</div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <div class="stat-number">85</div>
                        <div class="stat-label">Teachers</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-money-check-alt"></i>
                        </div>
                        <div class="stat-number">LKR 2.5M</div>
                        <div class="stat-label">Monthly Revenue</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div class="stat-number">98%</div>
                        <div class="stat-label">Attendance Rate</div>
                    </div>
                </div>

                <div style="text-align: center; margin-top: 2rem;">
                    <a href="{{ route('login') }}" class="btn-primary">
                        <i class="fas fa-external-link-alt"></i> Open Full Dashboard
                    </a>
                </div>
            </div>
        </section> --}}

        <!-- Video Guides -->
        <section class="video-guides-section" id="videos">
            <h2 class="section-title">Step-by-Step Video Guides</h2>
            <p style="text-align: center; color: #cbd5e1; max-width: 800px; margin: 0 auto 3rem;">
                Learn how to use every feature of the web platform with our comprehensive video tutorials
            </p>

            <div class="video-grid">
                <!-- Login & Navigation Video -->
                <div class="video-card" data-video-id="login-guide">
                    <div class="video-thumbnail">
                        <div class="play-button">
                            <i class="fas fa-play"></i>
                        </div>
                    </div>
                    <div class="video-info">
                        <h3 class="video-title">Login & Dashboard Navigation</h3>
                        <div class="video-duration">
                            <i class="fas fa-clock"></i> 2:30 min
                        </div>
                        <p class="video-description">
                            Learn how to log in to the web platform and navigate the main dashboard.
                            Understand the layout and access key features quickly.
                        </p>
                    </div>
                </div>

                <!-- Student Management Video -->
                <div class="video-card" data-video-id="student-management">
                    <div class="video-thumbnail">
                        <div class="play-button">
                            <i class="fas fa-play"></i>
                        </div>
                    </div>
                    <div class="video-info">
                        <h3 class="video-title">Student Enrollment & Management</h3>
                        <div class="video-duration">
                            <i class="fas fa-clock"></i> 4:15 min
                        </div>
                        <p class="video-description">
                            Complete guide to adding new students, managing student profiles,
                            class assignments, and bulk operations.
                        </p>
                    </div>
                </div>

                <!-- Payment Management Video -->
                <div class="video-card" data-video-id="payment-management">
                    <div class="video-thumbnail">
                        <div class="play-button">
                            <i class="fas fa-play"></i>
                        </div>
                    </div>
                    <div class="video-info">
                        <h3 class="video-title">Fee Collection & Payment Management</h3>
                        <div class="video-duration">
                            <i class="fas fa-clock"></i> 5:20 min
                        </div>
                        <p class="video-description">
                            How to process student payments, generate receipts, manage payment plans,
                            and track financial transactions.
                        </p>
                    </div>
                </div>

                <!-- Teacher Salary Video -->
                <div class="video-card" data-video-id="teacher-salary">
                    <div class="video-thumbnail">
                        <div class="play-button">
                            <i class="fas fa-play"></i>
                        </div>
                    </div>
                    <div class="video-info">
                        <h3 class="video-title">Teacher Salary Processing</h3>
                        <div class="video-duration">
                            <i class="fas fa-clock"></i> 3:45 min
                        </div>
                        <p class="video-description">
                            Complete guide to managing teacher salaries, advances, deductions,
                            and generating salary slips.
                        </p>
                    </div>
                </div>

                <!-- Attendance System Video -->
                <div class="video-card" data-video-id="attendance-system">
                    <div class="video-thumbnail">
                        <div class="play-button">
                            <i class="fas fa-play"></i>
                        </div>
                    </div>
                    <div class="video-info">
                        <h3 class="video-title">Attendance Management System</h3>
                        <div class="video-duration">
                            <i class="fas fa-clock"></i> 3:10 min
                        </div>
                        <p class="video-description">
                            Learn how to mark and manage attendance, generate reports,
                            and track student attendance patterns.
                        </p>
                    </div>
                </div>

                <!-- Reports & Analytics Video -->
                <div class="video-card" data-video-id="reports-analytics">
                    <div class="video-thumbnail">
                        <div class="play-button">
                            <i class="fas fa-play"></i>
                        </div>
                    </div>
                    <div class="video-info">
                        <h3 class="video-title">Reports & Analytics Dashboard</h3>
                        <div class="video-duration">
                            <i class="fas fa-clock"></i> 4:30 min
                        </div>
                        <p class="video-description">
                            How to generate financial reports, attendance analytics,
                            performance reports, and export data.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Platform Walkthrough -->
        <section class="walkthrough-section">
            <h2 class="section-title">Complete Institute Management Workflow</h2>

            <div class="walkthrough-steps">
                <!-- Step 1 -->
                <div class="walkthrough-step">
                    <div class="step-content">
                        <div class="step-number">1</div>
                        <h3>Login & System Setup</h3>
                        <p>
                            Access the web platform with your credentials. Configure your institute
                            settings, add branches, and set up user roles.
                        </p>
                        <ul class="step-features">
                            <li><i class="fas fa-check"></i> Secure login with role-based access</li>
                            <li><i class="fas fa-check"></i> Institute profile setup</li>
                            <li><i class="fas fa-check"></i> Branch management</li>
                            <li><i class="fas fa-check"></i> User role configuration</li>
                        </ul>
                    </div>
                    <div class="step-preview">
                        <div style="text-align: center; color: #94a3b8;">
                            <i class="fas fa-sign-in-alt" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                            <p>Login Interface Preview</p>
                        </div>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="walkthrough-step">
                    <div class="step-preview">
                        <div style="text-align: center; color: #94a3b8;">
                            <i class="fas fa-user-plus" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                            <p>Student Enrollment Preview</p>
                        </div>
                    </div>
                    <div class="step-content">
                        <div class="step-number">2</div>
                        <h3>Student Enrollment & Management</h3>
                        <p>
                            Add new students, assign classes, manage student profiles, and track
                            academic progress all from one interface.
                        </p>
                        <ul class="step-features">
                            <li><i class="fas fa-check"></i> Bulk student registration</li>
                            <li><i class="fas fa-check"></i> Class assignment</li>
                            <li><i class="fas fa-check"></i> Student profile management</li>
                            <li><i class="fas fa-check"></i> Academic progress tracking</li>
                        </ul>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="walkthrough-step">
                    <div class="step-content">
                        <div class="step-number">3</div>
                        <h3>Financial Management</h3>
                        <p>
                            Complete financial control including fee collection, expense tracking,
                            teacher salary processing, and financial reporting.
                        </p>
                        <ul class="step-features">
                            <li><i class="fas fa-check"></i> Fee collection & receipt generation</li>
                            <li><i class="fas fa-check"></i> Teacher salary processing</li>
                            <li><i class="fas fa-check"></i> Expense tracking</li>
                            <li><i class="fas fa-check"></i> Financial reports & analytics</li>
                        </ul>
                    </div>
                    <div class="step-preview">
                        <div style="text-align: center; color: #94a3b8;">
                            <i class="fas fa-chart-pie" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                            <p>Financial Dashboard Preview</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Final CTA Section -->
        <section class="cta-section">
            <h2 class="cta-title">Ready to Streamline Your Institute Management?</h2>
            <p class="cta-text">
                Join hundreds of institutes already using our web platform to manage their
                operations efficiently. Start your free trial today!
            </p>

            <div class="cta-buttons">
                <a href="{{ route('login') }}" class="btn btn-primary">
                    <i class="fas fa-sign-in-alt"></i> Access Web Platform
                </a>
                <a href="{{ route('pricing') }}" class="btn btn-secondary">
                    <i class="fas fa-tags"></i> View Pricing
                </a>
                <a href="{{ url('/') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Home
                </a>
            </div>

            <!-- Demo Login Credentials -->
            <div
                style="margin-top: 2rem; padding: 1rem; background: rgba(255, 255, 255, 0.05); border-radius: 12px; max-width: 500px; margin-left: auto; margin-right: auto;">
                <div
                    style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem; justify-content: center;">
                    <i class="fas fa-key" style="color: var(--accent-green);"></i>
                    <span style="font-weight: 600; color: #cbd5e1;">Web Platform Demo:</span>
                </div>
                <div style="display: flex; align-items: center; justify-content: center; gap: 1rem; flex-wrap: wrap;">
                    <div style="display: flex; align-items: center; gap: 0.25rem;">
                        <span style="color: #94a3b8; font-size: 0.9rem;">Email:</span>
                        <code
                            style="background: rgba(255, 255, 255, 0.1); padding: 0.25rem 0.75rem; border-radius: 6px;">admin@nexora.com</code>
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.25rem;">
                        <span style="color: #94a3b8; font-size: 0.9rem;">Password:</span>
                        <code
                            style="background: rgba(255, 255, 255, 0.1); padding: 0.25rem 0.75rem; border-radius: 6px;">nexora</code>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="footer">
            <div class="footer-links">
                <a href="{{ url('/') }}" class="footer-link">Home</a>
                <a href="{{ route('mobile-app') }}" class="footer-link">Mobile App</a>
                <a href="{{ route('web-platform') }}" class="footer-link">Web Platform</a>
                <a href="{{ route('pricing') }}" class="footer-link">Pricing</a>
                <a href="{{ route('interactive-learning') }}" class="footer-link">Features</a>
                <a href="{{ route('login') }}" class="footer-link">Login</a>
            </div>
            <p>&copy; 2024 NEXORA Education System. All rights reserved.</p>
            <p style="margin-top: 1rem; font-size: 0.9rem;">
                <i class="fas fa-map-marker-alt"></i> Mirigama, Sri Lanka |
                <i class="fas fa-phone"></i> +94 76 897 12 13 |
                <i class="fas fa-envelope"></i> info@nexora.edu.lk
            </p>
            <p style="margin-top: 0.5rem; font-size: 0.8rem; color: #64748b;">
                "Bringing You Next" in Education Technology
            </p>
        </footer>
    </div>

    <script>
        // Create background particles
        function createParticles() {
            const container = document.getElementById('particles');
            const colors = ['rgba(59, 130, 246, 0.1)', 'rgba(16, 185, 129, 0.1)', 'rgba(139, 92, 246, 0.1)'];

            for (let i = 0; i < 20; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');

                const size = Math.random() * 100 + 20;
                const color = colors[Math.floor(Math.random() * colors.length)];
                const left = Math.random() * 100;
                const top = Math.random() * 100;
                const delay = Math.random() * 15;

                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                particle.style.background = color;
                particle.style.left = `${left}%`;
                particle.style.top = `${top}%`;
                particle.style.animationDelay = `${delay}s`;

                container.appendChild(particle);
            }
        }

        // Video data - Replace with your actual YouTube/Vimeo video IDs
        const videoData = {
            'login-guide': {
                title: 'Login & Dashboard Navigation Guide',
                videoId: 'YOUR_VIDEO_ID_1', // Replace with actual YouTube/Vimeo ID
                type: 'youtube' // or 'vimeo'
            },
            'student-management': {
                title: 'Student Enrollment & Management Guide',
                videoId: 'YOUR_VIDEO_ID_2',
                type: 'youtube'
            },
            'payment-management': {
                title: 'Fee Collection & Payment Management Guide',
                videoId: 'YOUR_VIDEO_ID_3',
                type: 'youtube'
            },
            'teacher-salary': {
                title: 'Teacher Salary Processing Guide',
                videoId: 'YOUR_VIDEO_ID_4',
                type: 'youtube'
            },
            'attendance-system': {
                title: 'Attendance Management System Guide',
                videoId: 'YOUR_VIDEO_ID_5',
                type: 'youtube'
            },
            'reports-analytics': {
                title: 'Reports & Analytics Dashboard Guide',
                videoId: 'YOUR_VIDEO_ID_6',
                type: 'youtube'
            }
        };

        // Video modal functionality
        const videoModal = document.getElementById('videoModal');
        const closeModal = document.getElementById('closeModal');
        const videoContainer = document.getElementById('videoContainer');
        const modalTitle = document.getElementById('modalTitle');

        // Open video modal when play button is clicked
        document.querySelectorAll('.video-card').forEach(card => {
            const playButton = card.querySelector('.play-button');
            const videoId = card.dataset.videoId;

            playButton.addEventListener('click', () => {
                const video = videoData[videoId];
                if (video) {
                    modalTitle.textContent = video.title;

                    // Clear previous video
                    videoContainer.innerHTML = '';

                    // Create iframe based on video type
                    let iframeSrc = '';
                    if (video.type === 'youtube') {
                        iframeSrc = `https://www.youtube.com/embed/${video.videoId}?autoplay=1&rel=0`;
                    } else if (video.type === 'vimeo') {
                        iframeSrc = `https://player.vimeo.com/video/${video.videoId}?autoplay=1`;
                    }

                    const iframe = document.createElement('iframe');
                    iframe.src = iframeSrc;
                    iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture';
                    iframe.allowFullscreen = true;

                    videoContainer.appendChild(iframe);
                    videoModal.classList.add('active');
                    document.body.style.overflow = 'hidden';
                }
            });
        });

        // Close video modal
        closeModal.addEventListener('click', () => {
            videoModal.classList.remove('active');
            document.body.style.overflow = 'auto';
            // Stop video playback
            videoContainer.innerHTML = '';
        });

        // Close modal when clicking outside
        videoModal.addEventListener('click', (e) => {
            if (e.target === videoModal) {
                videoModal.classList.remove('active');
                document.body.style.overflow = 'auto';
                videoContainer.innerHTML = '';
            }
        });

        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');

        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('active');
            mobileMenuBtn.innerHTML = mobileMenu.classList.contains('active')
                ? '<i class="fas fa-times"></i>'
                : '<i class="fas fa-bars"></i>';
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!mobileMenu.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
                mobileMenu.classList.remove('active');
                mobileMenuBtn.innerHTML = '<i class="fas fa-bars"></i>';
            }
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                if (this.getAttribute('href').startsWith('#') && this.getAttribute('href') !== '#') {
                    e.preventDefault();

                    const targetId = this.getAttribute('href');
                    const targetElement = document.querySelector(targetId);

                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 100,
                            behavior: 'smooth'
                        });
                    }
                }
            });
        });

        // Initialize everything when page loads
        document.addEventListener('DOMContentLoaded', function () {
            createParticles();
        });
    </script>
</body>

</html>