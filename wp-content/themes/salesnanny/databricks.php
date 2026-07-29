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

        /* CHALLENGES SECTION - PREMIUM */
        .challenges-section {
            background: linear-gradient(135deg, #f8faf7 0%, var(--cream) 100%);
            min-height: 75svh;
            max-height: 100svh;
            display: flex;
            align-items: center;
            padding: clamp(20px, 3.5vh, 40px) 0;
            overflow: hidden;
            box-sizing: border-box;
        }

        .challenges-section::before {
            display: none;
        }

        .challenges-section .container {
            width: 100%;
            max-height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: clamp(20px, 3vh, 32px);
            padding-top: 0;
            padding-bottom: 0;
        }

        .challenges-section .section-header {
            margin-bottom: 0;
            display: grid;
            grid-template-columns: minmax(0, 1.05fr) minmax(0, 1fr);
            gap: clamp(16px, 3vw, 40px);
            align-items: start;
            margin-bottom: 30px;
        }

        .challenges-section .section-header h2 {
            font-size: clamp(1.75rem, 3.2vw, 2.5rem);
            margin-bottom: 12px;
            padding-bottom: 12px;
        }

        .challenges-section .section-header p {
            font-size: clamp(0.8125rem, 1.1vw, 0.9375rem);
            line-height: 1.55;
            max-width: none;
        }

        .challenges-list {
            list-style: none;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: clamp(20px, 2.8vh, 28px) clamp(22px, 2.8vw, 32px);
            margin: 0;
            flex: 1;
            min-height: 0;
            align-content: center;
        }

        .challenges-list li {
            padding: clamp(16px, 2.2vh, 22px) clamp(18px, 2vw, 24px);
            background: var(--white);
            border-radius: 8px;
            border-left: 4px solid var(--sage);
            font-size: clamp(0.75rem, 1vw, 0.875rem);
            line-height: 1.5;
            transition: box-shadow 0.3s ease, border-color 0.3s ease;
            box-shadow: var(--shadow-sm);
            position: relative;
        }


        .challenges-list li:hover {
            box-shadow: var(--shadow-md);
            transform: none;
        }

        .challenges-list li:hover::before {
            opacity: 0.7;
        }

        @media (max-width: 1100px) {
            .challenges-section .section-header {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .challenges-list {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: clamp(18px, 2.5vh, 26px) clamp(20px, 3vw, 28px);
            }
        }

        @media (max-width: 900px) {
            .challenges-section {
                min-height: auto;
                max-height: none;
                overflow: visible;
                padding: clamp(40px, 6vh, 56px) 0;
            }

            .challenges-section .container {
                gap: clamp(16px, 3vh, 28px);
            }

            .challenges-list {
                gap: clamp(16px, 2.5vh, 24px) clamp(18px, 4vw, 24px);
            }

            .challenges-list li {
                font-size: clamp(0.8125rem, 2.8vw, 0.875rem);
                line-height: 1.55;
                padding: clamp(16px, 2.5vh, 20px) clamp(18px, 3vw, 22px);
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
            padding: 20px;
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
            height: 4px;
            background: linear-gradient(to right, var(--sage), var(--sage-light));
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }

        .service-card:hover::before {
            transform: translateX(0);
        }

        .service-card:hover {
            border-color: var(--sage);
            box-shadow: var(--shadow-lg);
            transform: translateY(-8px);
        }

        .service-icon {
            margin: -40px -40px 24px;
            padding: 36px 24px;
            background: linear-gradient(180deg, #7d9478 0%, #4f6554 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            border-radius: 7px 7px 0 0;
        }

        .service-icon svg {
            width: 52px;
            height: 52px;
            display: block;
            flex-shrink: 0;
        }

        .service-card:hover .service-icon {
            transform: none;
        }

        .service-card h3 {
            font-size: 18px;
            margin-bottom: 16px;
            color: var(--forest);
            font-weight: 700;
            letter-spacing: -0.3px;
        }

        .service-card p {
            font-size: 14px;
            line-height: 1.8;
            color: var(--text-light);
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

        /* BRONZE PARTNER SECTION - reference stats band */
        section.bronze-section {
            background: #0F1A2A;
            color: var(--white);
            position: relative;
            overflow: hidden;
            padding: clamp(56px, 8vw, 50px) 0;
        }

        section.bronze-section::before {
            display: none;
        }

        section.bronze-section::after {
            display: none;
        }

        .bronze-section .container {
            max-width: none;
            padding: 0;
        }

        .bronze-content {
            margin-top: 0;
            position: relative;
            z-index: 1;
        }

        .bronze-highlights {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 0;
            max-width: 1320px;
            margin: 0 auto;
            padding: 0 clamp(24px, 5vw, 60px);
        }

        .bronze-stat {
            position: relative;
            padding: clamp(8px, 2vw, 16px) clamp(20px, 4vw, 48px);
            text-align: center;
            background: none;
            border: none;
            border-radius: 0;
            backdrop-filter: none;
        }

        .bronze-stat:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 10%;
            right: 0;
            width: 1px;
            height: 80%;
            background: rgba(255, 255, 255, 0.18);
        }

        .bronze-stat-number {
            font-family: 'Aptos', 'Segoe UI', system-ui, sans-serif;
            font-size: clamp(2.75rem, 6vw, 50px);
            line-height: 1;
            font-weight: 600;
            color: var(--white);
            margin-bottom: clamp(14px, 2vw, 20px);
            letter-spacing: -0.03em;
        }

        .bronze-stat-value {
            color: var(--white);
        }

        .bronze-stat-suffix {
            color: var(--accent);
            font-weight: 700;
        }

        .bronze-stat-label {
            font-family: 'Aptos', 'Segoe UI', system-ui, sans-serif;
            font-size: clamp(0.9375rem, 1.5vw, 1.125rem);
            line-height: 1.45;
            color: var(--white);
            opacity: 1;
            font-weight: 700;
            max-width: 16rem;
            margin: 0 auto;
        }

        @media (max-width: 900px) {
            .bronze-highlights {
                grid-template-columns: 1fr;
                gap: 0;
                padding: 0 clamp(20px, 5vw, 32px);
            }

            .bronze-stat:not(:last-child)::after {
                display: none;
            }

            .bronze-stat:not(:last-child) {
                border-bottom: 1px solid rgba(255, 255, 255, 0.14);
                padding-bottom: clamp(32px, 6vw, 44px);
                margin-bottom: clamp(32px, 6vw, 44px);
            }

            .bronze-stat:last-child {
                padding-bottom: 0;
            }
        }

        /* WHY DATABRICKS SECTION */
        section.why-section {
            background: linear-gradient(160deg, #f8faf7 0%, var(--cream) 45%, #f3f6f1 100%);
            position: relative;
            overflow: hidden;
        }

        section.why-section::before {
            content: '';
            position: absolute;
            width: min(520px, 55vw);
            height: min(520px, 55vw);
            border-radius: 50%;
            background: radial-gradient(circle, rgba(118, 163, 121, 0.12) 0%, transparent 70%);
            top: -120px;
            left: -80px;
            pointer-events: none;
        }

        section.why-section::after {
            content: '';
            position: absolute;
            width: min(400px, 40vw);
            height: min(400px, 40vw);
            border-radius: 50%;
            background: radial-gradient(circle, rgba(26, 43, 60, 0.04) 0%, transparent 70%);
            bottom: -100px;
            right: -60px;
            pointer-events: none;
        }

        section.why-section .container {
            position: relative;
            z-index: 1;
        }

        .why-layout {
            display: flex;
            flex-direction: column;
            gap: clamp(28px, 4vw, 44px);
            align-items: stretch;
            margin-top: clamp(8px, 2vw, 16px);
        }

        .why-intro {
            position: static;
            max-width: 42rem;
        }

        .why-intro h2 {
            font-family: 'Aptos', 'Segoe UI', system-ui, sans-serif;
            font-size: clamp(1.75rem, 3.2vw, 2.5rem);
            color: var(--forest);
            font-weight: 700;
            line-height: 1.15;
            letter-spacing: -0.02em;
            margin-bottom: clamp(16px, 2vw, 20px);
            padding-bottom: 16px;
            position: relative;
        }
        .why-intro p {
            font-size: clamp(0.9375rem, 1.2vw, 1.0625rem);
            line-height: 1.7;
            color: var(--text-light);
            max-width: none;
        }

        .why-benefits-rows {
            display: flex;
            flex-direction: column;
            gap: clamp(14px, 2vw, 20px);
            width: 100%;
        }

        .why-benefits-row {
            list-style: none;
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: clamp(14px, 2vw, 20px);
            margin: 0;
            padding: 0;
        }

        .why-benefits-row li {
            margin: 0;
            padding: clamp(18px, 2.5vw, 22px) clamp(18px, 2.5vw, 22px) clamp(18px, 2.5vw, 22px) clamp(52px, 6vw, 58px);
            position: relative;
            font-size: clamp(0.8125rem, 1.05vw, 0.9375rem);
            line-height: 1.65;
            color: var(--text-light);
            background: rgba(255, 255, 255, 0.92);
            border: 1px solid rgba(118, 163, 121, 0.15);
            border-radius: 10px;
            box-shadow: var(--shadow-sm);
            transition: border-color 0.25s ease, box-shadow 0.25s ease, transform 0.25s ease;
        }

        .why-benefits-row li::before {
            content: '✓';
            position: absolute;
            left: clamp(14px, 2vw, 18px);
            top: clamp(16px, 2.2vw, 20px);
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 700;
            line-height: 1;
            color: var(--white);
            background: linear-gradient(135deg, var(--sage) 0%, var(--sage-dark) 100%);
            box-shadow: 0 4px 12px rgba(118, 163, 121, 0.25);
        }

        .why-benefits-row li:hover {
            border-color: rgba(118, 163, 121, 0.35);
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
            color: var(--text-dark);
        }

        .why-benefits-row li strong {
            display: block;
            color: var(--forest);
            font-weight: 700;
            font-size: clamp(0.875rem, 1.1vw, 0.96875rem);
            line-height: 1.35;
            margin-bottom: 8px;
        }

        @media (max-width: 1100px) {
            .why-benefits-row {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 640px) {
            .why-benefits-row {
                grid-template-columns: 1fr;
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
            background: linear-gradient(135deg, #1a2834 0%, #141d26 100%);
            color: var(--white);
            border-radius: 16px;
            padding: clamp(28px, 4vw, 44px) clamp(32px, 4.5vw, 56px);
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: clamp(24px, 3vw, 40px);
            box-shadow: 0 16px 48px rgba(26, 40, 52, 0.18);
            position: relative;
            z-index: 1;
        }

        .footer-cta-text {
            flex: 1 1 280px;
            min-width: 0;
        }

        .footer-cta h2 {
            font-family: 'Aptos', 'Segoe UI', system-ui, sans-serif;
            color: var(--white);
            font-size: clamp(1.375rem, 2.4vw, 1.875rem);
            font-weight: 700;
            line-height: 1.25;
            margin-bottom: clamp(10px, 1.5vw, 14px);
            letter-spacing: -0.02em;
        }

        .footer-cta p {
            font-size: clamp(0.875rem, 1.15vw, 1rem);
            line-height: 1.6;
            margin-bottom: 0;
            color: rgba(255, 255, 255, 0.72);
            max-width: 36rem;
        }

        .footer-cta-action {
            flex-shrink: 0;
            background: #b8c9b0 !important;
            color: #1a2834 !important;
            box-shadow: none !important;
            border-radius: 6px;
            padding: 14px 28px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .footer-cta-action::after {
            content: ' →';
            font-weight: 700;
        }

        .footer-cta-action:hover {
            background: #c8d8c0 !important;
            color: #141d26 !important;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15) !important;
        }

        @media (max-width: 640px) {
            section.footer-cta {
                padding: 40px 24px;
            }

            .footer-cta-card {
                flex-direction: column;
                align-items: stretch;
                padding: 28px 24px;
            }

            .footer-cta-action {
                width: 100%;
                text-align: center;
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
            .challenges-list { grid-template-columns: repeat(2, minmax(0, 1fr)); }
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
            .challenges-list { grid-template-columns: 1fr; }
            section.challenges-section {
                min-height: auto;
                max-height: none;
                overflow: visible;
                padding: 48px 0;
            }
            section { padding: 50px 0; }
        }

        @media (min-width: 901px) and (max-height: 820px) {
            .challenges-section {
                padding: 16px 0;
            }

            .challenges-section .container {
                gap: 10px;
            }

            .challenges-section .section-header h2 {
                font-size: 1.5rem;
                margin-bottom: 8px;
                padding-bottom: 8px;
            }

            .challenges-list {
                gap: 16px 18px;
            }

            .challenges-list li {
                padding: 14px 18px;
                font-size: 0.8125rem;
                line-height: 1.5;
            }
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
            <p>Transform fragmented legacy data infrastructure into a unified, AI-ready Lakehouse. Mahathi delivers zero-downtime migrations, real-time analytics, and AI-powered intelligence for insurance carriers, healthcare payers, MGAs, and TPAs. 100+ successful Databricks implementations. 2.5B+ records migrated. 35% faster queries. Zero incidents.</p>
        </div>
        <div class="hero-image">📊</div>
    </section>

    <!-- SECTION 2: INDUSTRY CHALLENGES & DATABRICKS SOLUTION -->
    <section class="challenges-section">
        <div class="container">
            <div class="section-header">
                <h2>Industry Challenges That Databricks Solves</h2>
                <p>Insurance carriers and healthcare payers face critical data infrastructure gaps. Legacy warehouses create operational silos, slow decision-making, and escalate costs. Databricks transforms these challenges into competitive advantage through a unified Lakehouse architecture.</p>
            </div>
            <ul class="challenges-list">
                <li><strong>Fragmented Data Silos:</strong> Claims, eligibility, underwriting data scattered across incompatible systems. No unified source of truth. Manual data reconciliation.</li>
                <li><strong>Slow Claims Processing:</strong> Average 15-30 day cycle times. Fraud detection remains manual. STP rates stuck below 40%. Manual workflows cost millions annually.</li>
                <li><strong>Underwriting Blindness:</strong> Decisions made on stale data. Real-time risk assessment impossible. Competitive disadvantage against faster competitors using AI.</li>
                <li><strong>Rising Data Costs:</strong> Separate tools for analytics, engineering, and AI. Infrastructure sprawl. Data duplication. Cloud spend 3-4x industry benchmark.</li>
                <li><strong>Compliance & Governance Gaps:</strong> Audit trails insufficient for HIPAA/SOC 2. PII masking manual. Row/column-level access control non-existent. Regulatory risk.</li>
                <li><strong>AI Capability Gap:</strong> No in-platform AI/ML. Manual fraud detection. Predictive pricing impossible. Competitor's chatbots outpacing internal capabilities.</li>
            </ul>
        </div>
    </section>

    <!-- SECTION 4: DATABRICKS IMPLEMENTATION SERVICES -->
    <section id="services">
        <div class="container">
            <div class="section-header">
                <h2>End-to-End Databricks Service Offering</h2>
                <p>Complete Databricks implementation services covering discovery, architecture, migration, governance, and ongoing optimization. From warehouse-to-lakehouse transformation to AI-powered analytics.</p>
            </div>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/><path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16"/><path d="M16 16h5v5"/></svg>
                    </div>
                    <h3>Zero-Downtime Data Migration</h3>
                    <p>Warehouse-to-lakehouse transformation using CDC (Change Data Capture). 2.5+ billion records migrated without business interruption. 8-12 week implementation. Bi-directional sync during cutover. Automated validation. Zero data loss.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2 3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                    </div>
                    <h3>Enterprise Data Ingestion & ETL</h3>
                    <p>Ingest APIs, databases, SaaS platforms (Salesforce, Epic, Workday). Claims data, eligibility records, underwriting information. Unlimited throughput. Quality validation. Real-time and batch modes. Change tracking. Automated error handling.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 20V10"/><path d="M10 20V4"/><path d="M16 20v-6"/><path d="M22 20V8"/></svg>
                    </div>
                    <h3>Real-Time Analytics & BI</h3>
                    <p>Sub-second dashboards on terabyte-scale data. Claims adjusters access live KPIs. Underwriters make real-time decisions. Executive dashboards refresh every minute. SQL query performance 10x faster than legacy systems.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="4" width="16" height="16" rx="2"/><path d="M9 9h.01"/><path d="M15 9h.01"/><path d="M9 15a3 3 0 0 0 6 0"/></svg>
                    </div>
                    <h3>AI & Machine Learning at Scale</h3>
                    <p>Fraud detection models, claims triage, predictive pricing, risk adjustment. Generative AI for documentation. Built-in AI features. Claims copilots. Underwriting assistants. Real-time predictions on millions of records.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="11" width="14" height="10" rx="2"/><path d="M8 11V7a4 4 0 0 1 8 0v4"/></svg>
                    </div>
                    <h3>Governance, Compliance & Security</h3>
                    <p>Unity Catalog for data governance. PII masking. Column/row-level access control. HIPAA/SOC 2/GDPR compliance built-in. Encryption in transit and at rest. Comprehensive audit trails. Identity federation with your SSO.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg>
                    </div>
                    <h3>Managed Databricks Services</h3>
                    <p>End-to-end platform management. 24/7 monitoring and support. Performance tuning. Security patches. Cluster optimization. Cost management. We manage infrastructure—you focus on business value. SLA-backed.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 8: BRONZE PARTNER -->
    <section id="bronze" class="bronze-section">
        <div class="container">
            <div class="bronze-content">
                <div class="bronze-highlights">
                    <div class="bronze-stat">
                        <div class="bronze-stat-number"><span class="bronze-stat-value">15</span><span class="bronze-stat-suffix">+</span></div>
                        <div class="bronze-stat-label">Certified Databricks Consultants</div>
                    </div>
                    <div class="bronze-stat">
                        <div class="bronze-stat-number"><span class="bronze-stat-value">100</span><span class="bronze-stat-suffix">+</span></div>
                        <div class="bronze-stat-label">Successful Implementations</div>
                    </div>
                    <div class="bronze-stat">
                        <div class="bronze-stat-number"><span class="bronze-stat-value">2.5B</span><span class="bronze-stat-suffix">+</span></div>
                        <div class="bronze-stat-label">Records Migrated</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 5: WHY DATABRICKS -->
    <section id="why" class="why-section">
        <div class="container">
            <div class="why-layout">
                <div class="why-intro">
                    <h2>Why Databricks for Insurance & Healthcare</h2>
                    <p>Databricks Lakehouse Platform uniquely addresses the data infrastructure needs of insurers and healthcare payers.</p>
                </div>
                <div class="why-benefits-rows">
                    <ul class="why-benefits-row">
                        <li><strong>Unified Architecture:</strong> Single platform for BI, ML, and data engineering eliminates tool sprawl and reduces infrastructure costs</li>
                        <li><strong>Enterprise Scale:</strong> Handle 2.5B+ records with sub-second query response. Terabyte-scale analytics instantly</li>
                        <li><strong>Real-Time Intelligence:</strong> Live dashboards. Streaming data ingestion. Real-time fraud detection and underwriting decisions</li>
                        <li><strong>Built-In AI/ML:</strong> Databricks Foundation Models. LLMOps. Prompt engineering. No need for separate ML platform</li>
                    </ul>
                    <ul class="why-benefits-row">
                        <li><strong>Cost Efficiency:</strong> 3-5x cheaper than legacy data warehouses. Shared compute across BI and analytics. Automatic scaling</li>
                        <li><strong>Compliance by Design:</strong> Unity Catalog for governance. Built-in PII protection. Row/column-level security. Full audit trails</li>
                        <li><strong>Zero-Downtime Upgrades:</strong> Platform updates without service interruption. Disaster recovery built-in</li>
                        <li><strong>Certified Partnership:</strong> Mahathi is an official Databricks Bronze Partner with deep implementation expertise</li>
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
                <p>Real results from Databricks implementations in insurance, healthcare, and related industries.</p>
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

    <!-- SECTION 11: FOOTER CTA -->
    <section class="footer-cta">
        <div class="footer-cta-card">
            <div class="footer-cta-text">
                <h2>Ready to Modernize Your Data Platform?</h2>
                <p>Schedule a 30-minute consultation with a Databricks specialist. We'll assess your current infrastructure, identify quick wins, and outline a phased implementation roadmap with cost projections.</p>
            </div>
            <a href="mailto:databricks@mahathiinfotech.com?subject=Databricks%20Implementation%20Consultation" class="btn btn-primary footer-cta-action">Schedule Consultation</a>
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