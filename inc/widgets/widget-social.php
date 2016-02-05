<?php
/**
 * Social  Widget
 * PHG Base Theme
 */
class phg_gold_social_widget extends WP_Widget
{
	 function phg_gold_social_widget(){
        $widget_ops = array('classname' => 'phg-gold-social','description' => esc_html__( "PHG Base Social Widget" ,'phg-gold') );
		    parent::__construct('phg-gold-social', esc_html__('phg-gold Social Widget','activello'), $widget_ops);
    }
    function widget($args , $instance) {
    	extract($args);
        $title = isset($instance['title']) ? $instance['title'] : esc_html__('Follow us' , 'phg-gold');
      echo $before_widget;
      echo $before_title;
      echo $title;
      echo $after_title;
    /**
     * Widget Content
     */
    ?>

    <!-- social icons -->
    <div class="social-icons sticky-sidebar-social">


    <?php phg_gold_social_icons(); ?>


    </div><!-- end social icons -->


		<?php
		echo $after_widget;
    }
    function form($instance) {
      if(!isset($instance['title'])) $instance['title'] = esc_html__('Follow us' , 'phg-gold');
    ?>

      <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title ','phg-gold') ?></label>

      <input type="text" value="<?php echo esc_attr($instance['title']); ?>"
                          name="<?php echo $this->get_field_name('title'); ?>"
                          id="<?php $this->get_field_id('title'); ?>"
                          class="widefat" />
      </p>

    	<?php
    }
}
?>