<?php

namespace App\Support;

class Markdown
{
    /**
     * Render a safe, minimal Markdown subset to HTML.
     * - Escapes raw HTML first
     * - Supports headings, bold, italics, inline code, code fences, links, and paragraphs
     */
    public static function render(?string $text): string
    {
        if ($text === null || $text === '') {
            return '';
        }

        // Normalize newlines
        $text = str_replace(["\r\n", "\r"], "\n", $text);

        // Escape raw HTML to avoid XSS; we'll inject safe HTML after
        $escaped = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');

        // Preserve code fences by replacing them with placeholders
        $codeBlocks = [];
        $escaped = preg_replace_callback('/```[a-zA-Z0-9\-\_]*\n([\s\S]*?)\n```/m', function ($m) use (&$codeBlocks) {
            $idx = count($codeBlocks);
            $code = $m[1];
            $codeBlocks[$idx] = '<pre class="rounded bg-gray-100 p-3 overflow-auto"><code>'.$code.'</code></pre>';

            return "[[[CODEBLOCK_{$idx}]]]";
        }, $escaped) ?? $escaped;

        // Headings: transform per line to avoid regex multiline pitfalls
        $lines = explode("\n", $escaped);
        foreach ($lines as $i => $line) {
            if (preg_match('/^(#{1,6})\s+(.+)$/', $line, $m) === 1) {
                $level = strlen($m[1]);
                $content = $m[2];
                $lines[$i] = '<h'.$level.'>'.$content.'</h'.$level.'>';
            }
        }
        $escaped = implode("\n", $lines);

        // Inline code
        $escaped = preg_replace('/`([^`]+)`/', '<code>$1</code>', $escaped) ?? $escaped;

        // Bold and italics
        $escaped = preg_replace('/\*\*([^*]+)\*\*/', '<strong>$1</strong>', $escaped) ?? $escaped;
        $escaped = preg_replace('/\*([^*]+)\*/', '<em>$1</em>', $escaped) ?? $escaped;

        // Links [text](url) - only allow http/https
        $escaped = preg_replace_callback('/\[([^\]]+)\]\(([^)]+)\)/', function ($m) {
            $text = $m[1];
            $url = $m[2];
            $url = filter_var($url, FILTER_SANITIZE_URL) ?: '';
            $valid = filter_var($url, FILTER_VALIDATE_URL) && preg_match('/^https?:\/\//i', $url);
            if (! $valid) {
                return $text;
            }

            return '<a href="'.$url.'" target="_blank" rel="nofollow noopener noreferrer">'.$text.'</a>';
        }, $escaped) ?? $escaped;

        // Paragraphs: wrap blocks separated by blank lines, ignoring existing tags like <h1> or <pre>
        $parts = preg_split('/\n{2,}/', $escaped) ?: [$escaped];
        foreach ($parts as $i => $part) {
            if (preg_match('/^\s*<(h[1-6]|pre|ul|ol|blockquote|table|p)[\s>]/i', $part) === 1) {
                continue;
            }
            // Convert single newlines to <br>
            $part = preg_replace('/\n/', '<br>', $part) ?? $part;
            $parts[$i] = '<p>'.$part.'</p>';
        }
        $html = implode("\n\n", $parts);

        // Restore code blocks
        foreach ($codeBlocks as $idx => $htmlBlock) {
            $html = str_replace("[[[CODEBLOCK_{$idx}]]]", $htmlBlock, $html);
        }

        return $html;
    }
}
