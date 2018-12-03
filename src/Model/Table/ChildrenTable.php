<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Children Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Childcares
 * @property \Cake\ORM\Association\BelongsToMany $Custodians
 *
 * @method \App\Model\Entity\Child get($primaryKey, $options = [])
 * @method \App\Model\Entity\Child newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Child[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Child|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Child patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Child[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Child findOrCreate($search, callable $callback = null)
 */
class ChildrenTable extends Table
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

        $this->table('children');
        $this->displayField('id');
        $this->primaryKey('id');

		$this->hasMany('Notes', [
            'foreignKey' => 'children_id'
        ]);
        $this->hasMany('Childcontacts', [
            'foreignKey' => 'children_id'
        ]);
        $this->belongsToMany('Childcares', [
            'foreignKey' => 'child_id',
            'targetForeignKey' => 'childcare_id',
            'joinTable' => 'childcares_children'
        ]);
        $this->belongsToMany('Custodians', [
            'foreignKey' => 'child_id',
            'targetForeignKey' => 'custodian_id',
            'joinTable' => 'custodians_children'
        ]);
    }

    //Date Format Code Start

    function dateFormatBeforeSave($dateString)
    {
        $newDate = explode("-",$dateString); // Was used to covert / to - in date string for db insert. In your case you are using -
        return $newDate[2]."-".$newDate[1]."-".$newDate[0];
    }
    //Date Format Code End

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */

    public function validationDefault(Validator $validator)
    {

 //       $validator->add($validator->isUnique(['givenName', 'familyName', 'dateOfBirth', 'streetAddress']));

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
            ->requirePresence('gender', 'create')
            ->notEmpty('gender');

        $validator
            //->date('dateOfBirth')
            ->requirePresence('dateOfBirth', 'create')
            ->notEmpty('dateOfBirth');

        $validator
            ->boolean('isAboriginal')
            ->requirePresence('aboriginal', 'create')
            ->notEmpty('aboriginal');

        $validator
            ->boolean('islander')
            ->requirePresence('islander', 'create')
            ->notEmpty('islander');

        $validator
            ->boolean('allergy')
            ->requirePresence('allergy', 'create')
            ->notEmpty('allergy');

        $validator
            ->boolean('disability')
            ->requirePresence('disability', 'create')
            ->notEmpty('disability');

        $validator
            ->boolean('legal')
            ->requirePresence('legal', 'create')
            ->notEmpty('legal');

        $validator
            ->boolean('immunisation')
            ->requirePresence('immunisation', 'create')
            ->notEmpty('immunisation');

        $validator
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->notEmpty('active');
		
		$validator
            ->allowEmpty('image')
			->add('image',[
					'validExtension' => [
                    'rule' => ['extension',['gif', 'jpeg', 'png', 'jpg']], 
                    'message' => __('File Not supported. Supported files : .png, .jpeg, .gif, .jpg')
                ]]);

        $validator
            ->requirePresence('primary_custodian', 'create')
            ->notEmpty('primary_custodian');

        $validator
            ->requirePresence('streetAddress', 'create')
            ->notEmpty('streetAddress');

        $validator
            ->requirePresence('suburb', 'create')
            ->notEmpty('suburb');

        $validator
            ->requirePresence('postCode', 'create')
            ->notEmpty('postCode');

        $validator
            ->requirePresence('state', 'create')
            ->notEmpty('state');

        return $validator;

    }

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['givenName', 'familyName', 'dateOfBirth', 'streetAddress'],
            'This child already exists in the database'));
        return $rules;
    }


}

