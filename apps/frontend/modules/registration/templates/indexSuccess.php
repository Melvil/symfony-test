
<form action="<?php echo url_for('registration/create') ?>" method="post">
	<input type="hidden" name="sf_method" value="put" />
	<table>
	<tfoot>
		<tr>
		<td colspan="2">
			&nbsp;<a href="/"><?php echo __('Back') ?></a>
			<input type="submit" value="<?php echo __('Registration') ?>" />
		</td>
		</tr>
	</tfoot>
	<tbody>
		<?php echo $form ?>
	</tbody>
	</table>
</form>
