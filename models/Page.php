<?php

namespace app\models;

use app\behaviors\SitemapBehavior;
use app\components\core\ActiveRecord;
use app\components\helpers\Url;
use app\traits\CounterTrait;
use app\traits\SeoTrait;
use Yii;

/**
 * This is the model class for table "pages".
 *
 * @property int $id
 * @property string $title_canonical
 * @property string $title
 * @property int $user_id
 * @property int $order
 * @property string $content
 * @property string|null $ts
 * @property int $is_published
 */
class Page extends ActiveRecord
{
    use CounterTrait, SeoTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title_canonical', 'title', 'user_id', 'content', 'order'], 'required'],
            [['user_id'], 'default', 'value' => Yii::$app->user->id],
            [['user_id', 'is_published', 'order'], 'integer'],
            [['content'], 'string'],
            [['ts'], 'default', 'value' => date('Y-m-d H:i:s')],
            [['title_canonical', 'title'], 'string', 'max' => 255],
        ];
    }

    public function behaviors()
    {
        return [
            'sitemap' => [
                'class' => SitemapBehavior::class
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title_canonical' => 'Canonical',
            'title' => 'Заголовок',
            'user_id' => 'Пользователь',
            'content' => 'Содержимое',
            'ts' => 'Ts',
            'is_published' => 'Опубликована',
        ];
    }

    public function getSitemapUrl()
    {
        return Url::to(['/main/default/page', 'title_canonical' => $this->title_canonical]);
    }
}
