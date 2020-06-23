<?php
	
    $qry="SELECT * FROM tbl_settings where id='1'";
    $result=mysqli_query($mysqli,$qry);
    $settings_row=mysqli_fetch_assoc($result);

    $cat_qry="SELECT * FROM tbl_category ORDER BY category_name";
    $cat_result=mysqli_query($mysqli,$cat_qry); 


  if(isset($_POST['submit'])){
    $img_res=mysqli_query($mysqli,"SELECT * FROM tbl_settings WHERE id='1'");
    $img_row=mysqli_fetch_assoc($img_res);
    
    if($_FILES['app_logo']['name']!=""){        
        unlink('images/'.$img_row['app_logo']);   
        
        $app_logo=$_FILES['app_logo']['name'];
        $pic1=$_FILES['app_logo']['tmp_name'];
        
        $tpath1='images/'.$app_logo;      
        copy($pic1,$tpath1);
        
        $data = array(      
            'email_from'  =>  '-',    
            'app_name'  =>  $_POST['app_name'],
            'app_logo'  =>  $app_logo,  
            'app_description'  => addslashes($_POST['app_description']),
            'app_version'  =>  $_POST['app_version'],
            'app_author'  =>  $_POST['app_author'],
            'app_contact'  =>  $_POST['app_contact'],
            'app_email'  =>  $_POST['app_email'],   
            'app_website'  =>  $_POST['app_website'],
            'app_developed_by'  =>  $_POST['app_developed_by'],
            'status'  =>  $_POST['status'],
            'app_privacy_policy'  =>  addslashes($_POST['app_privacy_policy'])
        );
    
    }else{
    
        $data = array(
            'email_from'  =>  '-',     
            'app_name'  =>  $_POST['app_name'],
            'app_description'  => addslashes($_POST['app_description']),
            'app_version'  =>  $_POST['app_version'],
            'app_author'  =>  $_POST['app_author'],
            'app_contact'  =>  $_POST['app_contact'],
            'app_email'  =>  $_POST['app_email'],   
            'app_website'  =>  $_POST['app_website'],
            'app_developed_by'  =>  $_POST['app_developed_by'],
            'status'  =>  $_POST['status'],
            'app_privacy_policy'  =>  addslashes($_POST['app_privacy_policy'])
        );
    } 
    
    $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");
    
    $_SESSION['msg']="11";
    header( "Location:settings.php");
    exit;
 
  }

   if(isset($_POST['verify_package_name'])){
        $data = array(
            'purchase_code' => $_POST['purchase_code'],
            'nemosofts_key' => $_POST['nemosofts_key'],
            'package_name' => $_POST['package_name']
        );
        
        $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");
        
        $_SESSION['msg']="11";
        header( "Location:settings.php");
        exit;
  }

  if(isset($_POST['admob_submit'])){
        $data = array(
            'publisher_id'  =>  $_POST['publisher_id'],
            'interstital_ad'  =>  $_POST['interstital_ad'],
            'interstital_ad_id'  =>  $_POST['interstital_ad_id'],
            'interstital_ad_click'  =>  $_POST['interstital_ad_click'],
            'banner_ad'  =>  $_POST['banner_ad'],
            'banner_ad_id'  =>  $_POST['banner_ad_id'],
            'facebook_interstital_ad'  =>  $_POST['facebook_interstital_ad'],
            'facebook_interstital_ad_id'  =>  $_POST['facebook_interstital_ad_id'],
            'facebook_interstital_ad_click'  =>  $_POST['facebook_interstital_ad_click'],
            'facebook_banner_ad'  =>  $_POST['facebook_banner_ad'],
            'facebook_banner_ad_id'  =>  $_POST['facebook_banner_ad_id']
        );
        
        $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");
        
        $_SESSION['msg']="11";
        header( "Location:settings.php");
        exit;
  }

  if(isset($_POST['notification_submit'])){
        $data = array(
            'onesignal_app_id' => $_POST['onesignal_app_id'],
            'onesignal_rest_key' => $_POST['onesignal_rest_key'],
        );
        
        $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");
        
        $_SESSION['msg']="11";
        header( "Location:settings.php");
        exit;
    }

    if(isset($_POST['home_submit'])){
        $data = array(
            'api_home_latest_cat_id'  =>  $_POST['cat_id']
        );
        
        $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");
        
        if ($settings_edit > 0){
        $_SESSION['msg']="11";
        header( "Location:settings.php");
        exit;
        }   
     
      }

    if(isset($_POST['submit_subscription'])){
           
        $data = array(
            'in_app' => $_POST['in_app'],
            'subscription_id' => $_POST['subscription_id'],
            'merchant_key' => $_POST['merchant_key'],
            'subscription_days' => $_POST['subscription_days']
        );
        
        $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");
        
        $_SESSION['msg']="11";
        header( "Location:settings.php");
        exit;
    }
    
    if(isset($_POST['api_submit'])){
        $data = array(
            'api_latest_limit'  =>  $_POST['api_latest_limit'],
            'api_cat_order_by'  =>  $_POST['api_cat_order_by'],
            'api_cat_post_order_by'  =>  $_POST['api_cat_post_order_by'] 
        );
        
        $settings_edit=Update('tbl_settings', $data, "WHERE id = '1'");
        
        if ($settings_edit > 0){
        $_SESSION['msg']="11";
        header( "Location:settings.php");
        exit;
        }   
    }
?>