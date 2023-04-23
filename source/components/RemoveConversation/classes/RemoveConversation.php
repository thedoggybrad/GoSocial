<?php

/**
 * Open Source Social Network
 *
 * @package   RemoveConversation
 * @author    Rafael Amorim <amorim@rafaelamorim.com.br>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 * 
 * Parts of code in this component are from OssnChat and OssnMessage, created by 
 * @author    Open Social Website Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * 
 */


class RemoveConversation extends OssnMessages {

    /**
     * Get messages between two users, without limit 
     *
     * @params $from: User 1 guid
     *         $to: User 2 guid
     *
     * @return object
     */
    public function getAllWith($from, $to, $count = false) {
        $messages = $this->searchMessages(array(
            'wheres' => array(
                "((message_from='{$from}' AND message_to='{$to}' AND emd0.value='') OR (message_from='{$to}' AND message_to='{$from}' AND emd1.value=''))"
            ),
            'page_limit'=>false,
            'limit'=>0,
            'order_by' => 'm.id DESC',
            'offset' => input('offset_message_xhr_with', '', 1),
            'count' => $count,
            'entities_pairs' => array(
                array(
                    'name' => 'is_deleted_from', //we don't wanted to show messages which user have expunged from record
                    'value' => false,
                    'wheres' => '(emd0.value IS NOT NULL)',
                ),
                array(
                    'name' => 'is_deleted_to', //we don't wanted to show messages which user have expunged from record
                    'value' => false,
                    'wheres' => '(emd1.value IS NOT NULL)',
                ),
            ),
        ));
        if ($messages && !$count) {
            return array_reverse($messages);
        }
        return $messages;
    }

}
