<?php

namespace app\models;

use app\components\core\ActiveRecord;
use app\components\helpers\StringHelper;
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
            [['category_id', 'title', 'body', 'author_id', 'publish_date'], 'required'],
            [['category_id', 'author_id', 'is_published', 'is_deleted', 'is_blocked'], 'integer'],
            [['body', 'announce'], 'string'],
            [['title', 'title_canonical'], 'string', 'max' => 255],
            [['title_canonical'], 'unique'],
            [['category_id'], 'exist', 'targetClass' => Category::class, 'targetAttribute' => 'id'],
            [['author_id'], 'exist', 'targetClass' => User::class, 'targetAttribute' => 'id'],
            [['title_canonical'], 'validateTitle'],
            [['announce'], 'string', 'min' => 40, 'max' => 100]
        ];
    }

    public function validateTitle()
    {
        if (!$this->title) {
            $this->addError('title', 'Заголовк не может быть пустым');
        }

        if (!$this->title_canonical) {
            $this->title_canonical = StringHelper::transliterate($this->title);
        }
    }

    /**
     * @return ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id'])->onCondition(['categories.is_published' => 1]);
    }

    /**
     * @return ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Profile::class, ['user_id' => 'author_id']);
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

    public function beforeSave($insert)
    {
        $this->updatePostsCounter();

        return parent::beforeSave($insert);
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
}
