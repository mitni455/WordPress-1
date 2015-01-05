<!------ FOOTER ------>
    <div class="footer">
        <div class="wrapper">
            <div class="footer-background">
                <div class="footer-wripper">
                    <!-- BORDER-HORIZONTAL -->
                    <div class="border-horizontal"></div>

                    <?php $check_banner = get_option(THEME_NAME.'_bottom_banner');
                            if ($check_banner == 1){
                    ?>
                    <!-- SPONZORI-LOGO -->
                    <div class="sponzori-logo">
                        <img src="<?php echo get_option(THEME_NAME.'_banner_image');?>" title="" alt="#" />
                    </div>

                    <div class="border-horizontal"></div>

                    <?php } ?>

                    <!-- BORDER-HORIZONTAL -->

                    <!-- BLOG-SMALL -->
                    <div class="blog-small-home">

    <?php

            $slug = get_page_link();
            
            wp_reset_query();
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 0;
            $args=array('post_type' => 'deals', 'post_status' => 'publish','paged' => 0,'posts_per_page' => 3,'ignore_sticky_posts'=> 1, 'orderby'=>'rand');

            //The Query
            query_posts($args);
            $post_counter = 1;
            //The Loop
            if ( have_posts() ) : while ( have_posts() ) : the_post();

                    $currency = get_option(THEME_NAME.'_currency');
                    $real_price = get_post_meta($post->ID, 'real_price', true);
                    $discount_price = get_post_meta($post->ID, 'discount_price', true);
                    $start_date = get_post_meta($post->ID, 'start_date', true);
                    $end_date = get_post_meta($post->ID, 'end_date', true);
                    $deal_type = get_post_meta($post->ID, 'deal_type', true);
                    $deal_info = get_post_meta($post->ID, 'deal_info', true);
                    $deal_image_1 = get_post_meta($post->ID+2, '_wp_attached_file', true);

                    $title = the_title('','',FALSE);

                    if ($title<>substr($title,0,30)) {
                        $dots = "...";
                    }else {
                        $dots = "";
                    }?>

                    <?php
                    $authorid = $post->post_author;
                    $author = get_userdata($authorid);
                    $written = $author->user_login;
                    if (isset($real_price) && ($real_price !=='') ) {$real_price = $real_price;};
                    if (isset($discount_price) && ($discount_price !=='') ) {$discount_price = $discount_price;};
                    if (isset($start_date) && ($start_date !=='') ) {$start_date = $start_date;};
                    if (isset($deal_type) && ($deal_type !=='') ) {$deal_type = $deal_type;};
                    if (isset($deal_info) && ($deal_info !=='') ) {$deal_info = $deal_info;};
                    if (isset($end_date) && ($end_date !=='') ) {
                        $end_date1 = $end_date;
                        $end_date = explode('/', $end_date1);
                    };
                    $discount_perc = ($discount_price*100)/$real_price;
                    $discount_perc = 100-$discount_perc;
                    $discount_perc = round($discount_perc, 0).'%';
                    if($discount_perc<0){$discount_perc = 'invalid entry';}
                    $you_save = $real_price-$discount_price;
                    if($you_save<0){$you_save = 'invalid entry';}
                    preg_match('/(\d{4})\-(\d{2})\-(\d{2})\s(\d{2})\:(\d{2})\:(\d{2})/i', $post->post_date_gmt, $matches);
                    $fulltime = strtotime($end_date[2].'-'.$end_date[0].'-'.$end_date[1].' '.$matches[4].':'.$matches[5].':'.$matches[6]);
                    $server_time = gmdate('Y-m-d G:i:s');
                    $server_time= strtotime($server_time);
                    ?>
                        
                        <div class="blog-small">
                            <div class="title-blog-small"><a href="<?php the_permalink(); ?>"><?php echo substr($title,0,30).$dots; ?></a></div><!--/title-blog-small-->
                            <div class="images-small">
                                    <a href="<?php echo the_permalink()?>" class="pirobox " title="<?php the_title(); ?>" rel="single">
                                        <img src="<?php echo $deal_image_1?>" alt="_" title="<?php the_title();?>" />
                                    </a>
                                <div class="statistic">
                                    <ul>
                                        <li>Deal Value<p><?php echo print_money_symbol($currency).' '.$real_price?></p></li>
                                        <li class="statistic-border"></li>
                                        <li>Discount<p><?php echo $discount_perc?></p></li>
                                        <li class="statistic-border"></li>
                                        <li>You Save<p><?php echo print_money_symbol($currency).' '.$you_save?></p></li>
                                    </ul>
                                </div><!--statistic-->
                            </div><!--/images-small-->
                            <div class="blog-small-button">

                        <script type="text/javascript">
                        jQuery(document).ready(function(){
                                $('.footer-count-<?php echo $post_counter;?>').countdown({until: new Date(<?php echo $end_date[2]?>, <?php echo $end_date[0]?>-1, <?php echo $end_date[1]?>, <?php echo $matches[4]?>, <?php echo $matches[5]?>, <?php echo $matches[6]?>), layout: '{dn} days {hnn} hrs {mnn} min {snn} sec', compact: true, timezone:0});
                        })
                        </script>
                                
                                <p class="footer-count-<?php echo $post_counter;?>"></p>
                                <div class="small-button">
                                    <a href="<?php the_permalink(); ?>">
                                        <div class="button">
                                            <div class="small-left"></div>
                                            <div class="small-center">SEE DEAL</div>
                                            <div class="small-right"></div>
                                        </div>
                                    </a><!--/button-->
                                </div><!--/small-button-->
                            </div><!--/blog-small-button-->
                        </div><!--/blog-small-->

                        <?php if($post_counter%3 !== 0){ ?> <div class="border-vertical"></div><?php } ?>
                        
                                <?php $post_counter++;endwhile;?>
                                <?php else: ?>
                                <?php endif; ?>

                    </div><!--blog-small-home-->

                    <!--TEXT WIDGET-->
                    <div class="footer_box">
                        <?php if(function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 1')) : ?>
                        <?php endif; ?>
                    </div><!--/footer_box -->

                    <div class="border-vertical"></div>

                    <!--TWITTER WIDGET-->
                    <div class="footer_box">
                        <?php if(function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 2')) : ?>
                        <?php endif; ?>
                    </div><!--/footer_box-->

                    <div class="border-vertical"></div>

                    <!--CUSTOM MENU-->
                    <div class="footer_box">
                        <?php if(function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widget 3')) : ?>
                        <?php endif; ?>
                    </div><!--footer_box-->

                </div><!--content-wripper-->
            </div><!--footer-background-->

            <!--FOOTER-COPY-->
            <div class="footer-copy">
                <div class="copy-text">
            <?php $copyright = get_option(THEME_NAME.'_footer_copyright');?>
            <p><?php echo $copyright?></p>
                </div><!--copy-text-->
            </div><!--footer-copy-->

        </div><!--/wrapper-->
    </div><!--/footer-->


</div><!--/container-->

<div class="clear-both"></div>

<?php wp_footer(); ?>
</body>
</html>