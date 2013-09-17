<div class="one-full">
    <section class="title">
        <h4><?php echo $title; ?></h4>
    </section>
    <section class="item">
        <div class="content">
            <?php if($galleries !== false) : ?>
                <form action="admin/photo_gallery/action">
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Photos in Gallery</th>
                                <th>Permalink</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($galleries as $gallery) : ?>
                                <tr>
                                    <td><?php echo $gallery->name; ?></td>
                                    <td><?php echo $gallery->description;?></td>
                                    <td><?php echo $gallery->num_photos;?></td>
                                    <td><?php echo $gallery->slug; ?></td>
                                    <td>
                                        <a href="admin/photo_gallery/edit/<?php echo $gallery->id;?>" class="button" title="Edit">Edit</a>
                                        <a href="admin/photo_gallery/delete/<?php echo $gallery->id;?>" class="button" title="Delete">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </form>
            <?php else : ?>
                <div class="no_data">
                    You have not yet added any Photo Galleries. Click the Add Gallery button in the top right to add a Photo Gallery.
                </div>
            <?php endif; ?>
        </div>
    </section>
</div>


