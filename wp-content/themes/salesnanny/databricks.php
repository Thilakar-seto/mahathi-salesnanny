<?php
/**
 * Template Name: Databricks Solutions
 * Description: Enterprise Databricks implementation & migration services page.
 */
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Databricks implementation services for insurance carriers and healthcare payers. Mahathi is a certified Databricks Bronze Partner offering zero-downtime migrations, real-time analytics, and AI-powered fraud detection. 100+ successful implementations, 2.5B+ records migrated.">
    <meta name="keywords" content="databricks implementation, databricks service, databricks partner, databricks bronze partner, data migration, enterprise analytics, insurance data platform, healthcare data solutions, lakehouse implementation, real-time analytics">
    <meta name="author" content="Mahathi Infotech">
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <meta property="og:title" content="Enterprise Databricks Implementation Services | Mahathi">
    <meta property="og:description" content="Transform your data platform with certified Databricks implementation. 100+ deployments, zero-downtime migrations, AI-powered intelligence for insurance & healthcare.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://mahathiinfotech.com/databricks">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Databricks Implementation Services">
    <meta name="twitter:description" content="Certified Databricks partner delivering enterprise data solutions for insurance and healthcare.">
    <link rel="canonical" href="https://mahathiinfotech.com/databricks">
    <title>Enterprise Databricks Implementation Services | Certified Bronze Partner</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=IBM+Plex+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --sage: #76A379;
            --sage-light: #91B896;
            --sage-dark: #5d8a62;
            --forest: #253830;
            --forest-light: #3a5047;
            --cream: #EEF0EC;
            --text-dark: #1a1a1a;
            --text-light: #707070;
            --text-muted: #999;
            --border-light: #e5e5e5;
            --accent: #f0743d;
            --white: #fff;
            --shadow-sm: 0 2px 8px rgba(0,0,0,0.06);
            --shadow-md: 0 4px 16px rgba(0,0,0,0.08);
            --shadow-lg: 0 8px 32px rgba(0,0,0,0.1);
            --shadow-xl: 0 12px 48px rgba(0,0,0,0.12);
        }

        html { scroll-behavior: smooth; }
        body {
            font-family: 'Aptos', 'IBM Plex Sans', 'Segoe UI', system-ui, sans-serif;
            line-height: 1.7;
            color: var(--text-dark);
            background: var(--white);
            font-size: 15px;
        }

        /* HERO - reference layout */
        section.hero {
            --hero-inline-pad: clamp(32px, 5vw, 60px);
            padding: clamp(52px, 6.5vw, 80px) var(--hero-inline-pad);
            background: #9aab9a;
        }

        section.hero::before {
            display: none;
        }

        .hero {
            --hero-img-height: clamp(300px, 36vw, 460px);
            position: relative;
            max-width: 1320px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(0, 1.12fr);
            align-items: center;
            gap: clamp(36px, 5vw, 80px);
            padding: 0;
            min-height: 0;
            overflow: visible;
            box-sizing: border-box;
        }

        .hero-content {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 100%;
            max-width: 34rem;
            padding: 0;
        }

        .hero-content h1 {
            font-family: 'Aptos', 'Segoe UI', system-ui, sans-serif;
            font-size: clamp(1.75rem, 3.25vw, 2.875rem);
            line-height: 1.12;
            margin-bottom: clamp(18px, 2.2vw, 26px);
            color: #1a2b3c;
            letter-spacing: -0.02em;
            font-weight: 700;
        }

        .hero-badge {
            display: block;
            background: none;
            color: #1a2b3c;
            padding: 0;
            border-radius: 0;
            font-size: 11px;
            font-weight: 700;
            margin-bottom: clamp(14px, 1.8vw, 20px);
            text-transform: uppercase;
            letter-spacing: 0.14em;
            box-shadow: none;
        }

        .hero p {
            font-size: clamp(0.9375rem, 1.25vw, 1.0625rem);
            line-height: 1.65;
            color: #1a2b3c;
            margin-bottom: 0;
            max-width: 32rem;
            text-align: justify;
        }

        .hero-image {
            position: relative;
            justify-self: stretch;
            width: 100%;
            height: var(--hero-img-height);
            margin: 0;
            font-size: 0;
            line-height: 0;
            color: transparent;
            overflow: hidden;
            border-top-left-radius: calc(var(--hero-img-height) / 2);
            border-bottom-left-radius: calc(var(--hero-img-height) / 2);
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
            background-color: #7a9172;
            background-image: url('https://images.unsplash.com/photo-1600880292203-757bb62b4baf?auto=format&fit=crop&w=1400&q=80');
            background-size: cover;
            background-position: center;
        }

        .btn {
            padding: 16px 40px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            display: inline-block;
            text-transform: uppercase;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--sage) 0%, var(--sage-dark) 100%);
            color: var(--white);
            box-shadow: 0 6px 20px rgba(118, 163, 121, 0.25);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 32px rgba(118, 163, 121, 0.35);
        }

        .btn-secondary {
            background: transparent;
            color: var(--sage);
            border: 2px solid var(--sage);
            font-weight: 700;
        }

        .btn-secondary:hover {
            background: var(--sage);
            color: var(--white);
            border-color: var(--sage);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(118, 163, 121, 0.2);
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        /* CONTAINER */
        .container {
            max-width: 1320px;
            margin: 0 auto;
            padding: 0 60px;
        }

        /* SECTION STYLING - PREMIUM */
        section {
            padding: 100px 0;
            position: relative;
        }

        section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(to right, transparent, var(--border-light), transparent);
        }

        /* SECTION HEADER */
        .section-header {
            margin-bottom: 60px;
            text-align: left;
        }

        .section-header h2 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 44px;
            color: var(--forest);
            margin-bottom: 20px;
            letter-spacing: -0.5px;
            font-weight: 700;
            position: relative;
            padding-bottom: 16px;
        }

        .section-header p {
            font-size: 16px;
            color: var(--text-light);
            line-height: 1.8;
            max-width: 700px;
        }

        /* CHALLENGES SECTION */
        .challenges-section {
            background: var(--cream);
            padding: 80px 0;
        }

        .challenges-section::before {
            display: none;
        }

        .challenges-section .section-header {
            margin-bottom: 40px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        .challenges-section .section-header h2 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 42px;
            color: var(--forest);
            margin: 0;
            letter-spacing: -0.5px;
            font-weight: 700;
            line-height: 1.2;
            padding-bottom: 0;
        }

        .challenges-section .section-header h2::after {
            display: none;
        }

        .section-intro {
            font-size: 15px;
            color: var(--text-light);
            line-height: 1.8;
        }

        .challenges-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .challenge-card {
            padding: 28px;
            background: var(--white);
            border-radius: 6px;
            border-left: 4px solid var(--sage);
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            min-height: 120px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        .challenge-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transform: translateY(-2px);
        }

        .challenge-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--forest);
            margin-bottom: 8px;
            letter-spacing: -0.3px;
        }

        .challenge-description {
            font-size: 14px;
            line-height: 1.7;
            color: var(--text-light);
            margin: 0;
        }

        @media (max-width: 1024px) {
            .challenges-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }
            .challenges-section .section-header {
                grid-template-columns: 1fr;
                gap: 30px;
            }
            .challenges-section .section-header h2 {
                font-size: 36px;
            }
        }

        @media (max-width: 768px) {
            .challenges-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }
            .challenges-section .section-header {
                grid-template-columns: 1fr;
                gap: 24px;
            }
            .challenges-section .section-header h2 {
                font-size: 28px;
            }
            .section-intro {
                font-size: 14px;
            }
        }

        /* SERVICES SECTION - PREMIUM */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 36px;
            margin-top: 50px;
        }

        .service-card {
            padding: 40px;
            border: 1px solid var(--border-light);
            border-radius: 8px;
            transition: all 0.3s ease;
            background: var(--white);
            box-shadow: var(--shadow-sm);
            position: relative;
            overflow: hidden;
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(to right, var(--sage), var(--sage-light));
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }

        .service-card:hover::before {
            transform: translateX(0);
        }

        .service-card:hover {
            border-color: var(--sage);
            box-shadow: 0 8px 32px rgba(118, 163, 121, 0.15);
            transform: translateY(-8px);
        }

        .service-icon {
            width: 56px;
            height: 56px;
            margin-bottom: 24px;
            background: linear-gradient(180deg, #7d9478 0%, #4f6554 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            transition: transform 0.3s ease;
        }

        .service-card:hover .service-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .service-icon svg {
            width: 28px;
            height: 28px;
            display: block;
            flex-shrink: 0;
        }

        .service-card h3 {
            font-size: 19px;
            margin-bottom: 16px;
            color: var(--forest);
            font-weight: 700;
            letter-spacing: -0.3px;
            line-height: 1.4;
        }

        .service-card p {
            font-size: 15px;
            line-height: 1.8;
            color: var(--text-light);
            margin-bottom: 16px;
        }

        .service-metric {
            display: flex;
            gap: 10px;
            align-items: flex-start;
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid #f0f0f0;
        }

        .service-metric + .service-metric {
            border-top: none;
            margin-top: 6px;
            padding-top: 0;
        }

        .metric-icon {
            color: var(--sage);
            font-weight: 700;
            font-size: 16px;
            min-width: 18px;
            line-height: 1.6;
        }

        .metric-text {
            font-size: 13px;
            line-height: 1.6;
            color: var(--text-dark);
            font-weight: 500;
        }

        /* WHY CHOOSE MAHATHI SECTION */
        section.why-mahathi-section {
            background: #fff;
        }

        section.why-mahathi-section::before {
            display: none;
        }

        .why-mahathi-section .mahathi-section-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: flex-start;
            padding: 20px 0 40px;
        }

        .why-mahathi-section .mahathi-left-column h2 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 42px;
            color: var(--forest);
            margin-bottom: 24px;
            letter-spacing: -0.5px;
            font-weight: 700;
            line-height: 1.2;
            padding-bottom: 0;
        }

        .why-mahathi-section .mahathi-left-column h2::after {
            display: none;
        }

        .why-mahathi-section .bronze-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, var(--sage) 0%, #659970 100%);
            color: var(--white);
            padding: 10px 18px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 12px rgba(118, 163, 121, 0.2);
            margin-bottom: 16px;
        }

        .why-mahathi-section .intro-text {
            font-size: 15px;
            color: var(--text-light);
            line-height: 1.8;
            margin-bottom: 0;
        }

        .why-mahathi-section .reasons-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 28px;
            margin: 0;
            padding: 0;
        }

        .why-mahathi-section .reason-item {
            display: flex;
            gap: 16px;
        }

        .why-mahathi-section .reason-icon {
            font-size: 28px;
            min-width: 40px;
            line-height: 1;
            color: var(--sage);
            font-weight: 700;
        }

        .why-mahathi-section .reason-title {
            font-size: 17px;
            font-weight: 700;
            color: var(--forest);
            letter-spacing: -0.3px;
            margin-bottom: 8px;
            line-height: 1.3;
        }

        .why-mahathi-section .reason-description {
            font-size: 14px;
            line-height: 1.7;
            color: var(--text-light);
            margin: 0;
        }

        @media (max-width: 1024px) {
            .why-mahathi-section .mahathi-section-content {
                gap: 60px;
            }
            .why-mahathi-section .mahathi-left-column h2 {
                font-size: 36px;
            }
        }

        @media (max-width: 768px) {
            .why-mahathi-section .mahathi-section-content {
                grid-template-columns: 1fr;
                gap: 40px;
                padding: 20px 0;
            }
            .why-mahathi-section .mahathi-left-column h2 {
                font-size: 32px;
            }
            .why-mahathi-section .reasons-list {
                gap: 24px;
            }
        }

        /* OUTCOMES SECTION - PREMIUM */
        section.outcomes-section {
            padding: clamp(40px, 5vw, 56px) 0;
            background: linear-gradient(135deg, #f8faf7 0%, var(--cream) 100%);
        }

        .outcomes-section .section-header {
            margin-bottom: clamp(28px, 4vw, 40px);
        }

        .outcomes-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 36px;
            margin-top: 0;
        }

        .outcome-card {
            background: var(--white);
            padding: 40px;
            border-radius: 8px;
            border-top: 5px solid var(--sage);
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
        }

        .outcome-card:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-6px);
        }

        .outcome-card h3 {
            font-size: 19px;
            color: var(--forest);
            margin-bottom: 16px;
            font-weight: 700;
            letter-spacing: -0.3px;
        }

        .outcome-card p {
            font-size: 14px;
            line-height: 1.8;
            color: var(--text-light);
        }

        /* WHY DATABRICKS SECTION */
        section.why-section {
            background: var(--cream);
            position: relative;
            overflow: hidden;
        }

        section.why-section::before,
        section.why-section::after {
            display: none;
        }

        .why-section .section-header {
            margin-bottom: 50px;
        }

        .why-section .section-header h2 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 42px;
            color: var(--forest);
            margin-bottom: 24px;
            letter-spacing: -0.5px;
            font-weight: 700;
            line-height: 1.2;
            padding-bottom: 0;
        }

        .why-section .section-header h2::after {
            display: none;
        }

        .why-section .section-intro {
            font-size: 15px;
            color: var(--text-light);
            line-height: 1.8;
            max-width: 700px;
        }

        .why-section .features-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            margin-top: 40px;
        }

        .why-section .feature-card {
            padding: 28px;
            background: var(--white);
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .why-section .feature-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transform: translateY(-2px);
        }

        .why-section .feature-header {
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .why-section .feature-checkmark {
            width: 32px;
            height: 32px;
            background: var(--sage);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-weight: 700;
            font-size: 18px;
            flex-shrink: 0;
            margin-top: 2px;
            line-height: 1;
        }

        .why-section .feature-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--forest);
            letter-spacing: -0.3px;
            line-height: 1.3;
            margin: 0;
        }

        .why-section .feature-description {
            font-size: 14px;
            line-height: 1.7;
            color: var(--text-light);
            margin: 0;
        }

        @media (max-width: 1024px) {
            .why-section .features-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 20px;
            }
        }

        @media (max-width: 768px) {
            .why-section .features-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }
            .why-section .section-header h2 {
                font-size: 32px;
            }
        }

        @media (max-width: 480px) {
            .why-section .features-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }
            .why-section .feature-card {
                padding: 24px;
            }
            .why-section .section-header h2 {
                font-size: 26px;
            }
            .why-section .section-intro {
                font-size: 14px;
            }
        }

        /* FAQ SECTION - reference accordion */
        .faq-section {
            background-color: #ffffff;
            position: relative;
            overflow: hidden;
        }

        .faq-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 90% 70% at 50% 35%, rgba(118, 163, 121, 0.07) 0%, transparent 55%),
                radial-gradient(ellipse 70% 50% at 50% 45%, rgba(0, 0, 0, 0.03) 0%, transparent 50%),
                radial-gradient(circle at 50% 50%, rgba(238, 240, 236, 0.9) 0%, transparent 65%);
            pointer-events: none;
            z-index: 0;
        }

        .faq-section .container {
            position: relative;
            z-index: 1;
            max-width: 920px;
        }

        .faq-section .section-header {
            text-align: center;
            margin-bottom: clamp(32px, 4vw, 48px);
        }

        .faq-section .section-header h2 {
            font-family: 'Aptos', 'Segoe UI', system-ui, sans-serif;
            font-size: clamp(1.625rem, 3.2vw, 2.25rem);
            font-weight: 700;
            color: #1a2834;
            text-align: center;
            padding-bottom: 0;
            margin-bottom: clamp(12px, 2vw, 16px);
            letter-spacing: -0.02em;
        }

        .faq-section .section-header h2::after {
            display: none;
        }

        .faq-section .section-header p {
            text-align: center;
            margin-left: auto;
            margin-right: auto;
            max-width: 40rem;
            font-size: clamp(0.875rem, 1.2vw, 1rem);
            line-height: 1.65;
        }

        .faq-grid {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 0;
        }

        .faq-item {
            background: #eef0ec;
            border-radius: 10px;
            border: none;
            box-shadow: none;
            overflow: hidden;
            transition: background-color 0.2s ease;
        }

        .faq-item:hover {
            background: #e8ebe5;
        }

        .faq-item summary {
            list-style: none;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: clamp(16px, 2.5vw, 22px) clamp(18px, 3vw, 28px);
            cursor: pointer;
            user-select: none;
        }

        .faq-item summary::-webkit-details-marker {
            display: none;
        }

        .faq-item summary::marker {
            content: '';
        }

        .faq-item h4 {
            font-family: 'Aptos', 'Segoe UI', system-ui, sans-serif;
            font-size: clamp(0.875rem, 1.35vw, 1.0625rem);
            font-weight: 700;
            color: #1a2834;
            margin: 0;
            line-height: 1.45;
            letter-spacing: -0.01em;
            flex: 1;
            min-width: 0;
            text-align: left;
        }

        .faq-toggle {
            flex-shrink: 0;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #e2e6df;
            color: var(--sage-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            font-weight: 400;
            line-height: 1;
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        .faq-item[open] .faq-toggle {
            background: #d8ddd4;
        }

        .faq-toggle::before {
            content: '+';
        }

        .faq-item[open] .faq-toggle::before {
            content: '−';
        }

        .faq-item p {
            font-size: clamp(0.8125rem, 1.1vw, 0.9375rem);
            line-height: 1.65;
            color: var(--text-light);
            margin: 0;
            padding: 0 clamp(18px, 3vw, 28px) clamp(18px, 2.5vw, 24px);
            text-align: left;
        }

        /* FOOTER CTA - reference card */
        section.footer-cta {
            background: #e8ebe5;
            text-align: left;
            padding: clamp(48px, 6vw, 72px) clamp(32px, 5vw, 60px);
            position: relative;
            overflow: visible;
        }

        section.footer-cta::before {
            display: none;
        }

        .footer-cta-card {
            max-width: 1320px;
            margin: 0 auto;
            background: linear-gradient(135deg, #0F1A2A 0%, #142540 100%);
            color: var(--white);
            border-radius: 14px;
            padding: clamp(36px, 4vw, 44px) clamp(32px, 4.5vw, 52px);
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: clamp(24px, 3vw, 36px);
            box-shadow: 0 24px 60px rgba(15, 26, 42, 0.22);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .footer-cta-card::before {
            content: '';
            position: absolute;
            top: -60%;
            right: -15%;
            width: 380px;
            height: 380px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(118, 163, 121, 0.22) 0%, transparent 65%);
            pointer-events: none;
        }

        .footer-cta-card::after {
            content: '';
            position: absolute;
            bottom: -50%;
            left: 30%;
            width: 280px;
            height: 280px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(240, 116, 61, 0.1) 0%, transparent 70%);
            pointer-events: none;
        }

        .footer-cta-text {
            flex: 1 1 280px;
            min-width: 0;
            position: relative;
            z-index: 1;
        }

        .footer-cta-eyebrow {
            font-size: 12px;
            color: var(--sage);
            font-weight: 700;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            margin-bottom: 12px;
            display: block;
        }

        .footer-cta h2 {
            font-family: 'Aptos', 'IBM Plex Sans', 'Segoe UI', system-ui, sans-serif;
            color: var(--white);
            font-size: clamp(1.5rem, 2.6vw, 1.75rem);
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 10px;
            letter-spacing: -0.02em;
        }

        .footer-cta p {
            font-size: clamp(0.9375rem, 1.15vw, 1rem);
            line-height: 1.6;
            margin-bottom: 0;
            color: rgba(255, 255, 255, 0.78);
            max-width: 36rem;
        }

        .footer-cta-action {
            flex-shrink: 0;
            position: relative;
            z-index: 1;
            background: var(--sage) !important;
            color: var(--forest) !important;
            box-shadow: none !important;
            border-radius: 4px;
            padding: 18px 38px;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            white-space: nowrap;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            transition: all 0.3s ease;
            line-height: 1;
        }

        .footer-cta-action::after {
            content: none;
        }

        .footer-cta-action svg {
            flex-shrink: 0;
            transition: transform 0.3s ease;
        }

        .footer-cta-action:hover {
            background: #91B896 !important;
            color: var(--forest) !important;
            transform: translateY(-3px);
            box-shadow: 0 14px 32px rgba(118, 163, 121, 0.35) !important;
        }

        .footer-cta-action:hover svg {
            transform: translateX(4px);
        }

        @media (max-width: 640px) {
            section.footer-cta {
                padding: 40px 24px;
            }

            .footer-cta-card {
                flex-direction: column;
                align-items: center;
                text-align: center;
                padding: 36px 28px;
                gap: 24px;
            }

            .footer-cta-text p {
                margin-left: auto;
                margin-right: auto;
            }

            .footer-cta-action {
                width: 100%;
                justify-content: center;
                white-space: normal;
            }
        }

        /* RESPONSIVE */
        @media (max-width: 1024px) {
            .container { padding: 0 48px; }
            section.hero {
                --hero-inline-pad: 48px;
                padding-top: 56px;
                padding-bottom: 48px;
            }
            .hero {
                --hero-img-height: clamp(260px, 42vw, 380px);
                grid-template-columns: 1fr;
                gap: 40px;
            }
            .hero-content {
                max-width: none;
            }
            .hero p {
                max-width: none;
            }
            .hero-image {
                justify-self: stretch;
                width: 100%;
                margin: 0;
            }
            .services-grid { grid-template-columns: repeat(2, 1fr); }
            .outcomes-cards { grid-template-columns: repeat(2, 1fr); }
            .faq-grid { gap: 8px; }
            .challenges-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 768px) {
            .container { padding: 0 32px; }
            section.hero {
                --hero-inline-pad: 32px;
                padding-top: 44px;
                padding-bottom: 36px;
            }
            .hero {
                --hero-img-height: clamp(220px, 52vw, 300px);
                gap: 32px;
            }
            .hero-content {
                padding: 0;
            }
            .hero-image {
                width: 100%;
            }
            .section-header h2 { font-size: 32px; }
            .services-grid { grid-template-columns: 1fr; }
            .outcomes-cards { grid-template-columns: 1fr; }
            .challenges-grid { grid-template-columns: 1fr; }
            section { padding: 50px 0; }
        }

        /* ====== SITE HEADER / FOOTER (shared chrome) ====== */
        .utility-bar {
            background: #2B3038;
            color: #E5E7EB;
            font-size: 13px;
            padding: 10px 0;
        }
        .utility-bar .row {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 0;
            max-width: 1320px;
            margin: 0 auto;
            padding: 0 60px;
        }
        .utility-bar a {
            color: #E5E7EB;
            padding: 0 18px;
            border-right: 1px solid #4A525C;
            text-decoration: none;
        }
        .utility-bar a:last-child { border-right: none; }
        .utility-bar a:hover { color: #fff; }
        .main-nav {
            background: #fff;
            border-bottom: 3px solid #C45A36;
            padding: 18px 0;
            position: sticky;
            top: 0;
            z-index: 50;
        }
        .main-nav .row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 40px;
            max-width: 1320px;
            margin: 0 auto;
            padding: 0 60px;
        }
        .main-nav .logo {
            display: flex;
            align-items: center;
            flex-shrink: 0;
            text-decoration: none;
        }
        .main-nav .logo img {
            display: block;
            max-width: 245px;
            height: auto;
            width: 245px;
        }
        .nav-items {
            display: flex;
            align-items: center;
            gap: 32px;
        }
        .nav-items a {
            font-size: 13px;
            font-weight: 700;
            color: #0F1A2A;
            letter-spacing: .5px;
            text-transform: uppercase;
            line-height: 1.3;
            text-align: center;
            text-decoration: none;
        }
        .nav-items a:hover,
        .nav-items a.active { color: #5d8a62; }
        @media (max-width: 1080px) {
            .nav-items { display: none; }
            .utility-bar .row,
            .main-nav .row { padding: 0 32px; }
        }
        .site-footer {
            background: #0F1A2A;
            color: rgba(255,255,255,.7);
            padding: 60px 0 28px;
            border-top: 1px solid rgba(255,255,255,.08);
        }
        .site-footer .container {
            max-width: 1320px;
            margin: 0 auto;
            padding: 0 60px;
        }
        .foot-grid {
            display: grid;
            grid-template-columns: 1.4fr 1fr 1fr 1fr;
            gap: 40px;
            margin-bottom: 48px;
        }
        @media (max-width: 780px) { .foot-grid { grid-template-columns: 1fr 1fr; } }
        @media (max-width: 480px) { .foot-grid { grid-template-columns: 1fr; } }
        .foot-brand p {
            color: rgba(255,255,255,.55);
            font-size: 14px;
            line-height: 1.7;
            margin: 18px 0 0;
            max-width: 320px;
        }
        .foot-brand img {
            display: block;
            max-width: 245px;
            height: auto;
        }
        .foot-col h5 {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1.5px;
            color: #fff;
            text-transform: uppercase;
            margin: 0 0 18px;
        }
        .foot-col a {
            display: block;
            color: rgba(255,255,255,.6);
            font-size: 14px;
            padding: 6px 0;
            text-decoration: none;
        }
        .foot-col a:hover { color: #B7C7B1; }
        .foot-bottom {
            border-top: 1px solid rgba(255,255,255,.08);
            padding-top: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            color: rgba(255,255,255,.5);
            flex-wrap: wrap;
            gap: 12px;
        }
        .foot-bottom em { color: #76A379; font-style: normal; }
    </style>
</head>
<body>
<!-- ====== HEADER ====== -->
<div class="utility-bar">
  <div class="row">
    <a href="/locations/">Locations</a>
    <a href="/awards/">Awards</a>
    <a href="/certifications/">Certifications</a>
    <a href="/careers/">Careers</a>
    <a href="/search/">Search</a>
  </div>
</div>
<header class="main-nav">
  <div class="row">
    <a class="logo" href="/" aria-label="Mahathi Infotech home">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/salesnanny-logo-og.svg" alt="Mahathi Infotech" width="245" height="70" fetchpriority="high">
    </a>
    <nav class="nav-items" aria-label="Primary">
      <a href="/insurance/">INSURANCE<br>SOLUTIONS</a>
      <a href="/healthcare/">HEALTHCARE<br>SOLUTIONS</a>
      <a href="/ai-enablement/" class="active">AI<br>ENABLEMENT</a>
      <a href="/digital-services/">DIGITAL<br>SERVICES</a>
      <a href="/news/">NEWS</a>
      <a href="/about/">ABOUT<br>US</a>
      <a href="/contact-us/">CONTACT<br>US</a>
    </nav>
  </div>
</header>

    <!-- SCHEMA MARKUP -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Service",
        "name": "Enterprise Databricks Implementation Services",
        "description": "Databricks implementation and migration services for insurance carriers and healthcare payers. Mahathi is an official Databricks Bronze Partner.",
        "provider": {
            "@type": "Organization",
            "name": "Mahathi Infotech",
            "url": "https://mahathiinfotech.com",
            "logo": "https://mahathiinfotech.com/logo.png",
            "sameAs": "https://mahathiinfotech.com/databricks"
        },
        "serviceType": ["Databricks Service", "Databricks Implementation", "Data Migration", "Analytics Platform"],
        "areaServed": ["US", "North America"],
        "offers": {
            "@type": "AggregateOffer",
            "priceCurrency": "USD",
            "price": "Contact for pricing"
        },
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "4.9",
            "reviewCount": "100",
            "bestRating": "5",
            "worstRating": "1"
        }
    }
    </script>

    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [
            {
                "@type": "Question",
                "name": "What is a Databricks implementation?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "A Databricks implementation is the complete deployment and configuration of the Databricks Lakehouse Platform for your organization, including data migration, governance setup, and optimization for your specific use cases."
                }
            },
            {
                "@type": "Question",
                "name": "How long does a Databricks migration take?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Most enterprise Databricks migrations take 8-12 weeks depending on data volume and complexity. Mahathi has migrated 2.5B+ records with zero downtime."
                }
            }
        ]
    }
    </script>

    <!-- SECTION 1: HERO -->
    <section class="hero">
        <div class="hero-content">
            <span class="hero-badge">🏆 Databricks Bronze Partner</span>
            <h1>Enterprise Databricks Implementation & Migration Services</h1>
            <p>Transform fragmented legacy data infrastructure into a unified, AI-ready Lakehouse. Mahathi delivers zero-downtime migrations, real-time analytics, and AI-powered intelligence for insurance carriers, healthcare payers, MGAs, and TPAs. 100+ successful Databricks implementations.</p>
        </div>
        <div class="hero-image">📊</div>
    </section>

    <!-- SECTION 2: INDUSTRY CHALLENGES & DATABRICKS SOLUTION -->
    <section class="challenges-section">
        <div class="container">
            <!-- SECTION HEADER -->
            <div class="section-header">
                <h2>Industry Challenges That Databricks Solves</h2>
                <p class="section-intro">Insurance carriers and healthcare payers face critical data infrastructure gaps. Legacy warehouses create operational silos, slow decision-making, and escalate costs. Databricks transforms these challenges into competitive advantage through a unified Lakehouse architecture.</p>
            </div>

            <!-- 6 CHALLENGE CARDS -->
            <div class="challenges-grid">
                <article class="challenge-card">
                    <div class="challenge-title">Fragmented Data Silos:</div>
                    <p class="challenge-description">Claims, eligibility, underwriting data scattered across incompatible systems. No unified source of truth. Manual data reconciliation wastes time and creates inconsistencies.</p>
                </article>
                <article class="challenge-card">
                    <div class="challenge-title">Slow Claims Processing:</div>
                    <p class="challenge-description">Average 15-30 day cycle times. Fraud detection remains manual. STP rates stuck below 40%. Manual workflows cost millions annually in operational overhead.</p>
                </article>
                <article class="challenge-card">
                    <div class="challenge-title">Underwriting Blindness:</div>
                    <p class="challenge-description">Decisions made on stale data updated daily. Real-time risk assessment impossible. Competitive disadvantage against faster competitors using AI-driven pricing.</p>
                </article>
                <article class="challenge-card">
                    <div class="challenge-title">Rising Data Costs:</div>
                    <p class="challenge-description">Separate tools for analytics, engineering, and AI. Infrastructure sprawl. Data duplication across systems. Cloud spend 3-4x industry benchmark.</p>
                </article>
                <article class="challenge-card">
                    <div class="challenge-title">Compliance &amp; Governance Gaps:</div>
                    <p class="challenge-description">Audit trails insufficient for HIPAA/SOC 2. PII masking manual. Row/column-level access control non-existent. Regulatory risk from exam findings on data governance.</p>
                </article>
                <article class="challenge-card">
                    <div class="challenge-title">AI Capability Gap:</div>
                    <p class="challenge-description">No in-platform AI/ML. Manual fraud detection. Predictive pricing impossible. Generative AI for documentation non-existent. Competitors' chatbots outpacing internal capabilities.</p>
                </article>
            </div>
        </div>
    </section>

    <!-- SECTION 4: MAHATHI CORE DATABRICKS CAPABILITIES -->
    <section id="services">
        <div class="container">
            <div class="section-header">
                <h2>Mahathi Core Databricks Capabilities</h2>
                <!-- <p>Six proven competencies built on 100+ implementations, 15+ certified consultants, and a relentless focus on transforming insurance and healthcare data operations into competitive advantage.</p> -->
            </div>
            <div class="services-grid">
                <!-- Card 1: Zero-Downtime Migration -->
                <div class="service-card">
                    <div class="service-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/><path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16"/><path d="M16 16h5v5"/></svg>
                    </div>
                    <h3>Zero-Downtime Data Migration</h3>
                    <p>Enterprise-scale warehouse-to-lakehouse migrations without business interruption. We've migrated 2.5B+ records using Change Data Capture (CDC) with bi-directional sync during cutover, ensuring claims processing continues uninterrupted while you transition to Databricks.</p>
                    <div class="service-metric">
                        <span class="metric-icon">✓</span>
                        <span class="metric-text">8-12 week implementation timeline</span>
                    </div>
                    <div class="service-metric">
                        <span class="metric-icon">✓</span>
                        <span class="metric-text">Zero data loss, zero incidents</span>
                    </div>
                </div>
                <!-- Card 2: Real-Time Analytics -->
                <div class="service-card">
                    <div class="service-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 20V10"/><path d="M10 20V4"/><path d="M16 20v-6"/><path d="M22 20V8"/></svg>
                    </div>
                    <h3>Real-Time Analytics &amp; Intelligence</h3>
                    <p>Sub-second dashboards on terabyte-scale data. Claims adjusters access live KPIs instantly. Underwriters make real-time decisions. Our implementation enables executive dashboards refreshing every minute, transforming raw data into actionable intelligence for your entire organization.</p>
                    <div class="service-metric">
                        <span class="metric-icon">✓</span>
                        <span class="metric-text">10x faster query performance</span>
                    </div>
                    <div class="service-metric">
                        <span class="metric-icon">✓</span>
                        <span class="metric-text">Sub-second dashboard refresh</span>
                    </div>
                </div>
                <!-- Card 3: AI & Predictive Intelligence -->
                <div class="service-card">
                    <div class="service-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="4" width="16" height="16" rx="2"/><path d="M9 9h.01"/><path d="M15 9h.01"/><path d="M9 15a3 3 0 0 0 6 0"/></svg>
                    </div>
                    <h3>AI &amp; Predictive Intelligence</h3>
                    <p>Fraud detection models, claims triage automation, predictive pricing, and risk adjustment—all built on Databricks Foundation Models. We implement generative AI for documentation, create claims copilots, and build underwriting assistants that learn from your historical data to predict outcomes with 92%+ accuracy.</p>
                    <div class="service-metric">
                        <span class="metric-icon">✓</span>
                        <span class="metric-text">92% fraud detection accuracy</span>
                    </div>
                    <div class="service-metric">
                        <span class="metric-icon">✓</span>
                        <span class="metric-text">Real-time predictions on millions of records</span>
                    </div>
                </div>
                <!-- Card 4: Enterprise Governance -->
                <div class="service-card">
                    <div class="service-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="11" width="14" height="10" rx="2"/><path d="M8 11V7a4 4 0 0 1 8 0v4"/></svg>
                    </div>
                    <h3>Enterprise Governance &amp; Compliance</h3>
                    <p>Unity Catalog provides unified data governance across workspaces. We implement PII masking, column/row-level access control, and comprehensive audit trails. HIPAA, SOC 2, and GDPR compliance built-in from day one. Your data remains secure while enabling democratized analytics access across teams.</p>
                    <div class="service-metric">
                        <span class="metric-icon">✓</span>
                        <span class="metric-text">Automated PII detection &amp; masking</span>
                    </div>
                    <div class="service-metric">
                        <span class="metric-icon">✓</span>
                        <span class="metric-text">Complete audit trails for compliance</span>
                    </div>
                </div>
                <!-- Card 5: Data Integration & ETL -->
                <div class="service-card">
                    <div class="service-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2 3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                    </div>
                    <h3>Enterprise-Scale Data Integration</h3>
                    <p>Seamless ingestion from APIs, databases, and SaaS platforms (Salesforce, Epic, Workday). Claims data, eligibility records, underwriting information—all flowing in real-time with quality validation. We architect unlimited throughput pipelines with automated error handling and change tracking that adapt to your growing data volume.</p>
                    <div class="service-metric">
                        <span class="metric-icon">✓</span>
                        <span class="metric-text">Real-time &amp; batch ingestion modes</span>
                    </div>
                    <div class="service-metric">
                        <span class="metric-icon">✓</span>
                        <span class="metric-text">Automated quality validation</span>
                    </div>
                </div>
                <!-- Card 6: Managed Operations -->
                <div class="service-card">
                    <div class="service-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg>
                    </div>
                    <h3>Managed Databricks Operations</h3>
                    <p>End-to-end platform management so you focus on business value. 24/7 monitoring, performance tuning, security patches, cluster optimization, cost management. We handle infrastructure upgrades without service interruption, conduct quarterly health checks, and proactively optimize based on usage patterns. SLA-backed support with dedicated Mahathi engineers.</p>
                    <div class="service-metric">
                        <span class="metric-icon">✓</span>
                        <span class="metric-text">24/7 proactive monitoring &amp; support</span>
                    </div>
                    <div class="service-metric">
                        <span class="metric-icon">✓</span>
                        <span class="metric-text">60-70% cost savings vs. legacy warehouses</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 5: WHY DATABRICKS -->
    <section id="why" class="why-section">
        <div class="container">
            <div class="section-header">
                <h2>Why Databricks for Insurance &amp; Healthcare</h2>
                <p class="section-intro">Databricks Lakehouse Platform uniquely addresses the data infrastructure needs of insurers and healthcare payers—delivering unified architecture, real-time intelligence, and enterprise compliance at a fraction of legacy warehouse costs.</p>
            </div>

            <div class="features-grid">
                <article class="feature-card">
                    <div class="feature-header">
                        <div class="feature-checkmark">✓</div>
                        <h3 class="feature-title">Unified Architecture</h3>
                    </div>
                    <p class="feature-description">Single platform for BI, ML, and data engineering eliminates tool sprawl. Consolidate from 5-7 separate systems into one. Reduce infrastructure complexity and operational overhead.</p>
                </article>
                <article class="feature-card">
                    <div class="feature-header">
                        <div class="feature-checkmark">✓</div>
                        <h3 class="feature-title">Enterprise Scale</h3>
                    </div>
                    <p class="feature-description">Handle 2.5B+ records with sub-second query response. Process terabyte-scale datasets instantly. Scale from millions to billions of records without performance degradation.</p>
                </article>
                <article class="feature-card">
                    <div class="feature-header">
                        <div class="feature-checkmark">✓</div>
                        <h3 class="feature-title">Real-Time Intelligence</h3>
                    </div>
                    <p class="feature-description">Live dashboards refresh every minute. Streaming data ingestion from claims, eligibility, and underwriting systems. Real-time fraud detection and instant underwriting decisions.</p>
                </article>
                <article class="feature-card">
                    <div class="feature-header">
                        <div class="feature-checkmark">✓</div>
                        <h3 class="feature-title">Built-In AI/ML</h3>
                    </div>
                    <p class="feature-description">Databricks Foundation Models pre-installed. LLMOps, prompt engineering, model versioning native. No separate ML platform needed. Fraud detection and predictive pricing out-of-box.</p>
                </article>
                <article class="feature-card">
                    <div class="feature-header">
                        <div class="feature-checkmark">✓</div>
                        <h3 class="feature-title">Cost Efficiency</h3>
                    </div>
                    <p class="feature-description">3-5x cheaper than legacy data warehouses (Redshift, Snowflake). Shared compute across BI and analytics. Automatic scaling means pay only for what you use. Average $400K annual savings.</p>
                </article>
                <article class="feature-card">
                    <div class="feature-header">
                        <div class="feature-checkmark">✓</div>
                        <h3 class="feature-title">Compliance by Design</h3>
                    </div>
                    <p class="feature-description">Unity Catalog provides governance across workspaces. Built-in PII detection and masking. Row/column-level security controls. Complete audit trails for HIPAA, SOC 2, GDPR compliance.</p>
                </article>
                <article class="feature-card">
                    <div class="feature-header">
                        <div class="feature-checkmark">✓</div>
                        <h3 class="feature-title">Zero-Downtime Upgrades</h3>
                    </div>
                    <p class="feature-description">Platform updates without service interruption. Disaster recovery built-in. Multi-region failover. Your claims processing and analytics run 24/7 with no manual intervention.</p>
                </article>
                <article class="feature-card">
                    <div class="feature-header">
                        <div class="feature-checkmark">✓</div>
                        <h3 class="feature-title">Certified Partnership</h3>
                    </div>
                    <p class="feature-description">Mahathi is an official Databricks Bronze Partner. 100+ implementations, 15+ certified consultants, 2.5B+ records migrated, 0 production incidents. Deep insurance and healthcare expertise.</p>
                </article>
            </div>
        </div>
    </section>

    <!-- WHY CHOOSE MAHATHI -->
    <section class="why-mahathi-section" id="why-mahathi">
        <div class="container">
            <div class="mahathi-section-content">
                <div class="mahathi-left-column">
                    <h2>Why Choose Mahathi for Databricks Implementation</h2>
                    <!-- <p class="intro-text">Mahathi is an official Databricks Bronze Partner with 100+ successful implementations. We've migrated 2.5B+ records with zero production incidents. Our 15+ certified consultants specialize in insurance and healthcare data operations—we understand your business, not just the technology.</p> -->
                </div>
                <div class="mahathi-right-column">
                    <ul class="reasons-list">
                        <li class="reason-item">
                            <div class="reason-icon">✓</div>
                            <div class="reason-content">
                                <div class="reason-title">Certified Bronze Partner</div>
                                <p class="reason-description">Official Databricks partnership. Recognized expertise and ongoing commitment to latest innovations.</p>
                            </div>
                        </li>
                        <li class="reason-item">
                            <div class="reason-icon">✓</div>
                            <div class="reason-content">
                                <div class="reason-title">100+ Proven Implementations</div>
                                <p class="reason-description">Successful deployments across insurance, healthcare, finance. 2.5B+ records migrated. Zero-downtime, zero-incident track record.</p>
                            </div>
                        </li>
                        <li class="reason-item">
                            <div class="reason-icon">✓</div>
                            <div class="reason-content">
                                <div class="reason-title">Industry Deep Expertise</div>
                                <p class="reason-description">15+ certified Databricks consultants. Specialists in claims processing, compliance, underwriting, and regulatory requirements.</p>
                            </div>
                        </li>
                        <li class="reason-item">
                            <div class="reason-icon">✓</div>
                            <div class="reason-content">
                                <div class="reason-title">Managed Services &amp; Support</div>
                                <p class="reason-description">24/7 monitoring, performance optimization, security patches. We manage infrastructure—you focus on business outcomes.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 6: CUSTOMER OUTCOMES -->
    <section class="outcomes-section">
        <div class="container">
            <div class="section-header">
                <h2>Proven Customer Outcomes</h2>
                <!-- <p>Real results from Databricks implementations in insurance, healthcare, and related industries.</p> -->
            </div>
            <div class="outcomes-cards">
                <div class="outcome-card">
                    <h3>50% Claims Cycle Reduction</h3>
                    <p>Real-time dashboards cut claims adjudication time in half. Claims adjusters triage instantly instead of waiting days. Straight-through processing increased from 35% to 78%. Annual claims cost savings: $200K+.</p>
                </div>
                <div class="outcome-card">
                    <h3>92% Fraud Detection Accuracy</h3>
                    <p>AI models trained on historical claims data detect suspicious patterns in real-time. False positive rate cut from 18% to 4%. Investigated claims recovery rate increased 40%. Annual fraud prevention: $400K+.</p>
                </div>
                <div class="outcome-card">
                    <h3>15-Min Underwriting Decisions</h3>
                    <p>Real-time data access enables instant risk assessment. Underwriting turn-around time dropped from 48 hours to 15 minutes. Quote generation automated. Revenue per underwriter increased 35%.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- SECTION 11: FOOTER CTA -->
    <section class="footer-cta">
        <div class="footer-cta-card">
            <div class="footer-cta-text">
                <span class="footer-cta-eyebrow">Get in Touch</span>
                <h2>Speak to our team</h2>
                <p>Interested in learning more about our offerings? Our solutions specialists are ready to help.</p>
            </div>
            <a href="/contact-us/" class="footer-cta-action">
                Get in Touch
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>
    </section>


    <!-- SECTION 10: FAQ -->
    <section id="faq" class="faq-section">
        <div class="container">
            <div class="section-header">
                <h2>Frequently Asked Questions</h2>
                <p>Common questions about Databricks implementation, migration, and platform capabilities.</p>
            </div>
            <div class="faq-grid">
                <details class="faq-item">
                    <summary>
                        <h4>What is the difference between Databricks and a traditional data warehouse?</h4>
                        <span class="faq-toggle" aria-hidden="true"></span>
                    </summary>
                    <p>Databricks Lakehouse combines the reliability and governance of data warehouses with the scale and cost-efficiency of data lakes. You get ACID transactions, schema enforcement, and SQL analytics at petabyte scale without the cost of traditional warehouses like Redshift or Snowflake.</p>
                </details>
                <details class="faq-item">
                    <summary>
                        <h4>How long does a Databricks implementation take?</h4>
                        <span class="faq-toggle" aria-hidden="true"></span>
                    </summary>
                    <p>Typical implementations span 8-12 weeks depending on data volume, complexity, and integrations needed. Discovery: 2-3 weeks. Architecture & pilot: 3-4 weeks. Migration: 2-3 weeks. Hardening & go-live: 1-2 weeks. Mahathi has migrated 2.5B+ records with zero downtime.</p>
                </details>
                <details class="faq-item">
                    <summary>
                        <h4>Is there downtime during data migration?</h4>
                        <span class="faq-toggle" aria-hidden="true"></span>
                    </summary>
                    <p>No. Mahathi uses Change Data Capture (CDC) for bi-directional sync during the migration window. You continue processing claims and eligibility requests. We synchronize at cutover—typically a 30-60 minute validation window, not hours or days.</p>
                </details>
                <details class="faq-item">
                    <summary>
                        <h4>How does Databricks handle compliance (HIPAA, SOC 2)?</h4>
                        <span class="faq-toggle" aria-hidden="true"></span>
                    </summary>
                    <p>Databricks has inherent HIPAA and SOC 2 compliance. We layer on additional security: VPC isolation, CMK encryption, audit logging for all data access, PII masking, and row/column-level access control. Your security and compliance teams remain in control.</p>
                </details>
                <details class="faq-item">
                    <summary>
                        <h4>What about data governance and PII protection?</h4>
                        <span class="faq-toggle" aria-hidden="true"></span>
                    </summary>
                    <p>Unity Catalog provides comprehensive governance. Automated PII detection and masking. Sensitive data tags. Access control by role, department, or individual. Complete audit trails for all queries and data access. Lineage tracking from source to destination.</p>
                </details>
                <details class="faq-item">
                    <summary>
                        <h4>Can we continue using existing BI tools?</h4>
                        <span class="faq-toggle" aria-hidden="true"></span>
                    </summary>
                    <p>Yes. Databricks connects natively to Tableau, Power BI, Looker, QlikView, and other tools via standard SQL connectors. No tool replacement needed. Your analysts continue using familiar interfaces on faster, cheaper infrastructure.</p>
                </details>
                <details class="faq-item">
                    <summary>
                        <h4>How much will this cost?</h4>
                        <span class="faq-toggle" aria-hidden="true"></span>
                    </summary>
                    <p>Databricks typically costs 60-70% less than legacy data warehouses like Redshift or Snowflake due to shared compute, storage optimization, and auto-scaling. Implementation varies by scope: $200K-$500K for enterprise deployments. We provide detailed cost modeling during discovery.</p>
                </details>
                <details class="faq-item">
                    <summary>
                        <h4>What happens after go-live? Does Mahathi stick around?</h4>
                        <span class="faq-toggle" aria-hidden="true"></span>
                    </summary>
                    <p>Yes. We offer managed services (24/7 support, monitoring, optimization), training, and ongoing optimization. Most clients retain us post-implementation for performance tuning, new feature adoption, and quarterly health checks.</p>
                </details>
            </div>
        </div>
    </section>



