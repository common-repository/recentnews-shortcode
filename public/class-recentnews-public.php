<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://alex.stocker.info
 * @since      1.0.0
 *
 * @package    Recentnews
 * @subpackage Recentnews/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Recentnews
 * @subpackage Recentnews/public
 * @author     Alexander Stocker <alex@stocker.info>
 */
class Recentnews_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Recentnews_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Recentnews_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/recentnews-public.css', [], $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Recentnews_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Recentnews_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/recentnews-public.js', ['jquery'], $this->version, false );

	}

	/**
	 * @param array $attr
	 * @return string
	 */
	public function recentnews_shortcode($attr = []) {
		
		global $wp_query;
		$post_id = $wp_query->post->ID;

		$options = get_option($this->plugin_name);

		if(isset($attr['count'])) {
			$count = (int)$attr['count'];
		} else {
			$count = $options['post_count'];
		}

		$args = [
			'numberposts' => $count,
			'offset' => 0,
			'category' => 0,
			'orderby' => 'post_date',
			'order' => 'DESC',
			'post_type' => 'post',
			'post_status' => 'publish',
			'exclude' => [$post_id],
			'suppress_filters' => true
		];
		$posts = wp_get_recent_posts( $args, ARRAY_A );

		$output = '<ul class="recentnews_ul">';
		foreach($posts as $post) {
			$output .= '<li class="recentnews_li"><h4 class="recentnews_title">'.$post["post_title"].'</h4>';
			$output .= '<div class="recentnews_excerpt" style="display:none;">';
			if(!empty($post['post_excerpt'])) {
				$output .= $post['post_excerpt'];
			} else {
				$output .= wp_trim_excerpt( $post['post_content']);
			}
			$output .= '<span class="recentnews_readmore">';
			$output .= '<a href="'. get_permalink($post["ID"]) . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', '' ) . '</a></span>';
			$output .= '</li>';
		}
		$output .= '</ul>';

		return $output;
	}

}
