<?php
// !empty($_SESSION['success'] nghia la ton tai phan tu co key la success va gia tri khac rong
// !empty doc la co
$message = '';
$classType = '';
if (!empty($_SESSION['success'])) {
    $message = $_SESSION['success'];
    // xoa phan tu co key la success 
    unset($_SESSION['success']);
    $classType = 'alert-success';
} else if (!empty($_SESSION['error'])) {
    $message = $_SESSION['error'];
    // xoa phan tu co key la success 
    unset($_SESSION['error']);
    $classType = 'alert-danger';
}
?>

<?php
if ($message) :
?>
<!-- .alert.alert-success  -->
<div class="alert <?= $classType ?> mt-3">
    <?= $message ?>
</div>
<?php endif ?>