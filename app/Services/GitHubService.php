<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class GitHubService
{
    /**
     * Fetch the README.md content for a given repository using GitHub REST API v3.
     * Returns decoded plain text (Markdown) or null on any failure/edge case.
     */
    public function getRepositoryReadme(string $owner, string $repo): ?string
    {
        $owner = trim($owner);
        $repo = trim($repo);
        if ($owner === '' || $repo === '') {
            return null;
        }

        $url = "https://api.github.com/repos/{$owner}/{$repo}/readme";

        try {
            $request = Http::accept('application/vnd.github.v3+json');

            $token = (string) config('services.github.token');
            if ($token !== '') {
                $request = $request->withToken($token);
            }

            $response = $request->get($url);

            if (! $response->successful()) {
                // Gracefully return null on 404, 403, 429, or any non-2xx
                return null;
            }

            $data = $response->json();
            // GitHub returns base64-encoded content field
            $encoded = $data['content'] ?? null;
            if (! is_string($encoded) || $encoded === '') {
                return null;
            }

            $decoded = base64_decode(str_replace(["\n", "\r"], '', $encoded), true);

            if (! is_string($decoded) || $decoded === '') {
                return null;
            }

            // Optional safety: limit to first 5000 characters
            return Str::of($decoded)->limit(5000, '')->rtrim()->toString();
        } catch (\Throwable $e) {
            // Non-blocking: do not throw, just return null
            return null;
        }
    }
}
