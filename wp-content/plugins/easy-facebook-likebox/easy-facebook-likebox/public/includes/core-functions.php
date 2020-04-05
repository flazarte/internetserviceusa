<?php

if(!function_exists('efbl_time_ago')){ 
	function efbl_time_ago($date,$granularity=2) {
		//Preparing strings to translate
		$date_time_strings = array("second" => __('second', 'easy-facebook-likebox'), 
								   "seconds" =>  __('seconds', 'easy-facebook-likebox'), 
								   "minute" => __('minute', 'easy-facebook-likebox'), 
								   "minutes" => __('minutes', 'easy-facebook-likebox'), 
								   "hour" => __('hour', 'easy-facebook-likebox'), 
								   "hours" => __('hours', 'easy-facebook-likebox'), 
								   "day" => __('day', 'easy-facebook-likebox'), 
								   "days" => __('days', 'easy-facebook-likebox'),
								   "week" => __('week', 'easy-facebook-likebox'),
								   "weeks" => __('weeks', 'easy-facebook-likebox'), 
								   "month"  => __('month', 'easy-facebook-likebox'), 
								   "months"  => __('months', 'easy-facebook-likebox'), 
								   "year" => __('year', 'easy-facebook-likebox'),  
								   "years" => __('years', 'easy-facebook-likebox'),
								   "decade" => __('decade', 'easy-facebook-likebox'),
								   );
		
		$ago_text = __('ago', 'easy-facebook-likebox');
		$date = strtotime($date);
		$difference = time() - $date;
		$periods = array('decade' => 315360000,
			'year' => 31536000,
			'month' => 2628000,
			'week' => 604800, 
			'day' => 86400,
			'hour' => 3600,
			'minute' => 60,
			'second' => 1);
	
		foreach ($periods as $key => $value) {
			if ($difference >= $value) {
				$time = floor($difference/$value);
				$difference %= $value;
				$retval .= ($retval ? ' ' : '').$time.' ';
				$retval .= (($time > 1) ? $date_time_strings[$key.'s'] : $date_time_strings[$key] );
				$granularity--;
			}
			if ($granularity == '0') { break; }
		}
		 
		return ''.$retval.' '.$ago_text;      
	}
}

if(!function_exists('jws_fetchUrl')){
//Get JSON object of feed data
	function jws_fetchUrl($url){

		$args = array(
	    'timeout'     => 150,
	    'sslverify' => false
	); 
	$feedData = wp_remote_get($url,$args);
		
		// echo '<pre>'; print_r($feedData);exit;

	if(!is_wp_error($feedData)){
		return $feedData['body'];
	} else{
		return $feedData;
	}
}
}
if(!function_exists('ecff_stripos_arr')){
	function ecff_stripos_arr($haystack, $needle) {
		 
		if(!is_array($needle)) $needle = array($needle);
		foreach($needle as $what) {
			if(($pos = stripos($haystack, ltrim($what) ))!==false) return $pos;
		}
		return false;
	}
}

// if(!function_exists('ecff_makeClickableLinks')){
// 	function ecff_makeClickableLinks($text)
// 	{
// 		return preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank">$1</a>', $text);
		
// 	}
// }

if(!function_exists('ecff_hastags_to_link')){
	function ecff_hastags_to_link($text){
		
		return preg_replace('/(^|\s)#(\w*[a-zA-Z_]+\w*)/', '\1#<a href="https://www.facebook.com/hashtag/\2" class="eflb-hash" target="_blank">\2</a>', $text);
	}
}

if(!function_exists('efbl_parse_url')){
	function efbl_parse_url($url){
		$fb_url = parse_url( $url );
		$fanpage_url = str_replace('/', '', $fb_url['path']);

		return $fanpage_url;

	}
}

