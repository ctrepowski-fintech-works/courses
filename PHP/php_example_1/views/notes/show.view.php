<?php require_once base_path('views/partials/head.php'); ?>

<?php require_once base_path('views/partials/nav.php'); ?>

<?php require base_path('views/partials/banner.php'); ?>

    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <p class="mb-6">
                <a href="/notes" class="text-blue-500 hover:underline">
                    Go Back
                </a>
            </p>
            <p>
                <?= htmlspecialchars($note['body']) ?>
            </p>

            <footer class="mt-6">
                <a href="/note/edit?id=<?= $note['id'] ?>"
                   class="text-sm font-semibold leading-6 text-gray-900">Edit</a>
            </footer>
            <form method="post">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="id" value="<?= $note['id'] ?>">
                <button class="text-red-500 underline mt-6">Delete</button>
            </form>
            <!--            <form method="get" action="/note/edit">-->
            <!--                <input type="hidden" name="id" value="--><?php //=$note['id']?><!--">-->
            <!--                <button class="text-blue-500 underline mt-6" >Edit</button>-->
            <!--            </form>-->
        </div>
    </main>

<?php require base_path('views/partials/foot.php');

