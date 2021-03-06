<form method="post">
    <p>The following information is synced with your identity provider every time you log in, and can't be manually changed.</p>
    <dl>
        <dt>Username</dt>
        <dd><?php echo $context->current_user->uid ?></dd>

        <dt>Name</dt>
        <dd><?php echo $context->current_user->getName() ?></dd>

        <dt>Email Address</dt>
        <dd><?php echo $context->current_user->email ?></dd>

        <dt>Identity Provider</dt>
        <dd><?php echo $context->current_user->provider ?></dd>
    </dl>
    
    <fieldset>
        <legend>Privacy Settings</legend>
        <ul>
            <li>
                <label>
                    Keep my information private
                    <input
                        type="checkbox"
                        name="is_private"
                        value="1"
                        <?php echo ($context->current_user->is_private === 'YES')?'checked="checked"':'' ?>
                        aria-describedby="privacy_details"
                    >
                </label>
                <p id="privacy_details">
                    Your username and provider are considered public, but you can choose to keep other information private, such as your name and email address. Additionally, if you choose to keep your information private, other users can not add you to their sites (unless your provider specifically allows this).
                </p>
            </li>
        </ul>
    </fieldset>
    <?php $csrf_helper->insertToken() ?>
    <button>Save</button>
</form>