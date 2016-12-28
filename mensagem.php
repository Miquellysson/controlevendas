<?php
if ( isset($_SESSION['msg']) ){
    $msg = $_SESSION['msg'];
    $alert = '';
    $icon = '';
    //var_dump(strpos($msg, 'Erro'));
    if( strpos($msg, 'sucesso') !== false ){
        $alert = 'alert-success';
        $icon = 'icon fa fa-check';
        //echo 'a';
    }else{
        $alert = 'alert-danger';
        $icon = 'icon fa fa-ban';
        //echo 'b';
    }
?>
    <div class="alert <?php echo $alert; ?> alert-dismissable">
        <h4> <i class="<?php echo $icon; ?>"></i>
<?php
        echo $msg;

?>
        </h4>
    </div>
<?php
}
unset($_SESSION['msg']);
?>
    


