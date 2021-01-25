<?php

namespace app\models;

use app\behaviors\NotificationBehavior;
use app\behaviors\SitemapBehavior;
use app\components\core\ActiveRecord;
use app\components\helpers\StringHelper;
use app\components\helpers\Url;
use app\traits\SeoTrait;
use app\traits\CounterTrait;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "publications".
 *
 * @property int $id
 * @property int $category_id
 * @property string $title
 * @property string $title_canonical
 * @property string $body
 * @property string $announce
 * @property int $author_id
 * @property string $publish_date
 * @property int $is_published
 * @property int $is_deleted
 * @property int $is_blocked
 * @property string|null $ts
 *
 * @property User $author
 * @property Category $category
 */
class Publication extends ActiveRecord
{
    use SeoTrait, CounterTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'publications';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'title', 'body', 'author_id'], 'required'],
            [['category_id', 'author_id', 'is_published', 'is_deleted', 'is_blocked'], 'integer'],
            [['body', 'announce'], 'string'],
            ['publish_date', 'default', 'value' => date('Y-m-d H:i:s')],
            [['title', 'title_canonical'], 'string', 'max' => 255],
            [['title_canonical'], 'unique'],
            [['category_id'], 'exist', 'targetClass' => Category::class, 'targetAttribute' => 'id'],
            [['author_id'], 'exist', 'targetClass' => User::class, 'targetAttribute' => 'id'],
            ['title_canonical', 'filter', 'filter' => function ($value) {
                if (!$value) {
                    return StringHelper::transliterate($this->title);
                }
                return $value;
            }],
        ];
    }

    public function behaviors()
    {
        return [
            'notification' => [
                'class' => NotificationBehavior::class
            ],
            'sitemap' => [
                'class' => SitemapBehavior::class,
            ]
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id'])->onCondition(['categories.is_published' => 1])
            ->cache(300);
    }

    /**
     * @return ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Profile::class, ['user_id' => 'author_id'])
            ->cache(300);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Категория',
            'title' => 'Заголовок',
            'title_canonical' => 'Canonical',
            'body' => 'Текст',
            'announce' => 'Анонс',
            'author_id' => 'Автор',
            'publish_date' => 'Время публикации',
            'is_published' => 'Опубликована',
            'is_deleted' => 'Удалена',
            'is_blocked' => 'Заблокирована',
            'ts' => 'Время создания'
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            $counter = new Counter();
            $counter->entity_id = $this->id;
            $counter->entity_table = $this->tableName();
            $counter->save();
        }

        $this->updatePostsCounter();

        parent::afterSave($insert, $changedAttributes);
    }

    public function afterDelete()
    {
        parent::afterDelete();
        $this->updatePostsCounter();
    }

    private function updatePostsCounter()
    {
        /* @var $counter CategoryPublications */
        $counter = CategoryPublications::find()->where([
            'category_id' => $this->category_id
        ])->one();

        $currentCount = Publication::find()->where([
            'is_published' => 1,
            'is_deleted' => 0,
            'is_blocked' => 0,
            'category_id' => $this->category_id
        ])->count();

        $counter->count = $currentCount;
        $counter->save();
    }

    public function getSitemapUrl(): string
    {
        return Url::to(['/main/news/view', 'title_canonical' => $this->title_canonical]);
    }
}
