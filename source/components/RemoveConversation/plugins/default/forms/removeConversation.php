<div class="ossn-privacy">
    <?php
    $options = array(
        'me' => ossn_print('ossnmessages:delete:me') . ' (' . ossn_print('removeconversation:note') . ')',
    );
    echo ossn_plugin_view('input/radio', array(
        'name' => 'type',
        'value' => 'me',
        'options' => $options,
    ));
    ?>
    <p class="mt-3"><?php echo ossn_print('removeconversation:alert'); ?></p>
    <input type="hidden" name="id" value="<?php echo $params['guid_to']; ?>" />
    <input type="hidden" name="user" value="<?php echo $params['user']; ?>" />
    <input type="submit" class="hidden" value="<?php echo ossn_print('save'); ?>" id="ossn-md-edit-save"/>
</usev>
