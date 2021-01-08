
<div class="wrapper-right fx">
    <div class="carousel-fullscreen-sidebar">
        <pre>
        <div class="">
            <?= $msg ?>
        </div>
        
        <?php if($xml){ ?>
            <pre>
                <?php print_r($xml); ?>
            </pre>
        <?php } ?>
        <?php print_r($this->session->userdata()) ?>
    </div>
</div>
        
