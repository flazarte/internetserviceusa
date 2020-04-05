<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );
/**
 * Description of SchemaThing
 *
 * @author mark
 */
class HunchSchema_Thing {

	/**
	 * Schema.org Array
	 * 
	 * @var type 
	 */
	protected $schema;
	protected $SchemaBreadcrumb;
	protected $Settings;

	/**
	 * Construuctor
	 */
	public function __construct() {
		$this->Settings = get_option( 'schema_option_name' );
	}


	public static function factory( $post_type ) {
		if ( is_search() ) {
			$post_type = 'Search';
		} elseif ( is_author() ) {
			$post_type = 'Author';
		} elseif ( is_category() ) {
			$post_type = 'Category';
		} elseif ( is_tag() ) {
			$post_type = 'Tag';
		} elseif ( ! is_front_page() && is_home() || is_home() ) {
			$post_type = 'Blog';
		}

		$post_type = apply_filters( 'hunch_schema_thing_post_type', $post_type );
		$class_name = 'HunchSchema_' . $post_type;

		if ( class_exists( $class_name ) ) {
			return new $class_name;
		} else {
			return new HunchSchema_Thing;
		}
	}


	public function getResource( $pretty = false ) {
		// To override in child classes
	}

	public function getBreadcrumb( $pretty = false ) {
		return false;
	}


	public function getWebSite( $pretty = false ) {
		$this->SchemaWebSite['@context'] = 'http://schema.org';
		$this->SchemaWebSite['@type'] = 'WebSite';
		$this->SchemaWebSite['@id'] = home_url( '/#website' );
		$this->SchemaWebSite['name'] = get_bloginfo( 'name' );
		$this->SchemaWebSite['url'] = home_url();
		$this->SchemaWebSite['potentialAction'] = array (
			'@type' => 'SearchAction',
			'target' => home_url( '/?s={search_term_string}' ),
			'query-input' => 'required name=search_term_string',
		);

		return $this->toJson( $this->SchemaWebSite, $pretty );
	}


	public static function getPermalink() {
		$permalink = '';

		if ( is_author() ) {
			$permalink = get_author_posts_url( get_the_author_meta( 'ID' ) );
		} elseif ( is_category() ) {
			$permalink = get_category_link(get_query_var( 'cat' ) );
		} elseif ( is_singular() ) {
			$permalink = get_permalink();
		} elseif ( is_front_page() && is_home() || is_front_page() ) {
			$permalink = home_url();
		} elseif ( is_home() ) {
			$permalink = get_permalink( get_option( 'page_for_posts' ) );
		}

		return apply_filters( 'hunch_schema_thing_markup_permalink', $permalink );
	}


	protected function getExcerpt() {
		global $post;

		if ( post_password_required( $post ) ) {
			return apply_filters( 'hunch_schema_thing_markup_excerpt', 'This is a protected post.' );
		}

		if ( class_exists( 'WPSEO_Frontend' ) ) {
			$wpseo_frontend = WPSEO_Frontend::get_instance();
			$wpseo_meta_description = $wpseo_frontend->metadesc( false );

			if ( ! empty( $wpseo_meta_description ) ) {
				return apply_filters( 'hunch_schema_thing_markup_excerpt', $wpseo_meta_description );
			}
		}

		if ( ! empty( $post->post_excerpt ) ) {
			$post_excerpt = apply_filters( 'get_the_excerpt', $post->post_excerpt, $post );

			return apply_filters( 'hunch_schema_thing_markup_excerpt', $post_excerpt );
		}

		if ( ! empty( $post->post_content ) ) {
			$text = $post->post_content;
			$text = strip_shortcodes( $text );

			$text = apply_filters( 'the_content', $text );
			$text = str_replace( ']]>', ']]&gt;', $text );
			$text = wp_strip_all_tags( $text );

			$excerpt_length = apply_filters( 'excerpt_length', 55 );
			$excerpt_more = apply_filters( 'excerpt_more', ' ' . '[&hellip;]' );

			$text = wp_trim_words( $text, $excerpt_length, $excerpt_more );

			return apply_filters( 'hunch_schema_thing_markup_excerpt', $text );
		}
	}


