<?php

if (! function_exists('htmx')) {
    /**
     * Get the HTMX helper instance
     */
    function htmx(): App\Support\Htmx
    {
        return app(App\Support\Htmx::class);
    }
}
