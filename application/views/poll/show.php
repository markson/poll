<?php foreach($poll as $poll_item): ?>
	<h1>This is the <?=$poll_item['id']?> poll</h1>
	<p>The title is <?=$poll_item['title']?></p>
	<p>The description is <?=$poll_item['description']?></p>
<?php endforeach ?>

