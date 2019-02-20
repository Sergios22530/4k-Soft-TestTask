<?php

namespace app\components;

use yii\db\ActiveRecord;
use yii\web\Controller;

/**
 * Class FrontendController
 * @package frontend\components
 *
 * @property ActiveRecord $model
 * @property string | null $bodyClass
 * @property string $footerAlias
 */
class FrontendController extends Controller
{
    public $model = null;
    public $routeWithoutModel = [];
    public $bodyClass = null;
    public $footerAlias = '//layouts/templates/body-templates/footer';

}