<!-- ====== FOOTER ====== -->
<footer class="site-footer">
  <div class="container">
    <div class="foot-grid">
      <div class="foot-brand">
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/salesnanny-logo-og.svg" alt="Mahathi Infotech" width="245" height="70">
        <p>A niche technology and business-services partner to P&amp;C insurance carriers, MGAs, TPAs, healthcare payers, and claims organizations. King of Prussia, PA · India · UAE · Philippines.</p>
      </div>
      <div class="foot-col">
        <h5>Insurance</h5>
        <a href="/insurance/guidewire/">Guidewire</a>
        <a href="/insurance/p-c-solution/">P&amp;C Solution</a>
        <a href="/insurance/life-and-annuity/">Life &amp; Annuity</a>
        <a href="/databricks/">Databricks</a>
      </div>
      <div class="foot-col">
        <h5>Healthcare</h5>
        <a href="/healthcare/">Overview</a>
        <a href="/healthcare/claims-management/">Claims Management</a>
        <a href="/healthcare/rcm/">RCM</a>
      </div>
      <div class="foot-col">
        <h5>Company</h5>
        <a href="/about/">About</a>
        <a href="/news/">News</a>
        <a href="/careers/">Careers</a>
        <a href="/contact-us/">Contact</a>
      </div>
    </div>
    <div class="foot-bottom">
      <div>&copy; 2026 Mahathi Infotech LLC · 2025 Inc. 5000 honoree</div>
      <div><em>Weaving Dreams to Reality</em></div>
    </div>
  </div>
</footer>

</body>
</html>