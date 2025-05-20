# Class Content Replacer WordPress Plugin

![Plugin Banner](assets/banner-1544x500.png)

A WordPress plugin that replaces content in elements with specific CSS classes based on admin configuration.

## Features

- Replace content in elements by CSS class
- Supports HTML content in replacements
- Simple JSON configuration interface
- Lightweight JavaScript implementation
- Secure content sanitization
- Multisite compatible

## Installation

1. Download the latest release from the [Releases page](https://github.com/yourusername/class-content-replacer/releases)
2. Upload the plugin folder to `/wp-content/plugins/`
3. Activate the plugin through WordPress admin
4. Configure at Settings → Content Replacer

## Configuration

1. Go to WordPress Admin → Settings → Content Replacer
2. Enter JSON configuration with your class mappings:

```json
{
    "footer-class": "Copyright © 2025 - <a href='https://example.com'>Site</a>",
    "header-text": "Welcome to our website"
}