if(!function_exists('efbl_get_locales')){
	/**
	 * Compile and filter the list of locales.
	 *
	 *
	 * @return return the list of locales.
	 */
	function efbl_get_locales(){

				$locales = array(  'af_ZA' => 'Afrikaans', 
						   'ar_AR' => 'Arabic', 
						   'az_AZ' => 'Azeri', 
						   'be_BY' => 'Belarusian', 
						   'bg_BG' => 'Bulgarian', 
						   'bn_IN' => 'Bengali', 
						   'bs_BA' => 'Bosnian', 
						   'ca_ES' => 'Catalan', 
						   'cs_CZ' => 'Czech', 
						   'cy_GB' => 'Welsh', 
						   'da_DK' => 'Danish', 
						   'de_DE' => 'German', 
						   'el_GR' => 'Greek', 
						   'en_US' => 'English (US)', 
						   'en_GB' => 'English (UK)', 
						   'eo_EO' => 'Esperanto', 
						   'es_ES' => 'Spanish (Spain)', 
						   'es_LA' => 'Spanish', 
						   'et_EE' => 'Estonian', 
						   'eu_ES' => 'Basque', 
						   'fa_IR' => 'Persian', 
						   'fb_LT' => 'Leet Speak', 
						   'fi_FI' => 'Finnish', 
						   'fo_FO' => 'Faroese', 
						   'fr_FR' => 'French (France)', 
						   'fr_CA' => 'French (Canada)', 
						   'fy_NL' => 'NETHERLANDS (NL)', 
						   'ga_IE' => 'Irish', 
						   'gl_ES' => 'Galician', 
 						   'hi_IN' => 'Hindi', 
						   'hr_HR' => 'Croatian', 
						   'hu_HU' => 'Hungarian', 
						   'hy_AM' => 'Armenian', 
						   'id_ID' => 'Indonesian', 
						   'is_IS' => 'Icelandic', 
						   'it_IT' => 'Italian', 
						   'ja_JP' => 'Japanese', 
						   'ka_GE' => 'Georgian', 
						   'km_KH' => 'Khmer', 
						   'ko_KR' => 'Korean', 
						   'ku_TR' => 'Kurdish', 
						   'la_VA' => 'Latin', 
						   'lt_LT' => 'Lithuanian', 
						   'lv_LV' => 'Latvian', 
						   'mk_MK' => 'Macedonian', 
						   'ml_IN' => 'Malayalam', 
						   'ms_MY' => 'Malay', 
						   'nb_NO' => 'Norwegian (bokmal)', 
						   'ne_NP' => 'Nepali', 
						   'nl_NL' => 'Dutch', 
						   'nn_NO' => 'Norwegian (nynorsk)', 
						   'pa_IN' => 'Punjabi', 
						   'pl_PL' => 'Polish', 
						   'ps_AF' => 'Pashto', 
						   'pt_PT' => 'Portuguese (Portugal)', 
						   'pt_BR' => 'Portuguese (Brazil)', 
						   'ro_RO' => 'Romanian', 
						   'ru_RU' => 'Russian', 
						   'sk_SK' => 'Slovak', 
						   'sl_SI' => 'Slovenian', 
						   'sq_AL' => 'Albanian', 
						   'sr_RS' => 'Serbian', 
						   'sv_SE' => 'Swedish', 
						   'sw_KE' => 'Swahili', 
						   'ta_IN' => 'Tamil', 
						   'te_IN' => 'Telugu', 
						   'th_TH' => 'Thai', 
						   'tl_PH' => 'Filipino', 
						   'tr_TR' => 'Turkish', 
						   'uk_UA' => 'Ukrainian',
						   'ur_PK' => 'Urdu',
 						   'vi_VN' => 'Vietnamese', 
						   'zh_CN' => 'Simplified Chinese (China)', 
						   'zh_HK' => 'Traditional Chinese (Hong Kong)', 
						   'zh_TW' => 'Traditional Chinese (Taiwan)',
						   );
			
			return apply_filters( 
				'efbl_locale_names',
				$locales
			);	
	}
}
if( !function_exists( 'get_css3_animations' ) ){	
	function get_css3_animations(){

		$css3_effects = array(
							'Static' => array(
									'No Effect',
							),
							'Attention Seekers' => array(
									'bounce',
									'flash',
									'pulse',
									'rubberBand',
									'shake',
									'swing',
							),

							'Bouncing Entrances' => array(
									'bounceIn',
									'bounceInDown',
									'bounceInLeft',
									'bounceInRight',
									'bounceInUp',
							),

							'Fading Entrances' => array(
									'fadeIn',
									'fadeInDown',
									'fadeInDownBig',
									'fadeInLeft',
									'fadeInLeftBig',
									'fadeInRight',
									'fadeInRightBig',
									'fadeInUp',
									'fadeInUpBig',
							),

							'Flippers' => array(
									'flip',
									'flipInX',
									'flipInY',
									'flipOutX',
									'flipOutY',						
							),

							'Rotating Entrances' => array(
									'rotateIn',
									'rotateInDownLeft',
									'rotateInDownRight',
									'rotateInUpLeft',
									'rotateInUpRight',
							),

							'Sliding Entrances' => array(
									'slideInUp',
									'slideInDown',
									'slideInLeft',
									'rotateInUpLeft',
									'slideInRight',
							),

							'Zoom Entrances' => array(
									'zoomIn',
									'zoomInDown',
									'zoomInLeft',
									'zoomInRight',
									'zoomInUp',
							),

							'Specials' => array(
									'hinge',
									'rollIn',
									'rollOut',
							),
				);

		return apply_filters( 
				'efbl_css3_effects',
				$css3_effects
			);

	}
}
if( !function_exists( 'efbl_check_reaction' ) ){
function efbl_check_reaction($needle,$array){
   
   $efbl_reaction_count = null;
   $efbl_reaction_array = array();	
   foreach($array as $efbl_reaction):
   	$efbl_reaction = (array) $efbl_reaction;
   	 if( $needle == $efbl_reaction['type']):  $efbl_reaction_count++; $efbl_reaction_array['data'][] = $efbl_reaction; endif;
   endforeach;
   if(!empty($efbl_reaction_array)) $efbl_reaction_array['total_count'] = $efbl_reaction_count;

   return $efbl_reaction_array;
}
}
if( !function_exists( 'efbl_get_page_bio' ) ){
function efbl_get_page_bio($id, $access_token, $cache_seconds){
   
   /*
    * Making slug for bio cache.
    */
    $efbl_bio_slug = "efbl_page_bio-{$id}";
       
    /*
    * Getting bio cached.
    */
    $efbl_bio_data = get_transient( $efbl_bio_slug );

    /*
    * Remote URL of the authenticated user of instagram API with access token
    */
        
    if ( !$efbl_bio_data || '' == $efbl_bio_data ) :

	   /*
	    * All accounts API endpoint
	    */  
	    $efbl_bio_url =  "https://graph.facebook.com/{$id}?fields=access_token,username,id,name,fan_count,category,about&access_token=".$access_token;


	    /*
	     * Getting all accounts
	    */
	    $efbl_bio_data_api = wp_remote_get($efbl_bio_url);
	    /*
	     * Descoding the array
	    */
	     $efbl_bio_data = json_decode($efbl_bio_data_api['body']);

	    if ( 200 == $efbl_bio_data_api['response']['code'] && !empty($efbl_bio_data) ):
                set_transient( $efbl_bio_slug, $efbl_bio_data, $cache_seconds );
        endif;

	endif;
	return $efbl_bio_data;
}
}
if( !function_exists( 'efbl_readable_count' ) ){
function efbl_readable_count($input){
    $input = number_format($input);
    $input_count = substr_count($input, ',');
    if($input_count != '0'){
        if($input_count == '1'){
            return substr($input, 0, -4).'K';
        } else if($input_count == '2'){
            return substr($input, 0, -8).'M';
        } else if($input_count == '3'){
            return substr($input, 0,  -12).'B';
        } else {
            return;
        }
    } else {
        return $input;
    }
}
}
if(!function_exists('ecff_makeClickableLinks')){
function ecff_makeClickableLinks($value, $protocols = array('http', 'mail', 'https'), array $attributes = array())
    {
        // Link attributes
        $attr = '';
        foreach ($attributes as $key => $val) {
            $attr .= ' ' . $key . '="' . htmlentities($val) . '"';
        }
        
        $links = array();
        
        // Extract existing links and tags
        $value = preg_replace_callback('~(<a .*?>.*?</a>|<.*?>)~i', function ($match) use (&$links) { return '<' . array_push($links, $match[1]) . '>'; }, $value);
        
        // Extract text links for each protocol
        foreach ((array)$protocols as $protocol) {
            switch ($protocol) {
                case 'http':
                case 'https':   $value = preg_replace_callback('~(?:(https?)://([^\s<]+)|(www\.[^\s<]+?\.[^\s<]+))(?<![\.,:])~i', function ($match) use ($protocol, &$links, $attr) { if ($match[1]) $protocol = $match[1]; $link = $match[2] ?: $match[3]; return '<' . array_push($links, "<a $attr href=\"$protocol://$link\">$link</a>") . '>'; }, $value); break;
                case 'mail':    $value = preg_replace_callback('~([^\s<]+?@[^\s<]+?\.[^\s<]+)(?<![\.,:])~', function ($match) use (&$links, $attr) { return '<' . array_push($links, "<a $attr href=\"mailto:{$match[1]}\">{$match[1]}</a>") . '>'; }, $value); break;
                case 'twitter': $value = preg_replace_callback('~(?<!\w)[@#](\w++)~', function ($match) use (&$links, $attr) { return '<' . array_push($links, "<a $attr href=\"https://twitter.com/" . ($match[0][0] == '@' ? '' : 'search/%23') . $match[1]  . "\">{$match[0]}</a>") . '>'; }, $value); break;
                default:        $value = preg_replace_callback('~' . preg_quote($protocol, '~') . '://([^\s<]+?)(?<![\.,:])~i', function ($match) use ($protocol, &$links, $attr) { return '<' . array_push($links, "<a $attr href=\"$protocol://{$match[1]}\">{$match[1]}</a>") . '>'; }, $value); break;
            }
        }
        
        // Insert all link
        return preg_replace_callback('/<(\d+)>/', function ($match) use (&$links) { return $links[$match[1] - 1]; }, $value);
    }
}    