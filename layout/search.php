<form action="/" method="GET">
    <?php if($c != 'student'): ?>
    <input type="hidden" name="c" value="<?= $c?>">
    <?php endif ?>
    <label class="form-inline justify-content-end">Tìm kiếm: <input type="search" name="search" class="form-control"
            value="<?= $search ?>">
        <button class="btn btn-danger">Tìm</button>
    </label>
</form>