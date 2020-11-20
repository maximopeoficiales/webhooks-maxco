<?php

// function wmHome()
// {
//      return ["msg" => "fasdfasdf"];
// }

// add_action("rest_api_init", function () {
//      register_rest_route("webhooks-maxco/v1", "/hola", array(
//           "methods" => "GET",
//           "callback" => "wmHome",
//           'args'            => array(),
//      ));
// });

add_action('woocommerce_created_customer', 'action_woocommerce_created_customer', 10, 3);
/* webhook de registro de cliente */
function action_woocommerce_created_customer($customer_id, $new_customer_data, $password_generated)
{
     global $wpdb;
     $sql = "INSERT INTO wp_userssap (cd_cli,cod,date_created) VALUES ($customer_id,0,%s)";
     $wpdb->query($wpdb->prepare($sql, $new_customer_data->date_created));
     $wpdb->flush();
};
