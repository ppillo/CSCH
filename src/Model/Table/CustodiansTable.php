<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Custodians Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Members
 * @property \Cake\ORM\Association\BelongsToMany $Children
 *
 * @method \App\Model\Entity\Custodian get($primaryKey, $options = [])
 * @method \App\Model\Entity\Custodian newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Custodian[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Custodian|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Custodian patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Custodian[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Custodian findOrCreate($search, callable $callback = null)
 */
class CustodiansTable extends Table
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

        $this->table('custodians');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Members', [
            'foreignKey' => 'member_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsToMany('Children', [
            'foreignKey' => 'custodian_id',
            'targetForeignKey' => 'child_id',
            'joinTable' => 'custodians_children'
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
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('helpRoster');

        $validator
            ->boolean('childLivingWithYou')
            ->allowEmpty('childLivingWithYou');

        $validator
            ->allowEmpty('relationshipToChild');

        $validator
            ->integer('related_member')
            ->allowEmpty('related_member');

        return $validator;
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
        $rules->add($rules->existsIn(['member_id'], 'Members'));
		$rules->add($rules->existsIn(['member_id'], 'Members'));
		$rules->add($rules->isUnique(['member_id'], 'Members'));
        return $rules;
    }
}
