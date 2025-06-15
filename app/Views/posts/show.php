<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($post['title']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8">
                <!-- Post content-->
                <article>
                    <!-- Post header-->
                    <header class="mb-4">
                        <!-- Post title-->
                        <h1 class="fw-bolder mb-1"><?= esc($post['title']) ?></h1>
                        <!-- Post meta content-->
                        <div class="text-muted fst-italic mb-2">Posted on <?= date('F d, Y', strtotime($post['created_at'])) ?> by <?= esc($post['author_name']) ?></div>
                        <!-- Post category-->
                        <a class="badge bg-secondary text-decoration-none link-light" href="#!"><?= esc($post['category_name']) ?></a>
                    </header>
                    <!-- Preview image figure-->
                    <figure class="mb-4"><img class="img-fluid rounded" src="<?= base_url('uploads/thumbnails/' . $post['thumbnail']) ?>" alt="<?= esc($post['title']) ?>" /></figure>
                    <!-- Post content-->
                    <section class="mb-5">
                        <?= $post['content'] ?>
                    </section>
                </article>
            </div>
        </div>
    </div>
</body>
</html>
