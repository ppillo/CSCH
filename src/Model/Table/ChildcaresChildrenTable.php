<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ChildcaresChildren Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Children
 * @property \Cake\ORM\Association\BelongsTo $Childcares
 *
 * @method \App\Model\Entity\ChildcaresChild get($primaryKey, $options = [])
 * @method \App\Model\Entity\ChildcaresChild newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ChildcaresChild[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ChildcaresChild|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ChildcaresChild patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ChildcaresChild[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ChildcaresChild findOrCreate($search, callable $callback = null)
 */
class ChildcaresChildrenTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('childcares_children');
        $this->displayField('child_id');
        $this->primaryKey(['child_id', 'childcare_id']);

        $this->belongsTo('Children', [
            'foreignKey' => 'child_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Childcares', [
            'foreignKey' => 'childcare_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['child_id'], 'Children'));
        $rules->add($rules->existsIn(['childcare_id'], 'Childcares'));

        return $rules;
    }
}
