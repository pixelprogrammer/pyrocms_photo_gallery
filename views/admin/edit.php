
<div class="one_full">
    <section class="title">
        <h4><?php echo $title; ?></h4>
    </section>
    <section class="item">
        <div class="content">
            <form class="tabs" action="" method="post">
                <div class="ui-tabs ui-widget ui-widget-content ui-corner-all">
                    <ul class="tab-menu ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
                        <li class="ui-state-default ui-corner-top">
                            <a href="#add-photos" title="">
                                <span>Add Photos</span>
                            </a>
                        </li>
                        <li class="ui-state-default ui-corner-top">
                            <a href="#remove-photos" title="">
                                <span>Remove Photos</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="ui-tabs-panel ui-widget-content ui-corner-bottom" id="add-photos">
                    <fieldset>
                        <?php if($images !== false) : ?>
                            <ul class="folders-center">
                            <?php foreach($images as $image) : ?>
                                <?php if($image->gallery_id == NULL) : ?>
                                <li class="files-tooltip file type-i add-image" data-id="<?php echo $image->id;?>" data-name="<?php echo $image->name;?>" original-title>
                                    <img src="<?php echo base_url() . 'files/cloud_thumb/' . $image->id;?>" alt="<?php echo $image->name;?>">
                                    <span class="name-text"><?php echo $image->name;?></span>
                                </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                     </fieldset>
                </div>
                <div class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide" id="remove-photos">
                    <fieldset>
                        <?php if($images !== false) : ?>
                            <ul class="folders-center">
                            <?php foreach($images as $image) : ?>
                                <?php if($image->gallery_id != NULL) : ?>
                                <li class="files-tooltip file type-i remove-image" data-id="<?php echo $image->id;?>" data-name="<?php echo $image->name;?>" original-title>
                                    <img src="<?php echo base_url() . 'files/cloud_thumb/' . $image->id;?>" alt="<?php echo $image->name;?>">
                                    <span class="name-text"><?php echo $image->name;?></span>
                                </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </fieldset>
                </div>
               
                <input type="hidden" name="gallery_id" value="<?php echo $gallery->id;?>">
                <div class="buttons padding-top clear">
                    <button class="btn blue" name="btn_action" value="save" type="submit">
                        <span>Save</span>
                    </button>
                </div>    
            </form>
        </div>
    </section>
</div>
