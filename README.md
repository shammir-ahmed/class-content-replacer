# Class Content Replacer WordPress Plugin

![Plugin Banner](assets/banner-1544x500.png)  
*Dynamically replace content in any HTML element by CSS class*

[![WordPress Version](https://img.shields.io/wordpress/plugin/tested/class-content-replacer?style=flat-square)](https://wordpress.org/plugins/) 
[![GitHub Release](https://img.shields.io/github/v/release/shammir-ahmed/class-content-replacer?style=flat-square)](https://github.com/shammir-ahmed/class-content-replacer/releases)
[![License](https://img.shields.io/badge/License-GPLv2-blue.svg?style=flat-square)](LICENSE)

## 🔥 Features

- **Target Elements by Class** - Replace content in any HTML element with specified CSS classes
- **Full HTML Support** - Include links, images, and formatted text in replacements
- **JSON Configuration** - Simple admin interface with real-time validation
- **Lightweight** - Vanilla JS implementation (no jQuery dependency)
- **Multisite Ready** - Works across WordPress networks

## 🚀 Installation

### Method 1: WordPress Admin
1. [Download Latest Release](https://github.com/shammir-ahmed/class-content-replacer/releases/latest/download/class-content-replacer.zip)
2. Go to **Plugins → Add New → Upload Plugin**
3. Activate the plugin

### Method 2: Manual (FTP)
```bash
cd /wp-content/plugins/
wget https://github.com/shammir-ahmed/class-content-replacer/archive/refs/heads/main.zip
unzip main.zip

## Admin Interface
![Plugin Banner](assets/screenshot-1.png) 

## How It Works
![Plugin Banner](assets/screenshot-2.png)

## Configuration

1. Go to WordPress Admin → Settings → Content Replacer
2. Enter JSON configuration with your class mappings:

```json
{
    "footer-class": "Copyright © 2025 - <a href='https://example.com'>Site</a>",
    "header-text": "Welcome to our website"
}

## License
This plugin is released under the [GPLv2 license](LICENSE).
