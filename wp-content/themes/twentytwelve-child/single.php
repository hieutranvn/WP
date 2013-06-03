<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
get_header();
?>
<?php
$votes = get_post_meta($post->ID, "votes", true);
$votes = ($votes == "") ? 0 : $votes;
?>
This post has <div id='vote_counter'><?php echo $votes ?></div>
votes<br />
<?php
$nonce = wp_create_nonce("my_user_vote_nonce");
$link = admin_url('admin-ajax.php?action=my_user_vote&post_id=' .
        $post->ID . '&nonce=' . $nonce);
echo '<a class="user_vote" data-nonce="' . $nonce . '" 
    data-post_id="' . $post->ID . '" href="javascript:void(0);">vote for this
article</a>';
?>
<br />
<br />
=======================Get Results==============================================
<div>
<?php
$post = $wpdb->get_results("SELECT ID, post_title 
    FROM $wpdb->posts 
    WHERE post_status = 'publish'
    AND post_type='post' ORDER BY comment_count DESC LIMIT 0,4");
for ($i=0; $i<count($post); $i++){
printf($post[$i]->post_title);
?>
    <br />
<?php
}
?>
</div>
================================================================================
<br />
<br />
==========================Get Row===============================================
<br />
==============(Only get one first row of results================================
<div>
<?php
   $post1 = $wpdb->get_row("SELECT ID, post_title 
       FROM wp_posts WHERE post_status = 'publish'
   AND post_type='post' ORDER BY comment_count DESC");

   // Echo the title of the most commented post
   echo $post1->post_title;
?>
</div>
================================================================================
<br />
<br />
==========================Get Column============================================
<br />
====================(Only get one first column of results)======================
<div>
<?php
   $post2 = $wpdb->get_col("SELECT post_title, ID
       FROM wp_posts WHERE post_status = 'publish'
   AND post_type='post' ORDER BY comment_count DESC");
   // Echo the title of the most commented post
   echo $post2[2];
?>
</div>
================================================================================


<div id="primary" class="site-content">
    <div id="content" role="main">
        <?php while (have_posts()) : the_post(); ?>

            <?php get_template_part('content', get_post_format()); ?>

            <nav class="nav-single">
                <h3 class="assistive-text"><?php _e('Post navigation', 'twentytwelve'); ?></h3>
                <span class="nav-previous"><?php previous_post_link('%link', '<span class="meta-nav">' . _x('&larr;', 'Previous post link', 'twentytwelve') . '</span> %title'); ?></span>
                <span class="nav-next"><?php next_post_link('%link', '%title <span class="meta-nav">' . _x('&rarr;', 'Next post link', 'twentytwelve') . '</span>'); ?></span>
            </nav><!-- .nav-single -->

            <?php comments_template('', true); ?>

        <?php endwhile; // end of the loop.  ?>

    </div><!-- #content -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>