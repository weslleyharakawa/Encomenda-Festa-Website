<?php if(!isset($_SESSION['admin'])){echo 'Hacking attempted'; return ;} ?>
 <tr class="<?php echo $color; ?>">
     	<td><?php print($category_list[$i]["email"]); ?></td>
     	<td class="center"><?php echo date("D j M Y",$category_list[$i]["date"]) ?></td>
	 <td class="center"><?php print($category_list[$i]["ip"]); ?></td>
	<td class="center"><a href="admin.php?action=edit&amp;num=<?php echo $i; ?>&amp;del=true&amp;email=<?php print($category_list[$i]['email']); ?>" title="delete <?php print($category_list[$i]['email']); ?>"><img src="admin/images/delete.gif" alt="delete" /></a></td>
</tr>
