<table class="table px-5">
	<thead>
	<tr>
		<th scope="col">Заголовок</th>
		<th scope="col">Содержимое</th>
		<th scope="col">Дата создания</th>
		<th scope="col">Дата обновления</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ( $apiPosts as $post ) { ?>
		<tr>
			<td><?= $post['title'] ?></td>
			<td><?= $post['content'] ?></td>
			<td><?= $post['created_at'] ?></td>
			<td><?= $post['updated_at'] ?></td>
		</tr>
	<?php } ?>
	</tbody>
</table>