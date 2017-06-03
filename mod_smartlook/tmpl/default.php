<?php
/**
 * Smartlook integration module.
 * 
 * @package   Smartlook
 * @author    Smartlook <vladimir@smartsupp.com>
 * @link      http://www.smartsupp.com
 * @copyright 2015 Smartsupp.com
 * @license   GPL-2.0+
 *
 * Plugin Name:       Smartlook
 * Plugin URI:        http://www.getsmartlook.com
 * Description:       Adds Smartlook code to Joomla.
 * Version:           1.0.0
 * Author:            Smartsupp
 * Author URI:        http://www.smartsupp.com
 * Text Domain:       smartlook
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */
?>

<?php
    defined('_JEXEC') or die;
    $user = JFactory::getUser();
?>

<?php
    if(empty($smartlook_code) || $smartlook_code=="0")
    {
        echo "<a href='https://www.getsmartlook.com' target='_blank'>Sign up Smartlook</a>";
    }
    else
    {
    ?>
        <div class="mod_smartlook">
    <?php
        echo $smartlook_code;
        if($user->guest)
        {
        } 
        else if($enableVariables==true && ($showName==true || $showEmail==true))
        {
            echo  "<script type=\"text/javascript\">";
            if($showName==true) {
                echo  "smartlook('tag', 'name', '".EncodeJScript($user->name)."');";
            }
            if($showEmail==true) {
                echo  "smartlook('tag', 'email', '".EncodeJScript($user->email)."');";
            }
            echo  "</script>";
        }
    ?>	
        </div>
    <?php
    }
?>