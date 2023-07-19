<?php
/****************Theme Option*************/
add_action('admin_menu', 'bookuniversity_theme_page');
function bookuniversity_theme_page ()
{
	if ( count($_POST) > 0 && isset($_POST['save_clientImage']) )
	{     
        $cimg=    $_POST['clientImage'];
        $new =array();

        for($i=0; $i<count($cimg); $i++){
            if($cimg !=''){
                $new[$i]['clientImage'] = $cimg[$i];
            }
            
        }
        update_option('clientImage',$new);
	}

	add_menu_page(__('Theme Options'), __('Theme Options'), 'edit_themes', basename(__FILE__), 'bookuniversity_settings');
	//add_submenu_page(__('Theme Options'), __('Theme Options'), 'edit_themes', basename(__FILE__), 'sk_settings');
}

function bookuniversity_settings(){ ?>
   <h2>Theme Settings</h2>
    <?php
    $getOptionVal =get_option('clientImage'); 
    
    ?>
    <form method="post" action="" enctype="multipart/form-data">
	
	<fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px; float:left; width:100%;">
	<legend style="margin-left:5px; padding:0 5px;color:#2481C6; text-transform:uppercase;"><strong>Happy Clients.</strong></legend>
	<table class="form-table">
        <?php if(!empty($getOptionVal)){
            foreach ($getOptionVal as $key => $value) { ?>
            <tr valign="top" class='srow'>
                <th scope="row"><label for="officeadd">Client Image</label></th>
                <td class="w-75">
                    <div class='main-box'>
                    <div class='contentData'>
                
                    <?php if(!empty($value['clientImage'])){
                        echo  "<a class='button insertImage-soffice imgInsert' href='javascript:void(0)' style='display:none'>Add Image</a>";
                     }else{
                       echo  "<a class='button insertImage-soffice imgInsert' href='javascript:void(0)'>Add Image</a>";
                    } ?>
                    
                    <input type='hidden' name='clientImage[]' class='imgVal' value='<?php if(isset($value['clientImage'])){ echo $value['clientImage']; } ?>' /></div>
                    <div class='preview_img'>
                        <?php if(!empty($value['clientImage'])){
                             $imgUrl = wp_get_attachment_image_url( $value['clientImage'], array( 80, 80 ) ); ?>
                            <div class="removeDiv">
                                <img src="<?php echo $imgUrl; ?>">
                                <a class="removeImg" data-name="remove" href="#" title="Remove" data-ID="<?php echo $value['clientImage']; ?>">x</a>
                            </div>
                      <?php } ?>
                    </div>
                </div>
                </td>
               <?php  
                if($key==0){
                    continue;
                }else{
                    echo '<td><a  class="button remove" href="javascript:void(0)">Remove</a></td>';
                } ?>
            </tr>
        <?php }
        }else{ ?>
                <tr valign="top" class='srow'>
                    <th><label for="officeadd">Client Image </label></th>
                    <td>
                    <div class='main-box'>
                        <div class='contentData'>
                        <a class='button insertImage-soffice imgInsert' href='javascript:void(0)'>Add Image</a>
                        <input type='hidden' name='clientImage[]' class='imgVal' value='' /></div>
                        <div class='preview_img'></div>
                    </div>   
                    </td>
                </tr>
       <?php } ?>
		
        <tfoot>
            <tr>
                <td ></td>
                <td colspan="4" ><a id="office-row" class="button addRowTable" href="javascript:void(0)">Add Row</a></td>
            </tr>
        </tfoot>
	</table>
	</fieldset>
	<p class="submit">
 	   <input type="submit" name="Submit" class="button-primary" value="Save Changes" />
  	  <input type="hidden" name="save_clientImage" value="save" style="display:none;" />
    </p>
</form>
<style>
.main-box {
    display: flex;    
}
.form-table label {
	margin-left: 50px;
}
.removeDiv {
        max-width: 150px;
        max-height: 150px;
        display: flex;
        border: 1px solid;
        padding: 2px;
        position: relative;
    }

    .removeDiv img {
        width: 100%;
        object-fit: cover;
    }

    .removeDiv .removeImg {
	opacity: 0;
	position: absolute;
	top: -10px;
	right: 2px;
	font-size: 20px;
    color:red;
}

    .removeDiv:hover .removeImg {
        opacity: 1;
    }

</style>
<script type="text/javascript">
    jQuery('.addRowTable').click(function(){
        let iD =jQuery(this).attr('id');
       // if(iD =='office-row'){
            //let trLength =jQuery('.srow').length;
           // if(trLength < 4){
                let row =`
                <tr valign="top" class='srow'>
                <th><label for="officeadd">Client Image</label></th>
                <td>
                <div class='main-box'>
                    <div class='contentData'>
                    <a class='button insertImage-soffice imgInsert' href='javascript:void(0)'>Add Image</a>
                    <input type='hidden' name='clientImage[]' class='imgVal' value='' /></div>
                    <div class='preview_img'></div>
                </div>   
                </td>
                <td><a  class="button remove" href="javascript:void(0)">Remove</a></td>
            </tr>`;
            jQuery(this).parents('tfoot').siblings('tbody').append(row);
            // if(jQuery('.srow').length ==4){
            //     jQuery('#'+iD).hide();
            // }else{
            //     jQuery('#'+iD).show();
            // }
            // }else{
            //     jQuery('#'+iD).show();
            // }

        //}
    });

    jQuery(document).on('click','.remove',function(){
        jQuery(this).parents('tr').remove();
        if(jQuery(this).parents('tr').attr('class') =='srow'){
            jQuery('#office-row').show();
        }else{
            jQuery('#social-row').show();
        }
        
    });

    jQuery(document).on('click', '.insertImage-soffice', function() {
            let that = jQuery(this);
            var upload = wp.media({
                    title: 'Choose Image', //Title for Media Box
                    multiple: false, //For limiting multiple image
                    library: {
                        type: ['image']
                    },
                })
                .on('select', function() {
                    var select = upload.state().get('selection');
                    var attach = select.first().toJSON();

                    that.parent('.contentData').siblings('.preview_img').append(
                        '<div class="removeDiv"><img src="' + attach.url +
                        '"><a class="removeImg" data-name="remove" href="#" title="Remove" data-ID="' +
                        attach.id + '">x</a></div>');

                    that.parent('.contentData').siblings('.preview_img').show();

                    that.siblings('.imgVal').val(attach.id);
                    that.hide();
                })
                .open();
        });

        jQuery(document).on('click','.removeImg',function(e){
            e.preventDefault();
            jQuery(this).siblings('img').attr('src','');
            jQuery(this).parents('.preview_img').siblings('.contentData').find('.insertImage-soffice').show();
            jQuery(this).parents('.preview_img').siblings('.contentData').find('.imgVal').val('');
            jQuery(this).parents('.preview_img').find('.removeDiv').remove();
            jQuery(this).hide();
            

        });
	

</script>
<?php }
?>