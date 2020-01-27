<?php
/**
 * @package Schedule an Walk-In / Mobile Appointment Form
 * @version 1.0.0
 */
/*
Plugin Name: Schedule an Walk-In / Mobile Appointment Form
Description: Walk-In / Mobile Appointment Form based on attribute. Usage [schedule_walkin_mobile_appointment_form form="mobile" action_url="..."]...[/schedule_walkin_mobile_appointment_form] or [schedule_walkin_mobile_appointment_form form="waklin" action_url="..."]...[/schedule_walkin_mobile_appointment_form]
Author: Selahattin Toprak
Version: 1.0.0
Author URI: https://selahattin.dev
*/

function schedule_walkin_mobile_appointment_form_shortcode_wp_enqueue_scripts() {
    wp_register_style( 'schedule-walkin-mobile-appointment-form-style', plugins_url( '/style.css', __FILE__ ), array(), '1.0.0', 'all' );
}

add_action( 'wp_enqueue_scripts', 'schedule_walkin_mobile_appointment_form_shortcode_wp_enqueue_scripts' );

function schedule_walkin_mobile_appointment_form_shortcode( $atts, $content ) { 
    ob_start();
    $atts = (array) $atts;
    if ( array_key_exists( "form", $atts ) && array_key_exists( "action_url", $atts )){
        wp_enqueue_style( 'schedule-walkin-mobile-appointment-form-style' );
        
        
?>

        <div class="flex-container-row form-continer">
<?php if(function_exists( 'is_amp_endpoint' ) && is_amp_endpoint()){?>
            <form class="flex-container-col" method="POST"
                action-xhr="<?php echo esc_attr( $atts['action_url'] );  ?>" target="_top">
<?php
}
else {
?>
<script>
"use strict";
function submitForm(oFormElement)
{
    var xhr = new XMLHttpRequest();
    xhr.onload = function(){ 
      document.getElementById("submit-success").innerHTML="Succes!" 
      document.getElementById("submit-button").disabled=true;
    }
    xhr.open(oFormElement.method, oFormElement.getAttribute("action"));
    xhr.send(new FormData(oFormElement));
    return false;
}
</script>
            <form id="my-form-id" class="flex-container-col" method="POST" onsubmit="return submitForm(this);" 
                action="<?php echo esc_attr( $atts['action_url'] );  ?>" target="_top">
<?php
}
?>
                <div class="flex-container-row">
                    <fieldset>
                        <div class="fields">
                            <label for="name">Name <span class="forms-req-symbol">*</span></label>
                            <input placeholder="Enter Your Name" type="text" name="name" required>
<?php
 if (array_key_exists("form", $atts) && array_key_exists("action_url", $atts) && $atts['form'] == "mobile") {
?>
                            <label for="address">Address <span class="forms-req-symbol">*</span></label>
                            <input placeholder="Enter Your Address" type="text" name="address" required>
                            <label for="zipCode">Zip Code <span class="forms-req-symbol">*</span></label>
                            <input placeholder="Enter Your Zip Code" type="number" name="zipCode" required>
<?php
 }
?>
                          
                            <label for="email">Email Address <span class="forms-req-symbol">*</span></label>
                            <input placeholder="Enter Your Email Address" type="email" name="email" required>
                            <label for="phone">Phone Number <span class="forms-req-symbol">*</span></label>
                            <input placeholder="Enter Your Phone Number" type="text" name="phone" required>
                        
                        
<?php
    if (array_key_exists("form", $atts) && array_key_exists("action_url", $atts) && $atts['form'] == "walkin") {
?>
                            <label for="location">Location <span class="forms-req-symbol">*</span></label>
                        
                                <select name="location" required class="select-css">
                                    <option value selected="selected">Select a Location</option>
                                    <option value="Santee">Santee</option>
                                    <option value="Mission Valley">Mission Valley</option>
                                    <option value="San Diego (Miramar)">San Diego (Miramar)</option>
                                    <option value="Carlsbad">Carlsbad</option>
                                    <option value="El Cajon">El Cajon</option>
                                    <option value="Encinitas">Encinitas</option>
                                    <option value="Mobile Service">Mobile Service</option>
                                </select>
                         
<?php
    }
?>
                        
                           
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="fields">
                            <label for="date">Date <span class="forms-req-symbol">*</span></label>
                            <input name="date" type="date" value="">
                            <label for="time">Time <span class="forms-req-symbol">*</span></label>
                            <div class="selectdiv">
                                <select name="time" required class="select-css">
                                    <option value="Select Time">Select Time</option>
                                    <option value="9:00">9:00 AM</option>
                                    <option value="9:30">9:30 AM</option>
                                    <option value="10:00">10:00 AM</option>
                                    <option value="10:30">10:30 AM</option>
                                    <option value="11:00">11:00 AM</option>
                                    <option value="11:30">11:30 AM</option>
                                    <option value="12:00">12:00 AM</option>
                                    <option value="12:30">12:30 PM</option>
                                    <option value="13:00">1:00 PM</option>
                                    <option value="13:30">1:30 PM</option>
                                    <option value="14:00">2:00 PM</option>
                                    <option value="14:30">2:30 PM</option>
                                    <option value="15:00">3:00 PM</option>
                                    <option value="15:30">3:30 PM</option>
                                    <option value="16:00">4:00 PM</option>
                                    <option value="16:30">4:30 PM</option>
                                    <option value="17:00">5:00 PM</option>
                                    <option value="17:30">5:30 PM</option>
                                    <option value="18:00">6:00 PM</option>
                                    <option value="18:30">6:30 PM</option>
                                </select>
                            </div>

                            <label for="deviceType">Type of Device <span class="forms-req-symbol">*</span></label>
                            <div class="selectdiv">
                                <select name="deviceType" required class="select-css">
                                    <option value selected="selected">Select Type of Device for Repair</option>
                                    <option value="iphone">iPhone</option>
                                    <option value="ipad">iPad</option>
                                    <option value="samsung-galaxy-phone">Samsung Galaxy Phone</option>
                                </select>
                            </div>

                            <label for="message">Message <span class="forms-req-symbol">*</span></label>
                            <textarea name="message" cols="30" rows="10" required></textarea>
                        </div>
                    </fieldset>
                </div>
                <fieldset class="flex-container-center">
                    <div class="fields">
                        <input type="submit" id="submit-button" value="Submit">
                        <div id="submit-success"></div>
                        <div submit-success>
                            <template type="amp-mustache">
                                Subscription successful!
                            </template>
                        </div>
                        <div submit-error>
                            <template type="amp-mustache">
                                Subscription failed!
                            </template>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>

<?php
return ob_get_clean();
    }
}
add_shortcode( 'schedule_walkin_mobile_appointment_form', 'schedule_walkin_mobile_appointment_form_shortcode' );