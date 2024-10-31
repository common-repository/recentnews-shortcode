<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://alex.stocker.info
 * @since      1.0.0
 *
 * @package    Recentnews
 * @subpackage Recentnews/admin/partials
 */
?>
<div class="wrap">
    <h2><?php echo esc_html(get_admin_page_title()); ?></h2>
    <form method="post" name="news_options" action="options.php">
        <?php settings_fields($this->plugin_name); ?>
        <?php
        $options = get_option($this->plugin_name);
        $postCount = $options['post_count'];
        ?>
        <fieldset>
            <legend class="screen-reader-text"><span>Number of recent news to list</span></legend>
            <label for="<?php echo $this->plugin_name; ?>-post_count">
                <input type="number" id="<?php echo $this->plugin_name; ?>-post_count" name="<?php echo $this->plugin_name; ?>[post_count]" value="<?php echo $postCount; ?>"/>
                <span><?php esc_attr_e('List recent news', $this->plugin_name); ?></span>
            </label>
        </fieldset>
        <?php submit_button('Save', 'primary','submit', TRUE); ?>
    </form>
</div>
