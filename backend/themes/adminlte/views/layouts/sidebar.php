<?php
use yii\helpers\Url;
use common\helpers\Myfunctions;
use backend\modules\listing\models\ListingCategory;
?>
<?php $categories = ListingCategory::getCategoryPk(); ?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo Url::to('site/index') ?>" class="brand-link">
        <img src="<?=$assetDir?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">MillerCMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?=$assetDir?>/img/avatar.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo Yii::$app->user->identity->getUserFullName() ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            //Myfunctions::echoArray(Url::current());
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    //[
                        //'label' => 'Starter Pages',
                        //'icon' => 'tachometer-alt',
                        //'badge' => '<span class="right badge badge-info">2</span>',
                        //'items' => [
                            //['label' => 'Active Page', 'url' => ['site/index'], 'iconStyle' => 'far'],
                            //['label' => 'Inactive Page', 'iconStyle' => 'far'],
                        //]
                    //],
                    //['label' => 'Simple Link', 'icon' => 'th', 'badge' => '<span class="right badge badge-danger">New</span>'],
                    ['label' => 'Yii2 PROVIDED', 'header' => true],
                    ['label' => 'Login', 'url' => ['site/login'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],
                    ['label' => 'Gii',  'icon' => 'file-code', 'url' => ['/gii'], 'target' => '_blank'],
                    ['label' => 'Debug', 'icon' => 'bug', 'url' => ['/debug'], 'target' => '_blank'],
                    //['label' => 'MULTI LEVEL EXAMPLE', 'header' => true],
                    //['label' => 'Level1'],
                    ['label' => 'Listings',
                        'items' => [
                            ['label' => 'Dešavanja', 'iconStyle' => 'far', 'icon' => 'dot-circle', 'url' => ['/listing/listingitem/', 'id' => 'desavanja'], 'options' => ['id' => 'desavanja']],
                            ['label' => 'Obaveštenja', 'iconStyle' => 'far', 'icon' => 'dot-circle', 'url' => ['/listing/listingitem/', 'id' => 'obavestenja'], 'options' => ['id' => 'obavestenja']],

                        ],
                    ],
                    ['label' => 'Menus',
                    'items' => [
                        ['label' => 'Menus', 'iconStyle' => 'far', 'icon' => 'dot-circle', 'url' => ['/menu/menucategory/'], 'options' => ['id' => 'menucategory']],
                    ],
                    ],
                    ['label' => 'Administration',
                        'items' => [
                            ['label' => 'Content', 'iconStyle' => 'far', 'icon' => 'dot-circle', 'url' => ['/content'], 'options' => ['id' => 'content']],
                            //[
                                //'label' => 'Level2',
                                //'iconStyle' => 'far',
                                //'items' => [
                                    //['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle'],
                                    //['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle'],
                                    //['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle']
                                //]
                            //],

                            ['label' => 'Pages', 'iconStyle' => 'far', 'icon' => 'dot-circle', 'url' => ['/page'], 'options' => ['id' => 'page']],
                            ['label' => 'Templates', 'iconStyle' => 'far', 'icon' => 'dot-circle', 'url' => ['/template'], 'options' => ['id' => 'template']],
                            ['label' => 'Sectors', 'iconStyle' => 'far', 'icon' => 'dot-circle', 'url' => ['/sector'], 'options' => ['id' => 'sector']],
                            ['label' => 'Widgets', 'iconStyle' => 'far', 'icon' => 'dot-circle', 'url' => ['/widget'], 'options' => ['id' => 'widget']],
                            ['label' => 'Widget Types', 'iconStyle' => 'far', 'icon' => 'dot-circle', 'url' => ['/widget-type'], 'options' => ['id' => 'widget-type']],
                            ['label' => 'Users', 'iconStyle' => 'far', 'icon' => 'dot-circle', 'url' => ['/user'], 'options' => ['id' => 'user']],
                        ]
                    ],
                    //['label' => 'Level1'],
                    //['label' => 'LABELS', 'header' => true],
                    //['label' => 'Important', 'iconStyle' => 'far', 'iconClassAdded' => 'text-danger'],
                    //['label' => 'Warning', 'iconClass' => 'nav-icon far fa-circle text-warning'],
                    //['label' => 'Informational', 'iconStyle' => 'far', 'iconClassAdded' => 'text-info'],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<?php
$controllerName = Yii::$app->controller->id;
$moduleName = Yii::$app->controller->module->id;
$getName = Yii::$app->request->get('id');
//Myfunctions::echoArray(gettype($getName));
if (isset($getName) && ($moduleName === 'listing') && ($moduleName !== 'app-backend')){
    $ret = $getName;
    $attr = 'search';
}else{
    $ret = $controllerName;
    $attr = 'pathname';
}
$this->registerJs(<<<JS
    var pathname = $(location).attr("${attr}");
    //alert(pathname);
    $(".nav-item").each( function () {

          if($(this).attr("id") === "${ret}") {
              $(this).parents("li.has-treeview").addClass('active menu-open');
              $(this).children("a").children("i").removeClass("far").addClass("fas");
              
          }

    });
JS
);

?>
















