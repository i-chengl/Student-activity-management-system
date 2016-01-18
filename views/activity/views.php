<?php
?>
<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">
			<h3>
				预览所有活动
			</h3>
			<table class="table">
				<thead>
					<tr>
						<th>
							编号
						</th>
						<th>
							活动名称
						</th>
						<th>
							组织者学号/工号
						</th>
						<th>
							提交时间
						</th>
						<th>
							举办方
						</th>
					</tr>
				</thead>
				<tbody>

<?php

if($activity){
// 	var_dump($activity);

	foreach ($activity as $act){
		?>
					<tr>
						<td>
							<?= $act['act_id'] ?>
						</td>
						<td>
							<?= $act['act_name'] ?>
						</td>
						<td>
							<?= $act['act_id_submit'] ?>
			
						</td>
						<td>
							<?= $act['act_date_beg'] ?>
						</td>
						<td>
							<?= $act['act_host'] ?>
						</td>
					</tr>
		<?php 
	}
}
?>

				</tbody>
			</table>
		</div>
	</div>
</div>