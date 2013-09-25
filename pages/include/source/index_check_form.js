/**
 * Created with JetBrains PhpStorm.
 * User: acer
 * Date: 3/2/13
 * Time: 9:07 PM
 * To change this template use File | Settings | File Templates.
 */

function check_form(){
    if ($(".user").text() == "" || $(".pass").text() == "")
        return false;
}