
<div class="one_full">
    <section class="title">
        <h4><?php echo $title; ?></h4>
    </section>
    <section class="item">
        <div class="content">
            <?php  echo form_open(); ?>
                <div class="form_inputs">
                    <fieldset>
                        <ul>
                            <li>
                                <label for="gallery-name">Name of Photo Gallery <span>*</span>
                                    
                                </label>
                                <div class="input">
                                    <input id="gallery-name" type="text" name="name" placeholder="Gallery Name" value=""></input>
                                </div>
                            </li>
                            <li>
                                <label for="gallery-slug">Permalink</label>
                                <div class="input"><input type="text" name="slug" placeholder="This is optional"></div>
                            </li>
                            <li>
                                <label for="gallery-description">Description</label>
                                <div class="edit-content">
                                    <?php echo form_textarea(array('id' => 'gallery-description', 'name' => 'description', 'value' => '', 'rows' => 5, 'class' => 'wysiwyg-simple')) ?>
                                </div>
                            </li>
                            <li>
                                <label for="status">Status</label>
                                <div class="input"><?php echo form_dropdown('status', array('0' => 'Draft', '1' => 'Live'), 0, 'id="status"') ?></div>
                            </li>
                        </ul>
                    </fieldset>
                    <div class="buttons">
                        <button type="submit" name="btn_action" value="save" class="btn blue">
                            <span>Create</span>
                        </button>
                        <button type="submit" name="btn_action" value="save_exit" class="btn blue">
                            <span>Create &amp; Exit</span>
                        </button>
                        <a href="admin/photo_gallery" class="gray btn cancel">Cancel</a>
                    </div>
                </div>
            <?php echo form_close(); ?>
        </div>
    </section>
</div>