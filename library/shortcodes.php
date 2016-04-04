<?php 
	function get_image_grid( $attr ) {
		$options = get_option('dc_phgmgmtconsole');
		if(has_tag('bacara')) {
			$options['image1'] = '/wp-content/uploads/2016/03/bacara-patio-residence.png'; 
			$options['image2'] = '/wp-content/uploads/2016/03/bacara-health-wellness.png'; 
			$options['image3'] = '/wp-content/uploads/2016/03/bacara-foley-wine-tasting-room.png'; 
			$options['image4'] = '/wp-content/uploads/2016/03/bacara-culinary.png'; 
			$options['image5'] = '/wp-content/uploads/2016/03/bacara-mission.png'; 
		} elseif(has_tag('balboa')) {
			$options['image1'] = '/wp-content/uploads/2016/03/BALBOA-OUTDOORS.png'; 
			$options['image2'] = '/wp-content/uploads/2016/03/BALBOA-WELLNESS.png'; 
			$options['image3'] = '/wp-content/uploads/2016/03/BALBOA-ARTSCULTURE.png'; 
			$options['image4'] = '/wp-content/uploads/2016/03/BALBOA-CULINARY.png'; 
			$options['image5'] = '/wp-content/uploads/2016/03/BALBOA-SPIRITUALITY.png';
		} elseif(has_tag('estancia')) {
			$options['image1'] = '/wp-content/uploads/2016/03/ESTANCIA-OUTDOORS.png'; 
			$options['image2'] = '/wp-content/uploads/2016/03/ESTANCIA-WELLNESS.png'; 
			$options['image3'] = '/wp-content/uploads/2016/03/ESTANCIA-ARTSCULTURE.png'; 
			$options['image4'] = '/wp-content/uploads/2016/03/ESTANCIA-CULINARY.png'; 
			$options['image5'] = '/wp-content/uploads/2016/03/ESTANCIA-SPIRITUALITY.png';
		} elseif(has_tag('koakea')) {
			$options['image1'] = '/wp-content/uploads/2016/03/KOAKEA-OUTDOORS.png'; 
			$options['image2'] = '/wp-content/uploads/2016/03/KOAKEA-WELLNESS.png'; 
			$options['image3'] = '/wp-content/uploads/2016/03/KOAKEA-ARTSCULTURE.png'; 
			$options['image4'] = '/wp-content/uploads/2016/03/KOAKEA-CULINARY.png'; 
			$options['image5'] = '/wp-content/uploads/2016/03/KOAKEA-SPIRITUALITY.png';
		} elseif(has_tag('meritage')) {
			$options['image1'] = '/wp-content/uploads/2016/03/stay-golden-cocktail.jpg'; 
			$options['image2'] = '/wp-content/uploads/2016/03/health-wellness.jpg';
			$options['image3'] = '/wp-content/uploads/2016/03/arts-culture.jpg'; 
			$options['image4'] = '/wp-content/uploads/2016/03/culinary-wine-joseph-phelps.jpg'; 
			$options['image5'] = '/wp-content/uploads/2016/03/spirituality.jpg'; 
		} elseif(has_tag('pasea')) {
			$options['image1'] = '/wp-content/uploads/2016/03/PASEA-OUTDOORS.png'; 
			$options['image2'] = '/wp-content/uploads/2016/03/PASEA-WELLNESS.png'; 
			$options['image3'] = '/wp-content/uploads/2016/03/PASEA-ARTSCULTURE.png'; 
			$options['image4'] = '/wp-content/uploads/2016/03/PASEA-CULINARY.png'; 
			$options['image5'] = '/wp-content/uploads/2016/03/PASEA-SPIRITUALITY.png';
		} else {
			$options['image1'] = '/wp-content/uploads/2016/03/MC-HOME_OUTDOORS.jpg';
			$options['image2'] = '/wp-content/uploads/2016/03/MC-HOME-WELLNESS.jpg'; 
			$options['image3'] = '/wp-content/uploads/2016/03/MC-HOME-ARTSCULTURE.jpg'; 
			$options['image4'] = '/wp-content/uploads/2016/03/MC-HOME-CULINARY.jpg'; 
			$options['image5'] = '/wp-content/uploads/2016/03/MC-HOME-SPIRITUALITY.jpg'; 
		}

		$options['header1'] = 'Outdoor Experiences'; 
		$options['header2'] = 'Health & Wellness'; 
		$options['header3'] = 'Arts & Culture'; 
		$options['header4'] = 'Culinary & Wine'; 
		$options['header5'] = 'Spirituality'; 

		/***** Custom Headers *****/
		if(has_tag('bacara')) {
			$options['header1'] = 'Outdoor Experiences'; 
			$options['header2'] = 'Health & Wellness'; 
			$options['header3'] = 'Arts & Culture'; 
			$options['header4'] = 'Culinary & Wine'; 
			$options['header5'] = 'Spirituality'; 
		} elseif (has_tag('balboa')) {
			$options['header1'] = 'Outdoor Experiences'; 
			$options['header2'] = 'Health & Wellness'; 
			$options['header3'] = 'Arts & Culture'; 
			$options['header4'] = 'Culinary & Wine'; 
			$options['header5'] = 'Spirituality'; 
		} elseif (has_tag('estancia')) {
			$options['header1'] = 'Outdoor Experiences'; 
			$options['header2'] = 'Health & Wellness'; 
			$options['header3'] = 'Arts & Culture'; 
			$options['header4'] = 'Culinary & Wine'; 
			$options['header5'] = 'Spirituality'; 
		} elseif (has_tag('koakea')) {
			$options['header1'] = 'Outdoor Experiences'; 
			$options['header2'] = 'Health & Wellness'; 
			$options['header3'] = 'Arts & Culture'; 
			$options['header4'] = 'Culinary & Wine'; 
			$options['header5'] = 'Spirituality'; 
		} elseif (has_tag('meritage')) {
			$options['header1'] = 'Outdoor Experiences'; 
			$options['header2'] = 'Health & Wellness'; 
			$options['header3'] = 'Arts & Culture'; 
			$options['header4'] = 'Culinary & Wine'; 
			$options['header5'] = 'Spirituality'; 
		} elseif (has_tag('pasea')) {
			$options['header1'] = 'Outdoor Experiences'; 
			$options['header2'] = 'Health & Wellness'; 
			$options['header3'] = 'Arts & Culture'; 
			$options['header4'] = 'Culinary & Wine'; 
			$options['header5'] = 'Spirituality'; 
		}

		extract(shortcode_atts(array(
			'id' => ''
			), $attr)); 
		$img_array = array('image2', 'image3', 'image4', 'image5'); 
		$header_array = array('header2', 'header3', 'header4', 'header5'); 
		shuffle($img_array); 
		shuffle($header_array); 

		$links['arts-culture']['bacara'] = 'http://meritagecollection.com/bacararesort/best-santa-barbara-dining/'; 
		$links['arts-culture']['balboa'] = '/balboabayresort/southern-california-getaways/';
		$links['arts-culture']['estancia'] = '/estancialajolla/hotel/la-jolla-vacation-activities/'; 
		$links['arts-culture']['koakea'] = '/koakea/hotel-overview/island-activities/'; 
		$links['arts-culture']['meritage'] = 'http://live-meritagecollectionevents.time.ly/event/napa-valley-arts-in-april/?instance_id=1119';
		$links['arts-culture']['pasea'] = '/paseahotel/huntington-beach-luxury-hotels/oceanfront-activities/'; 

		$links['culinary-wine']['bacara'] = '/bacararesort/best-santa-barbara-dining/santa-barbara-food-wine-weekend-3/';
		$links['culinary-wine']['balboa'] = '/balboabayresort/newport-beach-ca-restaurants/';
		$links['culinary-wine']['estancia'] = '/estancialajolla/san-diego-outdoor-dining/';
		$links['culinary-wine']['koakea'] = '/koakea/dining-at-red-salt/'; 
		$links['culinary-wine']['meritage'] = '/meritageresort/luxury-napa-valley-hotel/upcoming-resort-events/#event|masters-winemaker-dinner-with-joseph-phelps-vineyards|1303'; 
		$links['culinary-wine']['pasea'] = '/paseahotel/best-huntington-beach-restaurants/'; 

		$links['outdoor-experiences']['bacara'] = 'http://meritagecollection.com/bacararesort/santa-barbara-vacation-packages/#third'; 
		$links['outdoor-experiences']['balboa'] = '/balboabayresort/newport-beach-ca-hotels/'; 
		$links['outdoor-experiences']['estancia'] = '/estancialajolla/san-diego-hotel-deals/hotel-deals-san-diego/';
		$links['outdoor-experiences']['koakea'] = '/koakea/hotel-overview/island-activities/'; 
		$links['outdoor-experiences']['meritage'] = '/meritageresort/wine-county-vacation-packages/'; 
		$links['outdoor-experiences']['pasea'] = '/paseahotel/huntington-beach-luxury-hotels/'; 

		$links['spirituality']['bacara'] = 'http://meritagecollection.com/bacararesort/santa-barbara-luxury-hotels/santa-barbara-vacations/'; 
		$links['spirituality']['balboa'] = '/balboabayresort/newport-beach-ca-spa/luxury-resort-spas/';
		$links['spirituality']['estancia'] = '/estancialajolla/san-diego-hotel-spa/'; 
		$links['spirituality']['koakea'] = '/koakea/spa-experience/';
		$links['spirituality']['meritage'] = '/meritageresort/luxury-napa-valley-hotel/upcoming-resort-events/#event|mothers-day-brunch-2|1327'; 
		$links['spirituality']['pasea'] = '/paseahotel/huntington-beach-spa-resort/'; 

		$links['health-wellness']['bacara'] = 'http://meritagecollection.com/bacararesort/santa-barbara-spa-resort/luxury-treatments/';
		$links['health-wellness']['balboa'] = '/balboabayresort/newport-beach-ca-spa/';
		$links['health-wellness']['estancia'] = '/estancialajolla/san-diego-hotel-spa/fitness-spa-resort/'; 
		$links['health-wellness']['koakea'] = '/koakea/spa-experience/'; 
		$links['health-wellness']['meritage'] = '/meritageresort/napa-valley-spa-resorts/'; 
		$links['health-wellness']['pasea'] = '/paseahotel/huntington-beach-spa-resort/'; 

		$first_header = 'header1'; 
		$widget_html = "<div class='fp-table'><div class='column c1'><a href='".$links[get_header_page($options[$first_header])][get_href()]."' class='highlight-1 image1' style='background:url(\"".$options['image1']."\") no-repeat; background-size: cover;'><div class='text'><h1>".$options[$first_header]."</h1><span class='subheader'>Add copy here.</span></div></a></div>"; 

		$second_header = array_pop($header_array); 
		$third_header = array_pop($header_array); 
		$second_index = substr($second_header, -1, 1);
		$third_index = substr($third_header, -1, 1);

		$widget_html .= "<div class='column c2'><div class='row r1'><a href='".$links[get_header_page($options[$second_header])][get_href()]."' class='sub-highlight image2 ".$second_index."' style='background:url(\"".$options['image'.$second_index]."\") no-repeat; background-size: cover;'><div class='text'><h1>".$options[$second_header]."</h1></div></a><a href='".$links[get_header_page($options[$third_header])][get_href()]."' class='sub-highlight image3 ".$third_index."' style='background:url(\"".$options['image'.$third_index]."\") no-repeat; background-size: cover;'><div class='text'><h1>".$options[$third_header]."</h1></div></a></div>";

		$fourth_header = array_pop($header_array); 
		$fifth_header = array_pop($header_array); 
		$fourth_index = substr($fourth_header, -1, 1);
		$fifth_index = substr($fifth_header, -1, 1);

		$widget_html .= "<div class='row r2'><a href='".$links[get_header_page($options[$fourth_header])][get_href()]."' class='sub-highlight image4' style='background:url(\"".$options['image'.$fourth_index]."\") no-repeat; background-size: cover;'><div class='text'><h1>".$options[$fourth_header]."</h1></div></a><a href='".$links[get_header_page($options[$fifth_header])][get_href()]."' class='sub-highlight image5' style='background:url(\"".$options['image'.$fifth_index]."\") no-repeat; background-size: cover;'><div class='text'><h1>".$options[$fifth_header]."</h1></div></a></div></div>";
	    $widget_html .= "<div class='clearfix'></div></div>";
	  return $widget_html; 
	}

	function get_header_page($str) {
		$rtn_str = str_replace(' ', '-', str_replace(' / ', '-', str_replace(' & ', '-', $str)));
		return strtolower($rtn_str);
	}
	function get_href() {
		if(has_tag('bacara')) {
			return 'bacara'; 
		}
		elseif (has_tag('balboa')) {
			return 'balboa'; 
		}
		elseif (has_tag('estancia')) {
			return 'estancia'; 
		}
		elseif(has_tag('koakea')) {
			return 'koakea'; 
		}
		elseif(has_tag('meritage')) {
			return 'meritage'; 
		}
		elseif(has_tag('pasea')) {
			return 'pasea'; 
		}
		else {
			$hotels = array('bacara', 'balboa', 'estancia', 'koakea', 'meritage', 'pasea'); 
			$hotel_ind = array_rand($hotels); 
			return $hotels[$hotel_ind];
		}
	}

	function phg_location_func( $attr, $content = "" ) {
		if ( $content != '' ) :
        	$location_html = '<div class="location-card">';
        	if (strtolower($content) == "poipu beach, hi") {
				date_default_timezone_set('Pacific/Honolulu');
			} else {
				date_default_timezone_set('America/Los_Angeles');
			}
        	$jsonurl = "http://api.openweathermap.org/data/2.5/weather?q=" . urlencode($content) . '&APPID=ee2337a86981da09d339cc66337fcb7e';
        	$json = file_get_contents($jsonurl);
        	$weather = json_decode($json);
        	$kelvin = $weather->main->temp;
        	$celcius = $kelvin - 273.15;
        	$fahrenheit = $celcius * 9/5 + 32; 
        	
        	$location_html .= '<span class="temperature-display">' . round($fahrenheit);
        	$location_html .= '&degF</span><span class="time-display">' . date('g:i a'); 
        	$location_html .= '</span></div>'; 
      endif;

	  return (empty($location_html) ? "" : $location_html); 
	}

	function phg_destination_links_func( $attr, $content = "" ) {
		if ( $content != '' ) :
			$hotel = trim(htmlspecialchars($content)); 

			$dest_links = array(); 
			$dest_links['bacara']['meetings'] = '/bacararesort/southern-california-conference-resort/'; 
			$dest_links['balboa']['meetings'] = '/balboabayresort/conference-resort/'; 
			$dest_links['estancia']['meetings'] = '/estancialajolla/san-diego-meeting-and-conference-resorts/'; 
			$dest_links['meritage']['meetings'] = '/meritageresort/california-conference-resort/'; 
			$dest_links['pasea']['meetings'] = '/paseahotel/memorable-meetings-and-events/'; 

			$dest_links['bacara']['wedding'] = '/bacararesort/santa-barbara-weddings/'; 
			$dest_links['balboa']['wedding'] = '/balboabayresort/newport-beach-ca-wedding/';
			$dest_links['estancia']['wedding'] = '/estancialajolla/san-diego-weddings/';
			$dest_links['meritage']['wedding'] = '/meritageresort/napa-valley-weddings/';
			$dest_links['pasea']['wedding'] = '/paseahotel/huntington-beach-weddings/';

			$dest_links['bacara']['dining'] = '/bacararesort/best-santa-barbara-dining/';
			$dest_links['balboa']['dining'] = '/balboabayresort/newport-beach-ca-restaurants/';
			$dest_links['estancia']['dining'] = '/estancialajolla/san-diego-outdoor-dining/';
			$dest_links['koakea']['dining'] = '/koakea/dining-at-red-salt/';
			$dest_links['meritage']['dining'] = '/meritageresort/napa-valley-restaurants/';
			$dest_links['pasea']['dining'] = '/paseahotel/best-huntington-beach-restaurants/';

			$dest_links['bacara']['special-offers'] = '/bacararesort/santa-barbara-vacation-packages/';
			$dest_links['balboa']['special-offers'] = '/balboabayresort/southern-california-getaways/';
			$dest_links['estancia']['special-offers'] = '/estancialajolla/san-diego-hotel-deals/';
			$dest_links['koakea']['special-offers'] = '/koakea/packages/';
			$dest_links['meritage']['special-offers'] = '/meritageresort/wine-county-vacation-packages/';
			$dest_links['pasea']['special-offers'] = '/paseahotel/specials/';

			$dest_widget = "<div class='destination-menu'><h3>I am looking for:</h3><ul>";
			if(isset($dest_links[$hotel]['meetings'])) { $dest_widget .= "<li><a href='".$dest_links[$hotel]['meetings']."'>Meeting or Event Spaces</a></li>"; }
			if(isset($dest_links[$hotel]['wedding'])) { $dest_widget .= "<li><a href='".$dest_links[$hotel]['wedding']."'>Wedding Venues</a></li>"; }
			if(isset($dest_links[$hotel]['dining'])) { $dest_widget .= "<li><a href='".$dest_links[$hotel]['dining']."'>Restaurants + Bars</a></li>"; }
			if(isset($dest_links[$hotel]['special-offers'])) { $dest_widget .= "<li><a href='".$dest_links[$hotel]['special-offers']."'>Special Offers</a></li>"; }
			$dest_widget .= "</ul></div>";
		endif;

		return (empty($dest_widget) ? "" : $dest_widget); 
	}

	add_shortcode('phg_image_grid', 'get_image_grid');
	add_shortcode('phg_location_widget', 'phg_location_func'); 
	add_shortcode('phg_destination_links', 'phg_destination_links_func'); 