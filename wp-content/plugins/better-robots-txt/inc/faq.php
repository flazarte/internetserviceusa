<div class="rt-faq">

    <div class="faq-container">
        <div class="rt-q">
            <?php 
echo  esc_html__( 'What is a robots.txt?', 'better-robots-txt' ) ;
?>
        </div>
        <div class="rt-a">
            <p>
                <?php 
echo  esc_html__( 'Robots.txt is a text file usually created by webmasters (but often forgotten) to instruct web robots (typically search engine robots) how to crawl pages on their website. The robots.txt file indicates how robots must crawl a website, access and index content, and serve that content up to users. In practice, robots.txt files indicate whether certain user agents (web-crawling software) can or cannot crawl parts of a website. These crawl instructions are specified by “disallowing” or “allowing” the behavior of certain (or all) user agents.', 'better-robots-txt' ) ;
?>
            </p>

            <strong>Source: https://moz.com/learn/seo/robotstxt</strong>
        </div>
    </div>

    <div class="faq-container">
        <div class="rt-q">
            <?php 
echo  esc_html__( 'What is a sitemap?', 'better-robots-txt' ) ;
?>
        </div>
        <div class="rt-a">
            <p>
                <?php 
echo  esc_html__( 'Sitemaps are an easy way for webmasters to inform search engines about pages on their sites that are available for crawling. In its simplest form, a Sitemap is an XML file that lists URLs for a site along with additional metadata about each URL (when it was last updated, how often it usually changes, and how important it is, relative to other URLs in the site) so that search engines can more intelligently crawl the site.', 'better-robots-txt' ) ;
?>
            </p>

            <p><strong>Source: https://www.sitemaps.org/</strong></p>
        </div>
    </div>

    <div class="faq-container">
        <div class="rt-q">
            <?php 
echo  esc_html__( 'Better Robots.txt plugin is enabled but why can\'t I see any changes in the robots.txt file?', 'better-robots-txt' ) ;
?>
        </div>
        <div class="rt-a">
            <p>
                <?php 
echo  esc_html__( 'Better Robots.txt creates a virtual robots.txt file. Please make sure that your permalinks are enabled from Settings > Permalinks. If the permalinks are working, make sure that there is no physical robots.txt file on your server. Since it can\'t write over the existing physical file, you must connect to FTP and rename or delete the robots.txt file from your domain’s root directory. It is usually in the /public_html/ folder on cPanel hostings. If you can\'t find your domain root directory, please ask your hosting provider for help. If the issue persists after taking these measures, please post it in the support section or send a message to support@better-robots.com', 'better-robots-txt' ) ;
?>
            </p>
        </div>
    </div>

    <div class="faq-container">
        <div class="rt-q">
            <?php 
echo  esc_html__( 'How to add a sitemap in robots.txt?', 'better-robots-txt' ) ;
?>
        </div>
        <div class="rt-a">
            <p>
                <?php 
echo  esc_html__( 'This feature is allowed in the Better Robots.txt Pro version, which automatically adds a sitemap into the robots.txt file. It detects the sitemap from the Yoast SEO plugin. If you\'re using a different sitemap plugin or a manually generated sitemap, then you can simply add the sitemap URL into the sitemap input field. If Yoast XML sitemaps is also enabled then you need to disable it first by simply going to Yoast General Settings > Features and disable the XML Sitemaps feature.', 'better-robots-txt' ) ;
?>
            </p>
        </div>
    </div>

    <div class="faq-container">
        <div class="rt-q">
            <?php 
echo  esc_html__( 'Why should I optimize the robots.txt?', 'better-robots-txt' ) ;
?>
        </div>
        <div class="rt-a">
            <p>
                <?php 
echo  esc_html__( 'Considering that the robots.txt is the very first file read when your website is loaded by a browser, why not enable crawlers to index your content continuously? The simple fact of adding your Sitemap into the Robots.txt is simply common sense. Why? Did you list your website on Google Search Console? Did your webmaster do it? How do you tell the crawlers that you have new content available for indexation on your website? If you want this content to be found on search engines (Google, Bing, etc.), you have to have it indexed. That\'s exactly what this instruction (adding the sitemap) aims to do.', 'better-robots-txt' ) ;
?>
            </p>

            <p><strong><?php 
echo  esc_html__( 'One last point.', 'better-robots-txt' ) ;
?></strong></p>

            <p>
                <?php 
echo  esc_html__( 'The main reason this plugin exists is because 95% of the time (based on thousands of SEO analysis), the robots.txt is either missing, empty or misused. And that’s simply because it is either misunderstood or forgotten. Imagine now if it was activated and fully functional.', 'better-robots-txt' ) ;
?>
            </p>
        </div>
    </div>

    <div class="faq-container">
        <div class="rt-q">
            <?php 
echo  esc_html__( 'How can this plugin boost my website ranking?', 'better-robots-txt' ) ;
?>
        </div>
        <div class="rt-a">
            <p>
                <?php 
echo  esc_html__( 'Actually, this plugin will increase your website indexation capacity which leads to an improvement in your ranking on Google. How? Well, the idea of creating this plugin was taken after making hundreds of SEO optimization adjustments on professional and corporative websites. As mentioned before, 95% of the analyzed websites did not have what we could call an "optimized" robots.txt file and, while we were optimizing these websites, we realized that simply modifying the content of this file was actually "unlocking" these websites (based on daily SEMrush analyses). As we were used to working in 2 steps (periods of time), starting with this simple modification was already generating a significant impact on Google Ranking, and this was even before we started deeply modifying either the content, the site arborescence or the Meta Data. The more you help search engines to understand your website, the better you help your capacity for getting better results in SERPs.', 'better-robots-txt' ) ;
?>
            </p>
        </div>
    </div>

    <div class="faq-container">
        <div class="rt-q">
            <?php 
