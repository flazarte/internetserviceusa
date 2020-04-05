<div class="asap-section" id="asap-section-how" <?php if ($active_tab != 'how') { ?>style="display: none;"<?php } ?>>
     <p class="asap-authorize-note apfap-graph-api-options"><?php _e('Important Note: This plugin is replacement of our plugin "AccessPress Facebook Auto Post" This is not an official APP of Facebook but is a Free WordPress plugin which only helps you to auto post any post ,pages or custom post type content to your facebook account in your profile or fan pages.', 'accesspress-facebook-auto-post'); ?></p>
    <div class="more-title"><?php _e('Graph API For Auto Post To Your Facebook Pages ( Deprecated )', 'accesspress-facebook-auto-post'); ?></div>
    <p><?php _e('For Auto Post to your facebook profile or fan pages, you will need to get ', 'accesspress-facebook-auto-post'); ?>
    	<strong>Facebook Application ID</strong>,<strong>Facebook Application Secret</strong> and <strong>Facebook User ID</strong>.</p>
    <p><?php _e('To get all the required details you will need to create a Facebook APP', 'accesspress-facebook-auto-post'); ?> <a href="https://developers.facebook.com/apps" target="_blank">here</a>.</p>
    <p><?php _e('Also please make sure you follow below steps after creating app.', 'accesspress-facebook-auto-post'); ?><br>Navigate to Apps > Settings > Edit settings > Website > Site URL.<br/> Set the site url as : <input type="text" readonly="readonly" onfocus="this.select();" value="<?php echo site_url(); ?>" style="width: 100%;"/></p>
    <p><?php _e('Once you add the account, then you will need to authorize the account.You can authorize the account by clicking ', 'accesspress-facebook-auto-post'); ?>
        "<strong>Authorize</strong>"
       <?php _e('button at top left of the account settings section.Once you click on <strong>Authorize</strong> button you will be redirected to the facebook which will show a dailog box asking the permission to post on your wall and get all the details regarding your facebook pages related with that account.You will need to allow all the permission to enable the auto post to your profile and fan pages.', 'accesspress-facebook-auto-post'); ?>
    	</p>

    <p><?php _e('Please check our below video for proper setup of the plugin.', 'accesspress-facebook-auto-post'); ?></p>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/IZ2P9SWKl-k" frameborder="0" allowfullscreen></iframe>
   <div class="clearfix" style="margin-top:12px;"></div>
    <div class="more-title"><?php _e('Mobile API For Auto Post To Your Facebook Pages( Major Updates )', 'accesspress-facebook-auto-post'); ?></div>
    <p><?php _e('As facebook had made some limitation and done some changes recently so the graph API in case is not working then try Facebook Mobile API Auto Post option. You donot need to create any facebook APP for this method, but instead this method need to use your facebook accounts email address and password in its respective fields to allow permissions to get facebook token for posting on facebook fan page. The details are required to grant extended permission to get token. Note: The filled up facebook account details will not be stored anywhere. Thus, its secure and fast method to autopost in facebook. ', 'accesspress-facebook-auto-post'); ?>

    </p>
    <p><?php _e('Choose an option for Facebook Mobile API. Then, fill your facebook account email address and password. To get access token, click on "Generate Access Token". The token data will be displayed on textarea. Simply, copy all generated access token and paste on below provided field then click on "Add Account" in order to get all fans and profile page lists for auto post. Now, you can get all the lists of pages/groups on multiple selection dropdown lists. Configure all other options as per your requirement and then save the settings at last.', 'accesspress-facebook-auto-post'); ?>
    </p>

    <iframe width="560" height="315" src="https://www.youtube.com/embed/qgaqxljhZwI" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
</div>
