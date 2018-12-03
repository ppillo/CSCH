<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Hours Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Volunteers
 * @property \Cake\ORM\Association\BelongsTo $Categories
 *
 * @method \App\Model\Entity\Hour get($primaryKey, $options = [])
 * @method \App\Model\Entity\Hour newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Hour[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Hour|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Hour patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Hour[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Hour findOrCreate($search, callable $callback = null, $options = [])
 */
class HoursTable extends Table
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

        $this->table('hours');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Volunteers', [
            'foreignKey' => 'volunteer_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
            'joinType' => 'INNER'
        ]);
    }

    function dateFormatBeforeSave($dateString)
    {
        $newDate = explode("-",$dateString); // Was used to covert / to - in date string for db insert. In your case you are using -
        return $newDate[2]."-".$newDate[1]."-".$newDate[0];
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
            //->date('date')
            ->allowEmpty('date');

        $validator
            ->numeric('hours')
            ->allowEmpty('hours');

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
        $rules->add($rules->existsIn(['category_id'], 'Categories'));

        return $rules;
    }
}
