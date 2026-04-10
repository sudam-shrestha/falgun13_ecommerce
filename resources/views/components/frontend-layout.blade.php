<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SudamHub · artisan marketplace</title>
    <!-- Vite: Tailwind 4 (already installed) + app css/js -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    <!-- Font Awesome 6.5 (FA 7 does not exist — fixed) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.tailwindcss.com"></script>


    <!-- Custom style tag with root variables & container definition -->
    <style>
        /* ROOT VARIABLES – brand identity for SudamHub */
        :root {
            --primary: #1e3a5f;
            --primary-light: #2b5a7a;
            --accent: #c28b4e;
            --accent-soft: #e6c9a8;
            --surface: #faf8f5;
            --surface-card: #ffffff;
            --text-dark: #1a1e24;
            --text-soft: #3e4756;
            --border-light: #e0dbd2;
            --success: #2d6a4f;
            --shadow-card: 0 12px 28px -8px rgba(0, 0, 0, 0.06), 0 4px 12px rgba(0, 0, 0, 0.03);
            --radius-card: 1.5rem;
            --radius-input: 0.9rem;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: var(--surface);
            color: var(--text-dark);
            font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        .container {
            width: 86%;
            margin-left: auto;
            margin-right: auto;
        }

        .section-gap {
            padding-top: 4.5rem;
            padding-bottom: 4.5rem;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
            font-weight: 600;
            padding: 0.8rem 2rem;
            border-radius: 3rem;
            border: none;
            cursor: pointer;
            transition: background 0.2s, box-shadow 0.2s;
            box-shadow: 0 8px 16px -6px rgba(30, 58, 95, 0.2);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary:hover {
            background-color: var(--primary-light);
            box-shadow: 0 12px 20px -8px rgba(30, 58, 95, 0.3);
        }

        .btn-outline-accent {
            background: transparent;
            border: 1.5px solid var(--accent);
            color: var(--primary);
            font-weight: 600;
            padding: 0.7rem 1.8rem;
            border-radius: 3rem;
            transition: 0.2s;
        }

        .btn-outline-accent:hover {
            background-color: rgba(194, 139, 78, 0.06);
            border-color: var(--primary);
        }

        .input-custom {
            background: var(--surface-card);
            border: 1.5px solid var(--border-light);
            border-radius: var(--radius-input);
            padding: 0.85rem 1.2rem;
            width: 100%;
            font-size: 1rem;
            transition: border 0.15s, box-shadow 0.15s;
        }

        .input-custom:focus {
            outline: none;
            border-color: var(--primary-light);
            box-shadow: 0 0 0 4px rgba(30, 58, 95, 0.06);
        }

        .label-custom {
            font-weight: 500;
            color: var(--primary);
            margin-bottom: 0.4rem;
            display: block;
            font-size: 0.95rem;
        }

        .product-card {
            background: var(--surface-card);
            border-radius: var(--radius-card);
            box-shadow: var(--shadow-card);
            transition: transform 0.2s, box-shadow 0.25s;
            border: 1px solid rgba(224, 219, 210, 0.4);
        }

        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 28px 40px -12px rgba(0, 0, 0, 0.1);
        }

        .pill-badge {
            background: rgba(194, 139, 78, 0.12);
            color: var(--primary);
            padding: 0.25rem 1rem;
            border-radius: 40px;
            font-size: 0.8rem;
            font-weight: 600;
            border: 1px solid rgba(194, 139, 78, 0.2);
            display: inline-block;
        }

        /* Pill variant with primary background — replaces !bg-[var(--primary)]/10 */
        .pill-primary {
            background: rgba(30, 58, 95, 0.1);
            color: var(--primary);
            padding: 0.25rem 1rem;
            border-radius: 40px;
            font-size: 0.8rem;
            font-weight: 600;
            border: 1px solid rgba(30, 58, 95, 0.15);
            display: inline-block;
        }

        .footer-link {
            color: var(--text-soft);
            text-decoration: none;
            transition: color 0.15s;
        }

        .footer-link:hover {
            color: var(--primary);
        }

        /* ===== Tailwind v4 fix: opacity + CSS variable =====
           In v4 you CANNOT do bg-[var(--x)]/50 because Tailwind
           can't decompose a CSS variable into rgba channels.
           These utility classes replace every broken instance. */

        .bg-surface-card-80 {
            background-color: rgba(255, 255, 255, 0.8);
        }

        .bg-surface-card-60 {
            background-color: rgba(255, 255, 255, 0.6);
        }

        .bg-accent-soft-30 {
            background-color: rgba(230, 201, 168, 0.3);
        }

        .bg-primary-5 {
            background-color: rgba(30, 58, 95, 0.05);
        }

        .bg-primary-10 {
            background-color: rgba(30, 58, 95, 0.1);
        }

        .bg-accent-20 {
            background-color: rgba(194, 139, 78, 0.2);
        }

        .text-primary-40 {
            color: rgba(30, 58, 95, 0.4);
        }

        .text-primary-60 {
            color: rgba(30, 58, 95, 0.6);
        }

        /* Add-to-cart button: replaces bg-[var(--primary)]/5 + hover:bg-[var(--primary)]/10 */
        .btn-cart {
            background-color: rgba(30, 58, 95, 0.05);
            transition: background-color 0.15s;
        }

        .btn-cart:hover {
            background-color: rgba(30, 58, 95, 0.1);
        }
    </style>
</head>

<body class="antialiased">

    @include('sweetalert::alert')

    
    <!-- ========== HEADER / NAVIGATION ========== -->
    <x-frontend-header />

    <main>
        {{ $slot }}
    </main>

    <!-- ========== FOOTER ========== -->
    <x-frontend-footer />

</body>

</html>
