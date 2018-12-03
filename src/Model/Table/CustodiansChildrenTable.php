<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CustodiansChildren Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Custodians
 * @property \Cake\ORM\Association\BelongsTo $Children
 *
 * @method \App\Model\Entity\CustodiansChild get($primaryKey, $options = [])
 * @method \App\Model\Entity\CustodiansChild newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CustodiansChild[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CustodiansChild|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CustodiansChild patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CustodiansChild[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CustodiansChild findOrCreate($search, callable $callback = null)
 */
class CustodiansChildrenTable extends Table
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

        $this->table('custodians_children');
        $this->displayField('custodian_id');
        $this->primaryKey(['custodian_id', 'child_id']);

        $this->belongsTo('Custodians', [
            'foreignKey' => 'custodian_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Children', [
            'foreignKey' => 'child_id',
            'joinType' => 'INNER'
        ]);
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
        $rules->add($rules->existsIn(['custodian_id'], 'Custodians'));
        $rules->add($rules->existsIn(['child_id'], 'Children'));

        return $rules;
    }
}
