<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\HasMany $Custodians
 * @property \Cake\ORM\Association\HasMany $Members
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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

        $this->table('users');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Custodians', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Members', [
            'foreignKey' => 'user_id'
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
            ->add(
                'username',
                [
                    'minLength' => [
                        'rule' => 'validateUnique',
                        'provider' => 'table',
                        'message' => 'This username is already taken!'
                    ],
                ]
            )
            ->notEmpty('username', 'Username required!');

        //Password and confirm password validation

        $validator
            ->add(
                'password',
                [
                    'minLength' => [
                        'rule' => array('custom','(^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]*).{8,}$)'),
//                        'rule' => ['minLength', 6],
                        'message' => 'Password should contain: 8 characters, 1 upper case, 1 lower case, 1 number.'
                    ],
                ]
            )
            ->requirePresence('password', 'create', 'Password is required!')
            ->notEmpty('password', 'Password is required!');


        $validator
            ->requirePresence('cPassword', 'create', 'Password is required!')
            ->notEmpty('cPassword', 'Please confirm password')
            ->add(
                'cPassword',
                'custom',
                [
                    'rule' => function ($value, $context) {
                        if (isset($context['data']['password']) && $value == $context['data']['password']) {
                            return true;
                        }
                        return false;
                    },
                    'message' => 'Sorry, passwords do not match'
                ]
            );


        $validator
            ->notEmpty('role');

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
        $rules->add($rules->isUnique(['username']));

        return $rules;
    }
}
