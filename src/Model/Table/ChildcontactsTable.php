<?php
namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Childcontacts Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Children
 *
 * @method \App\Model\Entity\Childcontact get($primaryKey, $options = [])
 * @method \App\Model\Entity\Childcontact newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Childcontact[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Childcontact|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Childcontact patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Childcontact[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Childcontact findOrCreate($search, callable $callback = null)
 */
class ChildcontactsTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('childcontacts');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Children', [
            'foreignKey' => 'children_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator) {
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
            ->allowEmpty('homeNumber');

        $validator
            ->requirePresence('mobileNumber', 'create')
            ->notEmpty('mobileNumber');

        $validator
            ->requirePresence('relationshipToChild', 'create')
            ->notEmpty('relationshipToChild');
        $validator
			->requirePresence('streetAddress', 'create')
            ->notEmpty('streetAddress'); 

        $validator
			->requirePresence('suburb', 'create')
            ->notEmpty('suburb');  

        $validator
			->requirePresence('postCode', 'create')
            ->notEmpty('postCode'); 

        //$validator
			//->requirePresence('state', 'create')
            //->notEmpty('state');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->existsIn(['children_id'], 'Children'));

        return $rules;
    }
}
