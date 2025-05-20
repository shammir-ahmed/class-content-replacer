<?php
/**
 * Plugin Name: Advanced Class Content Replacer
 * Plugin URI: https://github.com/shammir-ahmed/class-content-replacer
 * Description: Replace content in elements with specific classes including HTML content
 * Version: 1.3
 * Author: Rushda Soft Development by Shammir Ahmed
 * Author URI: https://www.rushdasoft.com
 * License: GPL-2.0+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: class-content-replacer
 */

defined('ABSPATH') || exit;

class Class_Content_Replacer {
    
    public function __construct() {
        add_action('admin_menu', array($this, 'add_admin_page'));
        add_action('admin_init', array($this, 'settings_init'));
        add_action('wp_footer', array($this, 'process_replacements'));
    }

    public function add_admin_page() {
        add_options_page(
            'Content Replacement Settings',
            'Content Replacer',
            'manage_options',
            'cbcr-settings',
            array($this, 'admin_page_html')
        );
    }

    public function settings_init() {
        register_setting('cbcr', 'cbcr_replacements');
        
        add_settings_section(
            'cbcr_section',
            'CSS Class to Content Mappings',
            array($this, 'section_html'),
            'cbcr'
        );
        
        add_settings_field(
            'cbcr_field',
            'Replacements (supports HTML)',
            array($this, 'field_html'),
            'cbcr',
            'cbcr_section'
        );
    }

    public function admin_page_html() {
        if (!current_user_can('manage_options')) {
            return;
        }
        
        // Show error/update messages
        settings_errors('cbcr_messages');
        ?>
        <div class="wrap">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            <form action="options.php" method="post">
                <?php
                settings_fields('cbcr');
                do_settings_sections('cbcr');
                submit_button('Save Settings');
                ?>
            </form>
            
            <div class="plugin-credits" style="margin-top: 30px; padding: 15px; background: #f5f5f5; border-radius: 4px;">
                <h3>Plugin Information</h3>
                <p>Developed by <a href="https://www.rushdasoft.com" target="_blank" rel="noopener">Rushda Soft</a> - Development by Shammir Ahmed</p>
                <p>For support, please <a href="https://www.rushdasoft.com/contact" target="_blank" rel="noopener">contact us</a>.</p>
            </div>
        </div>
        <?php
    }

    public function section_html() {
        echo '<p>Enter CSS classes and their replacement content in JSON format (HTML allowed):</p>';
        echo '<div class="example" style="background: #f5f5f5; padding: 10px; border-radius: 4px; margin: 10px 0;">';
        echo '<strong>Example:</strong><br>';
        echo '<code>{<br>';
        echo '&nbsp;&nbsp;"footer-class": "Copyright © 2025 - &lt;a href=\'https://example.com\' target=\'_blank\' rel=\'noopener\'&gt;Company&lt;/a&gt;",<br>';
        echo '&nbsp;&nbsp;"header-text": "Welcome to our site"<br>';
        echo '}</code>';
        echo '</div>';
    }

    public function field_html() {
        $options = get_option('cbcr_replacements');
        ?>
        <textarea name="cbcr_replacements" rows="10" cols="50" class="widefat code"><?php echo esc_textarea($options); ?></textarea>
        <p class="description">Enter valid JSON format with CSS classes as keys and replacement content as values.</p>
        <?php
    }

    public function process_replacements() {
        $replacements_json = get_option('cbcr_replacements');
        $replacements = json_decode($replacements_json, true);
        
        if (empty($replacements) || !is_array($replacements)) {
            return;
        }
        
        $js = '<script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {';
        
        foreach ($replacements as $class => $content) {
            if (empty($class)) {
                continue;
            }
            
            // Clean and escape the content
            $cleaned_content = $this->clean_content($content);
            $escaped_content = $this->escape_js_content($cleaned_content);
            
            $js .= '
            var elements = document.getElementsByClassName("' . esc_js($class) . '");
            if (elements && elements.length > 0) {
                for (var i = 0; i < elements.length; i++) {
                    elements[i].innerHTML = "' . $escaped_content . '";
                }
            }';
        }
        
        $js .= '
        });
        </script>';
        
        echo $js;
    }
    
    private function clean_content($content) {
        // Convert smart quotes and other special characters
        $content = htmlspecialchars_decode($content, ENT_QUOTES);
        
        // Remove any potentially dangerous tags (optional)
        $allowed_tags = wp_kses_allowed_html('post');
        $content = wp_kses($content, $allowed_tags);
        
        return $content;
    }
    
    private function escape_js_content($content) {
        // Escape for JavaScript string
        $content = str_replace(
            array('\\', '"', "'", "\n", "\r"),
            array('\\\\', '\"', "\\'", '', ''),
            $content
        );
        
        return $content;
    }
}

// Initialize the plugin
new Class_Content_Replacer();