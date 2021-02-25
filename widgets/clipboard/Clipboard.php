<?php

namespace app\widgets\clipboard;

use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use yii\web\View;

class Clipboard extends \Eddmash\Clipboard\Clipboard
{
    public static function input(View $view, $type, $name = null, $value = null, $options = [], $action = null)
    {
        if ($action === null):
            $action = self::COPY;
        endif;

        return self::asHtml($view, $type, $action, $name, $value, $options);
    }

    /**
     * @inheritdoc
     */
    private static function asHtml(View $view, $type, $action, $name = null, $value = null, $options = [])
    {
        if (!isset($options['type'])) {
            $options['type'] = $type;
        }
        $options['name'] = $name;
        $options['value'] = $value === null ? null : (string) $value;

        $id = ArrayHelper::getValue($options, 'id', false);
        if ($id === false):
            $id = $name;
        endif;

        Html::addCssClass($options, 'form-control');
        Html::addCssClass($options, $name);

        $icon = '<i class="fa fa-clipboard ml-3"></i>';

        $content = Html::tag('div',
            Html::tag('div',
                Html::tag('input', '', $options).
                Html::tag('span', $icon, [
                        'data-clipboard-target' => '#'.$id,
                        'data-clipboard-action' => $action,
                        'class' => 'input-group-addon btn-'.$id,
                        'style' => 'cursor:pointer;',
                    ]
                ),
                ['class' => 'input-group']),
            ['class' => 'clearfix']
        );

        $view->registerJs("new ClipboardJS('.btn-".$id."')");

        return $content;
    }

}
