<?php

/**
 * Open Source Social Network
 *
 * @package   RemoveConversation
 * @author    Rafael Amorim <amorim@rafaelamorim.com.br>
 * @copyright (C) Rafael Amorim
 * @license   OSSNv4  http://www.opensource-socialnetwork.org/licence/
 * @link      https://www.rafaelamorim.com.br/
 */

header('Content-Type: application/json');
$id = input('id');
$type = input('type');
$user = input('user');
$userguid = ossn_loggedin_user()->guid;

if ((!$id) || ($user != $userguid)) {
    echo json_encode(array(
        'type' => $type,
        'status' => 0,
    ));
    exit;
}
$RemoveConversation = new RemoveConversation;
$allMessages = $RemoveConversation->getAllWith($userguid, $id);
foreach ($allMessages as $message) {
    if ($type == 'me' && $message->message_from == $userguid) {
        $message->data->is_deleted_from = true;
        if (!$message->save()) {
            error_log("Error-if1-150220221527");
            echo json_encode(array(
                'type' => $type,
                'status' => 0,
            ));
            exit;
        }
    }
    if ($type == 'me' && $message->message_to == $userguid) {
        $message->data->is_deleted_to = true;
        if (!$message->save()) {
            error_log("Error-if2-150220221528");
            echo json_encode(array(
                'type' => $type,
                'status' => 0,
            ));
            exit;
        }
    }
}

echo json_encode(array(
    'type' => $type,
    'status' => true,
    'id' => $id,
));
exit;
