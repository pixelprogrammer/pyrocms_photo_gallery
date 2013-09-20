
<div class="one_full">
    <section class="title">
        <h4><?php echo $title; ?></h4>
    </section>
    <section class="item">
        <div class="content">
            <?php echo form_open('', array('class' => 'tabs')); ?>
            <!-- <form class="tabs" action="<?php echo base_url() . 'admin/photo_gallery/edit/' . $gallery->id;?>" method="post"> -->
                <div class="ui-tabs ui-widget ui-widget-content ui-corner-all">
                    <ul class="tab-menu ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
                        <li class="ui-state-default ui-corner-top">
                            <a href="#add-photos" title="">
                                <span>Add Photos</span>
                            </a>
                        </li>
                        <li class="ui-state-default ui-corner-top">
                            <a href="#remove-photos" title="">
                                <span>Photos in Gallery</span>
                            </a>
                        </li>
                        <li class="ui-state-default ui-corner-top">
                            <a href="#gallery-details" title="">
                                <span>Gallery Details</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="ui-tabs-panel ui-widget-content ui-corner-bottom" id="add-photos">
                    <fieldset>
                        <p>Add photos to your Gallery</p>
                        <?php if($images !== false) : ?>
                            <ul class="folders-center" id="add-photos-container">
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
                        <p>Remove photos from your Gallery</p>
                        <?php if($images !== false) : ?>
                            <ul class="folders-center" id="remove-photos-container">
                            <?php foreach($images as $image) : ?>
                                <?php if($image->gallery_id != NULL) : ?>
                                <li class="files-tooltip file type-i remove-image" data-id="<?php echo $image->id;?>" data-name="<?php echo $image->name;?>" original-title>
                                    <img src="<?php echo base_url() . 'files/cloud_thumb/' . $image->id;?>" alt="<?php echo $image->name;?>">
                                    <span class="name-text"><?php echo $image->name;?></span>
                                </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            </ul>
                        <?php else : ?>
                            <div class="no_data">
                                You have not yet added any photos to this Gallery
                            </div>
                        <?php endif; ?>
                    </fieldset>
                </div>
               <div class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide" id="gallery-details">
                    <fieldset>
                        <ul>
                            <li>
                                <label for="gallery-name">Name of Photo Gallery <span>*</span>
                                    
                                </label>
                                <div class="input">
                                    <input id="gallery-name" type="text" name="name" placeholder="Gallery Name" value="<?php echo $gallery->name;?>"></input>
                                </div>
                            </li>
                            <li>
                                <label for="gallery-slug">Permalink</label>
                                <div class="input"><input type="text" name="slug" placeholder="This is optional" value="<?php if($gallery->slug != NULL) { echo $gallery->slug; }?>"></div>
                            </li>
                            <li>
                                <label for="gallery-description">Description</label>
                                <div class="edit-content">
                                    <?php echo form_textarea(array('id' => 'gallery-description', 'name' => 'description', 'value' => $gallery->description, 'rows' => 5, 'class' => 'wysiwyg-simple')) ?>
                                </div>
                            </li>
                            <li>
                                <label for="status">Status</label>
                                <div class="input"><?php echo form_dropdown('status', array('0' => 'Draft', '1' => 'Live'), $gallery->status, 'id="status"') ?></div>
                            </li>
                        </ul>
                    </fieldset>
                </div>
                <input type="hidden" name="gallery_id" value="<?php echo $gallery->id;?>">
                <div class="buttons padding-top clear">
                    <button type="submit" name="btn_action" value="save" class="btn blue">
                        <span>Save</span>
                    </button>
                    <button type="submit" name="btn_action" value="save_exit" class="btn blue">
                        <span>Save &amp; Exit</span>
                    </button>
                    <a href="admin/photo_gallery" class="gray btn cancel">Cancel</a>
                </div>    
            <?php echo form_close(); ?>
        </div>
    </section>
</div>
