<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Programs Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Categories
 * @property \Cake\ORM\Association\BelongsToMany $Members
 *
 * @method \App\Model\Entity\Program get($primaryKey, $options = [])
 * @method \App\Model\Entity\Program newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Program[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Program|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Program patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Program[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Program findOrCreate($search, callable $callback = null)
 */
class ProgramsTable extends Table
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

        $this->table('programs');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsToMany('Members', [
            'foreignKey' => 'program_id',
            'targetForeignKey' => 'member_id',
            'joinTable' => 'members_programs'
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
            ->notEmpty('name')
            ->add(
                'name',
                [
                    'minLength' => [
                        'rule' => 'validateUnique',
                        'provider' => 'table',
                        'message' => 'A program with the same name already exists'
                    ],
                ]
            );

        $validator
            ->dateTime('date')
            ->notEmpty('date');

        $validator
            ->allowEmpty('id', 'classsize');

        $validator
            ->notEmpty('type');

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
        //$rules->add($rules->isUnique(['name'], 'A program with the same name already exists'));
        $rules->add($rules->existsIn(['category_id'], 'Categories'));

        return $rules;
    }
}
