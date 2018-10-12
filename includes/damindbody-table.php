<?php
/**
 * Plugin Name: DefineAwesome MindBody
 *
 * @since 1.2.0
 */
defined( 'ABSPATH' ) || exit; // Prevent Direct Access

// Hook for adding this shortcode
add_shortcode( 'awe1', 'showData' );

//Display page elements (currently filled with dummy data to be replaced by date retrieved from Mindbody Public API.
function page() {
	echo "

<div class='container tab-template-masonry'>
	<div class='row reveal grid reveal_visible' style='position:relative; height: 765px'>


		<div class='col-md-6 col-sm-12 col-xs-12 grid-item block-type-text cts-default-font cts-font-weight-normal 
		cts-content-default-font block-field-job_description' style='position: absolute; left: 0px; top: 0px'>
			<div class='element content-block wp-editor-content'>
				<div class='pf-head'>
					<div class=\"title-style-1 title-style-1\"><i class=\"mi view_headline\"></i> <h5>Description</h5></div>
				</div>
				<div class=\"pf-body\"><p></p><p>Balance brings us closer to ease. Ease brings us closer to freedom, freedom of heart 
and of mind. Wallis invites you to relish in a 2-hour Yin Yang immersion. Expect to find balance by feeling into both 
the moments of intensity and the moments of softness, with the same level commitment and appreciation, with the same 
open heart.</p> <p></p>
				</div>				
			</div>
		</div>

	
		<div class='col-md-6 col-sm-12 col-xs-12 gridposition: absolute; left: 585px; top: 0px;-item block-type-related_listing
		 cts-default-font cts-font-weight-normal cts-content-default-font' 
			 style='position: absolute; left: 585px; top: 0px;'>
			<div class=\"element related-listing-block\">
				<div class='pf-head'>
					<div class=\"title-style-1 title-style-1\"><i class=\"mi layers\"></i> <h5>Hosted By</h5></div>
				</div>
				<div class=\"pf-body\">
					<div class=\"event-host\">
						<a href=\"https://theyogabrief.com/listing/good-vibes-yoga/\">
						<div class=\"avatar\">
							<img src=\"https://theyogabrief.com/wp-content/uploads/2017/12/GoodvibesLogo-150x150.png\">
						</div>
						<span class=\"host-name\">Good Vibes Yoga (Northcote)</span></a>
					</div>
				</div>			
			</div>
		</div>	
		
		<div class=\"col-md-6 col-sm-12 col-xs-12 grid-item block-type-table cts-default-font cts-font-weight-normal c
		ts-content-default-font\" style=\"position: absolute; left: 585px; top: 132px;\">
			<div class=\"element table-block\">
				<div class='pf-head'>
					<div class=\"title-style-1 title-style-1\"><i class=\"mi view-module\"></i> <h5>Event Brief</h5></div>
				</div>
				<div class=\"pf-body\">
					<ul class=\"extra-details\">
						<li>
							<div class=\"item-attr\">Date</div>
							<div class=\"item-property\">Saturday, 28 April	</div>
						</li>
						<li>
							<div class=\"item-attr\">Time</div>
							<div class=\"item-property\">6pm - 8pm</div>
						</li>
						<li>
							<div class=\"item-attr\">Venue</div>
							<div class=\"item-property\">Good Vibes Yoga</div>
						</li>		
						<li>
							<div class=\"item-attr\">Address</div>
							<div class=\"item-property\">116 High Street, Northcote VIC, Australia</div>
						</li>
						<li>
							<div class=\"item-attr\">Instructor</div>
							<div class=\"item-property\">Wallis Murphy</div>
						</li>				
					</ul>
				</div>			
			</div>
		</div>			

		<div class=\"col-md-6 col-sm-12 col-xs-12 grid-item block-type-countdown cts-default-font cts-font-weight-normal
		 cts-content-default-font block-field-job_date\" style=\"position: absolute; left: 0px; top: 218px;\">
			<div class=\"element countdown-box countdown-block\">
				<div class='pf-head'>
					<div class=\"title-style-1 title-style-1\"><i class=\"av_timer\"></i> <h5>Event starts in</h5></div>
				</div>
				<div class=\"pf-body\">
					<ul class=\"countdown-list\">
						<li><p>00</p><span>Days</span></li>
						<li><p>00</p><span>Hours</span></li>
						<li><p>00</p><span>Minutes</span></li>
					</ul>
				</div>			
			</div>
		</div>

		<div class=\"col-md-6 col-sm-12 col-xs-12 grid-item block-type-location cts-default-font cts-font-weight-normal 
		cts-content-default-font block-field-job_location\" id=\"section__5bc07091bf184\" style=\"position: absolute; 
		left: 0px; top: 398px;\">
			<div class=\"element map-block\">
				<div class='pf-head'>
					<div class=\"title-style-1 title-style-1\"><i class=\"mi map\"></i> <h5>Location Block</h5></div>
					<div class=\"location-address\">
						<a href=\"http://maps.google.com/maps?daddr=-37.779367%2C144.997187\" target=\"_blank\">Get Directions</a>
					</div>
				</div>				
				<div class=\"pf-body contact-map\">

				</div>	
			</div>
		</div>		
		
	</div>
</div>";
}






function getMockData( $url ) {
	$response = wp_remote_get( $url )['body'];
	$result   = json_decode( $response, true );

	return $result['items']['0'];
}

function printData( $table, $data ) {
	$table .= "<div id='datatable_container'><h2>Retrieved Data</h2><table>";
	$table .= "<tr><th>Key</th><th>Value</th></tr>";
	foreach ( $data as $key => $value ) {
		$table .= "<tr>";
		$table .= "<td>" . htmlentities( $key ) . "</td>";
		if ( is_string( $value ) || is_integer( $value ) || is_float( $value ) ) {
			$table .= "<td>" . htmlentities( $value ) . "</td>";
		} else {
			$table .= "<td>Data (probably an array)</td>";
		}
		$table .= "</tr>";
	}
	$table .= "</table></div>";

	return $table;
}

function showData() {
	page();
	$table = "<div><h1>Table</h1>";
	$url   = "https://mb-mock-1.herokuapp.com/class";
	$data  = getMockData( $url );
	$table = printData( $table, $data );
	$table .= "</div>";

	return $table;
}

?>