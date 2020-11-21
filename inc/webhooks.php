<?php
date_default_timezone_set('America/Lima');
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

/* hook de registro de cliente */
add_action('user_register', 'wmUser_register', 10, 3);
function wmUser_register($user_id)
{
     global $wpdb;
     $fecha_actual = date("Y-m-d H:i:s");
     $sql = "INSERT INTO wp_userssap (user_id,cod,date_created) VALUES ($user_id,0,%s)";
     $wpdb->query($wpdb->prepare($sql, $fecha_actual));
     $wpdb->flush();
};

// hook de actualizacion de clientes
add_action('profile_update', 'wmUser_update', 10, 3);
function wmUser_update($user_id, $old_user_data)
{
     global $wpdb;
     $sql = "UPDATE wp_userssap SET cod = 1 WHERE user_id =$user_id";
     $wpdb->query($sql);
     $wpdb->flush();
}

//opcionalmente si se elimina usuario
add_action('delete_user', 'wmDelete_user');
function wmDelete_user($user_id)
{
     global $wpdb;
     $sql = "DELETE FROM wp_userssap WHERE user_id = $user_id";
     $wpdb->query($sql);
     $wpdb->flush();
}
