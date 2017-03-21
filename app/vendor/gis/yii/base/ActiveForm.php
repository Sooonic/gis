<?php
namespace gis\yii\base;

use yii\base\Exception;

abstract class ActiveForm extends Model
{

    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';
    const SCENARIO_DELETE = 'delete';

    /**
     * Returns the primary key name(s) for this AR class.
     * The default implementation will return the primary key(s) as declared
     * in the DB table that is associated with this AR class.
     *
     * If the DB table does not declare any primary key, you should override
     * this method to return the attributes that you want to use as primary keys
     * for this AR class.
     *
     * Note that an array should be returned even for a table with single primary key.
     *
     * @throws Exception
     * @return string[] the primary keys of the associated database table.
     */
    public static function primaryKey(): array
    {
        throw new Exception('Method find must be overridden');
    }

    abstract public function delete(): bool;

    abstract public function view(): bool;

    abstract public function viewAll(): bool;

    abstract public function save($runValidation = true, $attributeNames = null): bool;

    /**
     * Returns the primary key value(s).
     * @param bool $asArray whether to return the primary key value as an array. If `true`,
     * the return value will be an array with column names as keys and column values as values.
     * Note that for composite primary keys, an array will always be returned regardless of this parameter value.
     * @property mixed The primary key value. An array (column name => column value) is returned if
     * the primary key is composite. A string is returned otherwise (null will be returned if
     * the key value is null).
     * @return mixed the primary key value. An array (column name => column value) is returned if the primary key
     * is composite or `$asArray` is `true`. A string is returned otherwise (null will be returned if
     * the key value is null).
     */
    public function getPrimaryKey($asArray = false)
    {
        $keys = $this->primaryKey();
        $attributes = $this->getAttributes();
        if (!$asArray && count($keys) === 1) {
            return $attributes[$keys[0]] ?? $attributes[$keys[0]];
        } else {
            $values = [];
            foreach ($keys as $name) {
                $values[$name] = $attributes[$name] ?? null;
            }

            return $values;
        }
    }
}