<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Volunteers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Members
 * @property \Cake\ORM\Association\BelongsTo $Categories
 * @property \Cake\ORM\Association\HasMany $Referees
 *
 * @method \App\Model\Entity\Volunteer get($primaryKey, $options = [])
 * @method \App\Model\Entity\Volunteer newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Volunteer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Volunteer|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Volunteer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Volunteer[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Volunteer findOrCreate($search, callable $callback = null)
 */
class VolunteersTable extends Table
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

        $this->table('volunteers');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Members', [
            'foreignKey' => 'member_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Referees', [
            'foreignKey' => 'volunteer_id'
        ]);
		$this->hasMany('Hours', [
            'foreignKey' => 'volunteer_id', 
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

            ->allowEmpty('medicareNumber');

        $validator
            ->allowEmpty('privateHealthFundName');

        $validator
            ->allowEmpty('privateHealthFundNumber');

        $validator
            //->date('volunteerStartDate')
            ->requirePresence('volunteerStartDate', 'create')
            ->notEmpty('volunteerStartDate');

        $validator
            //->date('policeCheckExpiryDate')
            ->allowEmpty('policeCheckExpiryDate');

        $validator
            //->date('workingWithChildrenExpirydate')
            ->allowEmpty('workingWithChildrenExpirydate');

        $validator
            ->boolean('referenceCheckComplete')
            ->allowEmpty('referenceCheckComplete');

        $validator
            ->allowEmpty('workingWithChildrenNumber');

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
        $rules->add($rules->existsIn(['category_id'], 'Categories'));

        return $rules;
    }
}
