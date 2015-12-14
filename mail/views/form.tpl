<?php if (isset($message_text)): ?>
<p class="message bg-<?=$message_class?>"><?=$message_text?></div>
<?php endif ?>

	<form class="form-horizontal" role="form" method="post">
	<div class="form-group">
		<label for="to" class="col-sm-2 control-label"><?=MAIL_TO?></label>
		<div class="col-sm-10">
			<input name="to" type="text" class="form-control" id="to" value="<?=$to?>">
			<p class="help-block"><?=MAIL_SENTENCE_1?></p>
		</div>
	</div>
	<div class="form-group">
		<label for="subject" class="col-sm-2 control-label"><?=MAIL_SUBJECT?></label>
		<div class="col-sm-10">
			<input name="subject" type="text" class="form-control" id="subject" value="<?=$subject?>">
		</div>
	</div>
	<div class="form-group">
		<label for="message" class="col-sm-2 control-label"><?=MAIL_MESSAGE?></label>
		<div class="col-sm-10">
			<textarea id="message" name="message" class="form-control"><?=$message?></textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button name="mail_send" type="submit" class="btn btn-primary"><?=MAIL_SEND?></button>
		</div>
	</div>
</form>