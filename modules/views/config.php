<?php 
    $siteUrl = get_site_url();
    $stickers = get_option('stickers_list') ? get_option('stickers_list') : [];
    $categories_removed = get_option('categories_removed') ? get_option('categories_removed') : [];

    $baseUrlImage = "https://cdn.jsdelivr.net/emojione/assets/3.1/png/32";
    $categories = [
        "smileys_people" => [
            "name"  => "Pessoas",
            "image" => "$baseUrlImage/1f604.png",
        ],
        "animals_nature" => [
            "name"  => "Animais",
            "image" => "$baseUrlImage/1f439.png",
        ],
        "food_drink" => [
            "name"  => "Comidas",
            "image" => "$baseUrlImage/1f355.png",
        ],
        "activity" => [
            "name"  => "Atividade",
            "image" => "$baseUrlImage/1f3c0.png",
        ],
        "travel_places" => [
            "name"  => "Viagem",
            "image" => "$baseUrlImage/1f680.png",
        ],
        "objects" => [
            "name"  => "Objetos",
            "image" => "$baseUrlImage/1f4a1.png",
        ],
        "symbols" => [
            "name"  => "Simbolos",
            "image" => "$baseUrlImage/1f497.png",
        ],
        "flags" => [
            "name"  => "Bandeiras",
            "image" => "$baseUrlImage/1f1ec-1f1e7.png",
        ],            
    ];
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
    
    <h3>Selecione as categorias para remover ou adicionar</h3>

    <div class="stickers-category-list">
        <?php foreach($categories as $key => $category): ?>
            <span class="item" id="category-<?php echo $key ?>">
                <div>   
                    <img src="<?php echo $category['image'] ?>" />
                </div>
                <small><?php echo $category['name'] ?></small>

                <?php if(in_array($key, $categories_removed)): ?>
                    <span class="dashicons dashicons-plus-alt" onclick="editCategory('<?php echo $key ?>')"></span>
                <?php else : ?>
                    <span class="dashicons dashicons-remove" onclick="editCategory('<?php echo $key ?>')"></span>
                <?php endif; ?>

            </span>
        <?php endforeach; ?>
    </div>

    <a href="javascript:void(0)" class="save button button-primary" onclick="saveStickerList('<?php echo $siteUrl; ?>')">Salvar</a>
</section>