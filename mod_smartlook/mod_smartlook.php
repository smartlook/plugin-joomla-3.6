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
defined('_JEXEC') or die('Restricted access');

$smartlook_code = $params->get('smartlook_code', '');
$smartlook_variables = $params->get('smartlook_variables', '');
$smartlook_name = $params->get('smartlook_name', '');
$smartlook_email = $params->get('smartlook_email', '');

$enableVariables = false;
if($smartlook_variables == "yes")
{
    $enableVariables = true;
}

$showName = false;
if($smartlook_name == "yes")
{
    $showName = true;
}

$showEmail = false;
if($smartlook_email == "yes")
{
    $showEmail = true;
}

require(JModuleHelper::getLayoutPath('mod_smartlook'));

function EncodeJScript($str)
{
    $chars="0123456789ABCDEF";
    $chars = str_split($chars);

    $sb = "";
    $l = strlen($str);
    $strarr = str_split($str);
    for ($i = 0; $i < $l; $i++)
    {
        $c = $strarr[$i];
        if ($c == '\\' || $c == '"' || $c == '\'' || $c == '>' || $c == '<' || $c == '&' || $c == '\r' || $c == '\n')
        {
            if ($sb == "")
            {
                if ($i > 0)
                {
                    $sb .= substr($str, 0, $i);
                }
            }
            if ($c == '\\')
            {
                $sb.="\\x5C";
            }
            else if ($c == '"')
            {
                $sb.="\\x22";
            }
            else if ($c == '\'')
            {
                $sb.="\\x27";
            }
            else if ($c == '\r')
            {
                $sb.="\\x0D";
            }
            else if ($c == '\n')
            {
                $sb.="\\x0A";
            }
            else if ($c == '<')
            {
                $sb.="\\x3C";
            }
            else if ($c == '>')
            {
                $sb.="\\x3E";
            }
            else if ($c == '&')
            {
                $sb.="\\x26";
            }
            else
            {
                $code = $c;
                $a1 = $code & 0xF;
                $a2 = ($code & 0xF0) / 0x10;
                $sb.="\\x";
                $sb.=$chars[$a2];
                $sb.=$chars[$a1];
            }
        }
        else if ($sb != "")
        {
            $sb .= $c;
        }
    }
    if ($sb != "")
        return $sb;
    return $str;
}
?>