echo  esc_html__( 'What are the Best SEO Practices?', 'better-robots-txt' ) ;
?>
        </div>
        <div class="rt-a">
            <ul>
                <li>
                    <?php 
echo  esc_html__( 'Make sure you’re not blocking any content or sections of your website you want crawled.', 'better-robots-txt' ) ;
?>
                </li>

                <li>
                    <?php 
echo  esc_html__( 'Links on pages blocked by robots.txt will not be followed. This means 1.) Unless they’re also linked from other search engine-accessible pages (i.e. pages not blocked via robots.txt, meta robots, or otherwise), the linked resources will not be crawled and may not be indexed. 2.) No link equity can be passed from the blocked page to the link destination. If you have pages to which you want equity to be passed, use a different blocking mechanism other than robots.txt.', 'better-robots-txt' ) ;
?>
                </li>

                <li>
                    <?php 
echo  esc_html__( 'Do not use robots.txt to prevent sensitive data (like private user information) from appearing in SERP results. Because other pages may link directly to the page containing private information (thus bypassing the robots.txt directives on your root domain or homepage), it may still get indexed. If you want to block your page from search results, use a different method like password protection or the noindex meta directive.', 'better-robots-txt' ) ;
?>
                </li>

                <li>
                    <?php 
echo  esc_html__( 'Some search engines have multiple user-agents. For instance, Google uses Googlebot for organic search and Googlebot-Image for image search. Most user agents from the same search engine follow the same rules so there’s no need to specify directives for each of a search engine’s multiple crawlers, but having the ability to do so does allow you to fine-tune how your site content is crawled.', 'better-robots-txt' ) ;
?>
                </li>

                <li>
                    <?php 
echo  esc_html__( 'A search engine will cache the robots.txt contents, but usually updates the cached contents at least once a day. If you change the file and want to update it more quickly than is occurring, you can submit your robots.txt url to Google.', 'better-robots-txt' ) ;
?>
                </li>
            </ul>
        </div>
    </div>

    <div class="faq-container">
        <div class="rt-q">
            <?php 
echo  esc_html__( 'What is Spam Backlink Blocker?', 'better-robots-txt' ) ;
?>
        </div>
        <div class="rt-a">
            <p>
                <?php 
echo  esc_html__( 'Backlinks, also called "inbound links" or "incoming links" are created when one website links to another. The link to an external website is called a backlink. Backlinks are especially valuable for SEO because they represent a "vote of confidence" from one site to another. In essence, backlinks to your website are a signal to search engines that others vouch for your content. If many sites link to the same webpage or website, search engines can infer that the content is worth linking to, and therefore also worth showing on a SERP. So, earning these backlinks generates a positive effect on a site\'s ranking position or search visibility. In the SEM industry, it is very common for specialists to identify where these backlinks come from (competitors) in order to sort out the best of them and generate high-quality backlinks for their customers. Considering that creating very profitable backlinks, for a company, takes time (time + energy + budget), allowing your competitors to identify them and duplicate them so easily is a pure loss of efficiency. Better Robots.txt helps you block all SEO crawlers (aHref, Majestic, Semrush) to keep your backlinks undetectable. Source: https://moz.com/learn/seo/backlinks', 'better-robots-txt' ) ;
?>
            </p>
        </div>
    </div>

    <?php 
?>

    <div class="faq-container">
        <div class="rt-q">
            <?php 
echo  esc_html__( 'What is Better Robots.txt Post Meta Box?', 'better-robots-txt' ) ;
?>
        </div>
        <div class="rt-a">
            <p>
                <?php 
echo  esc_html__( 'This Post Meta Box allows to set "manually" if a page should be visible (or not) on search engines by injecting a dedicated "disallow" + "noindex" rule inside your robots.txt. Why is it an asset for your ranking on search engines ? Simply because some pages are not meant to be crawled / indexed. Thank you pages, landing pages, page containing exclusively forms are useful for visitors but not for crawlers, and you don\'t need them to be visible on search engines. Also, some pages containing dynamic calendars (for online booking) should NEVER be accessible to crawlers beause they tend to trap them into infinite crawling loops which impacts directly your crawl budget (and your ranking).', 'better-robots-txt' ) ;
?>
            </p>
        </div>
    </div>

    <div class="faq-container">
        <div class="rt-q">
            <?php 
echo  esc_html__( 'About Multisite robots.txt feature', 'better-robots-txt' ) ;
?>
        </div>
        <div class="rt-a">
            <p>
                <?php 
echo  esc_html__( 'When having directory network sites, for example : maindomain.com/networksite1 , maindomain.com/networksite2, etc. OR, if using a Wordpress directory such as maindomain.com/wp, .., you don\'t need to have a robots.txt file for each of them, simply because, by default, search engines bots (crawlers) will always look for the robots.txt file inside your main domain root directory (it\'s the way it works). Meaning that no matter how many network sites you have, you will always have ONE single robots.txt as they are all related to a main domain. In case of multi sites with sub-domains (here, for example, site1.maindomain.com, site2.maindomain.com, etc.), this is a totally different situation as each sub-domain is a separate entity, requiring its own robots.txt. So, when using Better robots.txt plugin, you must first define your robots.txt settings for your main domain, save your settings then go to "Multisite settings" tab and enter all your directory based network sites, one by one, one per line. Once done, you may select the same options as chosen for your main domain, or not (if for example, you have Woocommerce online stores on some of them). Better robots.txt will detect all your sitemaps, for each of these network sites, and add them to your robots.txt. At the end of this operation, you will have a robots.txt file displaying specific rules for each of your network sites, including your main domain.', 'better-robots-txt' ) ;
?>
            </p>
        </div>
    </div>

</div>
