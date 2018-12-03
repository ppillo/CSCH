<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Referees Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Volunteers
 *
 * @method \App\Model\Entity\Referee get($primaryKey, $options = [])
 * @method \App\Model\Entity\Referee newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Referee[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Referee|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Referee patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Referee[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Referee findOrCreate($search, callable $callback = null)
 */
class RefereesTable extends Table
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

        $this->table('referees');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('Volunteers', [
            'foreignKey' => 'volunteer_id',
            'joinType' => 'INNER'
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
            ->allowEmpty('name');

        $validator
            ->allowEmpty('phone');

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
        $rules->add($rules->existsIn(['volunteer_id'], 'Volunteers'));

        return $rules;
    }
}
