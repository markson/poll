<h2>Create a new poll</h2>
<?=validation_errors()?>
<?=form_open('poll/create')?>
<label title="this should be a short title" for='title'>Title:</label>
<br />
<input id='title' type='text' name='title' />
<br />
<label title="this should be a short title" for='title'>Question:</label>
<br />
<textarea id='question' name='question'></textarea>
<br />
<p>Answers:</p>
<label for='answer1'>Answer 1:</label>
<br />
<textarea id='answer1' name='answer1'></textarea><br />
<label for='answer2'>Answer 2:</label>
<br />
<textarea id='answer2' name='answer2'></textarea><br />

<input name='submit' type='submit' value='Create poll item' />
<?=form_close()?>
