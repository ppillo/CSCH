<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Childcares Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Children
 *
 * @method \App\Model\Entity\Childcare get($primaryKey, $options = [])
 * @method \App\Model\Entity\Childcare newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Childcare[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Childcare|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Childcare patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Childcare[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Childcare findOrCreate($search, callable $callback = null)
 */
class ChildcaresTable extends Table
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

        $this->table('childcares');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsToMany('Children', [
            'foreignKey' => 'childcare_id',
            'targetForeignKey' => 'child_id',
            'joinTable' => 'childcares_children'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->notEmpty('id', 'create');

        $validator
            ->notEmpty('day');

        $validator
            ->notEmpty('time');

        $validator
            ->notEmpty('type');

        return $validator;
    }
}
