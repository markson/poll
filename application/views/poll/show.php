<?php foreach($poll as $poll_item): ?>
	<h1>This is the <?=$poll_item->id?> poll</h1>
	<p>The title is <?=$poll_item->title?></p>
	<p>The question is <?=$poll_item->question?></p>
	<p>The answer is <?=$poll_item->answer?></p>
<?php endforeach ?>

