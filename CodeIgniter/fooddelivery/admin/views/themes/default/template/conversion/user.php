<?php foreach ($allusers as $us): ?>
<?php if ($this->session->u_id != $us->u_id): ?>
<a href="#" class="list-group-item " onclick="setuseridtype('<?= $us->u_id ?>','user',this)"><?= $us->username; ?></a>
<?php endif ?>
<?php endforeach ?>
<?php foreach ($allmerchant as $ms): ?>
<a href="#" class="list-group-item " onclick="setuseridtype('<?= $ms->m_id ?>','merchant',this)"><?= $ms->business_name; ?></a>
<?php endforeach ?>