	protected function getImage() {
		$image = array();

		if ( has_post_thumbnail() && wp_get_attachment_image_src( get_post_thumbnail_id() ) ) {
			$attachment_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );

			$image = array (
				'@type' => 'ImageObject',
				'@id' => $attachment_image[0],
				'url' => $attachment_image[0],
				'height' => $attachment_image[2],
				'width' => $attachment_image[1],
			);
		} else {
			global $post;

			if ( $post->post_content ) {
				$dom_document = new DOMDocument();
				@$dom_document->loadHTML( $post->post_content );
				$dom_document_images = $dom_document->getElementsByTagName( 'img' );

				if ( $dom_document_images->length ) {
					$image = array (
						'@type' => 'ImageObject',
						'@id' => $dom_document_images->item(0)->getAttribute( 'src' ),
						'url' => $dom_document_images->item(0)->getAttribute( 'src' ),
						'height' => $dom_document_images->item(0)->getAttribute( 'height' ),
						'width' => $dom_document_images->item(0)->getAttribute( 'width' ),
					);
				} else {
					$image = $this->getDefaultImage();
				}
			} else {
				$image = $this->getDefaultImage();
			}
		}

		return apply_filters( 'hunch_schema_thing_markup_image', $image );
	}


	protected function getDefaultImage() {
		if ( ! empty( $this->Settings['SchemaDefaultImage'] ) ) {
			global $wpdb;

			$attachment = $wpdb->get_row( $wpdb->prepare( "SELECT ID FROM {$wpdb->posts} WHERE guid = %s", $this->Settings['SchemaDefaultImage'] ) );

			if ( $attachment && wp_get_attachment_image_src( $attachment->ID ) ) {
				$attachment_image = wp_get_attachment_image_src( $attachment->ID, 'full' );

				return array (
					'@type' => 'ImageObject',
					'@id' => $this->Settings['SchemaDefaultImage'],
					'url' => $this->Settings['SchemaDefaultImage'],
					'width' => $attachment_image[1],
					'height' => $attachment_image[2],
				);
			} else {
				return array (
					'@type' => 'ImageObject',
					'@id' => $this->Settings['SchemaDefaultImage'],
					'url' => $this->Settings['SchemaDefaultImage'],
					'width' => 100,
					'height' => 100,
				);
			}
		}
	}


	protected function getTags() {
		global $post;

		$post_tags = wp_get_post_terms( $post->ID, 'post_tag', array( 'fields' => 'names' ) );

		if ( $post_tags && ! is_wp_error( $post_tags ) ) {
			return apply_filters( 'hunch_schema_thing_markup_tags', $post_tags );
		}
	}


	protected function getComments() {
		global $post;

		$comments = array();
		$post_comments = get_comments( array( 'post_id' => $post->ID, 'number' => 10, 'status' => 'approve', 'type' => 'comment' ) );

		if ( count( $post_comments ) ) {
			foreach ( $post_comments as $key => $value ) {
				$comments[] = array (
					'@type' => 'Comment',
					'@id' => get_permalink() . '#Comment' . ( $key + 1 ),
					'dateCreated' => $value->comment_date,
					'description' => $value->comment_content,
					'author' => array (
						'@type' => 'Person',
						'name' => $value->comment_author,
						'url' => $value->comment_author_url,
					),
				);
			}

			return apply_filters( 'hunch_schema_thing_markup_comments', $comments );
		}
	}


	protected function getAuthor() {
		global $post;

		$author = array (
			'@type' => 'Person',
			'@id' => esc_url( get_author_posts_url( get_the_author_meta( 'ID', $post->post_author ) ) ) . '#Person',
			'name' => get_the_author_meta( 'display_name', $post->post_author ),
			'url' => esc_url( get_author_posts_url( get_the_author_meta( 'ID', $post->post_author ) ) ),
		);

		if ( get_the_author_meta( 'description' ) ) {
			$author['description'] = get_the_author_meta( 'description' );
		}

		if ( version_compare( get_bloginfo( 'version' ), '4.2', '>=' ) ) {
			$author_image_url = get_avatar_url( get_the_author_meta( 'user_email', $post->post_author ), 96 );

			if ( $author_image_url ) {
				$author['image'] = array (
					'@type' => 'ImageObject',
					'@id' => $author_image_url,
					'url' => $author_image_url,
					'height' => 96,
					'width' => 96
				);
			}
		}

		return apply_filters( 'hunch_schema_thing_markup_author', $author );
	}


	public function getPublisher() {
		static $publisher;

		if ( ! $publisher ) {
			$options = get_option( 'schema_option_name' );

			if ( isset( $options['publisher_type'] ) ) {
				$publisher = array (
					'@type' => $options['publisher_type'],
				);

				if ( isset( $options['publisher_name'] ) ) {
					$publisher['name'] = $options['publisher_name'];
				}

				if ( isset( $options['publisher_image'] ) ) {
					global $wpdb;

					$image_property = ( $options['publisher_type'] === 'Person' ) ? 'image' : 'logo';

					$pubimage = $wpdb->get_row( $wpdb->prepare( "SELECT ID FROM {$wpdb->posts} WHERE guid = %s", $options['publisher_image'] ) );

					// Publisher image found, add it to schema
					if ( isset( $pubimage ) ) {
						$attachment_image = wp_get_attachment_image_src( $pubimage->ID, 'full' );

						$publisher[$image_property] = array (
							'@type' => 'ImageObject',
							'@id' => $options['publisher_image'],
							'url' => $options['publisher_image'],
							'width' => $attachment_image[1],
							'height' => $attachment_image[2],
						);
					} else {
						$publisher[$image_property] = array (
							'@type' => 'ImageObject',
							'@id' => $options['publisher_image'],
							'url' => $options['publisher_image'],
							'width' => 600,
							'height' => 60,
						);
					}
				}
			}
		}

		return apply_filters( 'hunch_schema_thing_markup_publisher', $publisher );
	}


	public function getVideos() {
		global $post;

		$featured_video_url = '';

		if ( function_exists( 'get_the_post_video_url' ) ) {
			$featured_video_url = get_the_post_video_url();
		}

		$videos = array();
		$urls = wp_extract_urls( $post->post_content . $featured_video_url );

		if ( count( $urls ) ) {
			foreach ( $urls as $url ) {
				$url = trim( $url );

				if ( filter_var( $url, FILTER_VALIDATE_URL ) != false  &&  stripos( $url, 'vimeo.com' ) !== false ) {
					$videos[] = $this->get_vimeo_video( $url );
				}
			}
		}


		$youtube_video_ids = $this->get_youtube_video_ids( $post->post_content . $featured_video_url );

		if ( count( $youtube_video_ids ) ) {
			foreach ( $youtube_video_ids as $youtube_video_id ) {
				$videos[] = $this->get_youtube_video( $youtube_video_id );
			}
		}


		if ( count( $videos ) && count( $videos ) == 1 ) {
			return apply_filters( 'hunch_schema_thing_markup_videos', reset( $videos ) );
		} elseif ( count( $videos ) ) {
			return apply_filters( 'hunch_schema_thing_markup_videos', $videos );
		}
	}


	protected function get_youtube_video( $id ) {
		if ( ! empty( $id ) ) {
			$transient_id = sprintf( 'HunchSchema-Markup-YouTube-%s', $id );
			$transient = get_transient( $transient_id );

			if ( $transient !== false ) {
				return $transient;
			}


			$response = wp_remote_retrieve_body( wp_remote_get( sprintf( 'https://api.schemaapp.com/schemaorg/video.json?ids=%s', $id ) ) );

			if ( ! empty( $response ) ) {
				// First delete then set; set method only updates expiry time if transient already exists
				delete_transient( $transient_id );
				set_transient( $transient_id, json_decode( $response ), ( 14 * DAY_IN_SECONDS ) );

				return json_decode( $response );
			}
		}

		return;
	}


	protected function get_youtube_video_ids( $string ) {
		if ( ! empty( $string ) ) {
			// https?://(?:[0-9A-Z-]+\.)?(?:youtu\.be/|youtube(?:-nocookie)?\.com\S*?[^\w\s-] )([\w-]{11})(?=[^\w-]|$)(?![?=&+%\w.-]*(?:[\'"][^<>]*>|</a>) )[?=&+%\w.-]*
			// https?://(?:[0-9A-Z-]+\.)?(?:youtu\.be/|youtube(?:-nocookie)?\.com\S*?[^\w\s-] )([\w-]{11})(?=[^\w-]|$)[?=&+%\w.-]*
			preg_match_all( '~https?://(?:www\.)?(?:youtu\.be/|youtube(?:-nocookie)?\.com\S*?[^\w\s-] )([\w-]{11})(?=[^\w-]|$)[?=&+%\w.-]*~im', $string, $matches );

			if ( isset( $matches[1] ) && count( $matches[1] ) ) {
				return $matches[1];
			}
		}

		return array();
	}


	protected function get_vimeo_video( $url ) {
		if ( ! empty( $url ) ) {
			$transient_id = sprintf( 'HunchSchema-Markup-Vimeo-%s', md5( $url ) );
			$transient = get_transient( $transient_id );

			if ( $transient !== false ) {
				return $transient;
			}


			$oembed = wp_remote_retrieve_body( wp_remote_get( 'https://vimeo.com/api/oembed.json?url=' . rawurlencode( $url ) ) );

			if ( ! empty( $oembed )  &&  ( $oembed_json = json_decode( $oembed ) )  ) {
				$schema = array(
					'@type' => 'VideoObject',
					'@id' => $oembed_json->thumbnail_url,
					'name' => $oembed_json->title,
					'description' => $oembed_json->description,
					'thumbnailUrl' => $oembed_json->thumbnail_url,
					'uploadDate' => date( 'c', strtotime( $oembed_json->upload_date ) ),
					'duration' => $this->iso8601_duration( $oembed_json->duration ),
				);

				// First delete then set; set method only updates expiry time if transient already exists
				delete_transient( $transient_id );
				set_transient( $transient_id, $schema, ( 14 * DAY_IN_SECONDS ) );

				return $schema;
			}
		}
	}


	protected function iso8601_duration( $seconds ) {
		if ( ! empty( $seconds ) ) {
			$days = floor( $seconds / 86400 );
			$seconds = $seconds % 86400;

			$hours = floor( $seconds / 3600 );
			$seconds = $seconds % 3600;

			$minutes = floor( $seconds / 60 );
			$seconds = $seconds % 60;

			return sprintf( 'P%dDT%dH%dM%dS', $days, $hours, $minutes, $seconds );
		}
	}


	/**
	 * Converts the schema information to JSON-LD
	 * 
	 * @return string
	 */
	protected function toJson( $array = array(), $pretty = false ) {
		foreach ( $array as $key => $value) {
			if ( $value === null ) {
				unset( $array[$key] );
			}
		}

		if ( isset( $array ) ) {
			if ( $pretty && strnatcmp( phpversion(), '5.4.0' ) >= 0 ) {
				$jsonLd = json_encode( $array, JSON_PRETTY_PRINT );
			} else {
				$jsonLd = json_encode( $array );
			}

			return $jsonLd;
		}
	}

}