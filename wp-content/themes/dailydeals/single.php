<?php get_header();
    $oldblog = get_option('id_blog_page');
?>


    <!------ CONTENT ------>
    <div class="content">
        <div class="wrapper">

            <div class="content-background">
                <div class="content-wripper">


					<?php


            $current_page_id = get_ID_by_slug($post->post_name);
            $page = get_page_by_title($post->post_name);
            $meta = (get_post_meta($current_page_id,'',true));
            $slug = get_page_link();

                                        $posts = query_posts($query_string . "&page_id=$post->ID");

					if ( have_posts() ) : while ( have_posts() ) : the_post();

                                        $currency = get_option(THEME_NAME.'_currency');
                                        $real_price = get_post_meta($post->ID, 'real_price', true);
                                        $discount_price = get_post_meta($post->ID, 'discount_price', true);
                                        $deal_type = get_post_meta($post->ID, 'deal_type', true);
                                        $deal_info = get_post_meta($post->ID, 'deal_info', true);
                                        $start_date = get_post_meta($post->ID, 'start_date', true);
                                        $end_date = get_post_meta($post->ID, 'end_date', true);
                                        $deal_image_1 = get_post_meta($post->ID+2, '_wp_attached_file', true);
					$data = get_post_meta( $post->ID, GD_THEME, true );
					$imagedata = simplexml_load_string(get_the_post_thumbnail());
					$title = the_title('','',FALSE);
					$lenght = strlen($title);
					if ($title<>substr($title,0,30)){ $dots = "...";}else{$dots = "";}
					?>

								<?php $post_img = "";
									if (has_post_thumbnail()){
										      $imagedata = simplexml_load_string(get_the_post_thumbnail());
										      if(!empty($imagedata)){
										      	$post_img = $imagedata->attributes()->src;
										      }
										   	} ?>
								<?php
                                                                $comments = get_comments("post_id=$post->ID");
                                                                $num_of_comments = 0;
                                                                foreach((get_the_category()) as $category) {
                                                                        $post_category = $category->cat_name;
                                                                        $post_category_id = $category->cat_ID;
                                                                        $cat_slug=get_cat_slug($post_category_id);
                                                                }
                                                                foreach($comments as $comm) :
                                                                        $num_of_comments++;
                                                                endforeach;
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
								<!-- BLOG -->
                        <div class="blog-left">
                            <div class="title-blog"><a href="<?php the_permalink(); ?>"><?php echo substr($title,0,30).$dots; ?></a></div><!--/title-blog-->
                            <div class="images">
                                <a href="<?php echo the_permalink()?>" class="pirobox " title="<?php the_title(); ?>" rel="single">
                                    <img src="<?php echo $deal_image_1?>" alt="_" title="<?php the_title();?>" />
                                </a>
                            </div><!--/images-->
                            <div class="text">
                                <p><?php the_content()?></p>
                            </div><!--/text-->
                        </div><!--/blog-left-->

                        <script type="text/javascript">
                        jQuery(document).ready(function(){
                            $('.countdown').countdown({until: new Date(<?php echo $end_date[2]?>, <?php echo $end_date[0]?>-1, <?php echo $end_date[1]?>, <?php echo $matches[4]?>, <?php echo $matches[5]?>, <?php echo $matches[6]?>), layout: '{dn} days {hnn} hrs {mnn} min {snn} sec', compact: true, timezone:0});
                        })
                        </script>

                        <div class="blog-right">
                            <div class="blog-right-text">
                                <span style="padding-top: 22px;">This deal will end in:</span><br />
                                <p class="countdown" style="padding-top: 12px;"></p><br />
                                <span style="padding-top: 25px; margin-bottom: -10px;">Discount</span><br />
                                <h5><?php echo $discount_perc;?></h5>
                                <div class="blog-right-dwo">
                                    <span>Deal Value</span><br />
                                    <p style="margin-top: 0;"><?php echo print_money_symbol($currency).' '.$real_price;?></p>
                                </div><!--blog-right-dwo-->
                                <div class="blog-right-dwo">
                                    <span>You Save</span><br />
                                    <p style="margin-top: 0;"><?php echo print_money_symbol($currency).' '.$you_save;?></p>
                                </div><!--blog-right-dwo-->

                                <div class="twitter-facebook">

                                    <div class="fb-like" data-href="<?php the_permalink(); ?>" data-send="false" data-layout="button_count" data-width="90" data-show-faces="false" data-font="arial"></div>
                                    <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-count="horizontal">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>

                                </div>
                            </div><!--blog-right-text-->

                             <?php
                            if($deal_type == 'coupon' ) {
                                $table_name = $wpdb->prefix . THEME_NAME.'_coupons';

                                $querystr = "SELECT COUNT(coupon) FROM ".$table_name."
                                                    WHERE postid = ".$post->ID." AND available = 1";

                                $result = $wpdb->get_results($querystr,ARRAY_A);

                                $result = $result[0]['COUNT(coupon)'];

                            }else {
                                $result = '1';
                            }

                            if ( ( (int)$server_time < (int)$fulltime) && $result !== '0') {

                                $paypal_redirect   = '';
                                $paypal_email 	   = get_option(THEME_NAME.'_paypal_email');
                                $currency 		   = get_option(THEME_NAME.'_currency');
                                $notify_url 	   = home_url().'/?paypal=1';
                                $return 		   = get_option(THEME_NAME.'_return_url');
                                $product_cost      = urlencode($discount_price);
                                $product_name      = urlencode(substr($title,0,40));
                                $item_number       = '';
                                $subscription_key  = urlencode(strtolower(md5(uniqid())));
                                $item_name         = urlencode(''.$product_name.'');
                                $sandbox 		   = get_option(THEME_NAME.'_paypal_sandbox');

                                if($sandbox == '1') {
                                    $sendbox_addon = 'sandbox.';
                                }else {
                                    $sendbox_addon = '';
                                }

                                $custom_secret = md5(date('Y-m-d H:i:s').''.rand(1,10).''.rand(1,100).''.rand(1,1000).''.rand(1,10000));
                                $custom_secret = $custom_secret.$post->ID;

                                $paypal_redirect  .= 'https://www.'.$sendbox_addon.'paypal.com/webscr?cmd=_xclick';
                                $paypal_redirect  .= '&business='.$paypal_email.'&item_name='.$item_name.'&no_shipping=1&no_note=1&item_number='.$subscription_key.'&currency_code='.$currency.'&charset=UTF-8&return='.urlencode($return).'&notify_url='.urlencode($notify_url).'&rm=2&custom='.$custom_secret.'&amount='.$product_cost;

				   ?>

                            <div class="blog-right-button">
                                <a href="<?php if($deal_type == 'custom'){echo $deal_info;} else {echo $paypal_redirect;} ?>">
                                    <div class="button">
                                        <div class="blog-right-left"></div>
                                        <div class="blog-right-center"><?php if ($discount_price != 0 ){?>Buy now - <?php echo print_money_symbol($currency).' '.$discount_price;}else {echo 'Get It FREE';}?></div>
                                        <div class="blog-right-right"></div>
                                    </div>
                                </a><!--/button-->
                            </div><!--/blog-right-button-->
                        </div><!--blog-right-->
<?php }else{ ?>
                            <div class="deal-has-expired">This deal has expired!</div>

                                <?php } endwhile;?>
                                <?php else: ?>
                                <?php endif; ?>


        </div> <!--close left_content -->

    </div> <!---->

    </div><!--/content-->
    </div><!--/content-->


<?php get_footer(); ?>