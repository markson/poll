<?=validation_errors()?>
<h1><?=$poll[0]->title?></h1>
<h2><?=$poll[0]->question?></h2>
<?=form_open('poll/vote')?>
<select name='answer_id'>
<?php foreach($poll as $poll_item): ?>
<option value=<?=$poll_item->id?> ><?=$poll_item->answer?></option>
<?php endforeach ?>
</select>
<input type='submit' value='vote' />
</form>
