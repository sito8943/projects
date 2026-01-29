<?php

it('renders filters toggle elements and header script after DOM ready', function () {
    $response = $this->get('/projects');

    $response->assertSuccessful();
    // Button and panel exist
    $response->assertSee('id="toggle-sidebar"', false);
    $response->assertSee('id="mobile-sidebar"', false);
    // Header script uses DOMContentLoaded to bind after the DOM is ready
    $response->assertSee('DOMContentLoaded', false);
});
