<?php
/**
 * @package Bullet_Emphasis_Via_Shortcodes
 * @version 1.0
 */
/*
Plugin Name: Bullet_Emphasis_Via_Shortcodes
Plugin URI: https://github.com/bertsaper/WordPress-Short-Code-to-Add-CSS-Class-When-Element-is-Centered-Vertical
Description: Places jQuery code that adds and removes CSS class "active-bullet-emphasis" to HTML elements with the class "bullet-emphasis" when the element is in the middle of the screen via [BulletEmphasisJQuery] shortcode. Plugin does not include CSS definitions, which can be added to page or site. Shortcode must be placed after all "bullet-emphasis" elements. Important: The plugin will not function correctly if active-bullet-emphasis CSS changes the height of the element.
Author: Bert Saper
Version: 1.0
Author URI: http://saper.us
*/


   
/**
* Description: Places jQuery code that adds and removes CSS class 
* "active-bullet-emphasis" to HTML elements with the class "bullet-emphasis"
* when the element is in the middle of the screen via [BulletEmphasisJQuery] shortcode. 
* Plugin does not include CSS definitions, which can be added to page or site. Shortcode 
* must be placed after all "bullet-emphasis" elements.
* Original jQuery code is from https://jsfiddle.net/fa90a23u/ linked from
* https://stackoverflow.com/questions/38564156/get-the-element-closer-to-the-middle-of-the-screen-in-jquery
* answer by Brett Gregson.
* Important: The plugin will not function correctly if active-bullet-emphasis CSS changes the height of the element.
*/    
    
 
 function bullet_emphasis_jquery($atts, $content = null)
 {

    $output  = '<script>' . chr(10);
    $output  .= 'var intViewportHeight = window.innerHeight' . chr(10);
    $output  .= 'jQuery(function () {' . chr(10);
    $output  .= '    function closest(array, number) {' . chr(10);
    $output  .= '        var num = 0;' . chr(10);
    $output  .= '        for (var i = array.length - 1; i >= 0; i--) {' . chr(10);
    $output  .= '            if (Math.abs(number - array[i].position) < Math.abs(number - array[num].position)) {' . chr(10);
    $output  .= '                num = i;' . chr(10);
    $output  .= '            }' . chr(10);
    $output  .= '            var scrollTopForStop = jQuery(document).scrollTop();' . chr(10);
    $output  .= '            var orientation = screen.msOrientation || screen.mozOrientation || (screen.orientation || {}).type;' . chr(10);     
    $output  .= '            var positionScrollTopAdjustment = ""' . chr(10);      
    $output  .= '            if (orientation === "landscape-primary" || orientation === "landscape-secondary") {' . chr(10);
    $output  .= '                positionScrollTopAdjustment = 30;' . chr(10);
    $output  .= '            } else if (orientation === "portrait-primary" || orientation === "portrait-secondary") {' . chr(10);  
    $output  .= '                positionScrollTopAdjustment = (intViewportHeight - 30);' . chr(10);
    $output  .= '            } else if (orientation === undefined) {' . chr(10);       
    $output  .= '                positionScrollTopAdjustment = 30;' . chr(10);  
    $output  .= '            }' . chr(10);   
    $output  .= '            if (scrollTopForStop > (positionScrollTopAdjustment + array[array.length - 1].position)) {' . chr(10);
    $output  .= '                jQuery(window).off("scroll");' . chr(10);
    $output  .= '                jQuery(window).off("touchmove");' . chr(10);     
    $output  .= '            console.log("off") ;' . chr(10);  
    $output  .= '            }' . chr(10);
    $output  .= '        }' . chr(10);
    $output  .= '        return array[num].element;' . chr(10);
    $output  .= '    }' . chr(10);
    $output  .= '    function activateBullletEmphasis() {' . chr(10);
    $output  .= '        var scrollTop = jQuery(document).scrollTop() + (intViewportHeight / 2.5);' . chr(10);
    $output  .= '        var positions = [];' . chr(10);
    $output  .= '            jQuery(".bullet-emphasis").each(function () {' . chr(10);
    $output  .= '            jQuery(this).removeClass("active-bullet-emphasis");' . chr(10);
    $output  .= '            positions.push({' . chr(10);
    $output  .= '                position: jQuery(this).position().top,' . chr(10);
    $output  .= '                element: jQuery(this)' . chr(10);
    $output  .= '            });' . chr(10);
    $output  .= '            if (positions[0].position < scrollTop) {;' . chr(10);
    $output  .= '                var getClosest = closest(positions, scrollTop);' . chr(10);
    $output  .= '                getClosest.addClass("active-bullet-emphasis");' . chr(10);	 
    $output  .= '            }' . chr(10);     
    
    $output  .= '        })' . chr(10);
    $output  .= '    }' . chr(10);
    $output  .= '    jQuery(window).bind("scroll", function() {' . chr(10);
    $output  .= '        activateBullletEmphasis()' . chr(10);    
    $output  .= '    });' . chr(10);
    $output  .= '    jQuery(window).bind("touchmove", function() {' . chr(10);
    $output  .= '        activateBullletEmphasis()' . chr(10);
    $output  .= '    })' . chr(10);	 
    $output  .= '});' . chr(10);
    
    $output .= '</script>' . chr(10);
    
    return $output;
}
add_shortcode('BulletEmphasisJQuery', 'bullet_emphasis_jquery');
?>
