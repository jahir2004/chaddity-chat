<div style="display: flex; min-height: 100vh; background-color: #ffffff; flex-direction: column;">
    <!-- Navbar -->
    <header style="background-color: #ffffff; position: sticky; top: 0; z-index: 40; border-bottom: 2px solid #dc2626;">
        <div style="max-width: 7xl; margin: 0 auto; padding: 1rem 1.5rem;">
            @isset($header)
                {{ $header }}
            @endisset
        </div>
    </header>

    <!-- Main Content -->
    <main style="flex: 1; background-color: #ffffff;">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer style="background-color: #111827; color: #ffffff; padding: 2rem; text-align: center; border-top: 2px solid #dc2626;">
        <p style="margin: 0; font-size: 0.875rem;">
            &copy; 2024 Chaddity Chat. All rights reserved.
        </p>
    </footer>
</div>
