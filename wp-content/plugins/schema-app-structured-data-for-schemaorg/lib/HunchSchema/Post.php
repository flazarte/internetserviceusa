<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );
/**
 * Description of BlogPosting
 *
 * @author mark
 */
class HunchSchema_Post extends HunchSchema_Page
{
    public function getResource($pretty = false)
    {
        global $post;

        parent::getResource($pretty);


        $this->schemaType = ! empty( $this->Settings['SchemaDefaultTypePost'] ) ? $this->Settings['SchemaDefaultTypePost'] : 'BlogPosting';
        $this->schema['@type'] = $this->schemaType;
		$this->schema['@id'] = get_permalink() . '#' . $this->schema['@type'];


        // Get the Categories
        $categories = get_the_category();
        if (count($categories) > 0) {
            foreach ($categories AS $category) {
                $categoryNames[] = $category->name;
            }
            $this->schema['about'] = $categoryNames;
        }


		$this->schema['wordCount'] = str_word_count( $post->post_content );
		$this->schema['keywords'] = $this->getTags();

		if ( ! empty( $this->Settings['SchemaArticleBody'] ) )
		{
			$this->schema['articleBody'] = str_replace( array( "\n", "\r" ), '', strip_tags( apply_filters( 'the_content', get_post_field( 'post_content', $post->ID ) ) ) );
		}


        return $this->toJson( $this->schema, $pretty );
    }


    public function getBreadcrumb( $Pretty = false )
    {
		$BreadcrumbPosition = 1;

		$this->SchemaBreadcrumb['@context'] = 'http://schema.org/';
		$this->SchemaBreadcrumb['@type'] = 'BreadcrumbList';

		$this->SchemaBreadcrumb['itemListElement'][] = array
		(
			'@type' => 'ListItem',
			'position' => $BreadcrumbPosition++,
			'item' => array
			(
				'@id' => home_url( '/#breadcrumbitem' ),
				'name' => get_bloginfo( 'name' ),
			),
		);

		$this->SchemaBreadcrumb['itemListElement'][] = array
		(
			'@type' => 'ListItem',
			'position' => $BreadcrumbPosition++,
			'item' => array
			(
				'@id' => get_permalink() . "#breadcrumbitem",
				'name' => get_the_title(),
			),
		);

        return $this->toJson( $this->SchemaBreadcrumb, $Pretty );
    }
}