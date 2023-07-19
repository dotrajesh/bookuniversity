<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );
         
if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
        wp_enqueue_style( 'chld_thm_cfg_child', trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array( 'twenty-twenty-one-style','twenty-twenty-one-style','twenty-twenty-one-print-style' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css', 998 );

// END ENQUEUE PARENT ACTION

function bookuniversity_script() {
    wp_enqueue_script('custom-js',get_stylesheet_directory_uri() . '/assets/js/custom.js',array( 'jquery' ),true);
    wp_enqueue_script('owlcarouseljs',get_stylesheet_directory_uri() . '/assets/js/owl.carousel.min.js',array( 'jquery' ),true);
    wp_enqueue_style('owlcarouselcss',get_stylesheet_directory_uri() . '/assets/css/owl.carousel.min.css');

    wp_enqueue_style('aoscss', 'https://unpkg.com/aos@2.3.1/dist/aos.css');
    wp_enqueue_script('aosjs','https://unpkg.com/aos@2.3.1/dist/aos.js');

    wp_localize_script( 'custom-js', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
}
add_action( 'wp_enqueue_scripts', 'bookuniversity_script' );

function DateCopy(){
    ob_start();
     echo date("Y");
     return ob_get_clean();
}

add_shortcode('copydate','DateCopy');
function load_media_files() {
    wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'load_media_files' );
include('theme-options.php');

add_shortcode('clientSlider','clientSlider');

function clientSlider(){
    ob_start();
    $getclientImg =get_option('clientImage');
    if(!empty($getclientImg[0]['clientImage'])){ ?>

<div class="owl-carousel owl-theme test1">
    <?php foreach ($getclientImg as $key => $value) {
            $imgUrl = wp_get_attachment_image_url( $value['clientImage'],'full'); ?>
    <div class="item">
        <img src="<?php echo $imgUrl; ?>" alt="" />
    </div>
    <?php
         } ?>
</div>
<?php }
     return ob_get_clean();
}


function contactForm(){
    ob_start();
    ?>
<div class="content_form">
    <div class="content-box">
        <form method="post" id="contact-form" class="default-form" novalidate="novalidate">
            <input type='hidden' name='action' value='enquiryaction' />
            <div class="formMsg" style="display: none;"></div>
            <div class="row">
                <div class="form-group">
                    <input type="text" name="name" id="name" placeholder="Name" required="" aria-required="true" maxlength="100">
                    <p class='error'></p>
                </div>

                <div class="form-group">
                    <input type="email" name="email" id="email" placeholder="Email" required="" aria-required="true" maxlength="100">
                    <p class='error'></p>
                </div>
            </div>
            
            <div class="form-group">
                <input type="text" name="subject" id="subject" placeholder="Subject" required="" aria-required="true" maxlength="50">
                <p class='error'></p>
            </div>
            <div class="form-group">
                <textarea name="message" id="message" placeholder="Drop message here"  maxlength="500"></textarea>
            </div>
            <div class="form-group text-center mb-0">
                <button class="btn-get-started footer-submit" type="submit" name="submit-form">Send Your
                    Query</button>
                <div class="spinner-border" role="status" style="display: none;">
                    <span class="visually-hidden"></span>
                </div>
            </div>
        </form>
    </div>
</div>


<?php 
return ob_get_clean();
}
add_shortcode('contactForm','contactForm');

add_action('wp_ajax_enquiryaction','enquiryForm');
add_action('wp_ajax_nopriv_enquiryaction', 'enquiryForm');

function enquiryForm(){
$responce =[];
$headers = "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\n";
$headers .= "From:Contact Form <".$_POST['email'].">\n";
$to = get_option('admin_email');

//$to = 'surendra.parihar@dotsquares.com';

//$to ='jain.rajesh@dotsquares.com';

$strEmailCont ="Name ".$_POST['name'];
$strEmailCont .="<br>";
$strEmailCont ="Email ".$_POST['email'];
$strEmailCont .="<br>";
$strEmailCont .="Message ".$_POST['message'];

$res = wp_mail($to, $_POST['subject'], $strEmailCont, $headers);
$responce['emailStatus']= $res;

if($res){
    $responce['status'] =true;
    $responce['msg'] ='Your Query has been Submitted.Our Team Contact Soon...';
    
}else{
    $responce['status'] =false;
    $responce['msg'] ='Something Wentrong.';
}


echo json_encode($responce);
wp_die();
}

add_action('wp_ajax_partneraction','PartnerAjaxForm');
add_action('wp_ajax_nopriv_partneraction', 'PartnerAjaxForm');

function PartnerAjaxForm(){
$responce =[];
$headers = "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\n";
$headers .= "From:Contact Form <".$_POST['email'].">\n";
$to = get_option('admin_email');

//$to = 'surendra.parihar@dotsquares.com';

//$to ='jain.rajesh@dotsquares.com';

$strEmailCont ="Name: ".$_POST['name'];
$strEmailCont .="<br>";
$strEmailCont ="Email ".$_POST['email'];
$strEmailCont .="<br>";
$strEmailCont .="Phone : ".$_POST['phone'];
$strEmailCont .="<br>";
$strEmailCont .="Organisation name : ".$_POST['organisation'];
$strEmailCont .="<br>";
$strEmailCont .="Address : ".$_POST['address'];
$strEmailCont .="<br>";
$strEmailCont .="Message ".$_POST['message'];

$res = wp_mail($to,'Become A Partner', $strEmailCont, $headers);
$responce['emailStatus']= $res;

if($res){
    $responce['status'] =true;
    $responce['msg'] ='Your Query has been Submitted.Our Team Contact Soon...';
    
}else{
    $responce['status'] =false;
    $responce['msg'] ='Something Wentrong.';
}


echo json_encode($responce);
wp_die();
}


function PartnerForm(){
    ob_start();
    ?>
<div class="partner_form">
    <div class="content-box">
        <form method="post" id="partner-form" class="default-form" novalidate="novalidate">
            <input type='hidden' name='action' value='partneraction' />
            <div class="formMsg" style="display: none;"></div>
            <div class="form-group">
                <input type="text" name="name" id="name" placeholder="Name" required="" aria-required="true" maxlength="100">
                <p class='error'></p>
            </div>

            <div class="form-group">
                <input type="email" name="email" id="email" placeholder="Email" required="" aria-required="true" maxlength="100">
                <p class='error'></p>
            </div>
            <div class="form-group">
                <input type="text" name="phone" id="phone" placeholder="Phone" required="" aria-required="true"  maxlength="16">
                <p class='error'></p>
            </div>

            <div class="form-group">
                <input type="text" name="organisation" id="orgname" placeholder="Organisation name" required=""
                    aria-required="true" maxlength="50">
                <p class='error'></p>
            </div>

            <div class="form-group">
                <input type="text" name="address" id="address" placeholder="Address" required="" aria-required="true" maxlength="200">
                <p class='error'></p>
            </div>

            <div class="form-group">
                <textarea name="message" id="message" placeholder="Drop message here"  maxlength="500"></textarea>
            </div>

            <div class="form-group text-center mb-0">
                <button class="btn-get-started partner-submit" type="submit" name="submit-form">Submit Query</button>
                <div class="spinner-border" role="status" style="display: none;">
                    <span class="visually-hidden"></span>
                </div>
            </div>
        </form>
    </div>
</div>
<?php 
return ob_get_clean();
}
add_shortcode('PartnerForm','PartnerForm');



/*****************Team custom post type**********************/

function my_custom_post_team() {

    //labels array added inside the function and precedes args array
    
    $labels = array(
    'name' => _x( 'Teams', 'post type general name' ),
    'singular_name' => _x( 'Team', 'post type singular name' ),
    'add_new' => _x( 'Add New', 'Team' ),
    'add_new_item' => __( 'Add New Team' ),
    'edit_item' => __( 'Edit Team' ),
    'new_item' => __( 'New Team' ),
    'all_items' => __( 'All Teams' ),
    'view_item' => __( 'View Team' ),
    'search_items' => __( 'Search Teams' ),
    'not_found' => __( 'No Teams found' ),
    'not_found_in_trash' => __( 'No Teams found in the Trash' ),
    'parent_item_colon' => '',
    'menu_name' => 'Teams',
    );
    
    // args array
    
    $args = array(
    'labels' => $labels,
    'description' => 'Displays Teams and their profile',
    'public' => true,
    'menu_position' => 4,
    'menu_icon' =>'dashicons-id',
    'supports' => array( 'title', 'editor', 'thumbnail'),
    'has_archive' => true,
    );
    
    register_post_type( 'team', $args );
    }
    add_action( 'init', 'my_custom_post_team' );

function TeamsShow(){
    ob_start();

    $args = array(  
        'post_type' => 'team',
        'post_status' => 'publish',
        'posts_per_page' => -1, 
        'order' => 'ASC', 
    );

    $loop = new WP_Query( $args ); 

    if($loop):
    $i=1;
    while ( $loop->have_posts() ) : $loop->the_post(); 
    $title =get_the_title();
    $content = get_the_content();
    $imgUrl =get_the_post_thumbnail_url();
    $profile =get_field('profile_field');
    $designation =$profile['designation'];
    $facebook =$profile['facebook'];
    $instagram =$profile['instagram'];
    $linkedin =$profile['linkedin'];
    ?>

    <div class="profile-box modelOpen" id='<?php echo $i; ?>'>
        <div class="team-img">
             <img src='<?php echo $imgUrl ?>' alt='<?php echo $title ?>'>
        </div>
            <h3 class='' ><?php echo $title ?></h3>
    </div>

    <!-- Modal -->
    <div class="modal fade  overlay" id="exampleModal<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true" style='display:none'>
        
        <div class="modal-dialog modal-dialog-centered popup" role="document">

            <div class="modal-content">
            <span class='closeModel'><i class="fa fa-times" aria-hidden="true"></i></span>
                <div class="modal-body">
                    <div class=row>
                        <div class="col-4 col">
                        <img src='<?php echo $imgUrl ?>' alt='<?php echo $title ?>'>
                        </div>
                        <div class="col-8 col">
                            <h1><?php echo $title; ?></h1>
                            <span><?php echo $designation; ?></span>
                            <div class="icon-box">
                                <?php if($facebook){ ?>
                                    <a class="icon-view" href='<?php echo $facebook ?>' taget='_blank'><i class="fab fa-facebook-f"></i></a>
                                <?php } ?>

                                <?php if($instagram){ ?>
                                    <a class="icon-view" href='<?php echo $instagram ?>' taget='_blank'><i class="fab fa-instagram"></i></a>
                                <?php } ?>
                                <?php if($linkedin){ ?>
                                    <a class="icon-view" href='<?php echo $linkedin ?>' taget='_blank'><i class="fab fa-linkedin-in"></i></a>
                                <?php } ?>
                                
                                
                            </div>
                           
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col">
                           <div class="inner-box">
                               <?php echo $content; ?>
                           </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
<div class="body-over-lay"></div>
<?php $i++;
    endwhile;
    wp_reset_postdata();
    endif; ?>
<?php return ob_get_clean();
}
add_shortcode('Teams','TeamsShow');

/*****************Footer menu********************/
    function print_menu_shortcode($atts, $content = null) {
        extract(shortcode_atts(array( 'name' => null, ), $atts));
        return wp_nav_menu( array( 'menu' => $name, 'echo' => false ) );
    }
    add_shortcode('menu', 'print_menu_shortcode');
    