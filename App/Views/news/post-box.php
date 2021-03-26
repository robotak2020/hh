<div class="col-lg-4 mb-4">
    <div class="card border-0 shadow-sm mb-2">
        <img class="card-img-top mb-2" src="<?php echo assets('images/' . $post->image); ?>" alt="<?php echo $post->title; ?>">
        <div class="card-body bg-light text-center p-4">
            <h4 class=""><?php echo $post->title; ?></h4>
            <div class="d-flex justify-content-center mb-3">
                <small class="mr-3"><i class="fa fa-user text-primary"></i> <?php echo $post->first_name . ' ' . $post->last_name; ?></small>
                <small class="mr-3"><i class="fa fa-folder text-primary"></i> <?php echo $post->category; ?></small>
                <small class="mr-3"><i class="fa fa-comments text-primary"></i> <?php echo $post->total_comments; ?></small>
            </div>
            <p><?php echo html_entity_decode(read_more($post->details, 20)) ;?></p>
            <a href="<?php echo url('/post/' . seo($post->title) . '/' . $post->id); ?>" class="btn btn-primary px-4 mx-auto my-2">Read More</a>
        </div>
    </div>
</div>