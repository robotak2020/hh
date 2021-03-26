
<!-- Header Start -->
<div class="container-fluid bg-primary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
        <h3 class="display-3 font-weight-bold text-white">Our Blog</h3>
        <div class="d-inline-flex text-white">
            <p class="m-0"><a class="text-white" href="">Home</a></p>
            <p class="m-0 px-2">/</p>
            <p class="m-0">Our Blog</p>
        </div>
    </div>
</div>
<!-- Header End -->

<div class="container-fluid pt-5">
    <div class="container">
        <div class="text-center pb-2">
            <p class="section-title px-5"><span class="px-2">Latest Blog</span></p>
            <h1 class="mb-4">Latest Articles From Blog</h1>
        </div>
        <div class="row pb-3">

        <!-- Main Content -->
    <?php foreach ($posts AS $post) { ?>
        <?php echo $post_box($post);?>
    <?php } ?>

            <div class="col-md-12 mb-4">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center mb-0">
                        <li class="page-item">
                            <a class="page-link" href="<?php echo $url . $pagination->prev(); ?>" aria-label="">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        <?php for ($page = 1; $page <= $pagination->last(); $page++) { ?>

                        <li <?php echo $page == $pagination->page() ? ' class="page-item active"': false; ?>><a class="page-link" href="<?php echo $url . $page; ?>"><?php echo $page; ?></a></li>
                        <?php } ?>

                        <li class="page-item">
                            <a class="page-link" href="<?php echo $url . $pagination->next(); ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
<!--/ Main Content --></div>
    </div>
</div>