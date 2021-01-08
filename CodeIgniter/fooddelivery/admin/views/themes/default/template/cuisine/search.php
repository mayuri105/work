<?php $i= 1; if(!empty($cuisines)): foreach($cuisines as $cuisine): ?>
									<tr>
										<td><input type="checkbox" value="<?= $cuisine->cu_id ?>" class="delete" name="delete[]"></td>
										
										<td>
											
											<?php $upload_path =  $this->config->item('show_upload_path').'/cuisine/'; ?>
											<?php if ($cuisine->cuisine_image_url): ?>
												<img src="<?= $upload_path.$cuisine->cuisine_image_url; ?>" width="50px" height="50px">

											<?php endif ?>
											
										</td>

										<td><?php echo $cuisine->cusine_type ?></td>
										
										<td><?php echo $cuisine->status ? 'Enabled' : 'Disabled' ?></td>
										<td class="text-right">
											<?php $id = $cuisine->cu_id; ?>
											<button class="btn btn-primary" onclick="edit('<?php echo $id; ?>')" data-toggle="modal" href="#myModaledit" data-id="<?php echo $cuisine->cu_id; ?>" >Edit</button>
										</td>
									</tr>
									<?php $i++;endforeach; else: ?>
									<tr class="err_msg"><td colspan="5">cuisine(s) not available.</td></tr>
									<?php endif; ?>