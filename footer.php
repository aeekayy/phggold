<?php
/**
 * THe template for the footer and related content
 *
 * @package phg_gold
 */
 ?>
			<footer class="footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">

				<div id="inner-footer" class="wrap cf">

					<nav role="navigation">
						<?php 
						if (has_tag('location')) {
							if(has_tag('bacara')) { $_menu_name = "Bacara Footer Menu"; }
							elseif(has_tag('balboa')) { $_menu_name = "Balboa Footer Menu"; }
							elseif(has_tag('estancia')) { $_menu_name = "Estancia Footer Menu"; }
							elseif(has_tag('koakea')) { $_menu_name = "Koa Kea Footer Menu"; }
							elseif(has_tag('meritage')) { $_menu_name = "Meritage Footer Menu"; }
							elseif(has_tag('pasea')) { $_menu_name = "Pasea Footer Menu"; }
							else { $_menu_name = "Footer Menu"; }
							wp_nav_menu(array(
	    					'container' => 'div',                           // enter '' to remove nav container (just make sure .footer-links in _gold.scss isn't wrapping)
	    					'container_class' => 'footer-links cf',         // class of container (should you choose to use it)
	    					'menu' => $_menu_name,   // nav name
	    					'menu_class' => 'nav footer-nav cf',            // adding custom nav class
	    					'theme_location' => 'footer-links',             // where it's located in the theme
	    					'before' => '',                                 // before the menu
	    					'after' => '',                                  // after the menu
	    					'link_before' => '',                            // before each link
	    					'link_after' => '',                             // after each link
	    					'depth' => 0,                                   // limit the depth of the nav
	    					'fallback_cb' => 'bones_footer_links_fallback'  // fallback function
							));
						} else {
							wp_nav_menu(array(
	    					'container' => 'div',                           // enter '' to remove nav container (just make sure .footer-links in _gold.scss isn't wrapping)
	    					'container_class' => 'footer-links cf',         // class of container (should you choose to use it)
	    					'menu' => __( 'Footer Links', 'bonestheme' ),   // nav name
	    					'menu_class' => 'nav footer-nav cf',            // adding custom nav class
	    					'theme_location' => 'footer-links',             // where it's located in the theme
	    					'before' => '',                                 // before the menu
	    					'after' => '',                                  // after the menu
	    					'link_before' => '',                            // before each link
	    					'link_after' => '',                             // after each link
	    					'depth' => 0,                                   // limit the depth of the nav
	    					'fallback_cb' => 'bones_footer_links_fallback'  // fallback function
							));
						}
						 ?>
						 <ul class="footer_nav_responsive">
							<li class="footer-accordion">
								<h3>Quick Links</h3>
								<ul class="footer_nav sub">
									<li class="giving-back"><a href="#">Giving Back</a></li>
									<?php if(has_tag('bacara') || has_tag('balboa') || has_tag('estancia') || has_tag('koakea') || has_tag('meritage') || has_tag('pasea')) {
											if(has_tag('bacara')) { $params = array('showposts' => 1, 'post_type' => 'page', 'post_status' => 'publish', 'tag_slug__and' => array('bacara','resort-page')); }
											elseif(has_tag('balboa')) { $params = array('showposts' => 1, 'post_type' => 'page', 'post_status' => 'publish', 'tag_slug__and' => array('balboa','resort-page')); }
											elseif(has_tag('estancia')) { $params = array('showposts' => 1, 'post_type' => 'page', 'post_status' => 'publish', 'tag_slug__and' => array('estancia','resort-page')); }
											elseif(has_tag('koakea')) { $params = array('showposts' => 1, 'post_type' => 'page', 'post_status' => 'publish', 'tag_slug__and' => array('koakea','resort-page')); }
											elseif(has_tag('meritage')) { $params = array('showposts' => 1, 'post_type' => 'page', 'post_status' => 'publish', 'tag_slug__and' => array('meritage','resort-page')); }
											elseif(has_tag('pasea')) { $params = array('showposts' => 1, 'post_type' => 'page', 'post_status' => 'publish', 'tag_slug__and' => array('pasea','resort-page')); }

											$query = new WP_Query; 
											$results = $query->query($params); 
											if( $query->have_posts() ) {
												while( $query->have_posts() ) {
													$query->the_post();
									?>
									<li class="directions"><a href="<?php the_permalink();?>#directions">Directions</a></li>
									<?php } } } ?>
								</ul>
							</li>
							<li class="footer-accordion">
								<h3>About Us</h3>
								<ul class="footer_nav sub">
									<li class="careers"><a href="#">Careers</a></li>
									<li class="prviacy"><a href="#">Privacy</a></li>
								</ul>
							</li>
							<li class="footer-accordion">
								<h3>Connect</h3>
								<ul class="footer_nav sub">
									<li class="contact-us"><a href="#">Contact Us</a></li>
									<li class="newsletter"><a href="#">Newsletter</a></li>
									<li class="newsroom"><a href="#">Newsroom</a></li>
									<li class="social-content"><a href="#">Social Connect</a></li>
								</ul>
							</li>
						</ul>
					</nav>

					<?php if( !get_theme_mod('footer_partner') ) phg_gold_partner_icons(); ?>
					
					<div class="sub-footer">
						<?php if( !get_theme_mod('footer_social') ) phg_gold_social_icons(); 
							if(has_tag('bacara')) { $pushtotalk = "http://www.navistechnologies.info/p2talk/P2TCust.aspx?account=15170&dnis=8445918931&loc=BRS"; }
							elseif(has_tag('balboa')) { $pushtotalk = "http://www.navistechnologies.info/p2talk/P2TCust.aspx?account=15170&dnis=8445918932&loc=BBR"; }
							elseif(has_tag('estancia')) { $pushtotalk = "https://www.thenavisway.com/p2talk/P2TCust.aspx?account=15170&dnis=8445918930&contactid=null&loc=ELJ"; }
							//elseif(has_tag('koakea')) { $pushtotalk = "http://www.navistechnologies.info/p2talk/P2TCust.aspx?account=15170&amp;dnis=8447500958&amp;loc=EST"; }
							elseif(has_tag('meritage')) { $pushtotalk = "http://www.navistechnologies.info/p2talk/P2TCust.aspx?account=15170&dnis=8445918929&loc=TMR"; }
							elseif(has_tag('pasea')) { $pushtotalk = "http://www.navistechnologies.info/p2talk/P2TCust.aspx?account=15170&dnis=8556982285&loc=PHS"; }
							else { $pushtotalk = "http://www.navistechnologies.info/p2talk/P2TCust.aspx?account=15170&dnis=8888880558&loc=TMC"; }

							if(has_tag('bacara')) {
								$phone_number = "855.968.0100";
							} elseif(has_tag('estancia')) {
								$phone_number = "855.318.7602";
							} elseif(has_tag('balboa')) {
								$phone_number = "888.894.2788";
							} elseif(has_tag('koakea')) {
								$phone_number = "888.898.8958";
							} else {
								$phone_number = "855.318.1768"; 
							}
						?>
						<span id="NavisPhoneNumber"><script type="text/javascript">ShowNavisNCPhoneNumberFormat("###.###.####");</script><noscript><?php print $phone_number; ?></noscript></span> | <a id="lnkP2Talk" href="<?php print $pushtotalk; ?>" target="_blank"><img class="alignnone size-full wp-image-48927" src="/wp-content/uploads/2016/03/footer-push-to-talk.png" width="84" height="38" /></a>
						<?php
						if(has_tag('bacara')) { ?>
						<script type="text/javascript" src="//www.navistechnologies.info/JavascriptPhoneNumber/js.aspx?account=15170&jspass=ddxwjw8jcnv63tabqx22&dflt=8559680100"></script>
						<?php } elseif(has_tag('balboa')) { ?>
						<script type="text/javascript" src="//www.navistechnologies.info/JavascriptPhoneNumber/js.aspx?account=15170&jspass=ddxwjw8jcnv63tabqx22&dflt=8888942788" ></script>
						<?php } elseif(has_tag('estancia')) { ?> 
						<script type="text/javascript" src="//www.navistechnologies.info/JavascriptPhoneNumber/js.aspx?account=15170&jspass=ddxwjw8jcnv63tabqx22&dflt=8445918930" ></script>
						<?php } elseif(has_tag('koakea')) { ?> 
						<script type="text/javascript" src="//www.navistechnologies.info/JavascriptPhoneNumber/js.aspx?account=15170&jspass=ddxwjw8jcnv63tabqx22&dflt=8888988958" ></script>
						<?php } elseif(has_tag('meritage')) { ?>
						<script type="text/javascript"  src="//www.navistechnologies.info/JavascriptPhoneNumber/js.aspx?account=15170&jspass=ddxwjw8jcnv63tabqx22&dflt=8553181768" ></script>
						<?php } else { ?>
						<script language="javascript" src="http://www.navistechnologies.info/JavascriptPhoneNumber/js.aspx?account=15170&jspass=ddxwjw8jcnv63tabqx22&dflt=8888880558"></script>
						<? } ?>
						<script type="text/javascript">ProcessNavisNCKeyword();</script>

					</div>

					<p class="source-org copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>.</p>

				</div>

			</footer>

		</div>

		<?php // all js scripts are loaded in library/bones.php ?>
		<?php wp_footer(); ?>

	</body>

</html> <!-- end of site. what a ride! -->