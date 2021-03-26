<!-- Breadcrumb -->

<!-- Header Start -->
<div class="container-fluid bg-primary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
        <h3 class="display-3 font-weight-bold text-white">Blog Detail</h3>
        <div class="d-inline-flex text-white">
            <p class="m-0"><a class="text-white" href="">Home</a></p>
            <p class="m-0 px-2">/</p>
            <p class="m-0">Blog Detail</p>
        </div>
    </div>
</div>
<!-- Header End -->


<!-- Detail Start -->
<div class="container py-5">
    <div class="row pt-5">
        <div class="col-lg-8">
            <div class="d-flex flex-column text-left mb-3">
                <p class="section-title pr-5"><span class="pr-2">Blog Detail Page</span></p>
                <h1 class="mb-3"><?php echo $post->title; ?></h1>
                <div class="d-flex">
                    <p class="mr-3"><i class="fa fa-user text-primary"></i> <?php echo $post->first_name . ' ' . $post->last_name; ?></p>
                    <p class="mr-3"><i class="fa fa-folder text-primary"></i> <?php echo $post->category; ?></p>
                    <p class="mr-3"><i class="fa fa-comments text-primary"></i> <?php echo $post->total_comments; ?></p>
                </div>
            </div>
            <div class="mb-5">
                <img class="img-fluid rounded w-100 mb-4" src="<?php echo assets('images/' . $post->image); ?>" alt="<?php echo $post->title; ?>">
                <?php echo htmlspecialchars_decode($post->details); ?>
            </div>

            <!-- Comment List -->
            <div class="mb-5">
                <h2 class="mb-4"><?php echo $post->total_comments; ?> Comments</h2>
                <?php foreach ($post->comments AS $comment) { ?>

                    <div class="media mb-4">
                        <img src="<?php echo assets('images/' . $comment->userImage); ?>" alt="Image" class="img-fluid rounded-circle mr-3 mt-1" style="width: 45px;">
                        <div class="media-body">
                            <h6><?php echo $comment->first_name . ' ' . $comment->last_name; ?> <small><i><?php echo date('d/m/Y h:i A', $comment->created); ?></i></small></h6>
                            <p><?php echo $comment->comment; ?></p>
                        </div>
                    </div>
                <?php } ?>

                <div class="media mb-4"></div>
            </div>

                <!-- Comment Form -->
                <div class="bg-light p-5">
                    <h2 class="mb-4">Leave a comment</h2>
                    <form action="<?php echo url('/post/' . seo($post->title) . '/' . $post->id . '/add-comment'); ?>" method="post" id="comment-form" class="box">

                        <div class="form-group">
                            <label for="comment">comment *</label>
                            <textarea id="comment" name="comment" cols="30" rows="5" class="form-control" required="required"></textarea>
                        </div>
                        <div class="form-group mb-0">
                            <input type="submit" value="Leave Comment" class="btn btn-primary px-3">
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-4 mt-5 mt-lg-0">
                <!-- Author Bio -->
                <div class="d-flex flex-column text-center bg-primary rounded mb-5 py-5 px-4">
                    <img src="<?php echo assets('images/' . $post->userImage); ?>" class="img-fluid rounded-circle mx-auto mb-3" style="width: 100px;">
                    <h3 class="text-secondary mb-3"><?php echo $post->first_name . ' ' . $post->last_name; ?></h3>
                </div>

                <!-- Category List -->
                <div class="mb-5">

                    <h2 class="mb-4">Categories</h2>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($categories AS $category) { ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <a href="<?php echo url('category/' . seo($category->name) . '/' . $category->id); ?>"><?php echo $category->name; ?></a>
                                <span class="badge badge-primary badge-pill"><?php echo $category->total_posts; ?></span>
                            </li>
                        <?php } ?>

                    </ul>
                </div>

    </div>
    <!--/ Post Page  -->
</div>
</div>
<!--/ Main Content -->