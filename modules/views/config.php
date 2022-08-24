<?php 
    $siteUrl = get_site_url();
    $stickers = get_option('stickers_list') ? get_option('stickers_list') : [];
?>

<section class="config-page">
    <div class="alert alert-info page-alert" style="display: none;">
        <span class="dashicons close dashicons-no-alt" onclick="closeAlert()"></span>
        <span class="message">Salvo com sucesso!</span> 
    </div>
    <a href="jascript:void(0)" class="save button button-primary" onclick="uploadSticker()">Upload Sticker</a>
   
    <div class="stickers-list">
        <?php if(!empty($stickers)): ?>
            <?php foreach($stickers as $id => $sticker): ?>
                <span id="sticker-<?php echo $id ?>" class="sticker-item-list">
                    <span class="dashicons dashicons-trash" onclick="deleteSticker(<?php echo $id ?>)"></span>
                    <img src="<?php echo $siteUrl . $sticker ?>">
                </span>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <a href="javascript:void(0)" class="save button button-primary" onclick="saveStickerList('<?php echo $siteUrl; ?>')">Salvar</a>
</section>