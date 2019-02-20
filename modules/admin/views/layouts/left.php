<?php
use app\modules\admin\helpers\ThemeHelper;
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image" style="height: 40px;">
            </div>
            <div class="pull-left info" style="left: 0px;">
                <p><?= (Yii::$app->getUser()->getIdentity()) ? Yii::$app->getUser()->getIdentity()->username : '' ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [

                    ['label' => 'Слайдер головна', 'icon' => 'picture-o text-'.ThemeHelper::MENU_ITEM_COLOR, 'url' => ['slider/index'], 'active' => (Yii::$app->controller->id == 'slider')],
                    ['label' => 'Новини', 'icon' => 'newspaper-o text-'.ThemeHelper::MENU_ITEM_COLOR, 'url' => ['post/index'], 'active' => (Yii::$app->controller->id == 'post')],
                    [
                        'label' => 'Налаштування',
                        'icon' => 'cog text-'.ThemeHelper::MENU_ITEM_COLOR,
                        'url' => '#',
                        'items' => [
                            ['label' => 'Мови', 'icon' => 'language text-'.ThemeHelper::MENU_ITEM_COLOR, 'url' => ['language/index'], 'active' => (Yii::$app->controller->id == 'language')],
                            [
                                'label' => 'Переклади',
                                'icon' => 'amazon text-'.ThemeHelper::MENU_ITEM_COLOR,
                                'url' => ['source-message/index'],
                                'active' => (Yii::$app->controller->id == 'source-message')
                            ],
                            [
                                'label' => 'Скрипти аналитіки',
                                'icon' => 'area-chart text-'.ThemeHelper::MENU_ITEM_COLOR,
                                'url' => ['/admin/analytics-script'],
                                'active' => (Yii::$app->controller->id == 'analytics-script')
                            ],
                            ['label' => 'Файловый менеджер', 'icon' => 'hdd-o text-'.ThemeHelper::MENU_ITEM_COLOR, 'url' => ['/admin/file-manager'], 'active' => (Yii::$app->controller->id == 'file-manager')],
                        ],
                    ],
                    [
                        'label' => 'Вийти',
                        'url' => ['/site/logout'],
                        'icon' => 'sign-out text-'.ThemeHelper::MENU_ITEM_COLOR,
                        'template' => '<a data-method="post" href="{url}">{icon} {label}</a>'
                    ]
                ],
            ]
        ) ?>
    </section>
</aside>
