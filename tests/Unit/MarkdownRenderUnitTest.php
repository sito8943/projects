<?php

use App\Support\Markdown;

it('renders headings and inline formatting', function () {
    $md = "# Title\n\n**bold** *italic* `code`";
    $html = Markdown::render($md);
    expect($html)->toContain('<h1>Title</h1>');
    expect($html)->toContain('<strong>bold</strong>');
    expect($html)->toContain('<em>italic</em>');
    expect($html)->toContain('<code>code</code>');
});
