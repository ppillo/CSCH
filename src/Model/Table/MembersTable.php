<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use ArrayObject;
use Cake\Event\Event;
use Cake\ORM\Entity;

/**
 * Members Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\HasMany $Custodians
 * @property \Cake\ORM\Association\HasMany $EmergencyContacts
 * @property \Cake\ORM\Association\HasMany $Volunteers
 * @property \Cake\ORM\Association\BelongsToMany $Categories
 * @property \Cake\ORM\Association\BelongsToMany $Programs
 *
 * @method \App\Model\Entity\Member get($primaryKey, $options = [])
 * @method \App\Model\Entity\Member newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Member[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Member|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Member patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Member[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Member findOrCreate($search, callable $callback = null)
 */
class MembersTable extends Table
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

        $this->table('members');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Custodians', [
            'foreignKey' => 'member_id'
        ]);
        $this->hasMany('EmergencyContacts', [
            'foreignKey' => 'member_id'
        ]);
        $this->hasMany('Volunteers', [
            'foreignKey' => 'member_id'
        ]);
        $this->belongsToMany('Categories', [
            'foreignKey' => 'member_id',
            'targetForeignKey' => 'category_id',
            'joinTable' => 'categories_members'
        ]);
        $this->belongsToMany('Programs', [
            'foreignKey' => 'member_id',
            'targetForeignKey' => 'program_id',
            'joinTable' => 'members_programs'
        ]);
    }


    //Date Format Code Start
    function beforeSave(Event $event, Entity $member, ArrayObject $options)
    {
        //$member = $event->data['entity'];
        //$member->dateOfBirth = $this->dateFormatBeforeSave($member->dateOfBirth);
        //return true;
    }

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
            //->date('dateOfBirth')
            ->requirePresence('dateOfBirth', 'create')
            ->notEmpty('dateOfBirth');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

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

        $validator
            ->allowEmpty('homePhone');

		$validator
            ->allowEmpty('related_member');

        $validator
            ->requirePresence('mobilePhone', 'create')
            ->notEmpty('mobilePhone');

        $validator
            ->requirePresence('tier', 'create')
            ->notEmpty('tier');

        $validator
            ->boolean('newsletter')
            ->requirePresence('newsletter', 'create')
            ->notEmpty('newsletter');

        $validator
            ->requirePresence('gender', 'create')
            ->notEmpty('gender');

        $validator
            ->boolean('voting')
            ->requirePresence('voting', 'create')
            ->notEmpty('voting');

        $validator
            //->date('signupDate')
            ->requirePresence('signupDate', 'create')
            ->notEmpty('signupDate');

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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }


}
