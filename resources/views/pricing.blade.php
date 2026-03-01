<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pricing - NEXORA Education System</title>

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
        .pricing-hero {
            padding: 4rem 2rem;
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
            font-size: 1.25rem;
            color: #cbd5e1;
            max-width: 600px;
            margin: 0 auto 3rem;
            line-height: 1.6;
        }

        /* Pricing Plans */
        .pricing-section {
            padding: 2rem 2rem 4rem;
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

        .pricing-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
            margin-bottom: 4rem;
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
        }

        @media (max-width: 768px) {
            .pricing-grid {
                grid-template-columns: 1fr;
                max-width: 500px;
                margin: 0 auto 4rem;
            }
        }

        .pricing-card {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            padding: 2.5rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .pricing-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .pricing-card.popular {
            border-color: var(--accent-green);
            transform: scale(1.05);
            z-index: 2;
        }

        .pricing-card.popular:hover {
            transform: scale(1.05) translateY(-10px);
        }

        .popular-badge {
            position: absolute;
            top: 20px;
            right: -30px;
            background: var(--accent-green);
            color: white;
            padding: 0.5rem 3rem;
            transform: rotate(45deg);
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .pricing-header {
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .plan-name {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: white;
        }

        .plan-description {
            color: #94a3b8;
            font-size: 0.9rem;
        }

        .price-container {
            margin: 1.5rem 0;
        }

        .price-main {
            font-size: 3.5rem;
            font-weight: 800;
            color: var(--accent-green);
            line-height: 1;
        }

        .price-period {
            color: #94a3b8;
            font-size: 1rem;
            margin-top: 0.5rem;
        }

        .price-note {
            font-size: 0.9rem;
            color: #f59e0b;
            background: rgba(245, 158, 11, 0.1);
            padding: 0.5rem;
            border-radius: 8px;
            margin-top: 0.5rem;
            border: 1px solid rgba(245, 158, 11, 0.2);
        }

        .price-highlight {
            font-size: 0.9rem;
            color: var(--accent-green);
            background: rgba(16, 185, 129, 0.1);
            padding: 0.5rem;
            border-radius: 8px;
            margin-top: 0.5rem;
            border: 1px solid rgba(16, 185, 129, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .features-list {
            flex-grow: 1;
            margin-bottom: 2rem;
        }

        .features-list h4 {
            color: white;
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }

        .features-list ul {
            list-style: none;
        }

        .features-list li {
            padding: 0.75rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            display: flex;
            align-items: flex-start;
            gap: 1rem;
        }

        .features-list li i {
            color: var(--accent-green);
            width: 24px;
            margin-top: 0.25rem;
        }

        .feature-included {
            color: #cbd5e1;
        }

        .feature-excluded {
            color: #64748b;
            text-decoration: line-through;
        }

        /* Button Styles - Updated */
        .pricing-button {
            margin-top: auto;
            width: 100%;
            padding: 1.2rem;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
        }

        .pricing-button::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.1) 50%, transparent 70%);
            transform: translateX(-100%);
            transition: transform 0.6s;
        }

        .pricing-button:hover::after {
            transform: translateX(100%);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent-green), #0da271);
            color: white;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.4);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-3px);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .btn-outline {
            background: transparent;
            color: white;
            border: 2px solid var(--accent-green);
        }

        .btn-outline:hover {
            background: rgba(16, 185, 129, 0.1);
            transform: translateY(-3px);
        }

        /* WhatsApp Button */
        .btn-whatsapp {
            background: linear-gradient(135deg, #25D366, #128C7E);
            color: white;
            box-shadow: 0 4px 15px rgba(37, 211, 102, 0.3);
        }

        .btn-whatsapp:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(37, 211, 102, 0.4);
        }

        /* Special Offer Banner */
        .offer-banner {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.1), rgba(239, 68, 68, 0.1));
            border-radius: 15px;
            padding: 2rem;
            max-width: 1200px;
            margin: 3rem auto;
            border: 1px solid rgba(245, 158, 11, 0.3);
            position: relative;
            overflow: hidden;
        }

        .offer-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 2rem;
        }

        .offer-icon {
            width: 80px;
            height: 80px;
            background: rgba(245, 158, 11, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .offer-icon i {
            color: #f59e0b;
            font-size: 2.5rem;
        }

        .offer-text {
            flex-grow: 1;
        }

        .offer-text h3 {
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
            color: white;
        }

        .offer-text p {
            color: #cbd5e1;
            line-height: 1.6;
        }

        /* Features Comparison */
        .comparison-section {
            padding: 4rem 2rem;
            background: rgba(255, 255, 255, 0.02);
            border-radius: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .comparison-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 2rem;
        }

        .comparison-table th,
        .comparison-table td {
            padding: 1rem;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .comparison-table th {
            background: rgba(255, 255, 255, 0.05);
            color: white;
            font-weight: 600;
        }

        .comparison-table td:first-child {
            text-align: left;
            font-weight: 500;
            color: #cbd5e1;
        }

        .feature-check {
            color: var(--accent-green);
            font-size: 1.2rem;
        }

        .feature-cross {
            color: #ef4444;
            font-size: 1.2rem;
        }

        .feature-limited {
            color: #f59e0b;
        }

        /* FAQ Section */
        .faq-section {
            padding: 4rem 2rem;
            max-width: 800px;
            margin: 0 auto;
        }

        .faq-grid {
            display: grid;
            gap: 1rem;
            margin-top: 2rem;
        }

        .faq-item {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .faq-question {
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
        }

        .faq-question h4 {
            font-size: 1.1rem;
            color: white;
        }

        .faq-toggle {
            color: var(--accent-green);
            transition: transform 0.3s;
        }

        .faq-answer {
            color: #cbd5e1;
            line-height: 1.6;
            margin-top: 1rem;
            display: none;
        }

        .faq-item.active .faq-answer {
            display: block;
        }

        .faq-item.active .faq-toggle {
            transform: rotate(45deg);
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

        /* WhatsApp Float Button */
        .whatsapp-float {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background: #25D366;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4);
            z-index: 1000;
            text-decoration: none;
            transition: all 0.3s;
        }

        .whatsapp-float:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 25px rgba(37, 211, 102, 0.6);
        }

        .whatsapp-float-text {
            position: absolute;
            right: 70px;
            background: #25D366;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            white-space: nowrap;
            opacity: 0;
            transition: opacity 0.3s;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .whatsapp-float:hover .whatsapp-float-text {
            opacity: 1;
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

            .offer-content {
                flex-direction: column;
                text-align: center;
            }

            .price-main {
                font-size: 2.8rem;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }

            .pricing-card.popular {
                transform: scale(1);
            }

            .pricing-card.popular:hover {
                transform: translateY(-10px);
            }

            .whatsapp-float {
                bottom: 20px;
                right: 20px;
                width: 50px;
                height: 50px;
                font-size: 1.5rem;
            }

            .whatsapp-float-text {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .hero-title {
                font-size: 2.2rem;
            }

            .section-title {
                font-size: 1.8rem;
            }

            .price-main {
                font-size: 2.2rem;
            }

            .pricing-card {
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
            <a href="{{ route('web-platform') }}" class="nav-link">Web Platform</a>
            <a href="{{ route('pricing') }}" class="nav-link active">Pricing</a>
            {{-- <a href="{{ route('interactive-learning') }}" class="nav-link">Features</a> --}}
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <div class="mobile-nav-links">
            <a href="{{ url('/') }}" class="mobile-nav-link">Home</a>
            <a href="{{ route('mobile-app') }}" class="mobile-nav-link">Mobile App</a>
            <a href="{{ route('web-platform') }}" class="mobile-nav-link">Web Platform</a>
            <a href="{{ route('pricing') }}" class="mobile-nav-link active">Pricing</a>
            {{-- <a href="{{ route('interactive-learning') }}" class="mobile-nav-link">Features</a> --}}
            <a href="{{ route('login') }}" class="mobile-nav-link"
                style="background: var(--accent-green); color: white;">
                <i class="fas fa-sign-in-alt"></i> ACCESS LOGIN
            </a>
        </div>
    </div>

    <!-- WhatsApp Float Button -->
    <a href="https://wa.me/94768971213" class="whatsapp-float" target="_blank" title="Contact on WhatsApp">
        <i class="fab fa-whatsapp"></i>
        <span class="whatsapp-float-text">Get Quote on WhatsApp</span>
    </a>

    <!-- Background Animation -->
    <div class="background-animation" id="particles"></div>
    <div class="grid-overlay"></div>

    <!-- Main Content -->
    <div class="main-container">
        <!-- Hero Section -->
        <section class="pricing-hero">
            <h1 class="hero-title">Simple, Transparent Pricing</h1>
            <p class="hero-subtitle">
                Get the complete NEXORA Education System for FREE! Pay only for Student ID Cards.
                Perfect for educational institutions of all sizes.
            </p>

            <div class="cta-buttons">
                <a href="#plans" class="btn-secondary">
                    <i class="fas fa-tags"></i> View Plans
                </a>
                <button class="btn-secondary" onclick="sendToWhatsApp('General Inquiry', 'Free System')">
                    <i class="fab fa-whatsapp"></i> Get Free System
                </button>
            </div>
        </section>

        <!-- Special Offer Banner -->
        <section class="offer-banner">
            <div class="offer-content">
                <div class="offer-icon">
                    <i class="fas fa-gift"></i>
                </div>
                <div class="offer-text">
                    <h3>🎉 Special Launch Offer!</h3>
                    <p>
                        Get the <strong>complete NEXORA Education System for FREE</strong>!
                        Pay only for Student ID Cards at a flat rate of
                        <strong>LKR 350 per student</strong>.
                    </p>
                </div>
                <button class="pricing-button btn-whatsapp"
                    onclick="sendToWhatsApp('Special Offer', 'Free System + ID Cards')">
                    <i class="fab fa-whatsapp"></i> Get This Offer
                </button>
            </div>
        </section>

        <!-- Pricing Plans -->
        <section class="pricing-section" id="plans">
            <h2 class="section-title">Choose Your Plan</h2>

            <div class="pricing-grid">
                <!-- Professional Plan (Most Popular) - NOW FREE -->
                <div class="pricing-card popular">
                    <div class="popular-badge">Most Popular</div>
                    <div class="pricing-header">
                        <h3 class="plan-name">Professional</h3>
                        <p class="plan-description">Complete Education System</p>

                        <div class="price-container">
                            <div class="price-main" style="color: #10b981;">FREE</div>
                            <div class="price-period">System Setup</div>
                            <div class="price-highlight">
                                <i class="fas fa-graduation-cap"></i>
                                Only pay for ID Cards - LKR 350/student
                            </div>
                        </div>
                    </div>

                    <div class="features-list">
                        <h4>Complete Package Includes:</h4>
                        <ul>
                            <li>
                                <i class="fas fa-check"></i>
                                <span class="feature-included"><strong>Complete NEXORA System - FREE</strong></span>
                            </li>
                            <li>
                                <i class="fas fa-check"></i>
                                <span class="feature-included">
                                    <strong>Student ID Cards - LKR 350 per student</strong>
                                </span>
                            </li>
                            <li>
                                <i class="fas fa-check"></i>
                                <span class="feature-included">
                                    <small style="color: #94a3b8;">(Includes ID Card + Full system access)</small>
                                </span>
                            </li>
                            <li>
                                <i class="fas fa-check"></i>
                                <span class="feature-included">Unlimited Teacher Accounts</span>
                            </li>
                            <li>
                                <i class="fas fa-check"></i>
                                <span class="feature-included">Advanced Mobile App</span>
                            </li>
                            <li>
                                <i class="fas fa-check"></i>
                                <span class="feature-included">Attendance & Payment System</span>
                            </li>
                            <li>
                                <i class="fas fa-check"></i>
                                <span class="feature-included">Unlimited Student ID Card Generation</span>
                            </li>
                            <li>
                                <i class="fas fa-check"></i>
                                <span class="feature-included">Priority Support & Regular Updates</span>
                            </li>
                        </ul>
                        <div
                            style="margin-top: 1rem; padding: 1rem; background: rgba(16, 185, 129, 0.1); border-radius: 8px; border: 1px solid rgba(16, 185, 129, 0.3);">
                            <p style="color: #cbd5e1; font-size: 0.9rem; margin: 0;">
                                <i class="fas fa-info-circle" style="color: #10b981;"></i>
                                <strong>Note:</strong> System is completely FREE. You only pay for Student ID Cards at
                                LKR 350 per student.
                            </p>
                        </div>
                    </div>

                    <div style="display: flex; flex-direction: column; gap: 1rem; margin-top: auto;">
                        <button class="pricing-button btn-whatsapp"
                            onclick="sendToWhatsApp('Professional FREE Plan', 'Free System + ID Card Packages')">
                            <i class="fab fa-whatsapp"></i> Get Free System
                        </button>
                        <a href="{{ route('login') }}" class="pricing-button btn-secondary">
                            <i class="fas fa-rocket"></i> Start Free Setup
                        </a>
                    </div>
                </div>

                <!-- Enterprise Plan -->
                <div class="pricing-card">
                    <div class="pricing-header">
                        <h3 class="plan-name">Enterprise</h3>
                        <p class="plan-description">For large institutions & chains</p>

                        <div class="price-container">
                            <div class="price-main">Custom</div>
                            <div class="price-period">Tailored pricing</div>
                            <div class="price-highlight">
                                <i class="fas fa-crown"></i>
                                Premium Features
                            </div>
                        </div>
                    </div>

                    <div class="features-list">
                        <h4>Everything in Professional, plus:</h4>
                        <ul>
                            <li>
                                <i class="fas fa-check"></i>
                                <span class="feature-included">Multi-branch Management</span>
                            </li>
                            <li>
                                <i class="fas fa-check"></i>
                                <span class="feature-included">Custom Development</span>
                            </li>
                            <li>
                                <i class="fas fa-check"></i>
                                <span class="feature-included">Dedicated Support Team</span>
                            </li>
                            <li>
                                <i class="fas fa-check"></i>
                                <span class="feature-included">API Access</span>
                            </li>
                            <li>
                                <i class="fas fa-check"></i>
                                <span class="feature-included">White-label Solution</span>
                            </li>
                            <li>
                                <i class="fas fa-check"></i>
                                <span class="feature-included">On-premise Deployment</span>
                            </li>
                            <li>
                                <i class="fas fa-check"></i>
                                <span class="feature-included">Custom Integration</span>
                            </li>
                            <li>
                                <i class="fas fa-check"></i>
                                <span class="feature-included">Training & Onboarding</span>
                            </li>
                        </ul>
                    </div>

                    <div style="display: flex; flex-direction: column; gap: 1rem; margin-top: auto;">
                        <button class="pricing-button btn-whatsapp"
                            onclick="sendToWhatsApp('Enterprise Plan', 'Custom Pricing')">
                            <i class="fab fa-whatsapp"></i> Contact Sales
                        </button>
                        <a href="{{ route('login') }}" class="pricing-button btn-outline">
                            <i class="fas fa-headset"></i> View Demo
                        </a>
                    </div>
                </div>
            </div>

            <!-- Maintenance Note -->
            <div
                style="text-align: center; margin-top: 2rem; padding: 1.5rem; background: rgba(59, 130, 246, 0.1); border-radius: 12px; border: 1px solid rgba(59, 130, 246, 0.3);">
                <h4 style="color: white; margin-bottom: 0.5rem;">
                    <i class="fas fa-shield-alt"></i> System Features
                </h4>
                <p style="color: #cbd5e1; max-width: 800px; margin: 0 auto;">
                    All plans include <strong>regular updates, security patches, and technical support</strong>.
                    The Professional plan offers the complete system for FREE with ID Card packages at
                    <strong>LKR 350 per student</strong>.
                </p>
            </div>
        </section>

        <!-- Features Comparison -->
        <section class="comparison-section" id="comparison">
            <h2 class="section-title">Feature Comparison</h2>

            <div class="comparison-table-container" style="overflow-x: auto;">
                <table class="comparison-table">
                    <thead>
                        <tr>
                            <th>Feature</th>
                            <th>Professional</th>
                            <th>Enterprise</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>System Access</td>
                            <td><strong style="color: #10b981;">FREE</strong></td>
                            <td><strong style="color: #10b981;">FREE</strong></td>
                        </tr>
                        <tr>
                            <td>Student ID Cards</td>
                            <td><strong>LKR 350/student</strong></td>
                            <td><strong>Custom Pricing</strong></td>
                        </tr>

                        <tr>
                            <td>Student Management</td>
                            <td><i class="fas fa-check feature-check"></i></td>
                            <td><i class="fas fa-check feature-check"></i></td>
                        </tr>
                        <tr>
                            <td>Teacher Management</td>
                            <td><i class="fas fa-check feature-check"></i></td>
                            <td><i class="fas fa-check feature-check"></i></td>
                        </tr>
                        <tr>
                            <td>Payment System</td>
                            <td><i class="fas fa-check feature-check"></i></td>
                            <td><i class="fas fa-check feature-check"></i></td>
                        </tr>
                        <tr>
                            <td>Attendance System</td>
                            <td><i class="fas fa-check feature-check"></i></td>
                            <td><i class="fas fa-check feature-check"></i></td>
                        </tr>
                        <tr>
                            <td>Mobile App</td>
                            <td><i class="fas fa-check feature-check"></i> Advanced</td>
                            <td><i class="fas fa-check feature-check"></i> Full Access</td>
                        </tr>
                        <tr>
                            <td>ID Card Generation</td>
                            <td><i class="fas fa-check feature-check"></i> Unlimited</td>
                            <td><i class="fas fa-check feature-check"></i> Unlimited</td>
                        </tr>
                        <tr>
                            <td>Security & Backup</td>
                            <td><i class="fas fa-check feature-check"></i></td>
                            <td><i class="fas fa-check feature-check"></i></td>
                        </tr>
                        <tr>
                            <td>Regular Updates</td>
                            <td><i class="fas fa-check feature-check"></i></td>
                            <td><i class="fas fa-check feature-check"></i></td>
                        </tr>
                        <tr>
                            <td>Priority Support</td>
                            <td><i class="fas fa-check feature-check"></i></td>
                            <td><i class="fas fa-check feature-check"></i> 24/7</td>
                        </tr>
                        <tr>
                            <td>Custom Features</td>
                            <td><i class="fas fa-times feature-cross"></i></td>
                            <td><i class="fas fa-check feature-check"></i></td>
                        </tr>
                        <tr>
                            <td>API Access</td>
                            <td><i class="fas fa-times feature-cross"></i></td>
                            <td><i class="fas fa-check feature-check"></i></td>
                        </tr>
                        <tr>
                            <td>Multi-branch Management</td>
                            <td><i class="fas fa-times feature-cross"></i></td>
                            <td><i class="fas fa-check feature-check"></i></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="faq-section">
            <h2 class="section-title">Frequently Asked Questions</h2>

            <div class="faq-grid">
                <div class="faq-item">
                    <div class="faq-question">
                        <h4>Is the system really FREE?</h4>
                        <span class="faq-toggle">+</span>
                    </div>
                    <div class="faq-answer">
                        <strong>Yes, absolutely FREE!</strong> The complete NEXORA Education System including all
                        features
                        (student management, teacher management, attendance system, payment system, mobile app) is
                        completely
                        FREE. You only pay for Student ID Cards.
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <h4>What are the ID Card pricing details?</h4>
                        <span class="faq-toggle">+</span>
                    </div>
                    <div class="faq-answer">
                        <p><strong>Student ID Card Pricing:</strong></p>
                        <div
                            style="margin: 1rem 0; padding: 1rem; background: rgba(16, 185, 129, 0.1); border-radius: 8px;">
                            <div
                                style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
                                <span><strong>All Students:</strong></span>
                                <span><strong>LKR 350 per student</strong></span>
                            </div>
                        </div>
                        <p style="color: #94a3b8; font-size: 0.9rem; margin-top: 0.5rem;">
                            <i class="fas fa-info-circle"></i> Each ID Card includes full-color printing, lamination,
                            and unique student identification.
                        </p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <h4>What happens after I get the FREE system?</h4>
                        <span class="faq-toggle">+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Once you get the FREE system, you can:</p>
                        <ul style="margin: 0.5rem 0 0.5rem 1.5rem; color: #cbd5e1;">
                            <li>Add unlimited teachers and staff</li>
                            <li>Set up your class structure</li>
                            <li>Configure payment plans</li>
                            <li>Access all features immediately</li>
                            <li>Start using the mobile app</li>
                        </ul>
                        <p>When you're ready to issue Student ID Cards, simply contact us with the number of students
                            and we'll process your ID Card order at LKR 350 per student.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <h4>Do I need to pay maintenance fees?</h4>
                        <span class="faq-toggle">+</span>
                    </div>
                    <div class="faq-answer">
                        <p><strong>No additional maintenance fees!</strong> All regular updates, security patches,
                            and basic technical support are included with your FREE system. The only charges are for
                            Student ID Cards as described.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <h4>Can I get a sample ID Card?</h4>
                        <span class="faq-toggle">+</span>
                    </div>
                    <div class="faq-answer">
                        Absolutely! We provide sample ID Cards for review before you place your order.
                        Contact us via WhatsApp to request samples and discuss your specific requirements.
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <h4>How long does setup take?</h4>
                        <span class="faq-toggle">+</span>
                    </div>
                    <div class="faq-answer">
                        System setup typically takes <strong>24-48 hours</strong>. Once setup is complete,
                        you'll receive login credentials and can start using the system immediately.
                        ID Card production starts after we receive your student list and photos.
                    </div>
                </div>
            </div>
        </section>

        <!-- Final CTA Section -->
        <section class="cta-section">
            <h2 class="cta-title">Ready to Get Your FREE System?</h2>
            <p class="cta-text">
                Get the complete NEXORA Education System for FREE today! Pay only for Student ID Cards
                at a flat rate of LKR 350 per student. Perfect for educational institutions of all sizes.
            </p>

            <div class="cta-buttons">
                <button class="pricing-button btn-whatsapp"
                    onclick="sendToWhatsApp('Professional FREE Plan', 'Free System + ID Card Packages')">
                    <i class="fab fa-whatsapp"></i> Get FREE System on WhatsApp
                </button>
                <a href="{{ url('/') }}" class="pricing-button btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Home
                </a>
                <a href="{{ route('interactive-learning') }}" class="pricing-button btn-secondary">
                    <i class="fas fa-play-circle"></i> Watch Demo
                </a>
            </div>

            <!-- Demo Login Credentials -->
            <div
                style="margin-top: 2rem; padding: 1rem; background: rgba(255, 255, 255, 0.05); border-radius: 12px; max-width: 500px; margin-left: auto; margin-right: auto;">
                <div
                    style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem; justify-content: center;">
                    <i class="fas fa-key" style="color: var(--accent-green);"></i>
                    <span style="font-weight: 600; color: #cbd5e1;">Demo Login:</span>
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
                {{-- <a href="{{ route('interactive-learning') }}" class="footer-link">Features</a> --}}
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
        // WhatsApp sharing function
        function sendToWhatsApp(planName, price) {
            const phoneNumber = '768971213'; // Your WhatsApp number without +94
            const message = `Hello NEXORA Team!\n\nI'm interested in the *${planName}* (${price}).\n\nPlease send me more details about:\n1. Getting the FREE system\n2. Student ID Card pricing (LKR 350 per student)\n3. Setup process\n4. System features\n\nThank you!\n\n*Name:* \n*Institute:* \n*Number of Students:* \n*Contact Number:* `;

            // Encode the message for URL
            const encodedMessage = encodeURIComponent(message);
            const whatsappURL = `https://wa.me/94${phoneNumber}?text=${encodedMessage}`;

            // Open WhatsApp in new tab
            window.open(whatsappURL, '_blank', 'noopener,noreferrer');
        }

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

        // FAQ toggle functionality
        document.querySelectorAll('.faq-question').forEach(question => {
            question.addEventListener('click', () => {
                const item = question.parentElement;
                item.classList.toggle('active');
            });
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

            // Auto-open first FAQ
            document.querySelector('.faq-item').classList.add('active');
        });
    </script>
</body>

</html>