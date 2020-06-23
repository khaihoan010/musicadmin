<?php include("includes/header.php");

	require("includes/function.php");
	require("language/language.php");
 	include("check/settings.php");
?>

<Style>.admob_title_my {
    /* background: #1782de; */
    border: 1px solid #1782df6e;
    background-color: #f8f9fa;
    text-align: center;
    padding: 15px 10px;
    width: 100%;
    color: #1782de;
    font-size: 20px;
    font-weight: 500;
    position: relative;
    margin-bottom: 40px;
}
.col-md-6.my {
    border-left: 1px solid #1782df6e;
}</Style>
 
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="page_title_block">
                <div class="page_title">Settings</div>
            </div>
            <div class="clearfix"></div>
            <div class="row mrg-top">
                <div class="col-md-12">
                    <div class="col-md-12 col-sm-12">
                        <?php if(isset($_SESSION['msg'])){?> 
                            <div class="alert alert-success alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <?php echo $client_lang[$_SESSION['msg']] ; ?></a> </div>
                        <?php unset($_SESSION['msg']);}?> 
                    </div>
                </div>
            </div>
            <div class="card-body mrg_bottom">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#verify_package_name" aria-controls="verify_package_name" role="tab" data-toggle="tab">Package Name</a></li>
                    <li role="presentation"><a href="#in-app" aria-controls="in-app" role="tab" data-toggle="tab">In-App Purchases</a></li>
                    <li role="presentation"><a href="#app_settings" aria-controls="app_settings" role="tab" data-toggle="tab">App Settings</a></li>
                    <li role="presentation"><a href="#notification_settings" aria-controls="notification_settings" role="tab" data-toggle="tab">Notification Settings</a></li>
                    <li role="presentation"><a href="#home_settings" aria-controls="home_settings" role="tab" data-toggle="tab">Home Settings</a></li>
                    <li role="presentation"><a href="#api_settings" aria-controls="api_settings" role="tab" data-toggle="tab">API Settings</a></li>
                    <li role="presentation"><a href="#admob_settings" aria-controls="admob_settings" role="tab" data-toggle="tab">Ads Settings</a></li>
                </ul>
                
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="verify_package_name">
                        <form action="" name="verify_package_name" method="post" class="form form-horizontal" enctype="multipart/form-data" id="api_form">
                            <div class="section">
                                <div class="section-body">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Item Purchase Code :-
                                            <p class="control-label-help">(<a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code" target="_blank">Where Is Item Purchase Code?</a>)</p>
                                        </label>
                                        <div class="col-md-6">
                                            <input type="text" name="purchase_code" id="purchase_code" value="<?php echo $settings_row['purchase_code'];?>" class="form-control" placeholder="xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx">
                                        </div>
                                    </div>  
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Nemosofts Key :-
                                            <p class="control-label-help">(<a href="http://apps.nemosofts.com/envato-purchase/" target="_blank">Get Nemosofts Key</a>)</p>
                                        </label>
                                        <div class="col-md-6">
                                            <input type="text" name="nemosofts_key" id="nemosofts_key" value="<?php echo $settings_row['nemosofts_key'];?>" class="form-control" placeholder="xxxxxxxxxx-xxxxxxxxxx-xxxxxxxxxx">
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Android Package Name :-</label>
                                        <div class="col-md-6">
                                            <input type="text" name="package_name" id="package_name" value="<?php echo $settings_row['package_name'];?>" class="form-control" placeholder="com.andorid.name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-9 col-md-offset-3">
                                            <button type="submit" name="verify_package_name" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="in-app">	  
                        <form action="" name="settings_from" method="post" class="form form-horizontal" enctype="multipart/form-data">
                            <div class="section">
                                <div class="section-body">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">In-App Purchasing</label>
                                        <div class="col-md-6">
                                            <select name="in_app" id="in_app" class="select2">
                                                <option value="true" <?php if($settings_row['in_app']=='true'){?>selected<?php }?>>True</option>
                                                <option value="false" <?php if($settings_row['in_app']=='false'){?>selected<?php }?>>False</option>
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">SUBSCRIPTION ID</label>
                                        <div class="col-md-6">
                                            <input type="text" name="subscription_id" id="subscription_id" value="<?php echo $settings_row['subscription_id'];?>" class="form-control" placeholder="PUT YOUR SUBSCRIPTION ID">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">MERCHANT KEY</label>
                                        <div class="col-md-6">
                                            <input type="text" name="merchant_key" id="merchant_key" value="<?php echo $settings_row['merchant_key'];?>" class="form-control" placeholder="PUT YOUR MERCHANT KEY HERE">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">SUBSCRIPTION DURATION </label>
                                        <div class="col-md-6">
                                            <input type="text" name="subscription_days" id="subscription_days" value="<?php echo $settings_row['subscription_days'];?>" class="form-control" placeholder="PUT SUBSCRIPTION DURATION DAYS HERE">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-9 col-md-offset-3">
                                            <button type="submit" name="submit_subscription" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    <div role="tabpanel" class="tab-pane" id="app_settings">	  
                        <form action="" name="settings_from" method="post" class="form form-horizontal" enctype="multipart/form-data">
                            <div class="section">
                                <div class="section-body">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Dark and Light Mode</label>
                                        <div class="col-md-6">  
                                            <select name="status" id="status"  class="select2">
                                                <option value="1" <?php if($settings_row['status']=='1'){?>selected<?php }?>>Dark Mode</option>
                                                <option value="0" <?php if($settings_row['status']=='0'){?>selected<?php }?>>Light Mode</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">App Name :-</label>
                                        <div class="col-md-6">
                                            <input type="text" name="app_name" id="app_name" value="<?php echo $settings_row['app_name'];?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">App Logo :-</label>
                                        <div class="col-md-6">
                                            <div class="fileupload_block">
                                                <input type="file" name="app_logo" id="fileupload">
                                                <?php if($settings_row['app_logo']!="") {?>
                                                    <div class="fileupload_img"><img type="image" src="images/<?php echo $settings_row['app_logo'];?>" alt="image" style="width: 100px;height: 100px"/></div>
                                                <?php } else {?>
                                                    <div class="fileupload_img"><img type="image" src="assets/images/add-image.png" alt="image" /></div>
                                                <?php }?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">App Description :-</label>
                                        <div class="col-md-6">
                                            <textarea name="app_description" id="app_description" class="form-control"><?php echo stripslashes($settings_row['app_description']);?></textarea>
                                            <script>CKEDITOR.replace( 'app_description' );</script>
                                        </div>
                                    </div>
                                    <div class="form-group">&nbsp;</div>                 
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">App Version :-</label>
                                        <div class="col-md-6">
                                            <input type="text" name="app_version" id="app_version" value="<?php echo $settings_row['app_version'];?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Author :-</label>
                                        <div class="col-md-6">
                                            <input type="text" name="app_author" id="app_author" value="<?php echo $settings_row['app_author'];?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Contact :-</label>
                                        <div class="col-md-6">
                                            <input type="text" name="app_contact" id="app_contact" value="<?php echo $settings_row['app_contact'];?>" class="form-control">
                                        </div>
                                    </div>     
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Email :-</label>
                                        <div class="col-md-6">
                                            <input type="text" name="app_email" id="app_email" value="<?php echo $settings_row['app_email'];?>" class="form-control">
                                        </div>
                                    </div>                 
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Website :-</label>
                                        <div class="col-md-6">
                                            <input type="text" name="app_website" id="app_website" value="<?php echo $settings_row['app_website'];?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Developed By :-</label>
                                        <div class="col-md-6">
                                            <input type="text" name="app_developed_by" id="app_developed_by" value="<?php echo $settings_row['app_developed_by'];?>" class="form-control">
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">App Privacy Policy :-</label>
                                        <div class="col-md-6">
                                            <textarea name="app_privacy_policy" id="privacy_policy" class="form-control"><?php echo stripslashes($settings_row['app_privacy_policy']);?></textarea>
                                            <script>CKEDITOR.replace( 'privacy_policy' );</script>
                                        </div>
                                    </div>
                                    </br>
                                    </br>
                                    <div class="form-group">
                                        <div class="col-md-9 col-md-offset-3">
                                            <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    <div role="tabpanel" class="tab-pane" id="notification_settings">
                        <form action="" name="settings_api" method="post" class="form form-horizontal" enctype="multipart/form-data" id="api_form">
                            <div class="section">
                                <div class="section-body">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">OneSignal App ID :-</label>
                                        <div class="col-md-6">
                                            <input type="text" name="onesignal_app_id" id="onesignal_app_id" value="<?php echo $settings_row['onesignal_app_id'];?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">OneSignal Rest Key :-</label>
                                        <div class="col-md-6">
                                            <input type="text" name="onesignal_rest_key" id="onesignal_rest_key" value="<?php echo $settings_row['onesignal_rest_key'];?>" class="form-control">
                                        </div>
                                    </div>              
                                    <div class="form-group">
                                        <div class="col-md-9 col-md-offset-3">
                                            <button type="submit" name="notification_submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    

                    <div role="tabpanel" class="tab-pane" id="home_settings">   
                        <form action="" name="settings_api" method="post" class="form form-horizontal" enctype="multipart/form-data">
                            <div class="section">
                                <div class="section-body">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-5 control-label">Home Songs category:-</label>
                                            <div class="col-md-6">
                                                <select name="cat_id" id="cat_id" class="select2" required>
                                                    <option value=""><?php echo $settings_row['api_home_latest_cat_id'];?></option>
                                                    <?php
                                                    while($cat_row=mysqli_fetch_array($cat_result))
                                                    {
                                                    ?>      
                                                    <option value="<?php echo $cat_row['cid'];?>" <?php if($cat_row['cid']==$settings_row['api_home_latest_cat_id']){?>selected<?php }?>><?php echo $cat_row['category_name'];?></option>	   
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                    <div class="col-md-9 col-md-offset-3">
                                    <button type="submit" name="home_submit" class="btn btn-primary">Save</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div> 
                    
                    
                    <div role="tabpanel" class="tab-pane" id="api_settings">   
                        <form action="" name="settings_api" method="post" class="form form-horizontal" enctype="multipart/form-data">
                            <div class="section">
                                <div class="section-body">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-5 control-label">Latest Limit:-</label>
                                            <div class="col-md-6">
                                                <input type="number" name="api_latest_limit" id="api_latest_limit" value="<?php echo $settings_row['api_latest_limit'];?>" class="form-control"> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-5 control-label">Category List Order By:-</label>
                                            <div class="col-md-6">
                                                <select name="api_cat_order_by" id="api_cat_order_by" class="select2">
                                                    <option value="cid" <?php if($settings_row['api_cat_order_by']=='cid'){?>selected<?php }?>>ID</option>
                                                    <option value="category_name" <?php if($settings_row['api_cat_order_by']=='category_name'){?>selected<?php }?>>Name</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-5 control-label">Category Post Order:-</label>
                                            <div class="col-md-6">
                                                <select name="api_cat_post_order_by" id="api_cat_post_order_by" class="select2">
                                                    <option value="ASC" <?php if($settings_row['api_cat_post_order_by']=='ASC'){?>selected<?php }?>>ASC</option>
                                                    <option value="DESC" <?php if($settings_row['api_cat_post_order_by']=='DESC'){?>selected<?php }?>>DESC</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-9 col-md-offset-3">
                                            <button type="submit" name="api_submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div> 
                    
                    
                    <div role="tabpanel" class="tab-pane" id="admob_settings">   
                        <form action="" name="admob_settings" method="post" class="form form-horizontal" enctype="multipart/form-data">
                            <div class="section">
                                <div class="section-body">            
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-6">          
                                                <div class="col-md-12">
                                                    <div class="admob_title_my">Admob</div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Publisher ID :-</label>
                                                        <div class="col-md-9">
                                                            <input type="text" name="publisher_id" id="publisher_id" value="<?php echo $settings_row['publisher_id'];?>" class="form-control">
                                                        </div>
                                                        <div style="height:60px;display:inline-block;position:relative"></div>
                                                    </div>
                                                    <div class="banner_ads_block">
                                                        <div class="banner_ad_item">
                                                            <label class="control-label">Admob Banner Ads:-</label>                                  
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="col-md-3 control-label">Banner Ad:-</label>
                                                                <div class="col-md-9">
                                                                    <select name="banner_ad" id="banner_ad" class="select2">
                                                                        <option value="true" <?php if($settings_row['banner_ad']=='true'){?>selected<?php }?>>True</option>
                                                                        <option value="false" <?php if($settings_row['banner_ad']=='false'){?>selected<?php }?>>False</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-md-3 control-label mr_bottom20">Banner ID :-</label>
                                                                <div class="col-md-9">
                                                                    <input type="text" name="banner_ad_id" id="banner_ad_id" value="<?php echo $settings_row['banner_ad_id'];?>" class="form-control">
                                                                </div>
                                                            </div>                    
                                                        </div>
                                                    </div>  
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="interstital_ads_block">
                                                        <div class="interstital_ad_item">
                                                            <label class="control-label">Admob Interstital Ads :-</label>             
                                                        </div>  
                                                        <div class="col-md-12"> 
                                                            <div class="form-group">
                                                                <label class="col-md-3 control-label">Interstital :-</label>
                                                                <div class="col-md-9">
                                                                    <select name="interstital_ad" id="interstital_ad" class="select2">
                                                                        <option value="true" <?php if($settings_row['interstital_ad']=='true'){?>selected<?php }?>>True</option>
                                                                        <option value="false" <?php if($settings_row['interstital_ad']=='false'){?>selected<?php }?>>False</option>
                                                                    </select> 
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-md-3 control-label mr_bottom20">Interstital ID :-</label>
                                                                <div class="col-md-9">
                                                                    <input type="text" name="interstital_ad_id" id="interstital_ad_id" value="<?php echo $settings_row['interstital_ad_id'];?>" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-md-3 control-label mr_bottom20">Interstital Clicks :-</label>
                                                                <div class="col-md-9">
                                                                    <input type="text" name="interstital_ad_click" id="interstital_ad_click" value="<?php echo $settings_row['interstital_ad_click'];?>" class="form-control">
                                                                </div>
                                                            </div>                    
                                                        </div>                  
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 my">                
                                                <div class="col-md-12">
                                                    <div class="admob_title_my">Facebook</div>
                                                    <div class="banner_ads_block">
                                                        <div class="banner_ad_item">
                                                            <label class="control-label">Facebook Banner Ads :-</label>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="col-md-3 control-label">Facebook Banner Ad:-</label>
                                                                <div class="col-md-9">
                                                                    <select name="facebook_banner_ad" id="facebook_banner_ad" class="select2">
                                                                        <option value="true" <?php if($settings_row['facebook_banner_ad']=='true'){?>selected<?php }?>>True</option>
                                                                        <option value="false" <?php if($settings_row['facebook_banner_ad']=='false'){?>selected<?php }?>>False</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-md-3 control-label mr_bottom20">Facebook Banner ID :-</label>
                                                                <div class="col-md-9">
                                                                    <input type="text" name="facebook_banner_ad_id" id="facebook_banner_ad_id" value="<?php echo $settings_row['facebook_banner_ad_id'];?>" class="form-control">
                                                                </div>
                                                            </div>                    
                                                        </div>
                                                    </div>  
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="interstital_ads_block">
                                                        <div class="interstital_ad_item">
                                                            <label class="control-label">Facebook Interstital Ads :-</label>             
                                                        </div>  
                                                        <div class="col-md-12"> 
                                                            <div class="form-group">
                                                                <label class="col-md-3 control-label">Facebook Interstital :-</label>
                                                                <div class="col-md-9">
                                                                    <select name="facebook_interstital_ad" id="facebook_interstital_ad" class="select2">
                                                                        <option value="true" <?php if($settings_row['facebook_interstital_ad']=='true'){?>selected<?php }?>>True</option>
                                                                        <option value="false" <?php if($settings_row['facebook_interstital_ad']=='false'){?>selected<?php }?>>False</option>
                                                                    </select> 
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-md-3 control-label mr_bottom20">Facebook Interstital ID :-</label>
                                                                <div class="col-md-9">
                                                                    <input type="text" name="facebook_interstital_ad_id" id="facebook_interstital_ad_id" value="<?php echo $settings_row['facebook_interstital_ad_id'];?>" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-md-3 control-label mr_bottom20">Facebook Interstital Clicks :-</label>
                                                                <div class="col-md-9">
                                                                    <input type="text" name="facebook_interstital_ad_click" id="facebook_interstital_ad_click" value="<?php echo $settings_row['facebook_interstital_ad_click'];?>" class="form-control">
                                                                </div>
                                                            </div>                    
                                                        </div>                  
                                                    </div> 
                                                </div>
                                            </div> 
                                        </div> 
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-9">
                                            <button type="submit" name="admob_submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                
                </div>   
            </div>
        </div>
    </div>
</div>

        
<?php include("includes/footer.php");?>       

<script type="text/javascript">
  $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
    localStorage.setItem('activeTab', $(e.target).attr('href'));
  });

  var activeTab = localStorage.getItem('activeTab');
  if(activeTab){
    $('.nav-tabs a[href="' + activeTab + '"]').tab('show');
  }
</script>