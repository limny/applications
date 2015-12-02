<h2><?=CONTACT_CONTACT?></h2>

<form method="post" action="<?=url('contact')?>">

<div class="contact form">
	<?php if (isset($message) && empty($message) === false): ?>
	<div class="message stable <?=$class?>"><?=$message?></div>
	<?php endif ?>

	<div>
		<label><?=CONTACT_NAME?>: <span class="text-red">*</span></label>
		<input name="name" type="text" value="">
	</div>

	<div>
		<label><?=CONTACT_EMAIL?>: <span class="text-red">*</span></label>
		<input name="email" type="text" value="">
	</div>

	<div>
		<label><?=CONTACT_MESSAGE?>: <span class="text-red">*</span></label>
		<textarea name="message" rows="5" cols="40"></textarea>
	</div>

	<div class="buttons">
		<button name="contact_submit" type="submit"><?=CONTACT_SUBMIT?></button>
	</div>
</div>

</form>