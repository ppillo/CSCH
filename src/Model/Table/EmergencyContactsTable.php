<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EmergencyContacts Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Members
 *
 * @method \App\Model\Entity\EmergencyContact get($primaryKey, $options = [])
 * @method \App\Model\Entity\EmergencyContact newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EmergencyContact[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EmergencyContact|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EmergencyContact patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EmergencyContact[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EmergencyContact findOrCreate($search, callable $callback = null)
 */
class EmergencyContactsTable extends Table
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

        $this->table('emergency_contacts');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Members', [
            'foreignKey' => 'member_id',
            //'joinType' => 'INNER'
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
            ->requirePresence('givenName', 'create')
            ->notEmpty('givenName');

        $validator
            ->requirePresence('familyName', 'create')
            ->notEmpty('familyName');

        $validator
            ->requirePresence('mobilePhone', 'create')
            ->notEmpty('mobilePhone');

        $validator
            ->allowEmpty('homePhone');

        $validator
            ->requirePresence('relationshipToMember', 'create')
            ->notEmpty('relationshipToMember');

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

        return $rules;
    }

    public function findId($id = null) {
        return $this->exists(['member_id'=> $id ]);

    }


}
